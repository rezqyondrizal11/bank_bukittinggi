<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Nasabah Disetujui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .kop {
            text-align: center;
        }

        .kop h2 {
            margin: 0;
        }

        .kop p {
            margin: 2px 0;
        }

        hr {
            border: 1px solid black;
        }

        .judul {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        .ttd {
            margin-top: 50px;
            width: 100%;
        }

        .ttd td {
            border: none;
            text-align: right;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <div class="kop">
        <h2>PT. BPRS TABUNGAN UTSMAN</h2>
        <p>Jl. Contoh Alamat No.123 Kota Anda</p>
        <p>Telp: 021-123456 | Email: info@utsman.co.id</p>
    </div>

    <hr>

    <div class="judul">
        SURAT KETERANGAN NASABAH DISETUJUI
    </div>

    <p>Tanggal: {{ $tanggal }}</p>

    <p>
        Dengan ini kami menyatakan bahwa nasabah berikut telah disetujui untuk
        proses pembiayaan berdasarkan hasil analisa dan penilaian yang telah dilakukan.
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No KTP</th>
                <th>No HP</th>
                <th>Nilai</th>
                <th>Surveyor</th>
                <th>Tanggal Survei</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pengajuanNasabah->nama }}</td>
                    <td>{{ $item->pengajuanNasabah->no_ktp }}</td>
                    <td>{{ $item->pengajuanNasabah->no_hp }}</td>
                    <td>{{ $item->nilai }}</td>
                    <td>
                        {{ $item->pengajuanNasabah?->prioritasSurveiCalonNasabahSurveyor?->user?->name ?? '-' }}
                    </td>
                    <td>
                        @php
                            $surveiDate = $item->pengajuanNasabah?->prioritasSurveiCalonNasabahSurveyor?->survei_date;
                        @endphp
                        {{ $surveiDate ? \Carbon\Carbon::parse($surveiDate)->format('d-m-Y') : '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <p>
        Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.
    </p>

    <table class="ttd">
        <tr>
            <td>
                Hormat Kami,<br><br><br><br>
                ___________________________<br>
                Manager Pembiayaan
            </td>
        </tr>
    </table>

</body>

</html>
