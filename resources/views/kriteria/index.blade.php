@extends('layout.app')

@section('title', 'Kriterias')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="alert alert-info">
        Silahkan input data kriteria terlebih dahulu, setelah data kriteria terinput semua, maka nilai bobot akan
        diberikan berdasarkan perhitungan metode <b>AHP</b> dengan cara mengklik tombol <b>Bobot Preferensi AHP</b>.
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">Kriteria List</h3>

            <div class="ms-auto">
                <a href="{{ route('kriterias.prioritas') }}" class="btn btn-primary btn-sm me-2">
                    <i class="bi bi-arrow-repeat"></i> Bobot Preferensi AHP
                </a>

                <a href="{{ route('kriterias.create') }}" class="btn btn-primary btn-sm">
                    Add Kriteria
                </a>
            </div>
        </div>


        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Jenis</th>
                    <th width="150">Action</th>
                </tr>

                @foreach ($kriterias as $kriteria)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kriteria->kode_kriteria }}</td>
                        <td>{{ $kriteria->nama }}</td>
                        <td>{{ $kriteria->bobot }}</td>
                        <td>{{ $kriteria->jenis }}</td>
                        <td>
                            <a href="{{ route('kriterias.edit', $kriteria) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('kriterias.destroy', $kriteria) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus kriteria?')" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </table>
        </div>
    </div>
@endsection
