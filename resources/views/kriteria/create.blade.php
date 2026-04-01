@extends('layout.app')

@section('title', 'Create Kriteria')

@section('content')
    <div class="card col-md-6">

        <div class="card-header">Create Kriteria</div>

        <div class="card-body">
            <form method="POST" action="{{ route('kriterias.store') }}">
                @csrf

                <div class="form-group">
                    <label class="font-weight-bold">Kode Kriteria</label>
                    <input name="kode_kriteria" class="form-control mb-2" placeholder="Kode Kriteria" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Nama</label>
                    <input name="nama" class="form-control mb-2" placeholder="Keterangan" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Bobot</label>
                    <input type="number" step="any" name="bobot" class="form-control mb-2" placeholder="Bobot"
                        required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Jenis</label>
                    <select name="jenis" class="form-control mb-3" required>
                        <option value="">Pilih Jenis</option>
                        <option value="benefit">Benefit</option>
                        <option value="cost">Cost</option>
                    </select>
                </div>

                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
