@extends('layout.app')

@section('title', 'Sub Kriteria')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4">Perhitungan AHP SMART</h1>


    <div class="card mb-4">
        <div class="card-header">
            <strong>Bobot Kriteria Preferensi (Wj)</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($kriterias as $kriteria)
                            <td>{{ $kriteria->bobot }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <strong>Matrix Keputusan (X)</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Nasabah</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->keterangan }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($results as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $row['nama'] }}</td>
                            @foreach ($kriterias as $kriteria)
                                <td>{{ $row['matrix'][$kriteria->id_kriteria] }}</td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 2 + count($kriterias) }}" class="text-center">
                                Belum ada data
                            </td>
                        </tr>
                    @endforelse

                    <tr class="table-light">
                        <th colspan="2">Min</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $minMax[$kriteria->id_kriteria]['min'] }}</th>
                        @endforeach
                    </tr>

                    <tr class="table-light">
                        <th colspan="2">Max</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $minMax[$kriteria->id_kriteria]['max'] }}</th>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <strong>Nilai Utility (Ui)</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Nasabah</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->keterangan }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $row['nama'] }}</td>
                            @foreach ($kriterias as $kriteria)
                                <td>{{ $row['utility'][$kriteria->id_kriteria] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <strong>Perhitungan SMART</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>Nama Nasabah</th>
                        <th>Detail</th>
                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $row['nama'] }}</td>
                            <td>
                                @foreach ($kriterias as $kriteria)
                                    ({{ $row['smart_detail'][$kriteria->id_kriteria]['bobot'] }}
                                    ×
                                    {{ $row['smart_detail'][$kriteria->id_kriteria]['utility'] }})
                                @endforeach
                            </td>
                            <td><strong>{{ $row['total'] }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
