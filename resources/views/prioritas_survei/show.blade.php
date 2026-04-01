@extends('layout.app')

@section('title', 'Detail Pengajuan - Prioritas Survei')

@section('content')
    <div class="container-fluid">

        <a href="{{ route('prioritas_survei.index') }}" class="btn btn-secondary mb-3">
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
                        $st = $pengajuan->status_pengajuan;
                        $stBadge = match ($st) {
                            'on process' => 'bg-warning text-dark',
                            'approved' => 'bg-success',
                            'rejected' => 'bg-danger',
                            'revisi' => 'bg-info',
                            default => 'bg-secondary',
                        };
                    @endphp
                    <span class="badge {{ $stBadge }}">{{ ucfirst($st) }}</span>
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
                    {{ $pasangan?->dob ? \Carbon\Carbon::parse($pasangan->dob)->format('d/m/Y') : '-' }}
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
                        @if ($penilaian->subKriteria?->nilai)
                            <span class="badge bg-secondary ms-1">Nilai: {{ $penilaian->subKriteria->nilai }}</span>
                        @endif
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

        {{-- 6. DOKUMEN PERSYARATAN --}}
        <div class="card mb-4">
            <div class="card-header bg-warning fw-bold">Dokumen Persyaratan</div>
            <div class="card-body row g-3">
                @php
                    $jenisLabel = [
                        'file_ktp' => 'KTP',
                        'file_kk' => 'Kartu Keluarga',
                        'file_foto' => 'Foto Nasabah',
                        'file_usaha' => 'Foto Usaha',
                        'file_jaminan' => 'Foto Jaminan',
                    ];
                    $dokumenMap = $pengajuan->dokumen->pluck('file_path', 'jenis_dokumen')->toArray();
                @endphp
                @foreach ($jenisLabel as $key => $label)
                    <div class="col-md-4">
                        <p class="fw-semibold mb-1">{{ $label }}</p>
                        @if (!empty($dokumenMap[$key]))
                            @php $ext = strtolower(pathinfo($dokumenMap[$key], PATHINFO_EXTENSION)); @endphp
                            @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                <a href="{{ Storage::url($dokumenMap[$key]) }}" target="_blank">
                                    <img src="{{ Storage::url($dokumenMap[$key]) }}" alt="{{ $label }}"
                                        class="img-thumbnail" style="max-height: 120px;">
                                </a>
                            @else
                                <a href="{{ Storage::url($dokumenMap[$key]) }}" target="_blank"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-file-pdf"></i> Lihat PDF
                                </a>
                            @endif
                        @else
                            <span class="text-muted fst-italic">Belum diupload</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 7. INFO JADWAL SURVEI --}}
        <div class="card mb-4">
            <div class="card-header fw-bold text-white d-flex justify-content-between align-items-center"
                style="background-color: #0d6efd;">
                <span><i class="fas fa-calendar-check me-2"></i>Jadwal Survei</span>
            </div>
            <div class="card-body">
                @php $jadwal = $pengajuan->jadwalSurvei; @endphp
                @if ($jadwal)
                    <div class="row g-3">
                        <div class="col-md-4">
                            <strong>Surveyor (AO):</strong><br>
                            {{ $jadwal->user?->name ?? '-' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Tanggal Survei:</strong><br>
                            {{ \Carbon\Carbon::parse($jadwal->tanggal_survei)->format('d/m/Y') }}
                        </div>
                        <div class="col-md-4">
                            <strong>Status:</strong><br>
                            @if ($prioritas?->status_terpilih == 2)
                                <span class="badge bg-success">Sudah Disurvei</span>
                            @else
                                <span class="badge bg-warning text-dark">Belum Disurvei</span>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="text-muted fst-italic mb-0">Belum ada jadwal survei yang ditetapkan.</p>
                @endif
            </div>
        </div>

        {{-- 8. PENILAIAN SURVEI --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white fw-bold d-flex align-items-center">
                <span><i class="fas fa-clipboard-check me-2"></i>Penilaian Survei</span>

                @if (auth()->user()->role === 'ao' &&
                        $jadwal &&
                        $jadwal->id_ao == auth()->user()->id_user &&
                        $prioritas?->status_terpilih == 1)
                    <button class="btn btn-light btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#modalPenilaian">
                        <i class="fas fa-plus me-1"></i> Input Penilaian
                    </button>
                @endif

            </div>

            <div class="card-body">
                @if ($jadwal && $jadwal->details->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="text-center align-middle table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Jenis Dokumen</th>
                                    <th width="120">Opsi</th>
                                    <th>Keterangan</th>
                                    <th width="150">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal->details as $key => $detail)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $detail->jenis_dokumen }}</td>
                                        <td class="text-center">
                                            @if ($detail->opsi == 'Ada')
                                                <span class="badge bg-success">Ada</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Ada</span>
                                            @endif
                                        </td>
                                        <td>{{ $detail->keterangan ?? '-' }}</td>
                                        <td class="text-center">
                                            @if ($detail->file_path)
                                                @php $ext = strtolower(pathinfo($detail->file_path, PATHINFO_EXTENSION)); @endphp
                                                @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                                    <a href="{{ Storage::url($detail->file_path) }}" target="_blank">
                                                        <img src="{{ Storage::url($detail->file_path) }}"
                                                            style="max-height:50px; max-width:80px;"
                                                            class="img-thumbnail">
                                                    </a>
                                                @else
                                                    <a href="{{ Storage::url($detail->file_path) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-file-pdf"></i> Lihat
                                                    </a>
                                                @endif
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($jadwal->note)
                        <div class="mt-3">
                            <strong>Opini & Catatan:</strong><br>
                            {{ $jadwal->note }}
                        </div>
                    @endif
                @else
                    <p class="text-muted fst-italic">Belum ada penilaian survei.</p>
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
                                'surveyed' => 'bg-primary',
                                default => 'bg-secondary',
                            };
                            $logLabel = match ($log->status) {
                                'on process' => 'On Process',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'revisi' => 'Revisi',
                                'surveyed' => 'Sudah Disurvei',
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

    {{-- MODAL PENILAIAN SURVEI --}}
    <div class="modal fade" id="modalPenilaian" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <form action="{{ route('prioritas_survei.store_penilaian') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf

                <input type="hidden" name="id_pengajuan" value="{{ $pengajuan->id_pengajuan }}">

                <div class="modal-header">
                    <h5 class="modal-title">Input Penilaian Survei</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <h6 class="fw-bold">A. Latar Belakang</h6>
                        <p class="mb-1">
                            Pemantauan penerapan prinsip kehati-hatian (Prudential Banking) terhadap prosedur
                            Pemberian Pembiayaan yang berpedoman kepada:
                        </p>
                        <p class="text-muted small mb-0">
                            Keputusan Direksi No. 101/BPRS-JG/DIR-IN/0721 Tentang Standar Operating Procedure
                            Pembiayaan PT. BPRS JAM GADANG (Perseroda)
                        </p>
                    </div>

                    <h6 class="fw-bold">B. Dokumen Legalitas</h6>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="text-center table-light">
                                <tr>
                                    <th rowspan="2" width="45">No</th>
                                    <th rowspan="2">Jenis Dokumen</th>
                                    <th colspan="2">Opsi</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2" width="160">
                                        Upload File
                                        <div class="text-muted fw-normal" style="font-size:11px;">
                                            (jpg/png/pdf, maks 2MB)
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="80">Ada</th>
                                    <th width="100">Tidak Ada</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php

                                    $rows = [
                                        [1, 'SLIK', 'row', 0],
                                        [2, 'KTP', 'row', 1],
                                        [3, 'Pas Photo', 'row', 2],
                                        [4, 'Kartu Keluarga', 'row', 3],
                                        [5, 'RAB', 'row', 4],
                                        [6, 'Agunan', 'head', null],
                                        ['', 'a) Kendaraan', 'sub', null],
                                        ['', '1) STNK', 'row', 5],
                                        ['', '2) BPKB', 'row', 6],
                                        ['', '3) FOTO KB', 'row', 7],
                                        ['', '4) Cek Fisik KB', 'row', 8],
                                        ['', 'b) Sertifikat', 'sub', null],
                                        ['', '1) Foto Hasil Survei', 'row', 9],
                                        ['', 'c) Lainnya', 'row', 10],
                                        [7, 'Foto Rumah', 'row', 11],
                                        [8, 'Usaha', 'head', null],
                                        ['', 'a) Foto Usaha', 'row', 12],
                                        ['', 'b) Mapping Usaha', 'row', 13],
                                        [9, 'Pengikatan', 'row', 14],
                                        [10, 'Dokumen Lainnya', 'row', 15],
                                    ];
                                @endphp

                                @foreach ($rows as $r)
                                    @if ($r[2] === 'head')
                                        <tr class="table-secondary">
                                            <td class="text-center fw-bold">{{ $r[0] }}</td>
                                            <td colspan="5" class="fw-bold">{{ $r[1] }}</td>
                                        </tr>
                                    @elseif ($r[2] === 'sub')
                                        <tr class="table-light">
                                            <td></td>
                                            <td colspan="5" class="fw-semibold ps-3">{{ $r[1] }}</td>
                                        </tr>
                                    @else
                                        @php $idx = $r[3]; @endphp
                                        <tr>
                                            <td class="text-center">{{ $r[0] }}</td>
                                            <td>
                                                {{ $r[1] }}
                                                <input type="hidden" name="dokumen[{{ $idx }}][jenis_dokumen]"
                                                    value="{{ $r[1] }}">
                                            </td>
                                            <td class="text-center">
                                                <input type="radio" name="dokumen[{{ $idx }}][opsi]"
                                                    value="Ada" required>
                                            </td>
                                            <td class="text-center">
                                                <input type="radio" name="dokumen[{{ $idx }}][opsi]"
                                                    value="Tidak Ada">
                                            </td>
                                            <td>
                                                <input type="text" name="dokumen[{{ $idx }}][keterangan]"
                                                    class="form-control form-control-sm" placeholder="Opsional">
                                            </td>
                                            <td>
                                                <input type="file" name="dokumen[{{ $idx }}][file]"
                                                    class="form-control form-control-sm" accept=".jpg,.jpeg,.png,.pdf">
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <h6 class="fw-bold">C. Opini dan Catatan</h6>
                        <textarea name="note" class="form-control" rows="3" placeholder="Tulis opini atau catatan hasil survei..."></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
