@extends('layout.app')

@section('title', 'Edit Kriteria')

@section('content')
    <div class="card col-md-6">

        <div class="card-header">Edit Kriteria</div>

        <div class="card-body">
            <form method="POST" action="{{ route('kriterias.update', $kriteria) }}">
                @csrf @method('PUT')

                <input name="kode_kriteria" class="form-control mb-2" value="{{ $kriteria->kode_kriteria }}" required>

                <input name="nama" class="form-control mb-2" value="{{ $kriteria->nama }}" required>

                <select name="jenis" class="form-control mb-3" required>
                    <option value="benefit" @selected($kriteria->jenis == 'benefit')>Benefit</option>
                    <option value="cost" @selected($kriteria->jenis == 'cost')>Cost</option>
                </select>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
