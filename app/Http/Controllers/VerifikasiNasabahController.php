<?php

namespace App\Http\Controllers;

use App\Models\PengajuanNasabah;
use App\Models\PengajuanNasabahDokumen;
use App\Models\SlikBiChecking;
use App\Models\StatusPengajuanLog;
use Illuminate\Http\Request;

class VerifikasiNasabahController extends Controller
{

    public function index()
    {
        $data = PengajuanNasabah::with('nasabah')
            ->whereIn('status_pengajuan', ['on process', 'revisi'])
            ->get();

        return view('verifikasi_nasabah.index', compact('data'));
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
            'statusLogs',
        ])->findOrFail($id);

        $slik = SlikBiChecking::where('id_pengajuan', $id)->first();

        return view('verifikasi_nasabah.show', compact('pengajuan', 'slik'));
    }

    public function verifikasiDokumen(Request $request, $id_dokumen)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:verified,rejected',
        ]);

        $dokumen = PengajuanNasabahDokumen::findOrFail($id_dokumen);
        $dokumen->update([
            'status_verifikasi' => $request->status_verifikasi,
        ]);

        $label = $request->status_verifikasi === 'verified' ? 'Terverifikasi' : 'Ditolak';

        return back()->with('success', "Dokumen berhasil di-update: {$label}.");
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pengajuan' => 'required|in:approved,revisi,rejected',
            'keterangan'       => 'nullable|string|max:1000',
        ]);

        $pengajuan = PengajuanNasabah::findOrFail($id);
        $pengajuan->update([
            'status_pengajuan' => $request->status_pengajuan,
        ]);

        StatusPengajuanLog::create([
            'id_pengajuan'   => $pengajuan->id_pengajuan,
            'status'         => $request->status_pengajuan,
            'tanggal_status' => now(),
            'keterangan'     => $request->keterangan,
        ]);

        $label = match ($request->status_pengajuan) {
            'approved' => 'disetujui',
            'revisi'   => 'dikembalikan untuk revisi',
            'rejected' => 'ditolak',
        };

        return redirect()
            ->route('verifikasi_nasabah.index')
            ->with('success', "Pengajuan berhasil {$label}.");
    }


    public function slikStore(Request $request)
    {
        $request->validate([
            'id_pengajuan' => 'required|exists:pengajuan,id_pengajuan',
            'tanggal_cek'  => 'required|date',
            'status_slik'  => 'required|in:lancar,kurang_lancar,diragukan,macet,tidak_ada',
            'keterangan'   => 'nullable|string|max:100',
            'harga'        => 'nullable|numeric|min:0',
            'total'        => 'nullable|numeric|min:0',
        ]);

        SlikBiChecking::create($request->only([
            'id_pengajuan',
            'tanggal_cek',
            'status_slik',
            'keterangan',
            'harga',
            'total',
        ]));

        return back()->with('success', 'Data SLIK / BI Checking berhasil disimpan.');
    }


    public function slikUpdate(Request $request, $id_slik)
    {
        $request->validate([
            'tanggal_cek' => 'required|date',
            'status_slik' => 'required|in:lancar,kurang_lancar,diragukan,macet,tidak_ada',
            'keterangan'  => 'nullable|string|max:100',
            'harga'       => 'nullable|numeric|min:0',
            'total'       => 'nullable|numeric|min:0',
        ]);

        $slik = SlikBiChecking::findOrFail($id_slik);
        $slik->update($request->only([
            'tanggal_cek',
            'status_slik',
            'keterangan',
            'harga',
            'total',
        ]));

        return back()->with('success', 'Data SLIK / BI Checking berhasil diperbarui.');
    }
}
