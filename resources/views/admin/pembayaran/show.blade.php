@extends('layouts.site')

@section('content')

<style>
    .admin-payment-page {
        max-width: 1450px;
        margin: 0 auto;
        padding: 40px 40px 80px;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-header .eyebrow {
        color: #15803d;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .page-header h1 {
        margin: 0;
        color: #17213a;
        font-size: 36px;
        font-weight: 800;
    }

    .page-header p {
        margin-top: 10px;
        color: #6b7c96;
        font-size: 16px;
    }

    .alert {
        border-radius: 16px;
        padding: 16px 20px;
        margin-bottom: 24px;
        font-weight: 600;
    }

    .alert-success {
        background: #e8f8ee;
        border: 1px solid #b9e6c8;
        color: #15803d;
    }

    .alert-error {
        background: #fff3df;
        border: 1px solid #f2d39b;
        color: #a45b00;
    }

    .payment-layout {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 28px;
        align-items: start;
    }

    .card {
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid rgba(180, 210, 194, 0.55);
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 12px 35px rgba(40, 70, 55, 0.06);
        backdrop-filter: blur(12px);
    }

    .card + .card {
        margin-top: 28px;
    }

    .card-title {
        margin: 0 0 24px;
        color: #17213a;
        font-size: 22px;
        font-weight: 800;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .detail-item {
        background: rgba(247, 251, 248, 0.9);
        border: 1px solid #e0ebe4;
        border-radius: 16px;
        padding: 18px;
    }

    .detail-label {
        display: block;
        color: #71829b;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .detail-value {
        color: #17213a;
        font-size: 16px;
        font-weight: 750;
        line-height: 1.4;
    }

    .amount-box {
        margin-top: 22px;
        padding: 22px;
        border-radius: 18px;
        background: linear-gradient(
            135deg,
            rgba(218, 244, 226, 0.95),
            rgba(239, 250, 243, 0.95)
        );
        border: 1px solid #b9e4c6;
    }

    .amount-box span {
        display: block;
        color: #67806f;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .amount-box strong {
        color: #15803d;
        font-size: 30px;
        font-weight: 850;
    }

    .method-transfer {
        color: #2563a8;
    }

    .method-qris {
        color: #15803d;
    }

    .status {
        display: inline-flex;
        align-items: center;
        padding: 8px 15px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
    }

    .status-menunggu {
        background: #fff2d7;
        color: #a86100;
    }

    .status-diverifikasi {
        background: #dcf7e5;
        color: #15803d;
    }

    .status-ditolak {
        background: #ffe3e3;
        color: #b42318;
    }

    .proof-wrapper {
        background: #f7faf8;
        border: 1px solid #dce9e1;
        border-radius: 20px;
        padding: 18px;
        text-align: center;
    }

    .proof-wrapper img {
        display: block;
        width: 100%;
        max-height: 650px;
        object-fit: contain;
        border-radius: 14px;
        background: white;
    }

    .proof-empty {
        padding: 65px 25px;
        border: 2px dashed #cbded2;
        border-radius: 18px;
        color: #71829b;
    }

    .proof-empty strong {
        display: block;
        color: #4c5c70;
        font-size: 17px;
        margin-bottom: 6px;
    }

    .proof-note {
        margin-top: 12px;
        color: #71829b;
        font-size: 13px;
    }

    .actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 24px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 48px;
        padding: 0 22px;
        border-radius: 13px;
        border: none;
        font-size: 15px;
        font-weight: 750;
        cursor: pointer;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-back {
        background: white;
        color: #17213a;
        border: 1px solid #b8d2c1;
    }

    .btn-success {
        background: #16803d;
        color: white;
    }

    .btn-danger {
        background: #c93636;
        color: white;
    }

    .reject-box {
        margin-top: 22px;
        padding: 22px;
        border-radius: 18px;
        background: #fff8f8;
        border: 1px solid #f1cccc;
    }

    .reject-box h3 {
        margin: 0 0 15px;
        color: #8f2020;
        font-size: 17px;
    }

    .reject-box label {
        display: block;
        margin-bottom: 8px;
        color: #374151;
        font-size: 14px;
        font-weight: 700;
    }

    .reject-box textarea {
        width: 100%;
        min-height: 120px;
        resize: vertical;
        box-sizing: border-box;
        border: 1px solid #d8caca;
        border-radius: 12px;
        padding: 13px 14px;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        background: white;
    }

    .reject-box textarea:focus {
        border-color: #c93636;
        box-shadow: 0 0 0 3px rgba(201, 54, 54, 0.08);
    }

    .existing-note {
        margin-top: 22px;
        padding: 18px;
        border-radius: 16px;
        background: #fff7e8;
        border: 1px solid #f1d9a9;
    }

    .existing-note strong {
        display: block;
        color: #8a5700;
        margin-bottom: 8px;
    }

    .existing-note p {
        margin: 0;
        color: #725a2d;
        line-height: 1.6;
    }

    @media (max-width: 1000px) {
        .payment-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .admin-payment-page {
            padding: 25px 18px 60px;
        }

        .page-header h1 {
            font-size: 29px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .card {
            padding: 22px;
            border-radius: 20px;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="admin-payment-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="eyebrow">VALIDASI PEMBAYARAN</div>

        <h1>Detail Pembayaran</h1>

        <p>
            Periksa informasi reservasi dan bukti pembayaran sebelum
            melakukan verifikasi.
        </p>
    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- ERROR MESSAGE --}}
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif


    <div class="payment-layout">

        {{-- ========================= --}}
        {{-- KOLOM KIRI --}}
        {{-- ========================= --}}

        <div>

            {{-- INFORMASI PEMBAYARAN --}}
            <div class="card">

                <h2 class="card-title">
                    Informasi Pembayaran
                </h2>

                <div class="detail-grid">

                    <div class="detail-item">
                        <span class="detail-label">
                            Kode Pembayaran
                        </span>

                        <div class="detail-value">
                            {{ $pembayaran->kode_pembayaran }}
                        </div>
                    </div>


                    <div class="detail-item">
                        <span class="detail-label">
                            Kode Reservasi
                        </span>

                        <div class="detail-value">
                            {{ $pembayaran->reservasi->kode_reservasi ?? '-' }}
                        </div>
                    </div>


                    <div class="detail-item">
                        <span class="detail-label">
                            Metode Pembayaran
                        </span>

                        <div class="detail-value
                            {{ $pembayaran->metode === 'qris'
                                ? 'method-qris'
                                : 'method-transfer' }}">

                            {{ $pembayaran->metode === 'qris'
                                ? 'QRIS'
                                : 'Transfer Bank' }}

                        </div>
                    </div>


                    <div class="detail-item">
                        <span class="detail-label">
                            Status
                        </span>

                        <div class="detail-value">

                            @if($pembayaran->status === 'diverifikasi')

                                <span class="status status-diverifikasi">
                                    Diverifikasi
                                </span>

                            @elseif($pembayaran->status === 'ditolak')

                                <span class="status status-ditolak">
                                    Ditolak
                                </span>

                            @else

                                <span class="status status-menunggu">
                                    Menunggu
                                </span>

                            @endif

                        </div>
                    </div>

                </div>


                {{-- TOTAL --}}
                <div class="amount-box">

                    <span>
                        Total Pembayaran
                    </span>

                    <strong>
                        Rp{{ number_format(
                            $pembayaran->jumlah,
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>

                </div>

            </div>


            {{-- INFORMASI RESERVASI --}}
            <div class="card">

                <h2 class="card-title">
                    Informasi Reservasi
                </h2>

                <div class="detail-grid">

                    <div class="detail-item">

                        <span class="detail-label">
                            Nama User
                        </span>

                        <div class="detail-value">
                            {{ $pembayaran->reservasi->user->name ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Email
                        </span>

                        <div class="detail-value">
                            {{ $pembayaran->reservasi->user->email ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Lapangan
                        </span>

                        <div class="detail-value">
                            {{ $pembayaran->reservasi->lapangan->nama ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Tanggal
                        </span>

                        <div class="detail-value">

                            @if($pembayaran->reservasi->jadwal?->tanggal)

                                {{ \Carbon\Carbon::parse(
                                    $pembayaran->reservasi->jadwal->tanggal
                                )->translatedFormat('d F Y') }}

                            @else
                                -
                            @endif

                        </div>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Jam
                        </span>

                        <div class="detail-value">

                            @if($pembayaran->reservasi->jadwal)

                                {{ substr(
                                    $pembayaran->reservasi->jadwal->jam_mulai,
                                    0,
                                    5
                                ) }}

                                -

                                {{ substr(
                                    $pembayaran->reservasi->jadwal->jam_selesai,
                                    0,
                                    5
                                ) }}

                            @else
                                -
                            @endif

                        </div>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Status Reservasi
                        </span>

                        <div class="detail-value">
                            {{ str_replace(
                                '_',
                                ' ',
                                ucfirst(
                                    $pembayaran->reservasi->status
                                )
                            ) }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- CATATAN JIKA PERNAH DITOLAK --}}
            @if($pembayaran->catatan)

                <div class="existing-note">

                    <strong>
                        Catatan Admin
                    </strong>

                    <p>
                        {{ $pembayaran->catatan }}
                    </p>

                </div>

            @endif

        </div>


        {{-- ========================= --}}
        {{-- KOLOM KANAN --}}
        {{-- ========================= --}}

        <div>

            {{-- BUKTI PEMBAYARAN --}}
            <div class="card">

                <h2 class="card-title">
                    Bukti Pembayaran
                </h2>


                @if($pembayaran->bukti_pembayaran)

                    <div class="proof-wrapper">

                        <img
                            src="{{ asset(
                                'storage/' .
                                $pembayaran->bukti_pembayaran
                            ) }}"
                            alt="Bukti Pembayaran"
                        >

                        <div class="proof-note">
                            Bukti pembayaran yang diunggah oleh user.
                        </div>

                    </div>

                @else

                    <div class="proof-empty">

                        <strong>
                            Bukti pembayaran belum tersedia
                        </strong>

                        User belum mengunggah bukti pembayaran
                        untuk transaksi ini.

                    </div>

                @endif


                {{-- ========================= --}}
                {{-- AKSI ADMIN --}}
                {{-- ========================= --}}

                @if($pembayaran->status !== 'diverifikasi')

                    <div class="actions">

                        {{-- TERIMA --}}
                        @if($pembayaran->bukti_pembayaran)

                            <form
                                action="{{ route(
                                    'admin.pembayaran.terima',
                                    $pembayaran->id
                                ) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-success"
                                    onclick="return confirm(
                                        'Apakah Anda yakin ingin memverifikasi pembayaran ini?'
                                    )"
                                >
                                    ✓ Terima & Verifikasi
                                </button>

                            </form>

                        @endif

                    </div>


                    {{-- FORM TOLAK --}}
                    <div class="reject-box">

                        <h3>
                            Tolak Pembayaran
                        </h3>

                        <form
                            action="{{ route(
                                'admin.pembayaran.tolak',
                                $pembayaran->id
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <label for="catatan">
                                Alasan Penolakan
                            </label>

                            <textarea
                                name="catatan"
                                id="catatan"
                                placeholder="Contoh: Bukti pembayaran tidak jelas atau jumlah pembayaran tidak sesuai."
                                required
                            ></textarea>

                            @error('catatan')
                                <div style="
                                    color:#b42318;
                                    margin-top:8px;
                                    font-size:13px;
                                ">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="actions">

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                    onclick="return confirm(
                                        'Apakah Anda yakin ingin menolak pembayaran ini?'
                                    )"
                                >
                                    ✕ Tolak Pembayaran
                                </button>

                            </div>

                        </form>

                    </div>

                @else

                    <div class="alert alert-success" style="margin-top:22px;">
                        Pembayaran ini sudah diverifikasi.
                        Reservasi telah dikonfirmasi.

                    </div>

                @endif


                {{-- KEMBALI --}}
                <div class="actions">

                    <a
                        href="{{ route('admin.pembayaran.index') }}"
                        class="btn btn-back"
                    >
                        ← Kembali ke Daftar Pembayaran
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection