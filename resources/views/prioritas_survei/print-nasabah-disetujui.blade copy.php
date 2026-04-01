<!DOCTYPE html>
<html lang="id">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Akad Pembiayaan Murabahah</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS print kamu -->
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" />
</head>

<body>
    <div class="page">

        <!-- HEADER -->
        <div class="header">
            <img src="{{ asset('asset/image.png') }}" alt="Bank Jam Gadang"
                style="max-width: 450px; height: auto; display: block; margin: 0 auto;">
        </div>

        <hr class="header-divider" />

        <!-- TITLE -->
        <div class="title-section">
            <div class="doc-title">Akad Pembiayaan Murabahah</div>
            <div class="doc-number">No. 2215/BPRS-JG/MRB/1025-1026/2025</div>

            <div class="bismillah">Bismillahirrahmanirrahim</div>

            <!-- Ayat 1 -->
            <div class="ayat-block">
                <span class="ayat-text">"Hai orang-orang yang <u>beriman</u>, <u>penuhilah akad-akad itu</u>" </span>
                <span class="ayat-ref">(<i>QS. Al <u><b>Maidah</b></u> : 1</i>)</span>
            </div>

            <!-- Ayat 2 -->
            <div class="ayat-block">
                <span class="ayat-text">"Dan Allah telah <u>menghalalkan jual beli</u> dan <u>mengharamkan riba</u>"
                </span>
                <span class="ayat-ref">(<i>QS Al <u><b>Baqarah</b></u> : 275</i>)</span>
            </div>

            <!-- Ayat 3 (long) -->
            <div class="ayat-block long">
                <span class="ayat-text">
                    "Hai orang-orang yang <u><i>beriman! Janganlah kamu saling memakan harta sesamamu dengan jalan
                            yang <u>batil</u>, kecuali dengan jalan perdagangan yang berlaku atas dasar suka sama
                            suka</i></u> di <u>antara
                        kamu</u>"
                </span>
                <span class="ayat-ref">(<i>QS An <u><b>Nisa</b></u> : 29</i>)</span>
            </div>
        </div>

        <!-- BODY -->
        <div class="body-section">
            <p class="intro-date">
                Pada hari Kamis tanggal <strong>{{ $month }}</strong>;<br />
                Yang bertanda tangan
                dibawah;&nbsp;...............................................................................................
            </p>

            <ol class="pihak-list" type="I">
                <li>
                    <span class="nomor">I.</span>
                    <span class="konten">
                        <strong>{{ strtoupper($direktur->name) }}</strong> dalam hal ini bertindak dalam jabatannya
                        selaku
                        <strong>Direktur Utama</strong>
                        berdasarkan Perubahan Anggaran Dasar <strong>PT BANK PEREKONOMIAN RAKYAT SYARIAH JAM GADANG
                            PERSERODA</strong>
                        Tanggal 10 Desember 2024 beserta perubahan-perubahan dan yang terakhir termaktub dalam Akta
                        Perubahan No.05
                        Tanggal 10 Desember 2024 yang dibuat oleh Notaris ZURLINA MERYANTI, SH, M.Kn yang telah disahkan
                        oleh menteri
                        Hukum dan HAM no. AHU-0080574.AH.01.02. tahun 2024 Tanggal 11 Desember 2024 tentang Persetujuan
                        Perubahan
                        Anggaran Dasar Perseroan Terbatas Bank Pembiayaan Rakyat Syariah Jam Gadang Perseroda menjadi
                        <strong>PT. BANK PEREKONOMIAN RAKYAT SYARIAH JAM GADANG PERSERODA</strong> berkantor pusat di
                        Bukittinggi,
                        dengan alamat Jalan Soekarno Hatta No. 52 A
                        Bukittinggi.&nbsp;...............
                    </span>
                </li>
                <li>
                    <span class="nomor">II.</span>
                    <span class="konten">

                        {{-- Nasabah 1 --}}
                        <table style="width:100%; border-collapse:collapse; font-size:12pt; margin-bottom:3mm;">
                            <tr>
                                <td style="width:6mm; vertical-align:top;">1.</td>
                                <td style="width:38mm; vertical-align:top;">Nama</td>
                                <td style="width:4mm; vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->nama }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="vertical-align:top;">Tempat /Tgl Lahir</td>
                                <td style="vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->tempat_lahir }} /
                                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y', strtotime($data->pengajuanNasabah->dob)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="vertical-align:top;">Pekerjaan</td>
                                <td style="vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->pekerjaan }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="vertical-align:top;">Alamat</td>
                                <td style="vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->alamat }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="vertical-align:top;">KTP No</td>
                                <td style="vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->no_ktp }}
                                </td>
                            </tr>
                        </table>

                        {{-- Penjamin --}}
                        <table style="width:100%; border-collapse:collapse; font-size:12pt; margin-bottom:3mm;">
                            <tr>
                                <td style="width:6mm; vertical-align:top;">2.</td>
                                <td style="width:38mm; vertical-align:top;">Nama Penjamin</td>
                                <td style="width:4mm; vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->pasangan->nama }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="vertical-align:top;">Tempat /Tgl Lahir</td>
                                <td style="vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->pasangan->tempat_lahir }} /
                                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y', strtotime($data->pengajuanNasabah->pasangan->dob)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="vertical-align:top;">Pekerjaan</td>
                                <td style="vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->pasangan->pekerjaan }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="vertical-align:top;">Alamat</td>
                                <td style="vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->pasangan->alamat }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="vertical-align:top;">KTP No</td>
                                <td style="vertical-align:top;">:</td>
                                <td style="vertical-align:top; border-bottom:1px solid #000;">
                                    {{ $data->pengajuanNasabah->pasangan->no_ktp }}
                                </td>
                            </tr>
                        </table>

                        <p style="margin-top:3mm;"><strong>Untuk selanjutnya disebut PIHAK KEDUA atau NASABAH</strong>
                        </p>
                        <br>
                        <p>
                            Dimana Pihak Ke II tersebut diatas menerangkan atas Fasilitas Pembiayaan yang akan
                            disebutkan dibawah ini, mereka berjanji secara bersama-sama dan mengikat diri secara
                            tanggung menanggung/tanggung renteng untuk menanggung segala hutang atas Fasilitas
                            Pembiayaan yang tersebut dibawah ini.
                        </p>
                        <p>
                            Para pihak dengan ini menerangkan terlebih dahulu sebagai
                            berikut:&nbsp;................................................
                        </p>
                        <p>
                            Bahwa berdasarkan Surat Permohonan Pembiayaan Utsman tertanggal
                            {{ \Carbon\Carbon::now()->translatedFormat('d F Y', strtotime($data->pengajuanNasabah->created_at)) }}
                            NASABAH
                            telah
                            mengajukan permohonan Pembiayaan Murabahah secara tertulis kepada PT. BPRS Jam Gadang
                            (Perseroda) dan Bank telah memberi persetujuan secara tertulis pada tanggal
                            {{ \Carbon\Carbon::now()->translatedFormat('d F Y', strtotime($data->pengajuanNasabah->prioritasPenilaian->created_at)) }}
                            dengan ketentuan pokok yang telah disetujui NASABAH. Ketentuan pokok tersebut akan
                            diuraikan lebih lanjut dalam ketentuan dan syarat-syarat akad pembiayaan Murabahah sebagai
                            berikut :&nbsp;..........................
                        </p>
                        <div class="text-center">
                            <span> <strong>PASAL 1</strong></span>
                            <br>
                            <span> <strong>DEFINISI </strong></span>
                        </div>

                        <table class="definisi-table">
                            <tr>
                                <td class="no">1.</td>
                                <td class="term">Murabahah</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Akad jual beli antara BANK dan NASABAH, dimana BANK membeli barang yang diperlukan
                                    NASABAH yang bersangkutan sebesar harga perolehan ditambah dengan keuntungan yang
                                    disepakati.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">2.</td>
                                <td class="term">Syari'ah</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Hukum Islam yang bersumber dari Al-Qur'an dan Al-Hadist (Sunnah) yang mengatur
                                    segala hal yang mencakup bidang 'ibadah madhah dan 'ibadah muamalah.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">3.</td>
                                <td class="term">Barang</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Barang yang dihalalkan berdasarkan syari'ah, baik materi maupun cara perolehannya,
                                    yang dibeli NASABAH dari Pemasok dengan pendanaan yang berasal dari Pembiayaan yang
                                    disediakan oleh BANK.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">4.</td>
                                <td class="term">Pemasok</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Pihak ketiga yang ditunjuk atau setidak-tidaknya disetujui dan dikuasai oleh BANK
                                    untuk menyediakan barang untuk dibeli oleh NASABAH untuk dan atas nama BANK.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">5.</td>
                                <td class="term">Pembiayaan</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Pagu atau plafon dana yang disediakan BANK digunakan untuk membeli barang dengan
                                    harga beli yang disepakati oleh BANK.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">6.</td>
                                <td class="term">Harga beli</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Sejumlah uang yang disediakan bank kepada NASABAH untuk membeli barang dari pemasok
                                    atas permintaan NASABAH yang disetujui BANK berdasar Surat Persetujuan Prinsip dari
                                    BANK kepada NASABAH, maksimum sebesar pembiayaan.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">7.</td>
                                <td class="term">Margin keuntungan</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Sejumlah uang sebagai keuntungan BANK atas terjadinya jual beli yang ditetapkan
                                    dalam Akad ini, yang dibayar oleh PEMKO BUKITTINGI kepada BANK sesuai dengan jadwal
                                    pembayaran yang telah disepakati. Harga beli ditambah dengan margin BANK yang
                                    disepakati antara BANK dengan PEMKO Bukittinggi. Masa berlakunya Akad ini sesuai
                                    yang ditentukan dalam Pasal 3 Akad ini.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">8.</td>
                                <td class="term">Harga Jual</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Harga beli ditambah dengan margin BANK yang disepakati antara BANK dengan PEMKO
                                    Bukittinggi.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">9.</td>
                                <td class="term">Jangka Waktu Akad</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Masa berlakunya Akad ini sesuai yang ditentukan dalam Pasal 3 Akad ini.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">10.</td>
                                <td class="term">Pembukuan Pembiayaan</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Pembukuan atas nama NASABAH pada BANK yang khusus mencatat seluruh transaksi NASABAH
                                    sehubungan dengan Pembiayaan, yang merupakan bukti sah dan mengikat NASABAH atas
                                    segala kewajiban pembayaran, sepanjang tidak dapat dibuktikan sebaliknya dengan cara
                                    yang sah menurut hukum.
                                </td>
                            </tr>

                            <tr>
                                <td class="no">11.</td>
                                <td class="term">Cidera Janji</td>
                                <td class="colon">:</td>
                                <td class="desc">
                                    Peristiwa-peristiwa sebagaimana yang tercantum dalam Pasal 9 Akad ini yang
                                    menyebabkan BANK dapat menghentikan seluruh atau sebahagian pembiayaan, dan menagih
                                    seketika dan sekaligus jumlah kewajiban NASABAH kepada BANK sebelum Jangka Waktu
                                    Akad ini berakhir.
                                </td>
                            </tr>

                        </table>
                    </span>
                </li>
            </ol>
            <div class="text-center">
                <span> <strong>PASAL 2</strong></span>
                <br>
                <span> <strong>TRANSAKSI JUAL BELI DAN PENGAKUAN HUTANG </strong></span>
            </div>
            <ol class="list-normal">
                <li>
                    BANK dan NASABAH sepakat untuk melakukan Transaksi Jual Beli Berupa :

                    <table class="table table-bordered">
                        <thead class="table-secondary">
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
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                        </tfoot>
                    </table>
                </li>
                <li>
                    Dalam hal ini BANK memberi kuasa kepada NASABAH untuk membeli Barang sebagaimana disebutkan dalam
                    Ayat 1 diatas dari dealer, toko dan/atau pemasok yang telah ditunjuk oleh BANK dan/atau NASABAH,
                    kuasa mana dibuat tersendiri yang menjadi satu kesatuan dan bagian yang tidak terpisahkan dari
                    perjanjian ini, dengan ketentuan sebagai berikut:
                    <table class="table table-bordered fw-bold">
                        <tr>
                            <td>Akad Pembiayaan</td>
                            <td class="text-center">:</td>
                            <td>Murabahah</td>
                        </tr>
                        <tr>
                            <td>Jangka Waktu</td>
                            <td class="text-center">:</td>
                            <td>12 (Dua Belas) Bulan</td>
                        </tr>
                        <tr>
                            <td>Harga Pokok Barang</td>
                            <td class="text-center">:</td>
                            <td>Rp. 10.000.000,-(Sepuluh Juta Rupiah)</td>
                        </tr>
                        <tr>
                            <td>Uang Muka / Urbun</td>
                            <td class="text-center">:</td>
                            <td>Rp. 1.750.000,- (Satu Juta Tujuh Ratus Lima Puluh Rupiah)</td>
                        </tr>
                        <tr>
                            <td>Pembiayaan dari Bank</td>
                            <td class="text-center">:</td>
                            <td>Rp. 10.000.000,-(Sepuluh Juta Rupiah)</td>
                        </tr>
                        <tr>
                            <td>Margin yang Disepakati</td>
                            <td class="text-center">:</td>
                            <td>Rp. ()</td>
                        </tr>
                        <tr>
                            <td>Harga jual ke Nasabah</td>
                            <td class="text-center">:</td>
                            <td>Rp. ()</td>
                        </tr>
                        <tr>
                            <td>Subsidi PEMKO Bukittinggi</td>
                            <td class="text-center">:</td>
                            <td>Rp. 1.750.000,- (Satu Juta Tujuh Ratus Lima Puluh Rupiah)</td>
                        </tr>
                        <tr>
                            <td>Beban Nasabah</td>
                            <td class="text-center">:</td>
                            <td>Rp. ()</td>
                        </tr>
                        <tr>
                            <td>Piutang Nasabah</td>
                            <td class="text-center">:</td>
                            <td>Rp. ()</td>
                        </tr>
                        <tr>
                            <td>Angsuran / Bulan</td>
                            <td class="text-center">:</td>
                            <td>Rp. ()</td>
                        </tr>
                    </table>
                </li>
                <li>
                    NASABAH mengakui bahwa total harga jual dan/atau sisa harga jual merupakan bukti yang sah
                    sejumlah hutang NASABAH kepada BANK berdasarakan transaksi jual beli
                </li>
                <li>
                    Dalam hal NASABAH menjual kembali barang tersebut yang menyebabkan kerugian bagi NASABAH, maka
                    NASABAH tetap mengakui hutangnya kepada BANK tanpa memperhitungkan kerugian yang ditanggungnya
                    sebagaimana yang disebut dalam ayat 3 diatas.
                </li>
            </ol>
            <div class="text-center">
                <span> <strong>PASAL 3</strong></span>
                <br>
                <span> <strong>JANGKA WAKTU, ANGSURAN, DAN TEMPAT PEMBAYARAN</strong></span>
            </div>
            <ol class="list-normal">
                <li>
                    Akad ini berlaku untuk jangka waktu <strong>12 (Dua Belas)</strong> bulan, terhitung sejak tanggal
                    <strong>
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y', strtotime($data->pengajuanNasabah->created_at)) }}</strong>
                    dan akan berakhir serta harus dibayar lunas selambat-lambatnya pada tanggal <strong>23 Oktober
                        2026</strong>,
                    sedangkan pembayaran kembali hutang dilakukan setiap bulannya selambat- lambatnya tanggal
                    <strong>
                        {{ \Carbon\Carbon::now()->translatedFormat('d', strtotime($data->pengajuanNasabah->created_at)) }}</strong>.
                    *(Apabila jatuh tempo pembayaran diatas tanggal 25, maka pembayaran paling lambat tanggal 25 setiap
                    bulannya).
                </li>
                <li>
                    Atas pemberian pembiayaan ini Nasabah hanya membayar angsuran pokok sebesar <strong>Rp. ()
                    </strong>setiap
                    bulannya. Dan angsuran Margin sebesar <strong>Rp. ()</strong> yang disubsidi oleh <strong>PEMERINTAH
                        KOTA BUKITTINGGI
                        ditambah Rp. () yang dibayar oleh nasabah melalui PERWAKO Nomor 6 Tahun 2024 Tentang Penugasan
                        Kepada PT. Bank Pembiayaan Rakyat Syariah Jam Gadang (Perseroda) Sebagai Penyalur Subsidi Margin
                        Pelaku Usaha Mikro.</strong>
                </li>
                <li>
                    Pembayaran angsuran dilakukan NASABAH di kantor BANK pada hari dan jam kerja, dengan mendapat
                    tanda bukti pembayaran yang sah, atau di tempat atau dengan cara lain yang sepakati, NASABAH wajib
                    meminta tanda bukti yang sah. Apabila NASABAH membayar pada tanggal dan tempat serta cara pembayaran
                    diluar dari yang disepakati, maka hal tersebut menjadi tanggung jawab NASABAH.
                </li>
                <li>
                    Jika jadwal angsuran hutang jatuh pada hari Minggu, hari libur umum atau hari yang bukan hari
                    kerja lainnya ditempat dimana pembayaran tersebut harus dilaksanakan, maka NASABAH harus melakukan
                    pembayaran tersebut pada hari kerja sebelumnya.
                </li>
                <li>
                    Apabila NASABAH menghendaki pembayaran kembali kewajibannya pada BANK melalui rekening atas
                    namanya di BANK, maka NASABAH memberi kuasa pada BANKyang menjadi satu kesatuan dan bagian yang
                    tidak terpisahkan dari akad ini, untuk mendebet rekening NASABAH guna pembayaran angsuran setiap
                    bulan, baik angsuran pokok, margin, denda, dan biaya-biaya lainnya yang timbul sehubungan dengan
                    fasilitas pembiayaan yang diberikan.
                </li>
                <li>
                    NASABAH menyetujui bahwa pembukuan BANK selalu menjadi dasar untuk menetapkan jumlah hutang yang
                    wajib dibayar oleh NASABAH kepada BANK berdasarkan perjanjian pembiayaan ini, baik jumlah pokok,
                    margin, denda dan biaya-biaya lainnya dan NASABAH akan menerima baik perhitungan yang dibuat dan
                    diberikan oleh BANK sebagaimana diuraikan di atas, <strong> tanpa mengurangi hak NASABAH untuk
                        membuktikan sebaliknya</strong>.
                </li>
                <li>
                    Nasabah menyetujui bahwa penarikan Tabungan Usman dapat dilakukana pabila pembiayaan dinyatakan
                    lunas oleh bank.
                </li>
            </ol>

            <div class="text-center">
                <span> <strong>PASAL 4</strong></span>
                <br>
                <span> <strong>PENARIKAN PEMBIAYAAN</strong></span>
            </div>
            <span>
                Dengan tetap memperhatikan dan menaati ketentuan-ketentuan tentang pembatasan penyediaan dan yang
                ditetapkan oleh yang berwenang, BANK berjanji dan dengan ini mengikatkan diri untuk mengizinkan NASABAH
                untuk menarik Pembiayaan, setelah NASABAH memenuhi seluruh prasyarat sebagai berikut :
            </span>
            <ol class="list-normal">
                <li>
                    Menyerahkan kepada BANK Permohonan Realisasi Pembiayaan yang berisi perincian barang yang akan
                    dibiayai dengan fasilitas pembiayaan beserta jumlah dan harganya berdasarkan Akad ini.
                </li>
                <li>
                    Menyerahkan kepada BANK seluruh dokumen NASABAH. Telah menandatangani Akad ini dan Akad-akad
                    jaminan yang disyaratkan. Terhadap setiap penarikan seluruh Pembiayaan, NASABAH berkewajiban
                    menandatangani Tanda Bukti Penerimaan uangnya dan menyerahkan kepada BANK
                </li>
            </ol>
            <div class="text-center">
                <span> <strong>PASAL 5</strong></span>
                <br>
                <span> <strong>DENDA KETERLAMBATAN PEMBAYARAN DAN TA'WID</strong></span>
            </div>
            <ol class="list-normal">
                <li>
                    Apabila NASABAH terlambat membayar angsuran sesuai kesepakatan diatas, NASABAH bersedia membayar
                    denda sebesar Rp. /bulanketerlambatan dihitung dari jumlah angsuran tertunggak, danakan disalurkan
                    ke Dana Kebajikan dan beban biaya penagihan. Pembebanan dendatersebut dimulai sejak jatuh tempo
                    angsuran sampai dengan jadwalpembayaran.
                </li>
                <li>
                    BANK akan mengenakan Ta'wid (ganti rugi operasional) yang riil yang diakibatkan oleh kelalaian
                    NASABAH dalam membayar kewajibannya
                </li>
            </ol>
            <div class="text-center">
                <span> <strong>PASAL 6</strong></span>
                <br>
                <span> <strong>PERISTIWA DAN AKIBAT CIDERA JANJI</strong></span>
            </div>
            <span>
                Menyimpang dari ketentuan dalam Pasal 3 Akad ini, BANK berhak untuk menuntut/ menagih pembayaran dari
                NASABAH atau siapa pun juga yang memperoleh hak darinya, atas sebagian atau seluruh jumlah hutang
                NASABAH kepada BANK berdasarkan Akad ini, untuk dibayar dengan seketika dan sekaligus apabila terjadi
                salah satu hal atau peristiwa di bawah ini:
            </span>
            <ol class="list-normal">
                <li>
                    Kelalaian NASABAH untuk melaksanakan kewajibannya menurut akad ini untuk membayar kembali
                    angsuran pembiayaan tepat pada waktunya, dalam hal lewat jangka waktu saja telah menjadi bukti yang
                    cukup bahwa NASABAH telah melalaikan kewajibannya. Untuk hal ini BANK dan NASABAH sepakat untuk
                    mengenyampingkan pasal 1236 Kitab Undang-Undang Hukum Perdata.
                </li>
                <li>
                    Apabila pihak yang mewakili NASABAH dalam akad ini menjadi pemboros, pemabuk atau dihukum
                    berdasar Putusan Pengadilan yang telah berkekuatan tetap dan pasti (in kracht van gewijsde) karena
                    perbuatan kejahatan yang dilakukannya, yang diancam dengan hukuman penjara atau kurungan satu tahun
                    atau lebih.
                </li>
                <li>
                    Apabila NASABAH berpindah domisili atau alamat surat menyurat tanpa pemberitahuan kepada BANK
                    yang akibat perbuatan NASABAH tersebut BANK mengalami kerugian, maka seluruh pembiayaan tersebut
                    akan menjadi jatuh tempo dan seluruh kewajiban NASABAH harus dibayarkan kepada BANK, dalam hal ini
                    BANK dapat mengambil tindakan apapun yang dianggap perlu sehubungan dengan perjanjian ini atau
                    sesuai dengan undang-undang dan peraturan yang berlaku untuk menjamin pelunasan kembali pembayaran
                    dimaksud.
                </li>
            </ol>
            <div class="text-center">
                <span> <strong>PASAL 7</strong></span>
                <br>
                <span> <strong>PERNYATAAN DAN PENGAKUAN NASABAH</strong></span>
            </div>
            <span>
                NASABAH dengan ini menyatakan dan mengakui:
            </span>
            <ol class="list-normal">
                <li>NASABAH berhak dan berwenang sepenuhnya untuk menandatangani Akad ini dan semua surat dan dokumen
                    yang menyertainya. </li>
                <li>
                    NASABAH menjamin bahwa segala dokumen dan akta yang ditandatangani oleh NASABAH berkaitan dengan
                    akad ini, keberadaannya tidak melanggar atau bertentangan dengan peraturan perundang-undangan yang
                    berlaku, sehingga karenanya sah, berkekuatan hukum, serta mengikat NASABAH dalam menjalankan Akad
                    ini dan demikian pula tidak dapat menghalang-halangi pelaksanaannya.
                </li>
                <li>
                    NASABAH menjamin, bahwa terhadap setiap pembelian barang dari pihak ketiga, barang tersebut bebas
                    dari penyitaan, pembebanan, tuntutan gugatan atau hak untuk menembus kembali.
                </li>
                <li>
                    NASABAH berjanji dan dengan ini mengikatkan diri untuk dari waktu ke waktu menyerahkan kepada
                    BANK, jaminan tambahan yang dinilai cukup oleh BANK, selama kewajiban membayar hutang atau sisa
                    hutang kepada BANK belum lunas.
                </li>
                <li>
                    Sepanjang tidak bertentangan dengan peraturan perundang-undangan yang berlaku, NASABAH berjanji
                    dan dengan ini mengikatkan diri mendahulukan untuk membayar dan melunasi kewajiban NASABAH kepada
                    BANK dari kewajiban lainnya.
                </li>
                <li>
                    Dalam hak-hak yang berkaitan dengan ayat 1, 2 dan 3 dalam pasal ini, NASABAH berjanji dan dengan
                    ini mengkatkan diri untuk membebaskan BANK dari segala tuntutan atau gugatan yang datang dari pihak
                    manapun dan/atau alasan apapun.
                </li>
                <li>
                    NASABAH setuju bahwa apabila dianggap perlu oleh BANK, berdasarkan pertimbangannya sendiri BANK
                    mempunyai hak untuk mengalihkan, baik seluruh atau sebagian hak-hak yang timbul sehubungan dengan
                    pelaksanaan Akad ini (berikut setiap perubahan, penambahan atau perpanjangan ) kepada pihak lainnya,
                    dan NASABAH setuju bahwa penerima pengalihan hak yang bersangkutan akan mendapat manfaat yang sama
                    dengan yang diberikan kepada BANK berdasarkan akad ini.
                </li>
                <li>
                    Dalam hal BANK mengalihkan hak dan kewajibannya baik sebagian atau seluruhnya, NASABAH tetap
                    terikat dan tunduk pada syarat-syarat dan ketentuan-ketentuan dalam akad ini (berikut setiap
                    perubahan, penambahan atau perpanjangan) serta perjanjian-perjanjian / akad- akad yang berhubungan
                    dengan pelaksanaan akad.
                </li>
                <li>
                    Nasabah tidak keberatan PT.BPRS Jam Gadang (Perseroda) memberikan data informasi pribadi kepada
                    pihak lain.
                </li>
                <li>
                    Nasabah setuju dan Ikhlas atas segala pendapatan yang diterima bank akibat dari pembiayaan ini,
                    yang berkaitan dengan keikutsertaan nasabah atas penjaminan asuransi dan notaris.
                </li>
            </ol>
            <div class="text-center">
                <span> <strong>PASAL 8</strong></span>
                <br>
                <span> <strong>PENGAWASAN DAN PEMERIKSAAN</strong></span>
            </div>
            <span>
                NASABAH berjanji dengan ini mengikatkan diri untuk memberikan izin kepada BANK atau pihak/petugas yang
                ditunjuknya, guna melaksanakan pengawasan/pemeriksaan terhadap pembukuan dan catatan-catatan pada setiap
                saat selama berjalannya akad ini, dan kepada petugas BANK tersebut diberi hak untuk mengambil foto,
                membuat photocopy dan atau catatan-catatan yang dianggap perlu.
            </span>
            <div class="text-center">
                <span> <strong>PASAL 9</strong></span>
                <br>
                <span> <strong>DOMISILI DAN PEMBERITAHUAN</strong></span>
            </div>
            <ol class="list-normal">
                <li>
                    Alamat BANK dan NASABAH sebagaimana yang tercantum pada kalimat-kalimat awal akad ini merupakan
                    alamat tetap dan tidak berubah bagi masing-masing pihak yang bersangkutan, alamat-alamat itu pula
                    secara sah segala surat menyurat atau komunikasi di antara kedua pihak akan dilakukan;
                </li>
                <li>
                    Apabila dalam pelaksanaan akad ini terjadi perubahan alamat, maka pihak yang berubah alamatnya
                    tersebut wajib memberitahukan kepada pihak lainnya alamat barunya dengan surat tercatat atau surat
                    tertulis yang disertai tanda bukti penerimaan dari pihak lainnya;
                </li>
                <li>
                    Selama tidak ada pemberitahuan tentang perubahan alamat sebagaimana dimaksud pada ayat 2 pasal
                    ini, maka surat menyurat atau komunikasi yang dilakukan ke alamat yang tercantum pada awal akad
                    dianggap sah menurut Hukum
                </li>
            </ol>
            <div class="text-center">
                <span> <strong>PASAL 10</strong></span>
                <br>
                <span> <strong>FORCE MAJEURE</strong></span>
            </div>
            <ol class="list-normal">
                <li>
                    Masing-masing pihak tidak dapat menuntut/klaim atau mengajukan gugatan kepada Pihak Lain dalam
                    hal terjadi keadaan Force Majeur yaitu peristiwa-peristiwa atau kejadian-kejadian yang disebabkan
                    oleh dan hanya karena keadaan bencana alam, kerusuhan, huru-hara, pemberontakan, peperangan atau
                    ketentuan-ketentuan Pemerintah dalam bidang moneter atau ketentuan Bank Indonesia yang harus
                    didahulukan dari pelaksanaan akad ini.
                </li>
                <li>
                    Dalam hal terjadi Force Majeur, maka Pihak yang terkena Force Majeur tersebut wajib
                    memberitahukan secara tertulis kepada Pihak lainnya mengenai peristiwa Force Majeur tersebut.
                </li>
                <li>
                    Segala dan tiap-tiap permasalahan yang timbul akibat terjadinya Force Majeur akan diselesaikan oleh
                    NASABAH dan BANK secara musyawarah untuk mufakat. Hal tersebut tanpa mengurangi hak-hak BANK
                    sebagaimana diatur dalam akad ini.
                </li>
            </ol>

            <div class="text-center">
                <span> <strong>PASAL 11</strong></span>
                <br>
                <span> <strong>PENYELESAIAN SENGKETA</strong></span>
            </div>
            <ol class="list-normal">
                <li>
                    Dalam hal salah satu pihak tidak memenuhi kewajibannya sebagaimana tertuang dalam akad ini atau
                    jika terjadi sengketa antara BANK dengan NASABAH, penyelesaian dilakukan dengan cara musyawarah dan
                    mufakat.
                </li>
                <li>
                    Dalam hal musyawarah sebagaimana yang dimaksud pada ayat 01 (satu) tidak mencapai kesepakatan maka
                    penyelesaian sengketa dapat dilakukan antara lain melalui mediasi termasuk mediasi perbankan sesuai
                    peraturan dan perundangan yang berlaku.
                </li>
                <li>
                    Dalam hal penyelesaian sengketa sebagaimana yang dimaksud pada ayat 02 (dua) tidak mencapai
                    kesepakatan, maka dengan ini NASABAH dan BANK sepakat diselesaikan dan diputuskan di Pengadilan
                    Agama Bukittinggi
                </li>
                <li>
                    Putusan Pengadilan Agama tersebut bersifat final dan mengikat (final and binding) untuk
                    dilaksanakan antara NASABAH dan BANK
                </li>
            </ol>
            <div class="text-center">
                <span> <strong>PASAL 12</strong></span>

            </div>
            <span>
                Perjanjian ini telah disesuaikan dengan ketentuan peraturan Perundang-Undangan termasuk ketentuan
                peraturan Otoritas Jasa Keuangan.
            </span>
            <div class="text-center">
                <span> <strong>PASAL 13</strong></span>
                <br>
                <span> <strong>PENUTUP</strong></span>
            </div>
            <ol class="list-normal">
                <li>
                    Segala sesuatu yang belum diatur dalam akad ini yang oleh BANK diatur dalam surat-menyurat dan
                    kertas-kertas lain yang merupakan bagian yang dilampirkan pada dan tidak dapat dipisahkan dari akad
                    ini.
                </li>
                <li>
                    Apabila ada hal-hal yang belum diatur atau belum cukup diatur dalam akad ini, maka NASABAH dan
                    BANK akan mengaturnya bersama secara musyawarah untuk mufakat dalam suatu Addendum. Tiap Addendum
                    dari akad ini merupakan satu kesatuan yang tidak terpisahkan dari akad ini
                </li>
                <li>
                    Surat akad ini dibuat dan ditandatangani oleh NASABAH dan BANK diatas kertas bermaterai cukup dan
                    disimpan oleh Bank
                </li>
            </ol>
            <span>
                Demikian akad ini dibuat dan ditandatangani di Bukittinggi pada hari ini, <strong>
                    {{ $hari[date('l')] }} </strong> tanggal <strong>{{ $month }}.</strong>
            </span>
            <br><br><br>

            <table style="width:100%; text-align:center; font-size:12pt;">
                <tr>
                    <td style="width:50%;">
                        PIHAK PERTAMA

                    </td>

                    <td style="width:50%;">
                        PIHAK KEDUA

                    </td>
                </tr>
                <tr>
                    <td style="width:50%;">

                        PT. BPRS JAM GADANG (Perseroda)
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td style="height:90px;"></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <u><strong>{{ strtoupper($direktur->name) }}</strong></u>


                    </td>

                    <td>
                        <u><strong>{{ strtoupper($data->pengajuanNasabah->nama) }}</strong></u>
                    </td>
                </tr>
                <tr>
                    <td> Direktur Utama</td>
                    <td></td>
                </tr>
            </table>
        </div>

    </div>
</body>

</html>
