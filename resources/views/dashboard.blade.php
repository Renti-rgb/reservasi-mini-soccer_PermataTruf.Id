@extends('layouts.site')

@section('title', 'Dashboard - PermataTruf.Id')

@section('page-style')

.summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 30px;
}

.summary-card {
    padding: 22px;
    border-radius: 20px;
    text-align: center;
    background: rgba(255, 255, 255, 0.35);
    border: 1px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(20px) saturate(140%);
    -webkit-backdrop-filter: blur(20px) saturate(140%);
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
}

.summary-icon {
    width: 44px;
    height: 44px;
    margin: 0 auto 10px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.summary-value {
    font-size: 26px;
    font-weight: 800;
    color: #172033;
    margin-bottom: 4px;
}

.summary-label {
    font-size: 12px;
    color: #687588;
    font-weight: 600;
}

.reservasi-row {
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr 0.8fr 0.8fr;
    gap: 12px;
    align-items: center;
    padding: 16px;
    border-radius: 14px;
    background: rgba(255,255,255,0.5);
    border: 1px solid rgba(255,255,255,0.5);
    margin-bottom: 10px;
    font-size: 13px;
}

.reservasi-row .label {
    display: none;
    font-size: 11px;
    color: #687588;
    font-weight: 700;
}

.status-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-align: center;
}

.quick-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.quick-card {
    padding: 24px 18px;
    border-radius: 20px;
    text-align: center;
    text-decoration: none;
    color: inherit;
    background: rgba(255, 255, 255, 0.35);
    border: 1px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: block;
}

.quick-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.10);
}

.quick-icon {
    width: 46px;
    height: 46px;
    margin: 0 auto 12px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: white;
    font-size: 18px;
}

.quick-card h3 {
    font-size: 14px;
    margin: 0 0 4px;
    color: #172033;
}

.quick-card p {
    font-size: 11px;
    color: #687588;
    margin: 0;
}

@media (max-width: 900px) {

    .summary-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .quick-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .reservasi-row {
        grid-template-columns: 1fr 1fr;
        gap: 6px 12px;
    }

    .reservasi-row .label {
        display: block;
    }
}

@media (max-width: 600px) {

    .summary-grid {
        grid-template-columns: 1fr;
    }

    .quick-grid {
        grid-template-columns: 1fr;
    }

    .reservasi-row {
        grid-template-columns: 1fr;
    }
}

@endsection


@section('content')

<section class="section" style="padding-top: 140px;">

    <div class="container">

        {{-- =====================================================
             WELCOME
        ====================================================== --}}

        <div
            class="glass-strong"
            style="
                padding: 32px;
                border-radius: 24px;
                margin-bottom: 30px;
            "
        >

            <h1
                style="
                    font-size: 24px;
                    font-weight: 800;
                    color: #172033;
                    margin: 0 0 8px;
                "
            >
                Selamat Datang, {{ auth()->user()->name }}!
            </h1>

            <p
                style="
                    color: #627084;
                    font-size: 14px;
                    margin: 0 0 20px;
                "
            >
                Siap bermain? Temukan lapangan dan jadwal yang sesuai
                untuk Anda.
            </p>

            <a
                href="{{ route('lapangan.index') }}"
                class="btn-primary"
                style="
                    padding: 12px 24px;
                    border-radius: 9px;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 700;
                "
            >
                Booking Sekarang
            </a>

        </div>


        {{-- =====================================================
             RINGKASAN RESERVASI
        ====================================================== --}}

        <div class="summary-grid">

            {{-- TOTAL --}}

            <div class="summary-card">

                <div
                    class="summary-icon"
                    style="background: rgba(34,197,94,0.12);"
                >
                    📋
                </div>

                <div class="summary-value">
                    {{ $stats['total'] }}
                </div>

                <div class="summary-label">
                    Total Reservasi
                </div>

            </div>


            {{-- MENUNGGU VERIFIKASI --}}

            <div class="summary-card">

                <div
                    class="summary-icon"
                    style="background: rgba(245,158,11,0.12);"
                >
                    ⏳
                </div>

                <div class="summary-value">
                    {{ $stats['menunggu_verifikasi'] }}
                </div>

                <div class="summary-label">
                    Menunggu Verifikasi
                </div>

            </div>


            {{-- DIKONFIRMASI --}}

            <div class="summary-card">

                <div
                    class="summary-icon"
                    style="background: rgba(34,197,94,0.12);"
                >
                    ✅
                </div>

                <div class="summary-value">
                    {{ $stats['dikonfirmasi'] }}
                </div>

                <div class="summary-label">
                    Reservasi Disetujui
                </div>

            </div>


            {{-- SELESAI --}}

            <div class="summary-card">

                <div
                    class="summary-icon"
                    style="background: rgba(59,130,246,0.12);"
                >
                    🏁
                </div>

                <div class="summary-value">
                    {{ $stats['selesai'] }}
                </div>

                <div class="summary-label">
                    Reservasi Selesai
                </div>

            </div>

        </div>


        {{-- =====================================================
             RESERVASI TERBARU
        ====================================================== --}}

        <div
            class="section-header"
            style="
                text-align: left;
                margin-bottom: 20px;
            "
        >

            <h2
                class="section-title"
                style="font-size: 22px;"
            >
                Reservasi Terbaru
            </h2>

        </div>


        @if ($reservasis->count() > 0)

            @foreach ($reservasis as $reservasi)

                @php

                    $statusMap = [

                        'pending' => [
                            'Menunggu',
                            '#64748b',
                            'rgba(148,163,184,0.15)'
                        ],

                        'menunggu_pembayaran' => [
                            'Menunggu Pembayaran',
                            '#b45309',
                            'rgba(245,158,11,0.12)'
                        ],

                        'menunggu_verifikasi' => [
                            'Menunggu Verifikasi',
                            '#b45309',
                            'rgba(245,158,11,0.12)'
                        ],

                        'dikonfirmasi' => [
                            'Disetujui',
                            '#15803d',
                            'rgba(34,197,94,0.12)'
                        ],

                        'ditolak' => [
                            'Ditolak',
                            '#b91c1c',
                            'rgba(239,68,68,0.10)'
                        ],

                        'dibatalkan' => [
                            'Dibatalkan',
                            '#b91c1c',
                            'rgba(239,68,68,0.10)'
                        ],

                        'selesai' => [
                            'Selesai',
                            '#1d4ed8',
                            'rgba(59,130,246,0.12)'
                        ],

                    ];

                    $statusInfo =
                        $statusMap[$reservasi->status]
                        ?? [
                            '-',
                            '#64748b',
                            'rgba(148,163,184,0.15)'
                        ];

                @endphp


                <div class="reservasi-row">

                    {{-- KODE --}}

                    <div>

                        <div class="label">
                            No. Reservasi
                        </div>

                        <strong>
                            {{ $reservasi->kode_reservasi }}
                        </strong>

                    </div>


                    {{-- LAPANGAN --}}

                    <div>

                        <div class="label">
                            Lapangan
                        </div>

                        {{ $reservasi->lapangan->nama ?? '-' }}

                    </div>


                    {{-- JADWAL --}}

                    <div>

                        <div class="label">
                            Jadwal
                        </div>

                        @if ($reservasi->jadwal)

                            {{ \Illuminate\Support\Carbon::parse(
                                $reservasi->jadwal->tanggal
                            )->format('d M Y') }}

                            (

                            {{ substr(
                                $reservasi->jadwal->jam_mulai,
                                0,
                                5
                            ) }}

                            -

                            {{ substr(
                                $reservasi->jadwal->jam_selesai,
                                0,
                                5
                            ) }}

                            )

                        @else

                            -

                        @endif

                    </div>


                    {{-- TOTAL --}}

                    <div>

                        <div class="label">
                            Total
                        </div>

                        Rp{{ number_format(
                            $reservasi->total_harga,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>


                    {{-- STATUS --}}

                    <div>

                        <div class="label">
                            Status
                        </div>

                        <span
                            class="status-badge"
                            style="
                                color: {{ $statusInfo[1] }};
                                background: {{ $statusInfo[2] }};
                            "
                        >
                            {{ $statusInfo[0] }}
                        </span>

                    </div>

                </div>

            @endforeach


        @else

            {{-- BELUM ADA RESERVASI --}}

            <div
                class="glass"
                style="
                    padding: 40px;
                    border-radius: 20px;
                    text-align: center;
                    margin-bottom: 30px;
                "
            >

                <div
                    style="
                        font-size: 36px;
                        margin-bottom: 10px;
                    "
                >
                    📭
                </div>

                <h3
                    style="
                        margin: 0 0 6px;
                        font-size: 17px;
                        color: #172033;
                    "
                >
                    Belum Ada Reservasi
                </h3>

                <p
                    style="
                        margin: 0;
                        color: #687588;
                        font-size: 13px;
                    "
                >
                    Yuk mulai booking lapangan pertama Anda.
                </p>

            </div>

        @endif


        {{-- =====================================================
             TINDAKAN CEPAT
        ====================================================== --}}

        <div
            class="section-header"
            style="
                text-align: left;
                margin: 40px 0 20px;
            "
        >

            <h2
                class="section-title"
                style="font-size: 22px;"
            >
                Tindakan Cepat
            </h2>

        </div>


        <div class="quick-grid">


            {{-- BUAT RESERVASI --}}

            <a
                href="{{ route('lapangan.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    📝
                </div>

                <h3>
                    Buat Reservasi
                </h3>

                <p>
                    Pilih lapangan untuk booking
                </p>

            </a>


            {{-- LIHAT JADWAL --}}

            <a
                href="{{ route('jadwal.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    📅
                </div>

                <h3>
                    Lihat Jadwal
                </h3>

                <p>
                    Cek ketersediaan jadwal
                </p>

            </a>


            {{-- RESERVASI SAYA --}}

            <a
                href="{{ route('reservasi.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    📄
                </div>

                <h3>
                    Reservasi Saya
                </h3>

                <p>
                    Lihat semua reservasi Anda
                </p>

            </a>


            {{-- RIWAYAT RESERVASI --}}

            <a
                href="{{ route('reservasi.riwayat') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    🕓
                </div>

                <h3>
                    Riwayat Reservasi
                </h3>

                <p>
                    Lihat riwayat reservasi Anda
                </p>

            </a>


        </div>

    </div>

</section>

@endsection