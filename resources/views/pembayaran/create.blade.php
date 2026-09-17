@extends('layouts.site')

@section('title', 'Pembayaran - PermataTruf.Id')

@section('content')

<section class="section" style="padding-top: 140px;">
    <div class="container">

        {{-- HEADER --}}
        <div class="section-header">

            <div class="section-label">
                Pembayaran
            </div>

            <h2 class="section-title">
                Pembayaran Reservasi
            </h2>

            <p class="section-description">
                Selesaikan pembayaran untuk melanjutkan reservasi kamu.
            </p>

        </div>


        {{-- PESAN SUCCESS --}}
        @if (session('success'))

            <div class="glass" style="
                padding: 18px 20px;
                margin-bottom: 25px;
                border-radius: 18px;
                background: rgba(34, 197, 94, 0.10);
                border: 1px solid rgba(34, 197, 94, 0.20);
                color: #15803d;
                font-size: 13px;
                font-weight: 600;
            ">
                {{ session('success') }}
            </div>

        @endif


        {{-- PESAN ERROR --}}
        @if (session('error'))

            <div class="glass" style="
                padding: 18px 20px;
                margin-bottom: 25px;
                border-radius: 18px;
                background: rgba(239, 68, 68, 0.08);
                border: 1px solid rgba(239, 68, 68, 0.18);
                color: #b91c1c;
                font-size: 13px;
                font-weight: 600;
            ">
                {{ session('error') }}
            </div>

        @endif


        {{-- VALIDATION ERROR --}}
        @if ($errors->any())

            <div class="glass" style="
                padding: 18px 20px;
                margin-bottom: 25px;
                border-radius: 18px;
                background: rgba(239, 68, 68, 0.08);
                border: 1px solid rgba(239, 68, 68, 0.18);
                color: #b91c1c;
                font-size: 13px;
            ">

                <strong>Terjadi kesalahan:</strong>

                <ul style="
                    margin: 8px 0 0 18px;
                    padding: 0;
                ">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- DETAIL RESERVASI --}}
        <div class="glass" style="
            padding: 30px;
            border-radius: 30px;
        ">


            {{-- KODE RESERVASI --}}
            <div style="
                padding-bottom: 22px;
                margin-bottom: 25px;
                border-bottom: 1px solid rgba(20, 100, 60, 0.10);
            ">

                <div style="
                    font-size: 12px;
                    color: #687588;
                    margin-bottom: 7px;
                ">
                    Kode Reservasi
                </div>

                <div style="
                    font-size: 24px;
                    font-weight: 800;
                    color: #172033;
                    letter-spacing: 1px;
                ">
                    {{ $reservasi->kode_reservasi }}
                </div>

            </div>


            {{-- INFORMASI RESERVASI --}}
            <div style="
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 18px;
                margin-bottom: 30px;
            ">


                {{-- LAPANGAN --}}
                <div style="
                    padding: 18px;
                    border-radius: 18px;
                    background: rgba(255,255,255,0.45);
                    border: 1px solid rgba(255,255,255,0.50);
                ">

                    <div style="
                        font-size: 11px;
                        color: #687588;
                        margin-bottom: 6px;
                    ">
                        Lapangan
                    </div>

                    <div style="
                        font-size: 16px;
                        font-weight: 800;
                        color: #172033;
                    ">
                        {{ $reservasi->lapangan->nama ?? '-' }}
                    </div>

                </div>


                {{-- TANGGAL --}}
                <div style="
                    padding: 18px;
                    border-radius: 18px;
                    background: rgba(255,255,255,0.45);
                    border: 1px solid rgba(255,255,255,0.50);
                ">

                    <div style="
                        font-size: 11px;
                        color: #687588;
                        margin-bottom: 6px;
                    ">
                        Tanggal
                    </div>

                    <div style="
                        font-size: 16px;
                        font-weight: 800;
                        color: #172033;
                    ">

                        @if ($reservasi->jadwal)

                            {{ \Carbon\Carbon::parse(
                                $reservasi->jadwal->tanggal
                            )->translatedFormat('l, d F Y') }}

                        @else

                            -

                        @endif

                    </div>

                </div>


                {{-- JAM --}}
                <div style="
                    padding: 18px;
                    border-radius: 18px;
                    background: rgba(255,255,255,0.45);
                    border: 1px solid rgba(255,255,255,0.50);
                ">

                    <div style="
                        font-size: 11px;
                        color: #687588;
                        margin-bottom: 6px;
                    ">
                        Jam
                    </div>

                    <div style="
                        font-size: 16px;
                        font-weight: 800;
                        color: #172033;
                    ">

                        @if ($reservasi->jadwal)

                            {{ substr($reservasi->jadwal->jam_mulai, 0, 5) }}
                            -
                            {{ substr($reservasi->jadwal->jam_selesai, 0, 5) }}

                        @else

                            -

                        @endif

                    </div>

                </div>


                {{-- TOTAL PEMBAYARAN --}}
                <div style="
                    padding: 18px;
                    border-radius: 18px;
                    background: rgba(34, 197, 94, 0.08);
                    border: 1px solid rgba(34, 197, 94, 0.18);
                ">

                    <div style="
                        font-size: 11px;
                        color: #687588;
                        margin-bottom: 6px;
                    ">
                        Total Pembayaran
                    </div>

                    <div style="
                        font-size: 20px;
                        font-weight: 800;
                        color: #15803d;
                    ">
                        Rp{{ number_format(
                            $reservasi->total_harga,
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                </div>

            </div>


            {{-- =====================================================
                 JIKA PEMBAYARAN SUDAH ADA
            ====================================================== --}}

            @if ($pembayaran)

                {{-- INFORMASI PEMBAYARAN --}}
                <div style="
                    padding: 22px;
                    margin-bottom: 25px;
                    border-radius: 18px;
                    background: rgba(245, 158, 11, 0.08);
                    border: 1px solid rgba(245, 158, 11, 0.18);
                ">

                    <div style="
                        font-size: 14px;
                        font-weight: 800;
                        color: #92400e;
                        margin-bottom: 10px;
                    ">
                        Pembayaran Sudah Dibuat
                    </div>

                    <div style="
                        font-size: 12px;
                        color: #92400e;
                        line-height: 1.8;
                    ">

                        Kode Pembayaran:
                        <strong>
                            {{ $pembayaran->kode_pembayaran }}
                        </strong>

                        <br>

                        Metode:
                        <strong>
                            {{ $pembayaran->metode === 'qris'
                                ? 'QRIS'
                                : 'Transfer Bank'
                            }}
                        </strong>

                        <br>

                        Status:
                        <strong>
                            {{ ucfirst($pembayaran->status) }}
                        </strong>

                    </div>

                </div>


                {{-- =================================================
                     INFORMASI TRANSFER BANK
                ================================================== --}}

                @if ($pembayaran->metode === 'transfer_bank')

                    <div style="
                        padding: 25px;
                        margin-bottom: 25px;
                        border-radius: 20px;
                        background: rgba(255,255,255,0.50);
                        border: 1px solid rgba(20,100,60,0.10);
                    ">

                        <div style="
                            font-size: 18px;
                            font-weight: 800;
                            color: #172033;
                            margin-bottom: 15px;
                        ">
                            Informasi Transfer Bank
                        </div>

                        <div style="
                            display: grid;
                            gap: 12px;
                        ">

                            <div>
                                <div style="
                                    font-size: 11px;
                                    color: #687588;
                                ">
                                    Bank
                                </div>

                                <div style="
                                    font-size: 15px;
                                    font-weight: 800;
                                    color: #172033;
                                ">
                                    Bank Permata
                                </div>
                            </div>

                            <div>
                                <div style="
                                    font-size: 11px;
                                    color: #687588;
                                ">
                                    Nomor Rekening
                                </div>

                                <div style="
                                    font-size: 18px;
                                    font-weight: 800;
                                    color: #172033;
                                    letter-spacing: 1px;
                                ">
                                    1234567890
                                </div>
                            </div>

                            <div>
                                <div style="
                                    font-size: 11px;
                                    color: #687588;
                                ">
                                    Atas Nama
                                </div>

                                <div style="
                                    font-size: 15px;
                                    font-weight: 800;
                                    color: #172033;
                                ">
                                    PermataTruf.Id
                                </div>
                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     UPLOAD BUKTI PEMBAYARAN
                ================================================== --}}

                @if (
                    $pembayaran->status === 'menunggu'
                    && empty($pembayaran->bukti_pembayaran)
                )

                    <div style="
                        margin-bottom: 20px;
                    ">

                        {{-- =================================================
                             QR CODE PEMBAYARAN
                        ================================================== --}}

                        @if ($pembayaran->metode === 'qris')

                            <div style="
                                margin-bottom: 30px;
                                padding: 30px;
                                border-radius: 24px;
                                background: rgba(255,255,255,0.55);
                                border: 1px solid rgba(20,100,60,0.12);
                                text-align: center;
                            ">

                                <div style="
                                    font-size: 18px;
                                    font-weight: 800;
                                    color: #172033;
                                    margin-bottom: 8px;
                                ">
                                    Scan QR untuk Membayar
                                </div>

                                <div style="
                                    font-size: 12px;
                                    color: #687588;
                                    margin-bottom: 22px;
                                    line-height: 1.6;
                                ">
                                    Scan QR Code berikut menggunakan aplikasi pembayaran
                                    yang mendukung QRIS.
                                </div>


                                {{-- QR CODE --}}
                                <div style="
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    padding: 18px;
                                    border-radius: 20px;
                                    background: #ffffff;
                                    border: 1px solid rgba(20,100,60,0.10);
                                    box-shadow: 0 10px 30px rgba(20,100,60,0.08);
                                ">

                                    <img
                                        src="{{ asset('images/qris-permatatruf.png') }}"
                                        alt="QRIS PermataTruf.Id"
                                        style="
                                            width: 240px;
                                            height: 240px;
                                            object-fit: contain;
                                            display: block;
                                        "
                                    >

                                </div>


                                {{-- TOTAL --}}
                                <div style="
                                    margin-top: 22px;
                                    padding: 15px 20px;
                                    border-radius: 14px;
                                    background: rgba(34,197,94,0.08);
                                    border: 1px solid rgba(34,197,94,0.15);
                                ">

                                    <div style="
                                        font-size: 11px;
                                        color: #687588;
                                        margin-bottom: 5px;
                                    ">
                                        Total yang harus dibayar
                                    </div>

                                    <div style="
                                        font-size: 22px;
                                        font-weight: 800;
                                        color: #15803d;
                                    ">
                                        Rp{{ number_format(
                                            $reservasi->total_harga,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </div>

                                </div>


                                <div style="
                                    margin-top: 15px;
                                    font-size: 11px;
                                    color: #687588;
                                    line-height: 1.6;
                                ">
                                    Setelah melakukan pembayaran, simpan bukti transaksi
                                    kemudian unggah pada bagian di bawah.
                                </div>

                            </div>

                        @endif


                        {{-- JUDUL UPLOAD --}}
                        <h3 style="
                            margin: 0 0 7px;
                            font-size: 18px;
                            font-weight: 800;
                            color: #172033;
                        ">
                            Unggah Bukti Pembayaran
                        </h3>

                        <p style="
                            margin: 0;
                            font-size: 12px;
                            color: #687588;
                            line-height: 1.6;
                        ">
                            Setelah pembayaran berhasil, unggah screenshot
                            bukti pembayaran untuk diverifikasi oleh admin.
                        </p>

                    </div>


                    {{-- FORM UPLOAD --}}
                    <form
                        method="POST"
                        action="{{ route('pembayaran.uploadBukti', $reservasi->id) }}"
                        enctype="multipart/form-data"
                    >

                        @csrf


                        <div style="
                            padding: 22px;
                            margin-bottom: 20px;
                            border-radius: 18px;
                            background: rgba(255,255,255,0.45);
                            border: 1px solid rgba(20,100,60,0.12);
                        ">

                            <label
                                for="bukti_pembayaran"
                                style="
                                    display: block;
                                    font-size: 13px;
                                    font-weight: 800;
                                    color: #172033;
                                    margin-bottom: 10px;
                                "
                            >
                                Screenshot / Bukti Pembayaran
                            </label>

                            <input
                                type="file"
                                id="bukti_pembayaran"
                                name="bukti_pembayaran"
                                accept="image/jpeg,image/png,image/jpg"
                                required
                                style="
                                    width: 100%;
                                    padding: 12px;
                                    border-radius: 12px;
                                    border: 1px solid rgba(20,100,60,0.15);
                                    background: rgba(255,255,255,0.65);
                                    font-family: inherit;
                                    font-size: 12px;
                                    box-sizing: border-box;
                                "
                            >

                            <div style="
                                margin-top: 8px;
                                font-size: 11px;
                                color: #687588;
                            ">
                                Format: JPG, JPEG, PNG. Maksimal 2 MB.
                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div style="
                            display: flex;
                            gap: 12px;
                            flex-wrap: wrap;
                        ">

                            <a
                                href="{{ route('reservasi.detail', $reservasi->id) }}"
                                class="btn-outline"
                                style="
                                    text-decoration: none;
                                    padding: 11px 18px;
                                    border-radius: 10px;
                                    font-size: 13px;
                                    font-weight: 700;
                                "
                            >
                                Kembali ke Detail
                            </a>


                            <button
                                type="submit"
                                class="btn-primary"
                                style="
                                    border: none;
                                    padding: 11px 20px;
                                    border-radius: 10px;
                                    font-family: inherit;
                                    font-size: 13px;
                                    font-weight: 700;
                                    cursor: pointer;
                                "
                            >
                                Upload Bukti Pembayaran
                            </button>

                        </div>

                    </form>


                {{-- =================================================
                     BUKTI SUDAH DIUPLOAD
                ================================================== --}}

                @elseif ($pembayaran->bukti_pembayaran)

                    <div style="
                        padding: 22px;
                        margin-bottom: 25px;
                        border-radius: 18px;
                        background: rgba(34, 197, 94, 0.08);
                        border: 1px solid rgba(34, 197, 94, 0.18);
                    ">

                        <div style="
                            font-size: 14px;
                            font-weight: 800;
                            color: #15803d;
                            margin-bottom: 8px;
                        ">
                            Bukti Pembayaran Sudah Diunggah
                        </div>

                        <div style="
                            font-size: 12px;
                            color: #15803d;
                            line-height: 1.6;
                        ">
                            Bukti pembayaran kamu sudah berhasil dikirim
                            dan sedang menunggu verifikasi admin.
                        </div>

                    </div>


                    {{-- PREVIEW BUKTI --}}
                    <div style="
                        padding: 25px;
                        margin-bottom: 25px;
                        border-radius: 20px;
                        background: rgba(255,255,255,0.50);
                        text-align: center;
                    ">

                        <div style="
                            font-size: 15px;
                            font-weight: 800;
                            color: #172033;
                            margin-bottom: 15px;
                        ">
                            Bukti Pembayaran
                        </div>

                        <img
                            src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                            alt="Bukti Pembayaran"
                            style="
                                max-width: 100%;
                                width: 500px;
                                border-radius: 15px;
                                border: 1px solid rgba(20,100,60,0.10);
                            "
                        >

                    </div>


                    <div style="
                        display: flex;
                        gap: 12px;
                        flex-wrap: wrap;
                    ">

                        <a
                            href="{{ route('reservasi.detail', $reservasi->id) }}"
                            class="btn-outline"
                            style="
                                text-decoration: none;
                                padding: 11px 18px;
                                border-radius: 10px;
                                font-size: 13px;
                                font-weight: 700;
                            "
                        >
                            Kembali ke Detail
                        </a>

                    </div>


                {{-- =================================================
                     STATUS LAIN
                ================================================== --}}

                @else

                    <div style="
                        padding: 22px;
                        margin-bottom: 25px;
                        border-radius: 18px;
                        background: rgba(148, 163, 184, 0.08);
                        border: 1px solid rgba(148, 163, 184, 0.18);
                    ">

                        <div style="
                            font-size: 14px;
                            font-weight: 800;
                            color: #475569;
                            margin-bottom: 8px;
                        ">
                            Status Pembayaran
                        </div>

                        <div style="
                            font-size: 12px;
                            color: #64748b;
                            line-height: 1.6;
                        ">
                            Pembayaran sedang diproses.
                            Silakan cek kembali status reservasi kamu.
                        </div>

                    </div>


                    <a
                        href="{{ route('reservasi.detail', $reservasi->id) }}"
                        class="btn-outline"
                        style="
                            text-decoration: none;
                            padding: 11px 18px;
                            border-radius: 10px;
                            font-size: 13px;
                            font-weight: 700;
                        "
                    >
                        Kembali ke Detail
                    </a>

                @endif


            {{-- =====================================================
                 JIKA PEMBAYARAN BELUM ADA
            ====================================================== --}}

            @else

                <div style="
                    margin-bottom: 20px;
                ">

                    <h3 style="
                        margin: 0 0 7px;
                        font-size: 18px;
                        font-weight: 800;
                        color: #172033;
                    ">
                        Pilih Metode Pembayaran
                    </h3>

                    <p style="
                        margin: 0;
                        font-size: 12px;
                        color: #687588;
                    ">
                        Pilih salah satu metode pembayaran yang tersedia.
                    </p>

                </div>


                {{-- FORM PILIH METODE --}}
                <form
                    method="POST"
                    action="{{ route('pembayaran.store', $reservasi->id) }}"
                >

                    @csrf


                    <div style="
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                        gap: 15px;
                        margin-bottom: 25px;
                    ">


                        {{-- TRANSFER BANK --}}
                        <label style="
                            display: block;
                            padding: 20px;
                            border-radius: 18px;
                            background: rgba(255,255,255,0.45);
                            border: 1px solid rgba(20,100,60,0.12);
                            cursor: pointer;
                        ">

                            <div style="
                                display: flex;
                                align-items: flex-start;
                                gap: 12px;
                            ">

                                <input
                                    type="radio"
                                    name="metode"
                                    value="transfer_bank"
                                    required
                                    style="
                                        margin-top: 3px;
                                    "
                                >

                                <div>

                                    <div style="
                                        font-size: 14px;
                                        font-weight: 800;
                                        color: #172033;
                                        margin-bottom: 5px;
                                    ">
                                        Transfer Bank
                                    </div>

                                    <div style="
                                        font-size: 12px;
                                        color: #687588;
                                        line-height: 1.5;
                                    ">
                                        Pembayaran melalui transfer rekening bank.
                                    </div>

                                </div>

                            </div>

                        </label>


                        {{-- QRIS --}}
                        <label style="
                            display: block;
                            padding: 20px;
                            border-radius: 18px;
                            background: rgba(255,255,255,0.45);
                            border: 1px solid rgba(20,100,60,0.12);
                            cursor: pointer;
                        ">

                            <div style="
                                display: flex;
                                align-items: flex-start;
                                gap: 12px;
                            ">

                                <input
                                    type="radio"
                                    name="metode"
                                    value="qris"
                                    required
                                    style="
                                        margin-top: 3px;
                                    "
                                >

                                <div>

                                    <div style="
                                        font-size: 14px;
                                        font-weight: 800;
                                        color: #172033;
                                        margin-bottom: 5px;
                                    ">
                                        QRIS
                                    </div>

                                    <div style="
                                        font-size: 12px;
                                        color: #687588;
                                        line-height: 1.5;
                                    ">
                                        Scan QR menggunakan mobile banking
                                        atau e-wallet.
                                    </div>

                                </div>

                            </div>

                        </label>

                    </div>


                    {{-- BUTTON --}}
                    <div style="
                        display: flex;
                        gap: 12px;
                        flex-wrap: wrap;
                    ">

                        <a
                            href="{{ route('reservasi.detail', $reservasi->id) }}"
                            class="btn-outline"
                            style="
                                text-decoration: none;
                                padding: 11px 18px;
                                border-radius: 10px;
                                font-size: 13px;
                                font-weight: 700;
                            "
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="btn-primary"
                            style="
                                border: none;
                                padding: 11px 20px;
                                border-radius: 10px;
                                font-family: inherit;
                                font-size: 13px;
                                font-weight: 700;
                                cursor: pointer;
                            "
                        >
                            Lanjutkan Pembayaran
                        </button>

                    </div>

                </form>

            @endif

        </div>

    </div>
</section>

@endsection