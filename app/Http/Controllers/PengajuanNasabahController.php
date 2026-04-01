<?php

namespace App\Http\Controllers;

use App\Models\BarangPermohonan;
use App\Models\Kriteria;
use App\Models\PengajuanNasabah;
use App\Models\PengajuanNasabahDokumen;
use App\Models\PengajuanNasabahPasangan;
use App\Models\PengajuanNasabahPembiayaan;
use App\Models\PengajuanNasabahPenilaian;
use App\Models\Periode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengajuanNasabahController extends Controller
{
    public function index()
    {
        $data = PengajuanNasabah::where('id_nasabah', Auth::id())->get();
        return view('pengajuan_nasabah.index', compact('data'));
    }

    public function persyaratan()
    {
        return view('pengajuan_nasabah.persyaratan');
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
        ])
            ->where('id_nasabah', Auth::id())
            ->findOrFail($id);

        return view('pengajuan_nasabah.show', compact('pengajuan'));
    }

    public function create()
    {
        $data = PengajuanNasabah::where('id_nasabah', Auth::id())->exists();
        if ($data) {
            return redirect()
                ->route('pengajuan_nasabah.index')
                ->with('info', 'Anda sudah mengajukan pembiayaan.');
        }

        $kriterias = Kriteria::with('subKriterias')->get();

        return view('pengajuan_nasabah.create', compact('kriterias'));
    }
    public function store(Request $request)
    {
        // =========================
        // VALIDASI INPUT
        // =========================
        $request->validate([
            'agree' => 'accepted',

            // DATA NASABAH
            'nama'          => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:100',
            'dob'           => 'required|date',
            'no_ktp'        => 'required',
            'no_hp'         => 'required|string|max:20',
            'jumlah_tanggungan'         => 'required|numeric',
            'alamat'        => 'required|string',
            'jenis_usaha'  => 'required|string|max:255',
            'alamat_usaha' => 'required|string|max:255',
            'no_rek'       => 'required|string|max:50',
            'penghasilan_usaha'       => 'required|numeric',
            'lama_usaha_tahun'       => 'required|numeric',

            // DATA PASANGAN ()
            'penjamin_nama'          => 'required|string|max:255',
            'penjamin_tempat_lahir' => 'required|string|max:100',
            'penjamin_pekerjaan' => 'required|string|max:100',
            'penjamin_dob'          => 'required|date',
            'penjamin_ktp'          => 'required|string|max:20',
            'penjamin_hp'           => 'required|string|max:20',
            'penjamin_alamat'       => 'required|string',

            // KRITERIA
            'sub_kriteria' => 'required|array',
            'sub_kriteria.*' => 'required|exists:sub_kriteria,id_subkriteria',

            // PEMBIAYAAN
            'jumlah'       => 'required|numeric',
            'jangka_waktu' => 'required|integer|min:1',
            'kegunaan'     => 'required|string|max:255',

            // FILE UPLOAD
            'file_ktp'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_kk'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_foto'    => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_usaha'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_jaminan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',

            //BARANGS
            'barang' => 'required|array',
            'barang.*.nama_barang' => 'required|string|max:255',
            'barang.*.volume' => 'required|numeric|min:1',
            'barang.*.satuan' => 'required|string|max:50',
            'barang.*.harga' => 'required|numeric|min:0',
            'barang.*.total' => 'required|numeric|min:0',
        ]);
        DB::beginTransaction();

        try {
            $periode = Periode::whereDate('tanggal_mulai', '<=', Carbon::now())
                ->whereDate('tanggal_selesai', '>=', Carbon::now())
                ->first();
            // =========================
            // 1. SIMPAN DATA NASABAH
            // =========================
            $user = User::where('id_user', Auth::id())->first();
            $user->name = $request->nama;
            $user->tempat_lahir = $request->tempat_lahir;
            $user->tanggal_lahir = $request->dob;
            $user->no_ktp = $request->no_ktp;
            $user->no_hp = $request->no_hp;
            $user->alamat = $request->alamat;
            $user->update();
            $pengajuan = PengajuanNasabah::create([
                'id_nasabah'       => Auth::id(),
                'id_periode'       => $periode->id_periode,
                'pekerjaan' => $request->pekerjaan,
                'jenis_usaha'  => $request->jenis_usaha,
                'alamat_usaha' => $request->alamat_usaha,
                'no_rek'       => $request->no_rek,
                'status_pengajuan'       => 'on process',
                'penghasilan_usaha' => $request->penghasilan_usaha,
                'lama_usaha_tahun' => $request->lama_usaha_tahun,
                'tujuan_pembiayaan' => $request->kegunaan,
                'jumlah_permohonan' => $request->jumlah,
                'agree' => $request->agree,
            ]);
            // =========================
            // 2. DATA PENJAMIN
            // =========================
            if ($request->penjamin_nama) {
                PengajuanNasabahPasangan::create([
                    'id_pengajuan' => $pengajuan->id_pengajuan,
                    'nama'         => $request->penjamin_nama,
                    'pekerjaan'         => $request->penjamin_pekerjaan,
                    'tempat_lahir' => $request->penjamin_tempat_lahir,
                    'dob'           => $request->penjamin_dob,
                    'no_ktp'       => $request->penjamin_ktp,
                    'no_hp'        => $request->penjamin_hp,
                    'alamat'      => $request->penjamin_alamat,

                ]);
            }
            // =========================
            // 3. PENILAIAN
            // =========================
            foreach ($request->sub_kriteria as $kriteriaId => $subKriteriaId) {

                PengajuanNasabahPenilaian::create([
                    'pengajuan_nasabah_id' => $pengajuan->id_pengajuan,
                    'kriteria_id' => $kriteriaId,
                    'sub_kriteria_id' => $subKriteriaId,
                ]);
            }

            // =========================
            // 4. UPLOAD DOKUMEN
            // =========================
            $uploadPath = 'uploads/pengajuan';

            $files = [
                'file_ktp',
                'file_kk',
                'file_foto',
                'file_usaha',
                'file_jaminan'
            ];

            foreach ($files as $file) {

                if ($request->hasFile($file)) {

                    $path = $request->file($file)->store($uploadPath, 'public');

                    PengajuanNasabahDokumen::create([
                        'id_pengajuan' => $pengajuan->id_pengajuan,
                        'jenis_dokumen' => $file,
                        'file_path' => $path,
                        'status_verifikasi' => 'pending'
                    ]);
                }
            }
            // =========================
            // 5. BARANG PERMOHONAN
            // =========================

            if ($request->barang) {

                foreach ($request->barang as $barang) {

                    BarangPermohonan::create([
                        'id_pengajuan' => $pengajuan->id_pengajuan,
                        'nama_barang' => $barang['nama_barang'],
                        'volume' => $barang['volume'],
                        'satuan' => $barang['satuan'],
                        'harga' => $barang['harga'],
                        'total' => $barang['total'],
                    ]);
                }
            }
            DB::commit();

            return redirect()
                ->route('pengajuan_nasabah.index')
                ->with('success', 'Pengajuan pembiayaan berhasil dikirim.');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pengajuan = PengajuanNasabah::with([
            'pasangan',
            'dokumen',
            'penilaians',
            'penilaians.kriteria.subKriterias',
            'penilaians.subKriteria',
            'barangs',
            'nasabah',
        ])->findOrFail($id);

        if ($pengajuan->id_nasabah !== Auth::id()) {
            abort(403);
        }

        if (!in_array($pengajuan->status_pengajuan, ['on process', 'revisi'])) {
            return redirect()
                ->route('pengajuan_nasabah.index')
                ->with('error', 'Pengajuan tidak dapat diedit pada status saat ini.');
        }

        $kriterias = Kriteria::with('subKriterias')->get();

        return view('pengajuan_nasabah.edit', compact('pengajuan', 'kriterias'));
    }

    public function update(Request $request, $id)
    {
        // =========================
        // VALIDASI INPUT
        // =========================
        $request->validate([
            'agree' => 'accepted',
            // DATA NASABAH
            'nama'               => 'required|string|max:255',
            'tempat_lahir'       => 'required|string|max:100',
            'pekerjaan'          => 'required|string|max:100',
            'dob'                => 'required|date',
            'no_ktp'             => 'required',
            'no_hp'              => 'required|string|max:20',
            'jumlah_tanggungan'         => 'required|numeric',
            'alamat'             => 'required|string',
            'jenis_usaha'        => 'required|string|max:255',
            'alamat_usaha'       => 'required|string|max:255',
            'no_rek'             => 'required|string|max:50',
            'penghasilan_usaha'  => 'required|numeric',
            'lama_usaha_tahun'   => 'required|numeric',

            // DATA PASANGAN / PENJAMIN
            'penjamin_nama'          => 'required|string|max:255',
            'penjamin_tempat_lahir'  => 'required|string|max:100',
            'penjamin_pekerjaan'     => 'required|string|max:100',
            'penjamin_dob'           => 'required|date',
            'penjamin_ktp'           => 'required|string|max:20',
            'penjamin_hp'            => 'required|string|max:20',
            'penjamin_alamat'        => 'required|string',

            // KRITERIA
            'sub_kriteria'           => 'required|array',
            'sub_kriteria.*'         => 'required|exists:sub_kriteria,id_subkriteria',

            // PEMBIAYAAN
            'jumlah'                 => 'required|numeric',
            'jangka_waktu'           => 'required|integer|min:1',
            'kegunaan'               => 'required|string|max:255',

            // FILE UPLOAD
            'file_ktp'               => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_kk'                => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_foto'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_usaha'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_jaminan'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // BARANG
            'barang'                     => 'required|array',
            'barang.*.nama_barang'       => 'required|string|max:255',
            'barang.*.volume'            => 'required|numeric|min:1',
            'barang.*.satuan'            => 'required|string|max:50',
            'barang.*.harga'             => 'required|numeric|min:0',
            'barang.*.total'             => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $pengajuan = PengajuanNasabah::findOrFail($id);

            if ($pengajuan->id_nasabah !== Auth::id()) {
                abort(403);
            }

            // =========================
            // 1. UPDATE DATA NASABAH (tabel users)
            // =========================
            $user = User::where('id_user', Auth::id())->first();
            $user->name          = $request->nama;
            $user->tempat_lahir  = $request->tempat_lahir;
            $user->tanggal_lahir = $request->dob;
            $user->no_ktp        = $request->no_ktp;
            $user->no_hp         = $request->no_hp;
            $user->alamat        = $request->alamat;
            $user->update();

            // =========================
            // 2. UPDATE DATA PENGAJUAN
            // =========================
            $pengajuan->update([
                'pekerjaan'          => $request->pekerjaan,
                'jenis_usaha'        => $request->jenis_usaha,
                'alamat_usaha'       => $request->alamat_usaha,
                'no_rek'             => $request->no_rek,
                'status_pengajuan'   => 'on process',
                'penghasilan_usaha'  => $request->penghasilan_usaha,
                'lama_usaha_tahun'   => $request->lama_usaha_tahun,
                'tujuan_pembiayaan'  => $request->kegunaan,
                'jumlah_permohonan'  => $request->jumlah,
                'jangka_waktu_bulan' => $request->jangka_waktu,
                'agree' => $request->agree,
            ]);

            // =========================
            // 3. UPDATE DATA PENJAMIN
            // =========================
            PengajuanNasabahPasangan::updateOrCreate(
                ['id_pengajuan' => $pengajuan->id_pengajuan],
                [
                    'nama'          => $request->penjamin_nama,
                    'pekerjaan'     => $request->penjamin_pekerjaan,
                    'tempat_lahir'  => $request->penjamin_tempat_lahir,
                    'dob'           => $request->penjamin_dob,
                    'no_ktp'        => $request->penjamin_ktp,
                    'no_hp'         => $request->penjamin_hp,
                    'alamat'        => $request->penjamin_alamat,
                ]
            );

            // =========================
            // 4. UPDATE PENILAIAN
            // =========================
            foreach ($request->sub_kriteria as $kriteriaId => $subKriteriaId) {
                PengajuanNasabahPenilaian::updateOrCreate(
                    [
                        'pengajuan_nasabah_id' => $pengajuan->id_pengajuan,
                        'kriteria_id'          => $kriteriaId,
                    ],
                    [
                        'sub_kriteria_id' => $subKriteriaId,
                    ]
                );
            }

            // =========================
            // 5. UPDATE DOKUMEN
            // =========================
            $uploadPath = 'uploads/pengajuan';

            $files = [
                'file_ktp',
                'file_kk',
                'file_foto',
                'file_usaha',
                'file_jaminan',
            ];

            foreach ($files as $fileKey) {
                if ($request->hasFile($fileKey)) {
                    $dokumenLama = PengajuanNasabahDokumen::where('id_pengajuan', $pengajuan->id_pengajuan)
                        ->where('jenis_dokumen', $fileKey)
                        ->first();

                    if ($dokumenLama && Storage::disk('public')->exists($dokumenLama->file_path)) {
                        Storage::disk('public')->delete($dokumenLama->file_path);
                    }

                    $path = $request->file($fileKey)->store($uploadPath, 'public');

                    PengajuanNasabahDokumen::updateOrCreate(
                        [
                            'id_pengajuan'  => $pengajuan->id_pengajuan,
                            'jenis_dokumen' => $fileKey,
                        ],
                        [
                            'file_path'          => $path,
                            'status_verifikasi'  => 'pending',
                        ]
                    );
                }
            }

            // =========================
            // 6. UPDATE BARANG PERMOHONAN
            // =========================
            BarangPermohonan::where('id_pengajuan', $pengajuan->id_pengajuan)->delete();

            foreach ($request->barang as $barang) {
                BarangPermohonan::create([
                    'id_pengajuan' => $pengajuan->id_pengajuan,
                    'nama_barang'  => $barang['nama_barang'],
                    'volume'       => $barang['volume'],
                    'satuan'       => $barang['satuan'],
                    'harga'        => $barang['harga'],
                    'total'        => $barang['total'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('pengajuan_nasabah.index')
                ->with('success', 'Pengajuan berhasil diperbarui.');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
