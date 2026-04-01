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
            <h3 class="card-title mb-0">Data Verifikasi Nasabah</h3>


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

                            <td>
                                @php
                                    $nohp = preg_replace('/[^0-9]/', '', $item->nasabah->no_hp);

                                    if (substr($nohp, 0, 1) === '0') {
                                        $nohp = '62' . substr($nohp, 1);
                                    }
                                @endphp

                                <a href="https://wa.me/{{ $nohp }}" target="_blank" class="text-success fw-bold">
                                    {{ $item->nasabah->no_hp }}
                                </a>
                            </td>

                            <td>
                                <span class="badge bg-warning">
                                    {{ ucfirst($item->status_pengajuan) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('verifikasi_nasabah.show', $item->id_pengajuan) }}"
                                    class="btn btn-info btn-sm">
                                    Detail
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada verifikasi nasabah
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
