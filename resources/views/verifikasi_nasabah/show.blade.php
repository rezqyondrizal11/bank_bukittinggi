@extends('layout.app')

@section('title', 'Verifikasi Pengajuan Pembiayaan')

@section('content')
    <div class="container-fluid">

        <a href="{{ route('verifikasi_nasabah.index') }}" class="btn btn-secondary mb-3">
            ← Kembali
        </a>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- 1. DATA POKOK PEMOHON --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold">DATA POKOK PEMOHON</div>
            <div class="card-body row g-3">
                <div class="col-md-6"><strong>Nama:</strong> {{ $pengajuan->nasabah->name ?? '-' }}</div>
                <div class="col-md-3"><strong>Tempat Lahir:</strong> {{ $pengajuan->nasabah->tempat_lahir ?? '-' }}</div>
                <div class="col-md-3">
                    <strong>Tanggal Lahir:</strong>
                    {{ $pengajuan->nasabah->tanggal_lahir ? \Carbon\Carbon::parse($pengajuan->nasabah->tanggal_lahir)->format('d/m/Y') : '-' }}
                </div>
                <div class="col-md-6"><strong>No KTP:</strong> {{ $pengajuan->nasabah->no_ktp ?? '-' }}</div>
                <div class="col-md-6"><strong>No HP:</strong> {{ $pengajuan->nasabah->no_hp ?? '-' }}</div>
                <div class="col-md-6"><strong>Pekerjaan:</strong> {{ $pengajuan->pekerjaan ?? '-' }}</div>
                <div class="col-md-6"><strong>Jumlah Tanggungan:</strong> {{ $pengajuan->jumlah_tanggungan ?? '-' }}</div>
                <div class="col-md-6"><strong>Alamat:</strong> {{ $pengajuan->nasabah->alamat ?? '-' }}</div>
                <div class="col-md-6"><strong>Penghasilan Usaha:</strong> Rp
                    {{ number_format($pengajuan->penghasilan_usaha ?? 0) }}</div>
                <div class="col-md-6"><strong>Lama Usaha:</strong> {{ $pengajuan->lama_usaha_tahun ?? '-' }} tahun</div>
                <div class="col-md-6"><strong>Jenis Usaha:</strong> {{ $pengajuan->jenis_usaha ?? '-' }}</div>
                <div class="col-md-6"><strong>Alamat Usaha:</strong> {{ $pengajuan->alamat_usaha ?? '-' }}</div>
                <div class="col-md-6"><strong>No Rekening:</strong> {{ $pengajuan->no_rek ?? '-' }}</div>
                <div class="col-md-6">
                    <strong>Status:</strong>
                    @php
                        $status = $pengajuan->status_pengajuan;
                        $badgeClass = match ($status) {
                            'on process' => 'bg-warning text-dark',
                            'approved' => 'bg-success',
                            'rejected' => 'bg-danger',
                            'revisi' => 'bg-info',
                            default => 'bg-secondary',
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                </div>
            </div>
        </div>

        {{-- 2. DATA PASANGAN / PENJAMIN --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white fw-bold">DATA PASANGAN / PENJAMIN</div>
            <div class="card-body row g-3">
                @php $pasangan = $pengajuan->pasangan; @endphp
                <div class="col-md-6"><strong>Nama:</strong> {{ $pasangan->nama ?? '-' }}</div>
                <div class="col-md-3"><strong>Tempat Lahir:</strong> {{ $pasangan->tempat_lahir ?? '-' }}</div>
                <div class="col-md-3">
                    <strong>Tanggal Lahir:</strong>
                    {{ $pasangan && $pasangan->dob ? \Carbon\Carbon::parse($pasangan->dob)->format('d/m/Y') : '-' }}
                </div>
                <div class="col-md-6"><strong>No KTP:</strong> {{ $pasangan->no_ktp ?? '-' }}</div>
                <div class="col-md-6"><strong>No HP:</strong> {{ $pasangan->no_hp ?? '-' }}</div>
                <div class="col-md-6"><strong>Pekerjaan:</strong> {{ $pasangan->pekerjaan ?? '-' }}</div>
                <div class="col-md-6"><strong>Alamat:</strong> {{ $pasangan->alamat ?? '-' }}</div>
            </div>
        </div>

        {{-- 3. KRITERIA --}}
        <div class="card mb-4">
            <div class="card-header bg-danger text-white fw-bold">KRITERIA</div>
            <div class="card-body row g-3">
                @forelse ($pengajuan->penilaians as $penilaian)
                    <div class="col-md-6">
                        <strong>{{ $penilaian->kriteria->nama ?? ($penilaian->kriteria->keterangan ?? '-') }}:</strong>
                        {{ $penilaian->subKriteria->deskripsi ?? '-' }}
                    </div>
                @empty
                    <div class="col-12 text-muted">Belum ada data penilaian.</div>
                @endforelse
            </div>
        </div>

        {{-- 4. RINCIAN PEMBIAYAAN --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white fw-bold">RINCIAN PEMBIAYAAN</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <strong>Jumlah Permohonan:</strong> Rp {{ number_format($pengajuan->jumlah_permohonan ?? 0) }}
                </div>
                <div class="col-md-6">
                    <strong>Jangka Waktu:</strong> {{ $pengajuan->jangka_waktu_bulan ?? '-' }} bulan
                </div>
                <div class="col-12">
                    <strong>Kegunaan / Tujuan:</strong> {{ $pengajuan->tujuan_pembiayaan ?? '-' }}
                </div>
            </div>
        </div>

        {{-- 5. BARANG YANG DIAJUKAN --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white fw-bold">BARANG YANG DIAJUKAN</div>
            <div class="card-body">
                @if ($pengajuan->barangs->count())
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan->barangs as $i => $barang)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->volume }}</td>
                                    <td>{{ $barang->satuan }}</td>
                                    <td>Rp {{ number_format($barang->harga) }}</td>
                                    <td>Rp {{ number_format($barang->total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="5" class="text-end">Grand Total</td>
                                <td>Rp {{ number_format($pengajuan->barangs->sum('total')) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                @else
                    <p class="text-muted">Belum ada data barang.</p>
                @endif
            </div>
        </div>

        {{-- 6. DOKUMEN PERSYARATAN + VERIFIKASI --}}
        <div class="card mb-4">
            <div class="card-header bg-warning fw-bold d-flex justify-content-between align-items-center">
                <span>Dokumen Persyaratan</span>
                <small class="text-muted fw-normal">Klik tombol untuk memverifikasi setiap dokumen</small>
            </div>
            <div class="card-body">
                @php
                    $jenisLabel = [
                        'file_ktp' => 'KTP',
                        'file_kk' => 'Kartu Keluarga',
                        'file_foto' => 'Foto Nasabah',
                        'file_usaha' => 'Foto Usaha',
                        'file_jaminan' => 'Foto Jaminan',
                    ];
                    $dokumenMap = $pengajuan->dokumen->keyBy('jenis_dokumen');
                @endphp
                <div class="row g-3">
                    @foreach ($jenisLabel as $key => $label)
                        @php $dok = $dokumenMap[$key] ?? null; @endphp
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="fw-semibold mb-0">{{ $label }}</p>
                                    @if ($dok)
                                        @php
                                            $sv = $dok->status_verifikasi ?? 'pending';
                                            $svBadge = match ($sv) {
                                                'verified' => 'bg-success',
                                                'rejected' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                            $svLabel = match ($sv) {
                                                'verified' => 'Terverifikasi',
                                                'rejected' => 'Ditolak',
                                                default => 'Belum Diverifikasi',
                                            };
                                        @endphp
                                        <span class="badge {{ $svBadge }}">{{ $svLabel }}</span>
                                    @endif
                                </div>

                                @if ($dok && !empty($dok->file_path))
                                    @php $ext = strtolower(pathinfo($dok->file_path, PATHINFO_EXTENSION)); @endphp
                                    @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                        <a href="{{ Storage::url($dok->file_path) }}" target="_blank">
                                            <img src="{{ Storage::url($dok->file_path) }}" alt="{{ $label }}"
                                                class="img-thumbnail mb-2"
                                                style="max-height: 120px; width:100%; object-fit:cover;">
                                        </a>
                                    @else
                                        <a href="{{ Storage::url($dok->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-secondary mb-2 d-block">
                                            <i class="fas fa-file-pdf me-1"></i> Lihat PDF
                                        </a>
                                    @endif
                                    <div class="d-flex gap-2 mt-2">
                                        <form
                                            action="{{ route('verifikasi_nasabah.verifikasi_dokumen', $dok->id_dokumen) }}"
                                            method="POST" class="flex-fill">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status_verifikasi" value="verified">
                                            <button type="submit" class="btn btn-success btn-sm w-100">
                                                <i class="fas fa-check me-1"></i> Verifikasi
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('verifikasi_nasabah.verifikasi_dokumen', $dok->id_dokumen) }}"
                                            method="POST" class="flex-fill">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status_verifikasi" value="rejected">
                                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                                <i class="fas fa-times me-1"></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted fst-italic">Belum diupload</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 7. SLIK / BI CHECKING --}}
        <div class="card mb-4">
            <div class="card-header fw-bold text-white d-flex justify-content-between align-items-center"
                style="background-color: #5c3d91;">
                <span><i class="fas fa-search-dollar me-2"></i>SLIK / BI Checking</span>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalSlik">
                    <i class="fas fa-{{ $slik ? 'edit' : 'plus' }} me-1"></i>
                    {{ $slik ? 'Edit' : 'Input Hasil Checking' }}
                </button>
            </div>
            <div class="card-body">
                @if ($slik)
                    <div class="row g-3">
                        <div class="col-md-4">
                            <strong>Tanggal Pengecekan:</strong><br>
                            {{ \Carbon\Carbon::parse($slik->tanggal_cek)->format('d/m/Y') }}
                        </div>
                        <div class="col-md-4">
                            <strong>Status SLIK:</strong><br>
                            @php
                                $ssBadge = match ($slik->status_slik) {
                                    'lancar' => 'bg-success',
                                    'kurang_lancar' => 'bg-warning text-dark',
                                    'diragukan' => 'bg-warning text-dark',
                                    'macet' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                                $ssLabel = match ($slik->status_slik) {
                                    'lancar' => 'Lancar',
                                    'kurang_lancar' => 'Kurang Lancar)',
                                    'diragukan' => 'Diragukan',
                                    'macet' => 'Macet',
                                    'tidak_ada' => 'Tidak Ada Data',
                                    default => ucfirst($slik->status_slik),
                                };
                            @endphp
                            <span class="badge {{ $ssBadge }} fs-6">{{ $ssLabel }}</span>
                        </div>
                        <div class="col-md-4">
                            <strong>Harga / Plafon Existing:</strong><br>
                            Rp {{ number_format($slik->harga ?? 0) }}
                        </div>
                        <div class="col-md-4">
                            <strong>Total Kewajiban:</strong><br>
                            Rp {{ number_format($slik->total ?? 0) }}
                        </div>
                        <div class="col-md-8">
                            <strong>Keterangan:</strong><br>
                            {{ $slik->keterangan ?? '-' }}
                        </div>
                    </div>
                @else
                    <p class="text-muted fst-italic mb-0">Belum ada data SLIK / BI Checking.</p>
                @endif
            </div>
        </div>

        {{-- Modal SLIK --}}
        <div class="modal fade" id="modalSlik" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#5c3d91; color:white;">
                        <h5 class="modal-title"><i class="fas fa-search-dollar me-2"></i>{{ $slik ? 'Edit' : 'Input' }}
                            Hasil SLIK / BI Checking</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form
                        action="{{ $slik ? route('verifikasi_nasabah.slik_update', $slik->id_slik) : route('verifikasi_nasabah.slik_store') }}"
                        method="POST">
                        @csrf
                        @if ($slik)
                            @method('PUT')
                        @endif
                        <input type="hidden" name="id_pengajuan" value="{{ $pengajuan->id_pengajuan }}">
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Pengecekan <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tanggal_cek" class="form-control"
                                    value="{{ $slik ? $slik->tanggal_cek : date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status SLIK <span
                                        class="text-danger">*</span></label>
                                <select name="status_slik" class="form-select" required>
                                    @foreach (['lancar' => 'Lancar (Kol. 1)', 'kurang_lancar' => 'Kurang Lancar (Kol. 2)', 'diragukan' => 'Diragukan (Kol. 3)', 'macet' => 'Macet (Kol. 4-5)', 'tidak_ada' => 'Tidak Ada Data'] as $val => $lbl)
                                        <option value="{{ $val }}"
                                            {{ $slik && $slik->status_slik === $val ? 'selected' : '' }}>
                                            {{ $lbl }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Plafon / Harga Existing (Rp)</label>
                                <input type="number" name="harga" class="form-control" min="0" step="0.01"
                                    value="{{ $slik->harga ?? 0 }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Total Kewajiban (Rp)</label>
                                <input type="number" name="total" class="form-control" min="0" step="0.01"
                                    value="{{ $slik->total ?? 0 }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3">{{ $slik->keterangan ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 8. KEPUTUSAN VERIFIKASI --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white fw-bold">Keputusan Verifikasi</div>
            <div class="card-body">
                @php
                    $totalDokumen = $pengajuan->dokumen->count();
                    $terverifikasi = $pengajuan->dokumen->where('status_verifikasi', 'verified')->count();
                    $adaTolak = $pengajuan->dokumen->where('status_verifikasi', 'rejected')->count() > 0;
                    $semuaVerified = $totalDokumen > 0 && $terverifikasi === $totalDokumen;
                @endphp

                <div class="alert alert-info mb-3">
                    <strong>Progress Verifikasi Dokumen:</strong> {{ $terverifikasi }} / {{ $totalDokumen }} dokumen
                    terverifikasi.
                    @if ($adaTolak)
                        <span class="text-danger fw-bold"> Ada dokumen yang ditolak.</span>
                    @endif
                </div>

                {{-- Form keterangan bersama (digunakan oleh ketiga tombol via JS) --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan Keputusan <small
                            class="text-muted">(opsional)</small></label>
                    <textarea id="keteranganKeputusan" class="form-control" rows="2"
                        placeholder="Contoh: Dokumen lengkap dan valid, pengajuan disetujui..."></textarea>
                </div>

                <div class="d-flex gap-3 flex-wrap">

                    <form id="formApprove"
                        action="{{ route('verifikasi_nasabah.update_status', $pengajuan->id_pengajuan) }}"
                        method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status_pengajuan" value="approved">
                        <input type="hidden" name="keterangan" id="ketApprove">
                        <button type="submit" class="btn btn-success btn-lg"
                            {{ !$semuaVerified || !$slik ? 'disabled' : '' }}
                            onclick="document.getElementById('ketApprove').value = document.getElementById('keteranganKeputusan').value; return confirm('Yakin menyetujui pengajuan ini?')">
                            <i class="fas fa-check-circle me-1"></i> Setujui Pengajuan
                        </button>
                    </form>

                    <form id="formRevisi"
                        action="{{ route('verifikasi_nasabah.update_status', $pengajuan->id_pengajuan) }}"
                        method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status_pengajuan" value="revisi">
                        <input type="hidden" name="keterangan" id="ketRevisi">
                        <button type="submit" class="btn btn-warning btn-lg"
                            onclick="document.getElementById('ketRevisi').value = document.getElementById('keteranganKeputusan').value; return confirm('Kirim permintaan revisi ke nasabah?')">
                            <i class="fas fa-edit me-1"></i> Minta Revisi
                        </button>
                    </form>

                    <form id="formReject"
                        action="{{ route('verifikasi_nasabah.update_status', $pengajuan->id_pengajuan) }}"
                        method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status_pengajuan" value="rejected">
                        <input type="hidden" name="keterangan" id="ketReject">
                        <button type="submit" class="btn btn-danger btn-lg"
                            onclick="document.getElementById('ketReject').value = document.getElementById('keteranganKeputusan').value; return confirm('Yakin menolak pengajuan ini?')">
                            <i class="fas fa-times-circle me-1"></i> Tolak Pengajuan
                        </button>
                    </form>

                </div>

                @if (!$semuaVerified || !$slik)
                    <small class="text-muted mt-2 d-block">
                        * Tombol "Setujui" akan aktif setelah semua dokumen terverifikasi dan data SLIK sudah diinput.
                    </small>
                @endif
            </div>
        </div>

        {{-- 9. RIWAYAT STATUS --}}
        <div class="card mb-4">
            <div class="card-header fw-bold text-white" style="background-color: #495057;">
                <i class="fas fa-history me-2"></i> Riwayat Status Pengajuan
            </div>
            <div class="card-body">

                @php $logs = $pengajuan->statusLogs ?? collect(); @endphp

                @if ($logs->isEmpty())
                    <p class="text-muted fst-italic mb-0">Belum ada riwayat perubahan status.</p>
                @else
                    @foreach ($logs as $log)
                        @php
                            $logBadge = match ($log->status) {
                                'on process' => 'bg-warning text-dark',
                                'approved' => 'bg-success',
                                'rejected' => 'bg-danger',
                                'revisi' => 'bg-info',
                                default => 'bg-secondary',
                            };
                            $logLabel = match ($log->status) {
                                'on process' => 'On Process',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'revisi' => 'Revisi',
                                default => ucfirst($log->status),
                            };
                        @endphp
                        <div class="d-flex mb-3 gap-3 align-items-start">
                            <div class="pt-1">
                                <span class="badge {{ $logBadge }}">{{ $logLabel }}</span>
                            </div>
                            <div>
                                <div class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($log->tanggal_status)->format('d/m/Y H:i') }}
                                </div>
                                @if ($log->keterangan)
                                    <div class="text-muted small">{{ $log->keterangan }}</div>
                                @endif
                            </div>
                        </div>
                        @if (!$loop->last)
                            <hr class="my-1">
                        @endif
                    @endforeach
                @endif

            </div>
        </div>

    </div>
@endsection
