@extends('layout.app')

@section('title', 'Pengajuan Pembiayaan Utsman')

@section('content')
    <div class="container-fluid">

        <form action="{{ route('pengajuan_nasabah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 1. DATA POKOK --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white fw-bold">
                    DATA POKOK PEMOHON
                </div>

                <div class="card-body row g-3">

                    <div class="col-md-6">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="col-md-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>No KTP</label>
                        <input type="text" name="no_ktp" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>

                    <div class="col-6">
                        <label>Alamat Rumah</label>
                        <textarea name="alamat" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Jumlah Tanggungan</label>
                        <input type="number" name="jumlah_tanggungan" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Penghasilan Usaha</label>
                        <input type="number" name="penghasilan_usaha" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Lama Usaha (Tahun)</label>
                        <input type="number" name="lama_usaha_tahun" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label>Alamat Usaha</label>
                        <input type="text" name="alamat_usaha" class="form-control" required>
                    </div>

                </div>
            </div>

            {{-- 2. DATA PENJAMIN --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    DATA PASANGAN / PENJAMIN
                </div>
                <div class="card-body row g-3">

                    <div class="col-md-6">
                        <label>Nama</label>
                        <input type="text" name="penjamin_nama" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="penjamin_tempat_lahir" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="penjamin_dob" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>No KTP</label>
                        <input type="text" name="penjamin_ktp" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>No HP</label>
                        <input type="text" name="penjamin_hp" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Pekerjaan</label>
                        <input type="text" name="penjamin_pekerjaan" class="form-control">
                    </div>
                    <div class="col-6">
                        <label>Alamat</label>
                        <textarea name="penjamin_alamat" class="form-control" rows="2"></textarea>
                    </div>

                </div>
            </div>

            {{-- 3. KRITERIA --}}
            <div class="card mb-4">
                <div class="card-header bg-danger text-white fw-bold">
                    KRITERIA
                </div>

                <div class="card-body row g-3">

                    @foreach ($kriterias as $kriteria)
                        <div class="col-md-6 mb-3">

                            {{-- Label --}}
                            <label class="form-label fw-bold">
                                {{ $kriteria->nama }}
                            </label>

                            {{-- Dropdown --}}
                            <select name="sub_kriteria[{{ $kriteria->id_kriteria }}]" class="form-control" required>
                                <option value="">-- Pilih Sub Kriteria --</option>

                                @foreach ($kriteria->subKriterias as $sub)
                                    <option value="{{ $sub->id_subkriteria }}">
                                        {{ $sub->deskripsi }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    @endforeach

                </div>
            </div>

            {{-- PEMBIAYAAN --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white fw-bold">
                    RINCIAN PEMBIAYAAN
                </div>
                <div class="card-body row g-3">

                    <div class="col-md-6">
                        <label>Jumlah Permohonan (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Jangka Waktu (bulan)</label>
                        <input type="number" name="jangka_waktu" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label>Kegunaan</label>
                        <textarea name="kegunaan" class="form-control" rows="2"></textarea>
                    </div>

                </div>
            </div>
            {{-- 4. DOKUMEN --}}
            <div class="card mb-4">
                <div class="card-header bg-warning fw-bold">Upload Dokumen</div>

                <div class="card-body row g-3">

                    @php
                        $dokumen = [
                            'file_ktp' => 'KTP',
                            'file_kk' => 'Kartu Keluarga',
                            'file_foto' => 'Foto Nasabah',
                            'file_usaha' => 'Foto Usaha',
                            'file_jaminan' => 'Foto Jaminan',
                        ];
                    @endphp

                    @foreach ($dokumen as $name => $label)
                        <div class="col-md-6">
                            <label class="form-label">{{ $label }}</label>
                            <input type="file" name="{{ $name }}" class="form-control" required>
                        </div>
                    @endforeach

                </div>
            </div>
            {{-- BARANG PERMOHONAN --}}
            <div class="card mb-4">
                <div class="card-header bg-info text-white fw-bold">
                    BARANG YANG DIAJUKAN
                </div>

                <div class="card-body">

                    <table class="table table-bordered" id="table-barang">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Barang</th>
                                <th width="120">Volume</th>
                                <th width="120">Satuan</th>
                                <th width="150">Harga</th>
                                <th width="150">Total</th>
                                <th width="80"></th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>
                                    <input type="text" name="barang[0][nama_barang]" class="form-control" required>
                                </td>

                                <td>
                                    <input type="number" name="barang[0][volume]" class="form-control volume" required>
                                </td>

                                <td>
                                    <input type="text" name="barang[0][satuan]" class="form-control" required>
                                </td>

                                <td>
                                    <input type="number" name="barang[0][harga]" class="form-control harga" required>
                                </td>

                                <td>
                                    <input type="number" name="barang[0][total]" class="form-control total" readonly>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove">X</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <button type="button" class="btn btn-success btn-sm" id="addBarang">
                        + Tambah Barang
                    </button>

                </div>
            </div>
            {{-- PERNYATAAN --}}
            <div class="card mb-4">
                <div class="card-header bg-light fw-bold">
                    Pernyataan Pemohon
                </div>
                <div class="card-body">

                    <p class="mb-3">
                        Sehubungan dengan data, informasi, serta dokumen-dokumen yang saya serahkan sesuai rincian di atas,
                        dengan ini saya selaku pemohon menyatakan bahwa:
                    </p>

                    <ol class="ps-3">
                        <li>
                            Seluruh informasi dalam formulir permohonan ini telah saya isi dengan lengkap dan
                            sebenar-benarnya.
                        </li>
                        <li>
                            Saya memberikan persetujuan atas penerimaan informasi melalui layanan SMS, e-mail,
                            dan/atau media komunikasi lainnya yang disediakan oleh
                            <strong>PT. BPRS Jam Gadang (Perseroda)</strong>.
                        </li>
                        <li>
                            Saya bersedia melengkapi serta menandatangani persyaratan tambahan yang ditetapkan Bank.
                            Apabila permohonan ini disetujui, realisasi pembiayaan akan disalurkan ke rekening tabungan
                            saya.
                        </li>
                    </ol>

                    <div class="mb-3 mt-3">
                        <label class="fw-semibold">Nomor Rekening Nasabah</label>
                        <input type="text" name="no_rek" class="form-control"
                            placeholder="Masukkan nomor rekening aktif" required>
                    </div>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="agree" id="agree" required>
                        <label class="form-check-label" for="agree">
                            Saya menyatakan bahwa seluruh data yang saya berikan adalah benar dan dapat
                            dipertanggungjawabkan
                        </label>
                    </div>

                </div>
            </div>


            <div class="text-end">
                <button class="btn btn-primary btn-lg">
                    Kirim Pengajuan Pembiayaan
                </button>
            </div>

        </form>

    </div>

@endsection
@push('js')
    <script>
        let indexBarang = 1;

        document.getElementById('addBarang').onclick = function() {

            let table = document.querySelector('#table-barang tbody');

            let row = `
        <tr>
            <td>
                <input type="text" name="barang[${indexBarang}][nama_barang]" class="form-control" required>
            </td>

            <td>
                <input type="number" name="barang[${indexBarang}][volume]" class="form-control volume" required>
            </td>

            <td>
                <input type="text" name="barang[${indexBarang}][satuan]" class="form-control" required>
            </td>

            <td>
                <input type="number" name="barang[${indexBarang}][harga]" class="form-control harga" required>
            </td>

            <td>
                <input type="number" name="barang[${indexBarang}][total]" class="form-control total" readonly>
            </td>

            <td>
                <button type="button" class="btn btn-danger btn-sm remove">X</button>
            </td>
        </tr>
        `;

            table.insertAdjacentHTML('beforeend', row);

            indexBarang++;
        };

        document.addEventListener('input', function(e) {

            if (e.target.classList.contains('volume') || e.target.classList.contains('harga')) {

                let row = e.target.closest('tr');

                let volume = row.querySelector('.volume').value || 0;
                let harga = row.querySelector('.harga').value || 0;

                row.querySelector('.total').value = volume * harga;
            }

        });

        document.addEventListener('click', function(e) {

            if (e.target.classList.contains('remove')) {
                e.target.closest('tr').remove();
            }

        });
    </script>
@endpush
