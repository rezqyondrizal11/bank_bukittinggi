@extends('layout.app')

@section('title', 'Pengajuan Pembiayaan Tabungan Utsman')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('info'))
        <div class="alert alert-warning">{{ session('info') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">Data Pengajuan Saya</h3>

            @if ($data->isEmpty())
                <a href="{{ route('pengajuan_nasabah.persyaratan') }}" class="btn btn-primary btn-sm ms-auto">
                    Ajukan Sekarang
                </a>
            @endif
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Nasabah</th>
                        <th>No KTP</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nasabah->name ?? '-' }}</td>
                            <td>{{ $item->nasabah->no_ktp ?? '-' }}</td>
                            <td>{{ $item->nasabah->no_hp ?? '-' }}</td>

                            <td>
                                @php
                                    $status = $item->status_pengajuan;
                                    $badgeClass = match ($status) {
                                        'on process' => 'bg-warning text-dark',
                                        'approved' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        'revisi' => 'bg-info',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('pengajuan_nasabah.show', $item->id_pengajuan) }}"
                                    class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                @if (in_array($item->status_pengajuan, ['on process', 'revisi']))
                                    <a href="{{ route('pengajuan_nasabah.edit', $item->id_pengajuan) }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada pengajuan pembiayaan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
