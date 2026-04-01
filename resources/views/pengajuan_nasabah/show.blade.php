@extends('layout.app')

@section('title', 'Detail Pengajuan Pembiayaan')

@section('content')
    <div class="container-fluid">

        <a href="{{ route('pengajuan_nasabah.index') }}" class="btn btn-secondary mb-3">
            ← Kembali
        </a>

        {{-- 1. DATA POKOK PEMOHON --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                DATA POKOK PEMOHON
            </div>
            <div class="card-body row g-3">

                <div class="col-md-6">
                    <strong>Nama:</strong> {{ $pengajuan->nasabah->name ?? '-' }}
                </div>
                <div class="col-md-3">
                    <strong>Tempat Lahir:</strong> {{ $pengajuan->nasabah->tempat_lahir ?? '-' }}
                </div>
                <div class="col-md-3">
                    <strong>Tanggal Lahir:</strong>
                    {{ $pengajuan->nasabah->tanggal_lahir
                        ? \Carbon\Carbon::parse($pengajuan->nasabah->tanggal_lahir)->format('d/m/Y')
                        : '-' }}
                </div>

                <div class="col-md-6">
                    <strong>No KTP:</strong> {{ $pengajuan->nasabah->no_ktp ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>No HP:</strong> {{ $pengajuan->nasabah->no_hp ?? '-' }}
                </div>

                <div class="col-md-6">
                    <strong>Pekerjaan:</strong> {{ $pengajuan->pekerjaan ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>Jumlah Tanggungan:</strong> {{ $pengajuan->jumlah_tanggungan ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>Alamat:</strong> {{ $pengajuan->nasabah->alamat ?? '-' }}
                </div>

                <div class="col-md-6">
                    <strong>Penghasilan Usaha:</strong>
                    Rp {{ number_format($pengajuan->penghasilan_usaha ?? 0) }}
                </div>
                <div class="col-md-6">
                    <strong>Lama Usaha:</strong> {{ $pengajuan->lama_usaha_tahun ?? '-' }} tahun
                </div>

                <div class="col-md-6">
                    <strong>Jenis Usaha:</strong> {{ $pengajuan->jenis_usaha ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>Alamat Usaha:</strong> {{ $pengajuan->alamat_usaha ?? '-' }}
                </div>

                <div class="col-md-6">
                    <strong>No Rekening:</strong> {{ $pengajuan->no_rek ?? '-' }}
                </div>
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
            <div class="card-header bg-secondary text-white fw-bold">
                DATA PASANGAN / PENJAMIN
            </div>
            <div class="card-body row g-3">

                @php $pasangan = $pengajuan->pasangan; @endphp

                <div class="col-md-6">
                    <strong>Nama:</strong> {{ $pasangan->nama ?? '-' }}
                </div>
                <div class="col-md-3">
                    <strong>Tempat Lahir:</strong> {{ $pasangan->tempat_lahir ?? '-' }}
                </div>
                <div class="col-md-3">
                    <strong>Tanggal Lahir:</strong>
                    {{ $pasangan && $pasangan->dob ? \Carbon\Carbon::parse($pasangan->dob)->format('d/m/Y') : '-' }}
                </div>

                <div class="col-md-6">
                    <strong>No KTP:</strong> {{ $pasangan->no_ktp ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>No HP:</strong> {{ $pasangan->no_hp ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>Pekerjaan:</strong> {{ $pasangan->pekerjaan ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>Alamat:</strong> {{ $pasangan->alamat ?? '-' }}
                </div>

            </div>
        </div>

        {{-- 3. KRITERIA --}}
        <div class="card mb-4">
            <div class="card-header bg-danger text-white fw-bold">
                KRITERIA
            </div>
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
            <div class="card-header bg-success text-white fw-bold">
                RINCIAN PEMBIAYAAN
            </div>
            <div class="card-body row g-3">

                <div class="col-md-6">
                    <strong>Jumlah Permohonan:</strong>
                    Rp {{ number_format($pengajuan->jumlah_permohonan ?? 0) }}
                </div>
                <div class="col-md-6">
                    <strong>Jangka Waktu:</strong>
                    {{ $pengajuan->jangka_waktu_bulan ?? '-' }} bulan
                </div>
                <div class="col-12">
                    <strong>Kegunaan / Tujuan:</strong>
                    {{ $pengajuan->tujuan_pembiayaan ?? '-' }}
                </div>

            </div>
        </div>

        {{-- 5. BARANG YANG DIAJUKAN --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white fw-bold">
                BARANG YANG DIAJUKAN
            </div>
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
            <div class="card-header bg-warning fw-bold">
                Dokumen Persyaratan
            </div>
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

        {{-- 7. RIWAYAT STATUS --}}
        <div class="card mb-4">
            <div class="card-header fw-bold text-white" style="background-color: #495057;">
                <i class="fas fa-history me-2"></i> Riwayat Status Pengajuan
            </div>
            <div class="card-body">

                @php
                    $logs = $pengajuan->statusLogs ?? collect();
                @endphp

                @if ($logs->isEmpty())
                    <p class="text-muted fst-italic mb-0">Belum ada riwayat perubahan status.</p>
                @else
                    <div class="timeline ps-3">
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
                    </div>
                @endif

            </div>
        </div>

        @if (in_array($pengajuan->status_pengajuan, ['on process', 'revisi']))
            <div class="text-end mb-4">
                <a href="{{ route('pengajuan_nasabah.edit', $pengajuan->id_pengajuan) }}" class="btn btn-warning btn-lg">
                    Edit Pengajuan
                </a>
            </div>
        @endif

    </div>
@endsection
