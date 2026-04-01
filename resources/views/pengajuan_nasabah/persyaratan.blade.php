@extends('layout.app')

@section('title', 'Persyaratan Pengajuan Pembiayaan Tabungan Utsman')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Persyaratan Pengajuan Pembiayaan Tabungan Utsman</h3>
        </div>

        <div class="card-body">

            <p>
                Sebelum melakukan pengajuan pembiayaan Tabungan Utsman, silakan pastikan Anda telah memenuhi
                persyaratan berikut:
            </p>

            <ul class="list-group mb-4">
                <li class="list-group-item">✅ Fotokopi KTP pemohon</li>
                <li class="list-group-item">✅ Fotokopi Kartu Keluarga (KK)</li>
                <li class="list-group-item">✅ Slip gaji / bukti penghasilan terakhir</li>
                <li class="list-group-item">✅ Rekening listrik / air (bila ada)</li>
                <li class="list-group-item">✅ Mengisi formulir pengajuan pembiayaan</li>
                <li class="list-group-item">✅ Memiliki rekening Tabungan Utsman</li>
            </ul>

            <div class="alert alert-info">
                <strong>Catatan:</strong>
                Pastikan seluruh dokumen dalam kondisi jelas dan valid untuk mempercepat proses verifikasi.
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('pengajuan_nasabah.index') }}" class="btn btn-secondary">
                    ← Kembali
                </a>

                <a href="{{ route('pengajuan_nasabah.create') }}" class="btn btn-primary">
                    Lanjut ke Form Pengajuan →
                </a>
            </div>

        </div>
    </div>

@endsection
