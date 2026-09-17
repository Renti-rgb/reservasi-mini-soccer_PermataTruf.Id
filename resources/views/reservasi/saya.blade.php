@extends('layouts.site')

@section('title', 'Reservasi Saya - PermataTruf.Id')

@section('content')

<section class="section" style="padding-top: 140px;">
    <div class="container">

        {{-- HEADER --}}
        <div class="section-header">

            <div class="section-label">
                Reservasi
            </div>

            <h2 class="section-title">
                Reservasi Saya
            </h2>

            <p class="section-description">
                Berikut daftar reservasi yang telah kamu buat.
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
                background: rgba(239, 68, 68, 0.10);
                border: 1px solid rgba(239, 68, 68, 0.20);
                color: #b91c1c;
                font-size: 13px;
                font-weight: 600;
            ">
                {{ session('error') }}
            </div>

        @endif


        {{-- JIKA ADA RESERVASI --}}
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

                    $statusInfo = $statusMap[$reservasi->status]
                        ?? [
                            ucfirst(str_replace('_', ' ', $reservasi->status)),
                            '#64748b',
                            'rgba(148,163,184,0.15)'
                        ];

                @endphp


                {{-- CARD RESERVASI --}}
                <div class="glass" style="
                    padding: 25px;
                    border-radius: 24px;
                    margin-bottom: 18px;
                ">

                    {{-- HEADER CARD --}}
                    <div style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        gap: 15px;
                        flex-wrap: wrap;
                        padding-bottom: 18px;
                        margin-bottom: 18px;
                        border-bottom: 1px solid rgba(20, 100, 60, 0.10);
                    ">

                        <div>

                            <div style="
                                font-size: 11px;
                                color: #687588;
                                margin-bottom: 5px;
                            ">
                                Kode Reservasi
                            </div>

                            <div style="
                                font-size: 19px;
                                font-weight: 800;
                                color: #172033;
                                letter-spacing: 0.5px;
                            ">
                                {{ $reservasi->kode_reservasi }}
                            </div>

                        </div>


                        <span style="
                            display: inline-block;
                            padding: 7px 13px;
                            border-radius: 20px;
                            color: {{ $statusInfo[1] }};
                            background: {{ $statusInfo[2] }};
                            font-size: 11px;
                            font-weight: 700;
                        ">
                            ● {{ $statusInfo[0] }}
                        </span>

                    </div>


                    {{-- INFORMASI RESERVASI --}}
                    <div style="
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                        gap: 15px;
                        margin-bottom: 20px;
                    ">


                        {{-- LAPANGAN --}}
                        <div style="
                            padding: 16px;
                            border-radius: 16px;
                            background: rgba(255,255,255,0.45);
                            border: 1px solid rgba(255,255,255,0.50);
                        ">

                            <div style="
                                font-size: 10px;
                                color: #687588;
                                margin-bottom: 5px;
                            ">
                                Lapangan
                            </div>

                            <div style="
                                font-size: 14px;
                                font-weight: 800;
                                color: #172033;
                            ">
                                {{ $reservasi->lapangan->nama ?? '-' }}
                            </div>

                        </div>


                        {{-- TANGGAL --}}
                        <div style="
                            padding: 16px;
                            border-radius: 16px;
                            background: rgba(255,255,255,0.45);
                            border: 1px solid rgba(255,255,255,0.50);
                        ">

                            <div style="
                                font-size: 10px;
                                color: #687588;
                                margin-bottom: 5px;
                            ">
                                Tanggal
                            </div>

                            <div style="
                                font-size: 14px;
                                font-weight: 800;
                                color: #172033;
                            ">
                                @if ($reservasi->jadwal)

                                    {{ \Illuminate\Support\Carbon::parse($reservasi->jadwal->tanggal)->translatedFormat('l, d F Y') }}

                                @else

                                    -

                                @endif
                            </div>

                        </div>


                        {{-- JAM --}}
                        <div style="
                            padding: 16px;
                            border-radius: 16px;
                            background: rgba(255,255,255,0.45);
                            border: 1px solid rgba(255,255,255,0.50);
                        ">

                            <div style="
                                font-size: 10px;
                                color: #687588;
                                margin-bottom: 5px;
                            ">
                                Jam
                            </div>

                            <div style="
                                font-size: 14px;
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


                        {{-- TOTAL --}}
                        <div style="
                            padding: 16px;
                            border-radius: 16px;
                            background: rgba(34, 197, 94, 0.08);
                            border: 1px solid rgba(34, 197, 94, 0.18);
                        ">

                            <div style="
                                font-size: 10px;
                                color: #687588;
                                margin-bottom: 5px;
                            ">
                                Total Harga
                            </div>

                            <div style="
                                font-size: 16px;
                                font-weight: 800;
                                color: #15803d;
                            ">
                                Rp{{ number_format($reservasi->total_harga, 0, ',', '.') }}
                            </div>

                        </div>

                    </div>


                    {{-- TOMBOL --}}
                    <div style="
                        display: flex;
                        gap: 10px;
                        flex-wrap: wrap;
                    ">

                        <a
                            href="{{ route('reservasi.detail', $reservasi->id) }}"
                            class="btn-primary"
                            style="
                                text-decoration: none;
                                padding: 10px 17px;
                                border-radius: 9px;
                                font-size: 12px;
                                font-weight: 700;
                            "
                        >
                            Lihat Detail
                        </a>


                        @if ($reservasi->status === 'menunggu_pembayaran')

                            @if ($reservasi->pembayaran)

                                <a
                                    href="{{ route('pembayaran.create', $reservasi->id) }}"
                                    class="btn-outline"
                                    style="
                                        text-decoration: none;
                                        padding: 10px 17px;
                                        border-radius: 9px;
                                        font-size: 12px;
                                        font-weight: 700;
                                    "
                                >
                                    Lanjut Pembayaran
                                </a>

                            @endif

                        @endif

                    </div>

                </div>

            @endforeach


            {{-- PAGINATION --}}
            @if ($reservasis->hasPages())

                <div style="
                    margin-top: 25px;
                    display: flex;
                    justify-content: center;
                ">
                    {{ $reservasis->links() }}
                </div>

            @endif


        @else

            {{-- BELUM ADA RESERVASI --}}
            <div class="glass" style="
                padding: 50px 30px;
                border-radius: 24px;
                text-align: center;
            ">

                <div style="
                    font-size: 42px;
                    margin-bottom: 12px;
                ">
                    📭
                </div>

                <h3 style="
                    margin: 0 0 8px;
                    font-size: 18px;
                    color: #172033;
                ">
                    Belum Ada Reservasi
                </h3>

                <p style="
                    margin: 0 0 22px;
                    color: #687588;
                    font-size: 13px;
                ">
                    Kamu belum memiliki reservasi.
                    Yuk mulai booking lapangan sekarang.
                </p>

                <a
                    href="{{ route('lapangan.index') }}"
                    class="btn-primary"
                    style="
                        display: inline-block;
                        text-decoration: none;
                        padding: 11px 20px;
                        border-radius: 9px;
                        font-size: 13px;
                        font-weight: 700;
                    "
                >
                    Booking Sekarang
                </a>

            </div>

        @endif


        {{-- KEMBALI --}}
        <div style="
            margin-top: 25px;
        ">

            <a
                href="{{ route('dashboard') }}"
                class="btn-outline"
                style="
                    display: inline-block;
                    text-decoration: none;
                    padding: 10px 17px;
                    border-radius: 9px;
                    font-size: 12px;
                    font-weight: 700;
                "
            >
                ← Kembali ke Dashboard
            </a>

        </div>

    </div>
</section>

@endsection