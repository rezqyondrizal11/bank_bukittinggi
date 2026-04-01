@extends('layout.app')

@section('title', 'Sub Kriteria')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4">Sub Kriteria</h1>

    @foreach ($kriterias as $kriteria)
        <div class="card mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">
                <i class="bi bi-table"></i> &nbsp; <strong>{{ $kriteria->keterangan }}
                    ({{ $kriteria->kode_kriteria }})
                </strong>

                <button class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal"
                    data-bs-target="#createModal{{ $kriteria->id_kriteria }}">
                    + Tambah Sub Kriteria
                </button>
            </div>

            <div class="card-body">

                <table class="table table-bordered">
                    <thead class="table-light text-center">

                        <tr>
                            <th width="60">No</th>
                            <th>Nama Sub Kriteria</th>
                            <th width="120">Nilai</th>
                            <th width="160">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($kriteria->subKriterias as $sub)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sub->deskripsi }}</td>
                                <td>{{ $sub->nilai }}</td>
                                <td>

                                    <!-- EDIT -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $sub->id_subkriteria }}">
                                        Edit
                                    </button>

                                    <!-- DELETE -->
                                    <form action="{{ route('sub-kriterias.destroy', $sub) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus sub kriteria ini?')"
                                            class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>

                            <!-- ================= EDIT MODAL ================= -->

                            <div class="modal fade" id="editModal{{ $sub->id_subkriteria }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('sub-kriterias.update', $sub) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Edit Sub Kriteria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="mb-2">
                                                    <label>Nama Sub Kriteria</label>
                                                    <input type="text" name="deskripsi" class="form-control"
                                                        value="{{ $sub->deskripsi }}" required>
                                                </div>

                                                <div>
                                                    <label>Nilai</label>
                                                    <input type="number" name="nilai" class="form-control"
                                                        value="{{ $sub->nilai }}" required>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary">
                                                    Update
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada sub kriteria
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>

        <!-- ================= CREATE MODAL ================= -->

        <div class="modal fade" id="createModal{{ $kriteria->id_kriteria }}" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('sub-kriterias.store') }}">
                    @csrf

                    <input type="hidden" name="id_kriteria" value="{{ $kriteria->id_kriteria }}">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h5>Tambah Sub Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-2">
                                <label>Nama Sub Kriteria</label>
                                <input type="text" name="deskripsi" class="form-control" required>
                            </div>

                            <div>
                                <label>Nilai</label>
                                <input type="number" name="nilai" class="form-control" required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">
                                Simpan
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection
