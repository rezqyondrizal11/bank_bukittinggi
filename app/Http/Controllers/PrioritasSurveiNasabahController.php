<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\JadwalSurvei;
use App\Models\Kriteria;
use App\Models\NasabahDisetujui;
use App\Models\PengajuanNasabah;
use App\Models\PengajuanNasabahDokumen;
use App\Models\PengajuanNasabahPasangan;
use App\Models\PengajuanNasabahPembiayaan;
use App\Models\PengajuanNasabahPenilaian;
use App\Models\PengajuanNasabahReview;
use App\Models\PrioritasSurveiCalonNasabah;
use App\Models\PrioritasSurveiCalonNasabahPenilaian;
use App\Models\PrioritasSurveiCalonNasabahPenilaianDetail;
use App\Models\PrioritasSurveiCalonNasabahSurveyor;
use App\Models\StatusPengajuanLog;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon as CarbonAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PrioritasSurveiNasabahController extends Controller
{

    public function index()
    {
        $data = PrioritasSurveiCalonNasabah::with([
            'pengajuanNasabah',
            'pengajuanNasabah.nasabah',
            'pengajuanNasabah.jadwalSurvei',
            'pengajuanNasabah.jadwalSurvei.user',
        ])
            ->where('status_terpilih', 1)
            ->orderBy('nilai_preferensi', 'desc')
            ->get();

        $surveyor = User::where('role', 'ao')->get();

        return view('prioritas_survei.index', compact('data', 'surveyor'));
    }

    public function show($id)
    {
        $pengajuan = PengajuanNasabah::with([
            'nasabah',
            'pasangan',
            'dokumen',
            'penilaians',
            'penilaians.kriteria',
            'penilaians.subKriteria',
            'barangs',
            'jadwalSurvei',
            'jadwalSurvei.user',
            'jadwalSurvei.details',
            'statusLogs',
        ])->findOrFail($id);

        $prioritas = PrioritasSurveiCalonNasabah::where('id_pengajuan', $id)->first();

        return view('prioritas_survei.show', compact('pengajuan', 'prioritas'));
    }

    public function assignSurveyor(Request $request)
    {
        $request->validate([
            'id_pengajuan'  => 'required|exists:pengajuan,id_pengajuan',
            'id_ao'         => 'required|exists:users,id_user',
            'tanggal_survei' => 'required|date',
        ]);

        $sudahAda = JadwalSurvei::where('id_pengajuan', $request->id_pengajuan)->exists();
        if ($sudahAda) {
            return back()->with('error', 'Surveyor sudah pernah di-assign untuk pengajuan ini.');
        }

        JadwalSurvei::create([
            'id_pengajuan'   => $request->id_pengajuan,
            'id_ao'          => $request->id_ao,
            'tanggal_survei' => $request->tanggal_survei,
        ]);

        return back()->with('success', 'Surveyor berhasil di-assign.');
    }

    public function storePenilaian(Request $request)
    {
        $request->validate([
            'id_pengajuan'            => 'required|exists:pengajuan,id_pengajuan',
            'dokumen'                 => 'required|array',
            'dokumen.*.jenis_dokumen' => 'required|string',
            'dokumen.*.opsi'          => 'required|in:Ada,Tidak Ada',
            'dokumen.*.keterangan'    => 'nullable|string',
            'dokumen.*.file'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'note'                    => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $jadwal = JadwalSurvei::where('id_pengajuan', $request->id_pengajuan)->firstOrFail();

            foreach ($jadwal->details as $detail) {
                if ($detail->file_path) {
                    Storage::disk('public')->delete($detail->file_path);
                }
            }
            $jadwal->details()->delete();

            foreach ($request->dokumen as $i => $dok) {
                $filePath = null;

                if ($request->hasFile("dokumen.$i.file")) {
                    $filePath = $request->file("dokumen.$i.file")
                        ->store('uploads/survei', 'public');
                }

                PrioritasSurveiCalonNasabahPenilaianDetail::create([
                    'id_survei'     => $jadwal->id_survei,
                    'jenis_dokumen' => $dok['jenis_dokumen'],
                    'opsi'          => $dok['opsi'],
                    'keterangan'    => $dok['keterangan'] ?? null,
                    'file_path'     => $filePath,
                ]);
            }

            $jadwal->update(['note' => $request->note]);

            PrioritasSurveiCalonNasabah::where('id_pengajuan', $request->id_pengajuan)
                ->update(['status_terpilih' => 2]);

            if (!Akad::where('id_pengajuan', $request->id_pengajuan)->exists()) {

                $pengajuan = PengajuanNasabah::with('periode')->findOrFail($request->id_pengajuan);

                $direksi = User::where('role', 'direksi')
                    ->where('status_aktif', 1)
                    ->first();

                $nomorUrut = Akad::count() + 1;

                $kodeBank = 'BPRS-JG';
                $kodeAkad = 'MRB';
                $tahun    = now()->year;

                $periode       = $pengajuan->periode;
                $periodeString = '';
                if ($periode) {
                    $bulanMulai   = \Carbon\Carbon::parse($periode->tanggal_mulai)->format('m');
                    $tahunMulai   = \Carbon\Carbon::parse($periode->tanggal_mulai)->format('y');
                    $bulanSelesai = \Carbon\Carbon::parse($periode->tanggal_selesai)->format('m');
                    $tahunSelesai = \Carbon\Carbon::parse($periode->tanggal_selesai)->format('y');
                    $periodeString = $bulanMulai . $tahunMulai . '-' . $bulanSelesai . $tahunSelesai;
                }

                $noAkad = 'No. ' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT)
                    . '/' . $kodeBank
                    . '/' . $kodeAkad
                    . '/' . $periodeString
                    . '/' . $tahun;

                Akad::create([
                    'id_pengajuan'       => $request->id_pengajuan,
                    'id_direksi'         => $direksi?->id_user,
                    'nomor_urut'         => $nomorUrut,
                    'kode_bank'          => $kodeBank,
                    'kode_akad'          => $kodeAkad,
                    'tahun'              => $tahun,
                    'no_akad'            => $noAkad,
                    'tanggal_akad'       => now()->toDateString(),
                    'jangka_waktu_bulan' => $pengajuan->jangka_waktu_bulan,
                    'harga_pokok'        => $pengajuan->jumlah_permohonan,
                    'uang_muka'          => 1750000,
                    'pembiayaan_bank'    => $pengajuan->jumlah_permohonan,
                    'margin'             => null,
                    'harga_jual'         => null,
                    'subsidi_pemko'      => 1750000,
                    'beban_nasabah'      => null,
                    'piutang_murabahah'  => null,
                    'angsuran_bulanan'   => null,
                    'status_pembiayaan'  => 'draft',
                ]);
            }

            StatusPengajuanLog::create([
                'id_pengajuan'   => $request->id_pengajuan,
                'status'         => 'surveyed',
                'tanggal_status' => now(),
                'keterangan'     => 'Survei lapangan telah dilakukan oleh ' . Auth::user()->name
                    . ($request->note ? '. Catatan: ' . $request->note : ''),
            ]);

            DB::commit();

            return back()->with('success', 'Penilaian survei berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function perhitungan()
    {
        $kriterias = Kriteria::with('subKriterias')->get();
        $pengajuanNasabah = PengajuanNasabah::with([
            'penilaians.subKriteria'
        ])
            ->where('status_pengajuan', 'approved')
            ->whereDoesntHave('nasabahDisetujui')
            ->get();
        $minMax = [];

        foreach ($kriterias as $kriteria) {

            $values = [];

            foreach ($pengajuanNasabah as $nasabah) {

                $penilaian = $nasabah->penilaians
                    ->where('kriteria_id', $kriteria->id_kriteria)
                    ->first();

                if ($penilaian && $penilaian->subKriteria) {
                    $values[] = $penilaian->subKriteria->nilai;
                }
            }

            $minMax[$kriteria->id_kriteria] = [
                'min' => count($values) ? min($values) : 0,
                'max' => count($values) ? max($values) : 0,
            ];
        }

        $results = [];
        PrioritasSurveiCalonNasabah::truncate();
        foreach ($pengajuanNasabah as $nasabah) {

            $row = [
                'nama' => $nasabah->nasabah->name,
                'matrix' => [],
                'utility' => [],
                'smart_detail' => [],
                'total' => 0,
            ];

            foreach ($kriterias as $kriteria) {

                $penilaian = $nasabah->penilaians
                    ->where('kriteria_id', $kriteria->id_kriteria)
                    ->first();

                $nilai = $penilaian && $penilaian->subKriteria
                    ? $penilaian->subKriteria->nilai
                    : 0;

                $min = $minMax[$kriteria->id_kriteria]['min'];
                $max = $minMax[$kriteria->id_kriteria]['max'];
                $pembagi = $max - $min;
                $row['matrix'][$kriteria->id_kriteria] = $nilai;
                if ($pembagi != 0) {

                    if ($kriteria->jenis == 'benefit') {
                        $utility = ($nilai - $min) / $pembagi;
                    } else {
                        $utility = ($max - $nilai) / $pembagi;
                    }
                } else {
                    $utility = 1;
                }

                $utility = round($utility, 3);

                $row['utility'][$kriteria->id_kriteria] = $utility;
                $smartValue = $kriteria->bobot * $utility;
                $row['smart_detail'][$kriteria->id_kriteria] = [
                    'bobot' => $kriteria->bobot,
                    'utility' => $utility,
                    'hasil' => $smartValue
                ];

                $row['total'] += $smartValue;
            }

            $row['total'] = round($row['total'], 4);
            $prioritas = PrioritasSurveiCalonNasabah::create([
                'id_pengajuan' => $nasabah->id_pengajuan,
                'nilai_preferensi' => $row['total']
            ]);
            $results[] = $row;
        }
        usort($results, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        return view('prioritas_survei.perhitungan', compact(
            'kriterias',
            'results',
            'minMax'
        ));
    }

    public function printPdf()
    {

        $data = PrioritasSurveiCalonNasabah::with('pengajuanNasabah')
            ->where('status', 1)
            ->orderBy('nilai', 'desc')
            ->get();

        $surveyor = User::where('role', 'ao')->get();

        $tanggal = Carbon::now()->format('d F Y');

        $pdf = Pdf::loadView('prioritas_survei.print', compact('data', 'surveyor', 'tanggal'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('nasabah-disetujui.pdf');
    }





    public function nasabahDisetujui(Request $request)
    {

        $query = PrioritasSurveiCalonNasabah::with([
            'pengajuanNasabah',
            'pengajuanNasabah.nasabah',
            'pengajuanNasabah.jadwalSurvei',
            'pengajuanNasabah.jadwalSurvei.user',
            'pengajuanNasabah.akad',
        ])->where('status_terpilih', 2);

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereHas('pengajuanNasabah.jadwalSurvei', function ($q) use ($request) {
                $q->whereBetween('tanggal_survei', [
                    $request->date_from,
                    $request->date_to,
                ]);
            });
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        return view('prioritas_survei.nasabah-disetujui', compact('data'));
    }

    public function printNasabahDisetujui($id, Request $request)
    {
        $item = PrioritasSurveiCalonNasabah::with([
            'pengajuanNasabah',
            'pengajuanNasabah.nasabah',
            'pengajuanNasabah.pasangan',
            'pengajuanNasabah.barangs',
            'pengajuanNasabah.jadwalSurvei.user',
            'pengajuanNasabah.akad',
            'pengajuanNasabah.periode',
        ])->where('id_pengajuan', $id)->firstOrFail();

        $hari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
        ];

        $akad     = $item->pengajuanNasabah->akad;
        $month    = Carbon::now()->translatedFormat('d F Y');
        $direktur = $akad->direksi;

        return view('prioritas_survei.print-nasabah-disetujui', compact('item', 'akad', 'hari', 'month', 'direktur'));
    }
}
