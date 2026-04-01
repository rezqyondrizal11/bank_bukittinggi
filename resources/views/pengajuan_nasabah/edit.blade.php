@extends('layout.app')

@section('title', 'Edit Pengajuan Pembiayaan')

@section('content')
    <div class="container-fluid">

        <form action="{{ route('pengajuan_nasabah.update', $pengajuan->id_pengajuan) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                        <input type="text" name="nama" class="form-control"
                            value="{{ old('nama', $pengajuan->nasabah->name) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control"
                            value="{{ old('tempat_lahir', $pengajuan->nasabah->tempat_lahir) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="dob" class="form-control"
                            value="{{ old('dob', \Carbon\Carbon::parse($pengajuan->nasabah->tanggal_lahir)->format('Y-m-d')) }}"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label>No KTP</label>
                        <input type="text" name="no_ktp" class="form-control"
                            value="{{ old('no_ktp', $pengajuan->nasabah->no_ktp) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control"
                            value="{{ old('no_hp', $pengajuan->nasabah->no_hp) }}" required>
                    </div>

                    <div class="col-6">
                        <label>Alamat Rumah</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $pengajuan->nasabah->alamat) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control"
                            value="{{ old('pekerjaan', $pengajuan->pekerjaan) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Jumlah Tanggungan</label>
                        <input type="number" name="jumlah_tanggungan" class="form-control"
                            value="{{ old('jumlah_tanggungan', $pengajuan->pekerjaan) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Penghasilan Usaha</label>
                        <input type="number" name="penghasilan_usaha" class="form-control"
                            value="{{ old('penghasilan_usaha', $pengajuan->penghasilan_usaha) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label>Lama Usaha (Tahun)</label>
                        <input type="number" name="lama_usaha_tahun" class="form-control"
                            value="{{ old('lama_usaha_tahun', $pengajuan->lama_usaha_tahun) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label>Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" class="form-control"
                            value="{{ old('jenis_usaha', $pengajuan->jenis_usaha) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label>Alamat Usaha</label>
                        <input type="text" name="alamat_usaha" class="form-control"
                            value="{{ old('alamat_usaha', $pengajuan->alamat_usaha) }}" required>
                    </div>

                </div>
            </div>

            {{-- 2. DATA PENJAMIN --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    DATA PASANGAN / PENJAMIN
                </div>
                <div class="card-body row g-3">

                    @php $pasangan = $pengajuan->pasangan; @endphp

                    <div class="col-md-6">
                        <label>Nama</label>
                        <input type="text" name="penjamin_nama" class="form-control"
                            value="{{ old('penjamin_nama', $pasangan->nama ?? '') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="penjamin_tempat_lahir" class="form-control"
                            value="{{ old('penjamin_tempat_lahir', $pasangan->tempat_lahir ?? '') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="penjamin_dob" class="form-control"
                            value="{{ old('penjamin_dob', $pasangan && $pasangan->dob ? \Carbon\Carbon::parse($pasangan->dob)->format('Y-m-d') : '') }}"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label>No KTP</label>
                        <input type="text" name="penjamin_ktp" class="form-control"
                            value="{{ old('penjamin_ktp', $pasangan->no_ktp ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label>No HP</label>
                        <input type="text" name="penjamin_hp" class="form-control"
                            value="{{ old('penjamin_hp', $pasangan->no_hp ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label>Pekerjaan</label>
                        <input type="text" name="penjamin_pekerjaan" class="form-control"
                            value="{{ old('penjamin_pekerjaan', $pasangan->pekerjaan ?? '') }}">
                    </div>

                    <div class="col-6">
                        <label>Alamat</label>
                        <textarea name="penjamin_alamat" class="form-control" rows="2">{{ old('penjamin_alamat', $pasangan->alamat ?? '') }}</textarea>
                    </div>

                </div>
            </div>

            {{-- 3. KRITERIA --}}
            <div class="card mb-4">
                <div class="card-header bg-danger text-white fw-bold">
                    KRITERIA
                </div>

                <div class="card-body row g-3">

                    @php
                        $penilaianMap = $pengajuan->penilaians->pluck('sub_kriteria_id', 'kriteria_id')->toArray();
                    @endphp

                    @foreach ($kriterias as $kriteria)
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                {{ $kriteria->nama }}
                            </label>

                            <select name="sub_kriteria[{{ $kriteria->id_kriteria }}]" class="form-control" required>
                                <option value="">-- Pilih Sub Kriteria --</option>

                                @foreach ($kriteria->subKriterias as $sub)
                                    <option value="{{ $sub->id_subkriteria }}"
                                        {{ old('sub_kriteria.' . $kriteria->id_kriteria, $penilaianMap[$kriteria->id_kriteria] ?? '') == $sub->id_subkriteria ? 'selected' : '' }}>
                                        {{ $sub->deskripsi }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    @endforeach

                </div>
            </div>

            {{-- 4. RINCIAN PEMBIAYAAN --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white fw-bold">
                    RINCIAN PEMBIAYAAN
                </div>
                <div class="card-body row g-3">

                    <div class="col-md-6">
                        <label>Jumlah Permohonan (Rp)</label>
                        <input type="number" name="jumlah" class="form-control"
                            value="{{ old('jumlah', $pengajuan->jumlah_permohonan) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label>Jangka Waktu (bulan)</label>
                        <input type="number" name="jangka_waktu" class="form-control"
                            value="{{ old('jangka_waktu', $pengajuan->jangka_waktu_bulan) }}" required>
                    </div>

                    <div class="col-12">
                        <label>Kegunaan</label>
                        <textarea name="kegunaan" class="form-control" rows="2">{{ old('kegunaan', $pengajuan->tujuan_pembiayaan) }}</textarea>
                    </div>

                </div>
            </div>

            {{-- 5. DOKUMEN --}}
            <div class="card mb-4">
                <div class="card-header bg-warning fw-bold">Upload Dokumen</div>

                <div class="card-body row g-3">

                    @php
                        $jenisLabel = [
                            'file_ktp' => 'KTP',
                            'file_kk' => 'Kartu Keluarga',
                            'file_foto' => 'Foto Nasabah',
                            'file_usaha' => 'Foto Usaha',
                            'file_jaminan' => 'Foto Jaminan',
                        ];
                        $dokumenMap = $pengajuan->dokumen->pluck('file_path', 'jenis_dokumen')->toArray();
                    @endphp

                    @foreach ($jenisLabel as $name => $label)
                        <div class="col-md-6">
                            <label class="form-label">{{ $label }}</label>

                            @if (!empty($dokumenMap[$name]))
                                <div class="mb-1">
                                    <small class="text-muted">File saat ini:</small>
                                    @php
                                        $ext = pathinfo($dokumenMap[$name], PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                                        <br>
                                        <img src="{{ Storage::url($dokumenMap[$name]) }}" alt="{{ $label }}"
                                            class="img-thumbnail mt-1" style="max-height: 80px;">
                                    @else
                                        <a href="{{ Storage::url($dokumenMap[$name]) }}" target="_blank"
                                            class="btn btn-sm btn-outline-secondary ms-2">
                                            <i class="fas fa-file-pdf"></i> Lihat PDF
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <input type="file" name="{{ $name }}" class="form-control"
                                {{ empty($dokumenMap[$name]) ? 'required' : '' }}>

                            @if (!empty($dokumenMap[$name]))
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>

            {{-- 6. BARANG PERMOHONAN --}}
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
                            @forelse ($pengajuan->barangs as $i => $barang)
                                <tr>
                                    <td>
                                        <input type="text" name="barang[{{ $i }}][nama_barang]"
                                            class="form-control"
                                            value="{{ old("barang.$i.nama_barang", $barang->nama_barang) }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="barang[{{ $i }}][volume]"
                                            class="form-control volume"
                                            value="{{ old("barang.$i.volume", $barang->volume) }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="barang[{{ $i }}][satuan]"
                                            class="form-control" value="{{ old("barang.$i.satuan", $barang->satuan) }}"
                                            required>
                                    </td>
                                    <td>
                                        <input type="number" name="barang[{{ $i }}][harga]"
                                            class="form-control harga"
                                            value="{{ old("barang.$i.harga", $barang->harga) }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="barang[{{ $i }}][total]"
                                            class="form-control total"
                                            value="{{ old("barang.$i.total", $barang->total) }}" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove">X</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <input type="text" name="barang[0][nama_barang]" class="form-control"
                                            required>
                                    </td>
                                    <td>
                                        <input type="number" name="barang[0][volume]" class="form-control volume"
                                            required>
                                    </td>
                                    <td>
                                        <input type="text" name="barang[0][satuan]" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="number" name="barang[0][harga]" class="form-control harga"
                                            required>
                                    </td>
                                    <td>
                                        <input type="number" name="barang[0][total]" class="form-control total"
                                            readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove">X</button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-success btn-sm" id="addBarang">
                        + Tambah Barang
                    </button>

                </div>
            </div>

            {{-- 7. PERNYATAAN --}}
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
                            placeholder="Masukkan nomor rekening aktif" value="{{ old('no_rek', $pengajuan->no_rek) }}"
                            required>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="agree" value="1"
                            @checked(old('agree', $pengajuan->agree)) disabled>

                        <input type="hidden" name="agree" value="{{ old('agree', $pengajuan->agree) }}">

                        <label class="form-check-label" for="agree">
                            Saya menyatakan bahwa seluruh data yang saya berikan adalah benar dan dapat
                            dipertanggungjawabkan
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mb-4">
                <a href="{{ route('pengajuan_nasabah.index') }}" class="btn btn-secondary btn-lg">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>
@endsection

@push('js')
    <script>
        let indexBarang = document.querySelectorAll('#table-barang tbody tr').length;

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
            </tr>`;

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
                let tbody = document.querySelector('#table-barang tbody');
                if (tbody.querySelectorAll('tr').length > 1) {
                    e.target.closest('tr').remove();
                } else {
                    alert('Minimal harus ada 1 barang.');
                }
            }
        });
    </script>
@endpush
