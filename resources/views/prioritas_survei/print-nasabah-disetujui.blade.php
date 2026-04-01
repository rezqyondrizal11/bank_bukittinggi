<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Akad Pembiayaan Murabahah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            color: #000;
            background: #fff;
        }

        .page {
            max-width: 210mm;
            margin: 0 auto;
            padding: 20mm 25mm;
        }

        .header-divider {
            border-top: 3px double #000;
            margin: 8px 0 12px;
        }

        .title-section {
            text-align: center;
            margin-bottom: 14px;
        }

        .doc-title {
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
        }

        .doc-number {
            font-size: 12pt;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 4px;
        }

        .bismillah {
            font-style: italic;
            text-decoration: underline;
            font-weight: bold;
            margin: 10px 0 6px;
        }

        .ayat-block {
            font-style: italic;
            margin-bottom: 4px;
            font-size: 11pt;
        }

        .intro-date {
            margin-top: 14px;
            text-align: justify;
        }

        ol.pihak-list {
            list-style: none;
            padding-left: 0;
        }

        ol.pihak-list>li {
            display: flex;
            gap: 8px;
            margin-bottom: 12px;
            text-align: justify;
        }

        .nomor {
            min-width: 20px;
            font-weight: bold;
        }

        .konten {
            flex: 1;
        }

        .info-table td {
            padding: 2px 4px;
            vertical-align: top;
        }

        .label-col {
            width: 42mm;
        }

        .colon-col {
            width: 6mm;
        }

        .value-col {
            border-bottom: 1px solid #000;
        }

        .pasal-header {
            text-align: center;
            font-weight: bold;
            margin: 16px 0 6px;
        }

        ol.list-normal {
            padding-left: 20px;
            text-align: justify;
        }

        ol.list-normal li {
            margin-bottom: 8px;
        }

        .definisi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
            margin-bottom: 10px;
        }

        .definisi-table td {
            padding: 3px 4px;
            vertical-align: top;
        }

        .definisi-table td.no {
            width: 8mm;
        }

        .definisi-table td.term {
            width: 42mm;
            font-weight: bold;
        }

        .definisi-table td.colon {
            width: 6mm;
        }

        .definisi-table td.desc {
            text-align: justify;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
            margin: 8px 0;
        }

        .data-table td,
        .data-table th {
            border: 1px solid #000;
            padding: 4px 8px;
        }

        .data-table th {
            background: #e9e9e9;
            font-weight: bold;
            text-align: center;
        }

        .ketentuan-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
            font-weight: bold;
            margin: 8px 0;
        }

        .ketentuan-table td {
            border: 1px solid #000;
            padding: 4px 8px;
            vertical-align: top;
        }

        .ttd-table {
            width: 100%;
            text-align: center;
            font-size: 12pt;
            margin-top: 20px;
        }

        .ttd-table td {
            width: 50%;
            vertical-align: top;
            padding: 4px;
        }

        .ttd-space {
            height: 80px;
        }

        @media print {
            body {
                margin: 0;
            }

            .page {
                padding: 15mm 20mm;
            }
        }
    </style>
</head>

<body>
    <div class="page">

        @php
            $pengajuan = $item->pengajuanNasabah;
            $nasabah = $pengajuan->nasabah;
            $pasangan = $pengajuan->pasangan;
        @endphp

        {{-- HEADER --}}
        <div class="text-center">
            <img src="{{ asset('asset/image.png') }}" alt="Bank Jam Gadang"
                style="max-width: 450px; height: auto; display: block; margin: 0 auto;">
        </div>

        <hr class="header-divider" />

        {{-- TITLE --}}
        <div class="title-section">
            <div class="doc-title">AKAD PEMBIAYAAN MURABAHAH</div>
            <div class="doc-number">{{ $akad->no_akad ?? 'No. -' }}</div>

            <div class="bismillah">Bismillahirrahmanirrahim</div>

            <div class="ayat-block">
                <em>"Hai orang-orang yang <u>beriman</u>, <u>penuhilah akad-akad itu</u>"
                    (<i>QS. Al <u><b>Maidah</b></u> : 1</i>)</em>
            </div>
            <div class="ayat-block">
                <em>"Dan Allah telah <u>menghalalkan jual beli</u> dan <u>mengharamkan riba</u>"
                    (<i>QS Al <u><b>Baqarah</b></u> : 275</i>)</em>
            </div>
            <div class="ayat-block">
                <em>"Hai orang-orang yang <u><i>beriman! Janganlah kamu saling memakan harta sesamamu dengan jalan
                            yang <u>batil</u>, kecuali dengan jalan perdagangan yang berlaku atas dasar suka sama
                            suka</i></u>
                    di <u>antara kamu</u>"
                    (<i>QS An <u><b>Nisa</b></u> : 29</i>)</em>
            </div>
        </div>

        {{-- BODY --}}
        <p class="intro-date">
            Pada hari <strong>{{ $hari[date('l')] }}</strong> tanggal <strong>{{ $month }}</strong>;<br>
            Yang bertanda tangan dibawah;&nbsp;.............................................
        </p>

        <ol class="pihak-list">
            {{-- PIHAK I --}}
            <li>
                <span class="nomor">I.</span>
                <span class="konten">
                    <strong>{{ strtoupper($direktur->name ?? 'DIREKTUR UTAMA') }}</strong>
                    dalam hal ini bertindak dalam jabatannya selaku <strong>Direktur Utama</strong>
                    berdasarkan Perubahan Anggaran Dasar <strong>PT BANK PEREKONOMIAN RAKYAT SYARIAH
                        JAM GADANG PERSERODA</strong> Tanggal 10 Desember 2024 beserta perubahan-perubahan
                    dan yang terakhir termaktub dalam Akta Perubahan No.05 Tanggal 10 Desember 2024
                    yang dibuat oleh Notaris ZURLINA MERYANTI, SH, M.Kn yang telah disahkan oleh
                    menteri Hukum dan HAM no. AHU-0080574.AH.01.02. tahun 2024 Tanggal 11 Desember
                    2024 tentang Persetujuan Perubahan Anggaran Dasar Perseroan Terbatas Bank
                    Pembiayaan Rakyat Syariah Jam Gadang Perseroda menjadi <strong>PT. BANK PEREKONOMIAN
                        RAKYAT SYARIAH JAM GADANG PERSERODA</strong> berkantor pusat di Bukittinggi,
                    dengan alamat Jalan Soekarno Hatta No. 52 A Bukittinggi.&nbsp;...........
                    <br><br>
                    <strong>-Selanjutnya disebut dengan BANK (Pihak Pertama);</strong>
                </span>
            </li>

            {{-- PIHAK II --}}
            <li>
                <span class="nomor">II.</span>
                <span class="konten">

                    {{-- Nasabah --}}
                    <table class="info-table" style="width:100%; border-collapse:collapse; margin-bottom:6px;">
                        <tr>
                            <td style="width:6mm; vertical-align:top;">1.</td>
                            <td class="label-col">Nama</td>
                            <td class="colon-col">:</td>
                            <td class="value-col">{{ $nasabah->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat / Tgl Lahir</td>
                            <td>:</td>
                            <td class="value-col">
                                {{ $nasabah->tempat_lahir ?? '-' }} /
                                {{ $nasabah->tanggal_lahir ? \Carbon\Carbon::parse($nasabah->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td class="value-col">{{ $pengajuan->pekerjaan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td class="value-col">{{ $nasabah->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>KTP No</td>
                            <td>:</td>
                            <td class="value-col">{{ $nasabah->no_ktp ?? '-' }}</td>
                        </tr>
                    </table>

                    {{-- Penjamin --}}
                    <table class="info-table" style="width:100%; border-collapse:collapse; margin-bottom:6px;">
                        <tr>
                            <td style="width:6mm; vertical-align:top;">2.</td>
                            <td class="label-col">Nama Penjamin</td>
                            <td class="colon-col">:</td>
                            <td class="value-col">{{ $pasangan->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat / Tgl Lahir</td>
                            <td>:</td>
                            <td class="value-col">
                                {{ $pasangan->tempat_lahir ?? '-' }} /
                                {{ $pasangan?->dob ? \Carbon\Carbon::parse($pasangan->dob)->translatedFormat('d F Y') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td class="value-col">{{ $pasangan->pekerjaan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td class="value-col">{{ $pasangan->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>KTP No</td>
                            <td>:</td>
                            <td class="value-col">{{ $pasangan->no_ktp ?? '-' }}</td>
                        </tr>
                    </table>

                    <p><strong>Untuk selanjutnya disebut PIHAK KEDUA atau NASABAH</strong></p>

                    <p style="text-align:justify;">
                        Dimana Pihak Ke II tersebut diatas menerangkan atas Fasilitas Pembiayaan yang akan
                        disebutkan dibawah ini, mereka berjanji secara bersama-sama dan mengikat diri secara
                        tanggung menanggung/tanggung renteng untuk menanggung segala hutang atas Fasilitas
                        Pembiayaan yang tersebut dibawah ini.
                    </p>
                    <p style="text-align:justify;">
                        Para pihak dengan ini menerangkan terlebih dahulu sebagai berikut:&nbsp;.....................
                    </p>
                    <p style="text-align:justify;">
                        Bahwa berdasarkan Surat Permohonan Pembiayaan Utsman tertanggal
                        <strong>{{ \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat('d F Y') }}</strong>
                        NASABAH telah mengajukan permohonan Pembiayaan Murabahah secara tertulis kepada
                        PT. BPRS Jam Gadang (Perseroda) dan Bank telah memberi persetujuan secara tertulis
                        pada tanggal
                        <strong>{{ $akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d F Y') : '-' }}</strong>
                        dengan ketentuan pokok yang telah disetujui NASABAH. Ketentuan pokok tersebut akan
                        diuraikan lebih lanjut dalam ketentuan dan syarat-syarat akad pembiayaan Murabahah
                        sebagai berikut :&nbsp;....................
                    </p>

                    {{-- PASAL 1 --}}
                    <div class="pasal-header">PASAL 1<br>DEFINISI</div>

                    <table class="definisi-table">
                        @php
                            $definisi = [
                                [
                                    'Murabahah',
                                    'Akad jual beli antara BANK dan NASABAH, dimana BANK membeli barang yang diperlukan NASABAH yang bersangkutan sebesar harga perolehan ditambah dengan keuntungan yang disepakati.',
                                ],
                                [
                                    'Syari\'ah',
                                    'Hukum Islam yang bersumber dari Al-Qur\'an dan Al-Hadist (Sunnah) yang mengatur segala hal yang mencakup bidang \'ibadah madhah dan \'ibadah muamalah.',
                                ],
                                [
                                    'Barang',
                                    'Barang yang dihalalkan berdasarkan syari\'ah, baik materi maupun cara perolehannya, yang dibeli NASABAH dari Pemasok dengan pendanaan yang berasal dari Pembiayaan yang disediakan oleh BANK.',
                                ],
                                [
                                    'Pemasok',
                                    'Pihak ketiga yang ditunjuk atau setidak-tidaknya disetujui dan dikuasai oleh BANK untuk menyediakan barang untuk dibeli oleh NASABAH untuk dan atas nama BANK.',
                                ],
                                [
                                    'Pembiayaan',
                                    'Pagu atau plafon dana yang disediakan BANK digunakan untuk membeli barang dengan harga beli yang disepakati oleh BANK.',
                                ],
                                [
                                    'Harga beli',
                                    'Sejumlah uang yang disediakan bank kepada NASABAH untuk membeli barang dari pemasok atas permintaan NASABAH yang disetujui BANK berdasar Surat Persetujuan Prinsip dari BANK kepada NASABAH, maksimum sebesar pembiayaan.',
                                ],
                                [
                                    'Margin keuntungan',
                                    'Sejumlah uang sebagai keuntungan BANK atas terjadinya jual beli yang ditetapkan dalam Akad ini, yang dibayar oleh PEMKO BUKITTINGGI kepada BANK sesuai dengan jadwal pembayaran yang telah disepakati.',
                                ],
                                [
                                    'Harga Jual',
                                    'Harga beli ditambah dengan margin BANK yang disepakati antara BANK dengan PEMKO Bukittinggi.',
                                ],
                                [
                                    'Jangka Waktu Akad',
                                    'Masa berlakunya Akad ini sesuai yang ditentukan dalam Pasal 3 Akad ini.',
                                ],
                                [
                                    'Pembukuan Pembiayaan',
                                    'Pembukuan atas nama NASABAH pada BANK yang khusus mencatat seluruh transaksi NASABAH sehubungan dengan Pembiayaan, yang merupakan bukti sah dan mengikat NASABAH atas segala kewajiban pembayaran, sepanjang tidak dapat dibuktikan sebaliknya dengan cara yang sah menurut hukum.',
                                ],
                                [
                                    'Cidera Janji',
                                    'Peristiwa-peristiwa sebagaimana yang tercantum dalam Pasal 9 Akad ini yang menyebabkan BANK dapat menghentikan seluruh atau sebahagian pembiayaan, dan menagih seketika dan sekaligus jumlah kewajiban NASABAH kepada BANK sebelum Jangka Waktu Akad ini berakhir.',
                                ],
                            ];
                        @endphp
                        @foreach ($definisi as $i => $def)
                            <tr>
                                <td class="no">{{ $i + 1 }}.</td>
                                <td class="term">{{ $def[0] }}</td>
                                <td class="colon">:</td>
                                <td class="desc">{{ $def[1] }}</td>
                            </tr>
                        @endforeach
                    </table>

                </span>
            </li>
        </ol>

        {{-- PASAL 2 --}}
        <div class="pasal-header">PASAL 2<br>TRANSAKSI JUAL BELI DAN PENGAKUAN HUTANG</div>
        <ol class="list-normal">
            <li>
                BANK dan NASABAH sepakat untuk melakukan Transaksi Jual Beli Berupa :
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Volume</th>
                            <th>Satuan</th>
                            <th>Harga Rp</th>
                            <th>Total Rp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuan->barangs as $i => $barang)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td class="text-center">{{ $barang->volume }}</td>
                                <td class="text-center">{{ $barang->satuan }}</td>
                                <td class="text-end">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($barang->total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            @for ($r = 1; $r <= 4; $r++)
                                <tr>
                                    <td class="text-center">{{ $r }}</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endfor
                        @endforelse
                        <tr style="font-weight:bold; background:#eee;">
                            <td colspan="5" class="text-end">Grand Total</td>
                            <td class="text-end">
                                Rp {{ number_format($pengajuan->barangs->sum('total'), 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </li>

            <li>
                Dalam hal ini BANK memberi kuasa kepada NASABAH untuk membeli Barang sebagaimana disebutkan
                dalam Ayat 1 diatas dari dealer, toko dan/atau pemasok yang telah ditunjuk oleh BANK dan/atau
                NASABAH, kuasa mana dibuat tersendiri yang menjadi satu kesatuan dan bagian yang tidak
                terpisahkan dari perjanjian ini, dengan ketentuan sebagai berikut:

                @php
                    // Helper: terbilang sederhana (ribuan - milyar)
                    function terbilang($angka)
                    {
                        $angka = (int) $angka;
                        $satuan = [
                            '',
                            'Satu',
                            'Dua',
                            'Tiga',
                            'Empat',
                            'Lima',
                            'Enam',
                            'Tujuh',
                            'Delapan',
                            'Sembilan',
                            'Sepuluh',
                            'Sebelas',
                            'Dua Belas',
                            'Tiga Belas',
                            'Empat Belas',
                            'Lima Belas',
                            'Enam Belas',
                            'Tujuh Belas',
                            'Delapan Belas',
                            'Sembilan Belas',
                        ];
                        if ($angka < 20) {
                            return $satuan[$angka];
                        }
                        if ($angka < 100) {
                            return $satuan[((int) ($angka / 10) * 10) / 10 + 10] .
                                ($angka % 10 ? ' ' . $satuan[$angka % 10] : '');
                        }
                        // Simplified - just return number for large values
                        return number_format($angka, 0, ',', '.');
                    }

                    $jw = $akad->jangka_waktu_bulan ?? $pengajuan->jangka_waktu_bulan;
                    $hp = $akad->harga_pokok ?? ($pengajuan->jumlah_permohonan ?? 0);
                    $um = $akad->uang_muka ?? 1750000;
                    $pb = $akad->pembiayaan_bank ?? $hp;
                    $margin = $akad->margin ?? 0;
                    $hj = $akad->harga_jual ?? 0;
                    $sp = $akad->subsidi_pemko ?? 1750000;
                    $bn = $akad->beban_nasabah ?? 0;
                    $pm = $akad->piutang_murabahah ?? 0;
                    $ab = $akad->angsuran_bulanan ?? 0;
                @endphp

                <table class="ketentuan-table">
                    <tr>
                        <td style="width:45%;">Akad Pembiayaan</td>
                        <td style="width:5%;" class="text-center">:</td>
                        <td>Murabahah</td>
                    </tr>
                    <tr>
                        <td>Jangka Waktu</td>
                        <td class="text-center">:</td>
                        <td>{{ $jw }} Bulan</td>
                    </tr>
                    <tr>
                        <td>Harga Pokok Barang</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ number_format($hp, 0, ',', '.') }},-</td>
                    </tr>
                    <tr>
                        <td>Uang Muka / Urbun</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ number_format($um, 0, ',', '.') }},-</td>
                    </tr>
                    <tr>
                        <td>Pembiayaan dari Bank</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ number_format($pb, 0, ',', '.') }},-</td>
                    </tr>
                    <tr>
                        <td>Margin yang Disepakati</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ $margin ? number_format($margin, 0, ',', '.') . ',-' : '(...)' }}</td>
                    </tr>
                    <tr>
                        <td>Harga Jual ke Nasabah</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ $hj ? number_format($hj, 0, ',', '.') . ',-' : '(...)' }}</td>
                    </tr>
                    <tr>
                        <td>Subsidi PEMKO Bukittinggi</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ number_format($sp, 0, ',', '.') }},-</td>
                    </tr>
                    <tr>
                        <td>Beban Nasabah</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ $bn ? number_format($bn, 0, ',', '.') . ',-' : '(...)' }}</td>
                    </tr>
                    <tr>
                        <td>Piutang Murabahah / Nasabah</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ $pm ? number_format($pm, 0, ',', '.') . ',-' : '(...)' }}</td>
                    </tr>
                    <tr>
                        <td>Angsuran / Bulan</td>
                        <td class="text-center">:</td>
                        <td>Rp {{ $ab ? number_format($ab, 0, ',', '.') . ',-' : '(...)' }}</td>
                    </tr>
                </table>
            </li>
            <li>
                NASABAH mengakui bahwa total harga jual dan/atau sisa harga jual merupakan bukti yang sah
                sejumlah hutang NASABAH kepada BANK berdasarkan transaksi jual beli.
            </li>
            <li>
                Dalam hal NASABAH menjual kembali barang tersebut yang menyebabkan kerugian bagi NASABAH,
                maka NASABAH tetap mengakui hutangnya kepada BANK tanpa memperhitungkan kerugian yang
                ditanggungnya sebagaimana yang disebut dalam ayat 3 diatas.
            </li>
        </ol>

        {{-- PASAL 3 --}}
        @php
            $tanggalMulai = \Carbon\Carbon::parse($pengajuan->created_at);
            $tanggalSelesai = $tanggalMulai->copy()->addMonths($jw ?? 12);
        @endphp
        <div class="pasal-header">PASAL 3<br>JANGKA WAKTU, ANGSURAN, DAN TEMPAT PEMBAYARAN</div>
        <ol class="list-normal">
            <li>
                Akad ini berlaku untuk jangka waktu <strong>{{ $jw }}</strong> bulan, terhitung sejak tanggal
                <strong>{{ $tanggalMulai->translatedFormat('d F Y') }}</strong>
                dan akan berakhir serta harus dibayar lunas selambat-lambatnya pada tanggal
                <strong>{{ $tanggalSelesai->translatedFormat('d F Y') }}</strong>,
                sedangkan pembayaran kembali hutang dilakukan setiap bulannya selambat-lambatnya tanggal
                <strong>{{ $tanggalMulai->format('d') }}</strong>.
                *(Apabila jatuh tempo pembayaran diatas tanggal 25, maka pembayaran paling lambat tanggal 25 setiap
                bulannya).
            </li>
            <li>
                Atas pemberian pembiayaan ini Nasabah hanya membayar angsuran pokok sebesar
                <strong>Rp. {{ $ab ? number_format($ab, 0, ',', '.') : '(...)' }}</strong> setiap bulannya.
                Dan angsuran Margin sebesar <strong>Rp.
                    {{ $margin ? number_format($margin / $jw, 0, ',', '.') : '(...)' }}</strong>
                yang disubsidi oleh <strong>PEMERINTAH KOTA BUKITTINGGI ditambah Rp. (...) yang dibayar oleh nasabah
                    melalui PERWAKO Nomor 6 Tahun 2024 Tentang Penugasan Kepada PT. Bank Pembiayaan Rakyat Syariah
                    Jam Gadang (Perseroda) Sebagai Penyalur Subsidi Margin Pelaku Usaha Mikro.</strong>
            </li>
            <li>
                Pembayaran angsuran dilakukan NASABAH di kantor BANK pada hari dan jam kerja, dengan mendapat
                tanda bukti pembayaran yang sah, atau di tempat atau dengan cara lain yang disepakati, NASABAH
                wajib meminta tanda bukti yang sah.
            </li>
            <li>
                Jika jadwal angsuran hutang jatuh pada hari Minggu, hari libur umum atau hari yang bukan hari
                kerja lainnya ditempat dimana pembayaran tersebut harus dilaksanakan, maka NASABAH harus
                melakukan pembayaran tersebut pada hari kerja sebelumnya.
            </li>
            <li>
                Apabila NASABAH menghendaki pembayaran kembali kewajibannya pada BANK melalui rekening atas
                namanya di BANK, maka NASABAH memberi kuasa pada BANK untuk mendebet rekening NASABAH guna
                pembayaran angsuran setiap bulan, baik angsuran pokok, margin, denda, dan biaya-biaya lainnya.
            </li>
            <li>
                NASABAH menyetujui bahwa pembukuan BANK selalu menjadi dasar untuk menetapkan jumlah hutang
                yang wajib dibayar oleh NASABAH kepada BANK, <strong>tanpa mengurangi hak NASABAH untuk
                    membuktikan sebaliknya</strong>.
            </li>
            <li>
                Nasabah menyetujui bahwa penarikan Tabungan Utsman dapat dilakukan apabila pembiayaan
                dinyatakan lunas oleh bank.
            </li>
        </ol>

        {{-- PASAL 4 --}}
        <div class="pasal-header">PASAL 4<br>PENARIKAN PEMBIAYAAN</div>
        <p style="text-align:justify;">Dengan tetap memperhatikan dan menaati ketentuan-ketentuan tentang pembatasan
            penyediaan dana yang ditetapkan oleh yang berwenang, BANK berjanji dan dengan ini mengikatkan diri untuk
            mengizinkan NASABAH untuk menarik Pembiayaan, setelah NASABAH memenuhi seluruh prasyarat sebagai berikut :
        </p>
        <ol class="list-normal">
            <li>Menyerahkan kepada BANK Permohonan Realisasi Pembiayaan yang berisi perincian barang yang akan
                dibiayai dengan fasilitas pembiayaan beserta jumlah dan harganya berdasarkan Akad ini.</li>
            <li>Menyerahkan kepada BANK seluruh dokumen NASABAH. Telah menandatangani Akad ini dan Akad-akad
                jaminan yang disyaratkan.</li>
        </ol>

        {{-- PASAL 5 --}}
        <div class="pasal-header">PASAL 5<br>DENDA KETERLAMBATAN PEMBAYARAN DAN TA'WID</div>
        <ol class="list-normal">
            <li>Apabila NASABAH terlambat membayar angsuran sesuai kesepakatan diatas, NASABAH bersedia membayar
                denda per bulan keterlambatan dihitung dari jumlah angsuran tertunggak, dan akan disalurkan ke Dana
                Kebajikan dan beban biaya penagihan.</li>
            <li>BANK akan mengenakan Ta'wid (ganti rugi operasional) yang riil yang diakibatkan oleh kelalaian
                NASABAH dalam membayar kewajibannya.</li>
        </ol>

        {{-- PASAL 6 --}}
        <div class="pasal-header">PASAL 6<br>PERISTIWA DAN AKIBAT CIDERA JANJI</div>
        <p style="text-align:justify;">Menyimpang dari ketentuan dalam Pasal 3 Akad ini, BANK berhak untuk
            menuntut/menagih pembayaran dari NASABAH apabila terjadi salah satu hal atau peristiwa di bawah ini:</p>
        <ol class="list-normal">
            <li>Kelalaian NASABAH untuk melaksanakan kewajibannya menurut akad ini untuk membayar kembali angsuran
                pembiayaan tepat pada waktunya.</li>
            <li>Apabila pihak yang mewakili NASABAH dalam akad ini menjadi pemboros, pemabuk atau dihukum
                berdasar Putusan Pengadilan yang telah berkekuatan tetap.</li>
            <li>Apabila NASABAH berpindah domisili atau alamat surat menyurat tanpa pemberitahuan kepada BANK.</li>
        </ol>

        {{-- PASAL 7 --}}
        <div class="pasal-header">PASAL 7<br>PERNYATAAN DAN PENGAKUAN NASABAH</div>
        <p style="text-align:justify;">NASABAH dengan ini menyatakan dan mengakui:</p>
        <ol class="list-normal">
            <li>NASABAH berhak dan berwenang sepenuhnya untuk menandatangani Akad ini dan semua surat dan dokumen yang
                menyertainya.</li>
            <li>NASABAH menjamin bahwa segala dokumen dan akta yang ditandatangani oleh NASABAH berkaitan dengan akad
                ini, keberadaannya tidak melanggar atau bertentangan dengan peraturan perundang-undangan yang berlaku.
            </li>
            <li>NASABAH menjamin, bahwa terhadap setiap pembelian barang dari pihak ketiga, barang tersebut bebas dari
                penyitaan, pembebanan, tuntutan gugatan atau hak untuk menembus kembali.</li>
            <li>NASABAH berjanji dan dengan ini mengikatkan diri untuk dari waktu ke waktu menyerahkan kepada BANK,
                jaminan tambahan yang dinilai cukup oleh BANK.</li>
            <li>Sepanjang tidak bertentangan dengan peraturan perundang-undangan yang berlaku, NASABAH berjanji
                mendahulukan untuk membayar dan melunasi kewajiban NASABAH kepada BANK dari kewajiban lainnya.</li>
            <li>NASABAH berjanji untuk membebaskan BANK dari segala tuntutan atau gugatan yang datang dari pihak
                manapun.</li>
            <li>NASABAH setuju bahwa BANK mempunyai hak untuk mengalihkan, baik seluruh atau sebagian hak-hak yang
                timbul sehubungan dengan pelaksanaan Akad ini kepada pihak lainnya.</li>
            <li>Dalam hal BANK mengalihkan hak dan kewajibannya, NASABAH tetap terikat dan tunduk pada syarat-syarat dan
                ketentuan-ketentuan dalam akad ini.</li>
            <li>Nasabah tidak keberatan PT.BPRS Jam Gadang (Perseroda) memberikan data informasi pribadi kepada pihak
                lain.</li>
            <li>Nasabah setuju dan Ikhlas atas segala pendapatan yang diterima bank akibat dari pembiayaan ini, yang
                berkaitan dengan keikutsertaan nasabah atas penjaminan asuransi dan notaris.</li>
        </ol>

        {{-- PASAL 8 --}}
        <div class="pasal-header">PASAL 8<br>PENGAWASAN DAN PEMERIKSAAN</div>
        <p style="text-align:justify;">NASABAH berjanji dengan ini mengikatkan diri untuk memberikan izin kepada BANK
            atau pihak/petugas yang ditunjuknya, guna melaksanakan pengawasan/pemeriksaan terhadap pembukuan dan
            catatan-catatan pada setiap saat selama berjalannya akad ini.</p>

        {{-- PASAL 9 --}}
        <div class="pasal-header">PASAL 9<br>DOMISILI DAN PEMBERITAHUAN</div>
        <ol class="list-normal">
            <li>Alamat BANK dan NASABAH sebagaimana yang tercantum pada kalimat-kalimat awal akad ini merupakan alamat
                tetap dan tidak berubah bagi masing-masing pihak yang bersangkutan.</li>
            <li>Apabila dalam pelaksanaan akad ini terjadi perubahan alamat, maka pihak yang berubah alamatnya tersebut
                wajib memberitahukan kepada pihak lainnya alamat barunya dengan surat tercatat.</li>
            <li>Selama tidak ada pemberitahuan tentang perubahan alamat, maka surat menyurat atau komunikasi yang
                dilakukan ke alamat yang tercantum pada awal akad dianggap sah menurut Hukum.</li>
        </ol>

        {{-- PASAL 10 --}}
        <div class="pasal-header">PASAL 10<br>FORCE MAJEURE</div>
        <ol class="list-normal">
            <li>Masing-masing pihak tidak dapat menuntut/klaim atau mengajukan gugatan kepada Pihak Lain dalam hal
                terjadi keadaan Force Majeur yaitu bencana alam, kerusuhan, huru-hara, pemberontakan, peperangan atau
                ketentuan-ketentuan Pemerintah dalam bidang moneter.</li>
            <li>Dalam hal terjadi Force Majeur, maka Pihak yang terkena Force Majeur tersebut wajib memberitahukan
                secara tertulis kepada Pihak lainnya.</li>
            <li>Segala dan tiap-tiap permasalahan yang timbul akibat terjadinya Force Majeur akan diselesaikan oleh
                NASABAH dan BANK secara musyawarah untuk mufakat.</li>
        </ol>

        {{-- PASAL 11 --}}
        <div class="pasal-header">PASAL 11<br>PENYELESAIAN SENGKETA</div>
        <ol class="list-normal">
            <li>Dalam hal salah satu pihak tidak memenuhi kewajibannya atau jika terjadi sengketa, penyelesaian
                dilakukan dengan cara musyawarah dan mufakat.</li>
            <li>Dalam hal musyawarah tidak mencapai kesepakatan maka penyelesaian sengketa dapat dilakukan melalui
                mediasi perbankan sesuai peraturan dan perundangan yang berlaku.</li>
            <li>Dalam hal penyelesaian sengketa tidak mencapai kesepakatan, maka NASABAH dan BANK sepakat diselesaikan
                di Pengadilan Agama Bukittinggi.</li>
            <li>Putusan Pengadilan Agama tersebut bersifat final dan mengikat (final and binding).</li>
        </ol>

        {{-- PASAL 12 --}}
        <div class="pasal-header">PASAL 12</div>
        <p style="text-align:justify;">Perjanjian ini telah disesuaikan dengan ketentuan peraturan Perundang-Undangan
            termasuk ketentuan peraturan Otoritas Jasa Keuangan.</p>

        {{-- PASAL 13 --}}
        <div class="pasal-header">PASAL 13<br>PENUTUP</div>
        <ol class="list-normal">
            <li>Segala sesuatu yang belum diatur dalam akad ini yang oleh BANK diatur dalam surat-menyurat dan
                kertas-kertas lain yang merupakan bagian yang dilampirkan pada dan tidak dapat dipisahkan dari akad ini.
            </li>
            <li>Apabila ada hal-hal yang belum diatur atau belum cukup diatur dalam akad ini, maka NASABAH dan BANK akan
                mengaturnya bersama secara musyawarah untuk mufakat dalam suatu Addendum.</li>
            <li>Surat akad ini dibuat dan ditandatangani oleh NASABAH dan BANK diatas kertas bermaterai cukup dan
                disimpan oleh Bank.</li>
        </ol>

        <p style="text-align:justify;">
            Demikian akad ini dibuat dan ditandatangani di Bukittinggi pada hari ini,
            <strong>{{ $hari[date('l')] }}</strong> tanggal <strong>{{ $month }}.</strong>
        </p>

        <br>

        {{-- TANDA TANGAN --}}
        <table class="ttd-table">
            <tr>
                <td><strong>PIHAK PERTAMA</strong></td>
                <td><strong>PIHAK KEDUA</strong></td>
            </tr>
            <tr>
                <td>PT. BPRS JAM GADANG (Perseroda)</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="ttd-space"></td>
                <td class="ttd-space"></td>
            </tr>
            <tr>
                <td><u><strong>{{ strtoupper($direktur->name ?? '') }}</strong></u></td>
                <td><u><strong>{{ strtoupper($nasabah->name ?? '') }}</strong></u></td>
            </tr>
            <tr>
                <td>Direktur Utama</td>
                <td>&nbsp;</td>
            </tr>
        </table>

    </div>
</body>

</html>
