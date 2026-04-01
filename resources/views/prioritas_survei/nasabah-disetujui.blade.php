@extends('layout.app')

@section('title', 'Data Nasabah Disetujui')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">Data Nasabah Disetujui</h3>
        </div>

        <div class="card-body">

            {{-- Filter --}}
            <form method="GET" class="row mb-3 g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Dari Tanggal Survei</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal Survei</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('nasabah_disetujui.index') }}" class="btn btn-secondary ms-1">Reset</a>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Nasabah</th>
                        <th>No KTP</th>
                        <th>No HP</th>
                        <th>Nilai SPK</th>
                        <th>Surveyor</th>
                        <th>Tgl Survei</th>
                        <th>No Akad</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $item)
                        @php
                            $nasabah = $item->pengajuanNasabah->nasabah ?? null;
                            $jadwal = $item->pengajuanNasabah->jadwalSurvei ?? null;
                            $akad = $item->pengajuanNasabah->akad ?? null;

                            $nohp = preg_replace('/[^0-9]/', '', $nasabah->no_hp ?? '');
                            if (substr($nohp, 0, 1) === '0') {
                                $nohp = '62' . substr($nohp, 1);
                            }
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $nasabah->name ?? '-' }}</td>
                            <td>{{ $nasabah->no_ktp ?? '-' }}</td>
                            <td>
                                @if ($nasabah?->no_hp)
                                    <a href="https://wa.me/{{ $nohp }}" target="_blank"
                                        class="text-success fw-bold">
                                        {{ $nasabah->no_hp }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ number_format($item->nilai_preferensi, 4) }}</td>
                            <td>{{ $jadwal?->user?->name ?? '-' }}</td>
                            <td>
                                {{ $jadwal?->tanggal_survei ? \Carbon\Carbon::parse($jadwal->tanggal_survei)->format('d/m/Y') : '-' }}
                            </td>
                            <td>
                                @if ($akad)
                                    <small class="text-muted">{{ $akad->no_akad }}</small>
                                @else
                                    <span class="text-muted fst-italic">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('nasabah_disetujui.show', $item->pengajuanNasabah->id_pengajuan) }}"
                                    class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                @if ($akad)
                                    <a href="{{ route('nasabah_disetujui.print_akad', $item->pengajuanNasabah->id_pengajuan) }}"
                                        target="_blank" class="btn btn-success btn-sm">
                                        <i class="fas fa-file-alt me-1"></i> Akad
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                Belum ada nasabah yang disetujui.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

@endsection
