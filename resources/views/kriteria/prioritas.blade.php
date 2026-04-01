@extends('layout.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3><i class="fas fa-cube"></i> Data Kriteria</h3>

        <a href="{{ route('kriterias.index') }}" class="btn btn-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('pesan_error'))
        <div class="alert alert-danger">{{ session('pesan_error') }}</div>
    @endif

    <div class="alert alert-info">
        Silahkan isi nilai perbandingan kriteria (skala 1–9) lalu klik
        <b>SIMPAN</b>. Setelah itu klik <b>CEK KONSISTENSI</b>.
    </div>

    <div class="card mb-4">
        <div class="card-header text-danger fw-bold">
            Perbandingan Data Antar Kriteria
        </div>

        <form method="POST" action="{{ route('kriterias.prioritas') }}">
            @csrf

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-right" width="25%">Nama Kriteria</th>
                                <th class="text-center" width="50%">Skala Perbandingan</th>
                                <th class="text-left" width="25%">Nama Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
        $no = 1;
        $i = 0;

        // range skala AHP (negatif kiri, positif kanan, 1 di tengah)
        $skala = array_merge(range(-9, -2), [1], range(2, 9));

        foreach ($kriteria as $row1):
            $ii = 0;
            foreach ($kriteria as $row2):
                if ($i < $ii):
                    $nilai = $kriteria_ahp[$row1->id_kriteria][$row2->id_kriteria] ?? null;
             
        ?>
                            <tr>
                                <td class="text-right">
                                    (<?= $row1->kode_kriteria ?>) <?= $row1->nama ?>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                        <?php foreach ($skala as $v): ?>
                                        <label class="btn btn-danger <?= $nilai == $v ? 'active' : '' ?>">
                                            <input type="radio" id="radio_<?= $no ?>_<?= $v ?>"
                                                name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>"
                                                value="<?= $v ?>" <?= $nilai == $v ? 'checked' : '' ?>>
                                            <?= abs($v) ?>
                                        </label>
                                        <?php endforeach; ?>

                                    </div>
                                </td>

                                <td class="text-left">
                                    (<?= $row2->kode_kriteria ?>) <?= $row2->nama ?>
                                </td>
                            </tr>
                            <?php
                    $no++;
                endif;
                $ii++;
            endforeach;
            $i++;
        endforeach;
        ?>

                            <tr>
                                <td colspan="3" class="text-center">

                                    <button name="save" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Simpan
                                    </button>

                                    <button name="check" class="btn btn-warning">
                                        <i class="bi bi-check-circle"></i> Cek Konsistensi
                                    </button>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#resetModal">
                                        <i class="bi bi-arrow-clockwise"></i> Reset
                                    </button>

                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </form>
    </div>

    {{-- ================= HASIL PERHITUNGAN ================= --}}

    @if (request()->has('check') && !session('pesan_error'))
        <div class="card mb-4">
            <div class="card-header text-danger fw-bold">
                Matriks Perbandingan Berpasangan
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">{!! $list_data !!}</table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header text-danger fw-bold">
                Matriks Normalisasi
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">{!! $list_data2 !!}</table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header text-danger fw-bold">
                Matriks Penjumlahan Baris
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">{!! $list_data3 !!}</table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header text-danger fw-bold">
                Rasio Konsistensi
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">{!! $list_data4 !!}</table>
                {!! $list_data5 !!}
            </div>
        </div>
    @endif

    {{-- ================= RESET MODAL ================= --}}

    <div class="modal fade" id="resetModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Konfirmasi Reset</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Yakin reset semua nilai perbandingan?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form method="POST" action="{{ route('kriterias.reset') }}">
                        @csrf
                        <button class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
