@extends('layout.app')

@section('title', 'Prioritas Survei Calon Nasabah')

@section('content')

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

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">Data Prioritas Survei Calon Nasabah</h3>
            <a href="{{ route('prioritas_survei.print') }}" class="btn btn-danger btn-sm ms-auto" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Print PDF
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">Prioritas</th>
                        <th>Nama Nasabah</th>
                        <th>No KTP</th>
                        <th>No HP</th>
                        <th>Nilai</th>
                        <th>Status</th>
                        <th>Surveyor</th>
                        <th>Tanggal Survei</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $item)
                        @php
                            $nasabah = $item->pengajuanNasabah->nasabah ?? null;
                            $jadwal = $item->pengajuanNasabah->jadwalSurvei ?? null;

                            $nohp = preg_replace('/[^0-9]/', '', $nasabah->no_hp ?? '');
                            if (substr($nohp, 0, 1) === '0') {
                                $nohp = '62' . substr($nohp, 1);
                            }
                        @endphp
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
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
                            <td>
                                @if ($item->status_terpilih == 1)
                                    <span class="badge bg-warning text-dark">Belum Disurvei</span>
                                @elseif ($item->status_terpilih == 2)
                                    <span class="badge bg-success">Sudah Disurvei</span>
                                @endif
                            </td>
                            <td>{{ $jadwal?->user?->name ?? '-' }}</td>
                            <td>
                                {{ $jadwal?->tanggal_survei ? \Carbon\Carbon::parse($jadwal->tanggal_survei)->format('d/m/Y') : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('prioritas_survei.show', $item->pengajuanNasabah->id_pengajuan) }}"
                                    class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                @if ($item->status_terpilih == 1 && !$jadwal)
                                    <button type="button" class="btn btn-primary btn-sm btn-assign"
                                        data-id="{{ $item->pengajuanNasabah->id_pengajuan }}"
                                        data-nama="{{ $nasabah->name ?? '-' }}" data-bs-toggle="modal"
                                        data-bs-target="#modalAssignSurveyor">
                                        Assign Surveyor
                                    </button>
                                @endif

                                @if ($item->status_terpilih == 2)
                                    <a href="#" class="btn btn-success btn-sm">
                                        Akad Pembiayaan
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                Belum ada data prioritas survei calon nasabah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Assign Surveyor --}}
    <div class="modal fade" id="modalAssignSurveyor" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('prioritas_survei.assign_surveyor') }}">
                @csrf

                <input type="hidden" name="id_pengajuan" id="modal_pengajuan_id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Surveyor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Nasabah</label>
                            <input type="text" id="modal_nama_nasabah" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Surveyor (AO) <span class="text-danger">*</span></label>
                            <select name="id_ao" class="form-select" required>
                                <option value="">-- Pilih Surveyor --</option>
                                @foreach ($surveyor as $user)
                                    <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Survei <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_survei" class="form-control" required
                                min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.btn-assign').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    document.getElementById('modal_pengajuan_id').value = this.dataset.id;
                    document.getElementById('modal_nama_nasabah').value = this.dataset.nama;
                });
            });
        });
    </script>
@endpush
