@extends('layouts.site')

@section('title', 'Detail Reservasi - PermataTruf.Id')

@section('content')

<section class="section" style="padding-top: 140px;">
    <div class="container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="section-header">

            <div class="section-label">
                Reservasi
            </div>

            <h2 class="section-title">
                Detail Reservasi
            </h2>

            <p class="section-description">
                Berikut informasi reservasi yang telah kamu buat.
            </p>

        </div>


        {{-- =====================================================
             PESAN SUCCESS
        ====================================================== --}}

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


        {{-- =====================================================
             PESAN ERROR
        ====================================================== --}}

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


        {{-- =====================================================
             DETAIL RESERVASI
        ====================================================== --}}

        <div class="glass" style="
            padding: 30px;
            border-radius: 30px;
        ">


            {{-- =================================================
                 KODE RESERVASI
            ================================================== --}}

            <div style="
                padding-bottom: 22px;
                margin-bottom: 22px;
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


            {{-- =================================================
                 STATUS RESERVASI
            ================================================== --}}

            @php

                $statusConfig = [

                    'pending' => [
                        'label' => 'Pending',
                        'color' => '#64748b',
                        'background' => 'rgba(148, 163, 184, 0.15)',
                    ],

                    'menunggu_pembayaran' => [
                        'label' => 'Menunggu Pembayaran',
                        'color' => '#b45309',
                        'background' => 'rgba(245, 158, 11, 0.12)',
                    ],

                    'menunggu_verifikasi' => [
                        'label' => 'Menunggu Verifikasi',
                        'color' => '#b45309',
                        'background' => 'rgba(245, 158, 11, 0.12)',
                    ],

                    'dikonfirmasi' => [
                        'label' => 'Dikonfirmasi',
                        'color' => '#15803d',
                        'background' => 'rgba(34, 197, 94, 0.12)',
                    ],

                    'ditolak' => [
                        'label' => 'Ditolak',
                        'color' => '#b91c1c',
                        'background' => 'rgba(239, 68, 68, 0.10)',
                    ],

                    'dibatalkan' => [
                        'label' => 'Dibatalkan',
                        'color' => '#b91c1c',
                        'background' => 'rgba(239, 68, 68, 0.10)',
                    ],

                    'selesai' => [
                        'label' => 'Selesai',
                        'color' => '#1d4ed8',
                        'background' => 'rgba(59, 130, 246, 0.12)',
                    ],

                ];

                $statusInfo = $statusConfig[$reservasi->status]
                    ?? [
                        'label' => ucfirst(
                            str_replace(
                                '_',
                                ' ',
                                $reservasi->status
                            )
                        ),
                        'color' => '#64748b',
                        'background' => 'rgba(148, 163, 184, 0.15)',
                    ];

            @endphp


            <div style="
                margin-bottom: 25px;
            ">

                <div style="
                    font-size: 12px;
                    color: #687588;
                    margin-bottom: 7px;
                ">
                    Status Reservasi
                </div>

                <span style="
                    display: inline-block;
                    padding: 7px 13px;
                    border-radius: 20px;
                    background: {{ $statusInfo['background'] }};
                    color: {{ $statusInfo['color'] }};
                    font-size: 12px;
                    font-weight: 700;
                ">
                    ● {{ $statusInfo['label'] }}
                </span>

            </div>


            {{-- =================================================
                 INFORMASI LAPANGAN
            ================================================== --}}

            <div style="
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 18px;
                margin-bottom: 25px;
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

                    @if ($reservasi->lapangan)

                        <div style="
                            margin-top: 5px;
                            font-size: 12px;
                            color: #687588;
                        ">
                            {{ $reservasi->lapangan->jenis ?? '-' }}

                            @if ($reservasi->lapangan->ukuran)
                                • {{ $reservasi->lapangan->ukuran }}
                            @endif
                        </div>

                    @endif

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

                        @else

                            -

                        @endif

                    </div>

                </div>


                {{-- TOTAL HARGA --}}

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
                        Total Harga
                    </div>

                    <div style="
                        font-size: 18px;
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


            {{-- =================================================
                 CATATAN
            ================================================== --}}

            @if ($reservasi->catatan)

                <div style="
                    margin-bottom: 25px;
                    padding: 18px;
                    border-radius: 18px;
                    background: rgba(148, 163, 184, 0.08);
                ">

                    <div style="
                        font-size: 11px;
                        color: #687588;
                        margin-bottom: 6px;
                    ">
                        Catatan
                    </div>

                    <div style="
                        font-size: 13px;
                        color: #172033;
                        line-height: 1.6;
                    ">
                        {{ $reservasi->catatan }}
                    </div>

                </div>

            @endif


            {{-- =================================================
                 INFORMASI STATUS
            ================================================== --}}

            @php

                $infoStatus = [

                    'pending' => [
                        'judul' => 'Reservasi Menunggu',
                        'pesan' => 'Reservasi kamu sedang menunggu proses selanjutnya.',
                        'color' => '#64748b',
                        'background' => 'rgba(148, 163, 184, 0.08)',
                        'border' => 'rgba(148, 163, 184, 0.18)',
                    ],

                    'menunggu_pembayaran' => [
                        'judul' => 'Menunggu Pembayaran',
                        'pesan' => 'Reservasi berhasil dibuat. Silakan lanjutkan ke proses pembayaran.',
                        'color' => '#92400e',
                        'background' => 'rgba(245, 158, 11, 0.08)',
                        'border' => 'rgba(245, 158, 11, 0.18)',
                    ],

                    'menunggu_verifikasi' => [
                        'judul' => 'Menunggu Verifikasi',
                        'pesan' => 'Pembayaran kamu sedang menunggu verifikasi oleh admin.',
                        'color' => '#92400e',
                        'background' => 'rgba(245, 158, 11, 0.08)',
                        'border' => 'rgba(245, 158, 11, 0.18)',
                    ],

                    'dikonfirmasi' => [
                        'judul' => 'Reservasi Dikonfirmasi',
                        'pesan' => 'Reservasi kamu telah dikonfirmasi. Silakan datang sesuai jadwal yang telah dipilih.',
                        'color' => '#15803d',
                        'background' => 'rgba(34, 197, 94, 0.08)',
                        'border' => 'rgba(34, 197, 94, 0.18)',
                    ],

                    'ditolak' => [
                        'judul' => 'Reservasi Ditolak',
                        'pesan' => 'Reservasi ini ditolak oleh admin. Silakan pilih jadwal lain jika ingin melakukan reservasi kembali.',
                        'color' => '#b91c1c',
                        'background' => 'rgba(239, 68, 68, 0.08)',
                        'border' => 'rgba(239, 68, 68, 0.18)',
                    ],

                    'dibatalkan' => [
                        'judul' => 'Reservasi Dibatalkan',
                        'pesan' => 'Reservasi ini telah dibatalkan.',
                        'color' => '#b91c1c',
                        'background' => 'rgba(239, 68, 68, 0.08)',
                        'border' => 'rgba(239, 68, 68, 0.18)',
                    ],

                    'selesai' => [
                        'judul' => 'Reservasi Selesai',
                        'pesan' => 'Reservasi ini telah selesai. Terima kasih telah menggunakan layanan kami.',
                        'color' => '#1d4ed8',
                        'background' => 'rgba(59, 130, 246, 0.08)',
                        'border' => 'rgba(59, 130, 246, 0.18)',
                    ],

                ];

                $info = $infoStatus[$reservasi->status]
                    ?? [
                        'judul' => 'Informasi Reservasi',
                        'pesan' => 'Informasi reservasi tersedia pada halaman ini.',
                        'color' => '#64748b',
                        'background' => 'rgba(148, 163, 184, 0.08)',
                        'border' => 'rgba(148, 163, 184, 0.18)',
                    ];

            @endphp


            <div style="
                padding: 20px;
                margin-bottom: 25px;
                border-radius: 18px;
                background: {{ $info['background'] }};
                border: 1px solid {{ $info['border'] }};
            ">

                <div style="
                    font-size: 14px;
                    font-weight: 800;
                    color: {{ $info['color'] }};
                    margin-bottom: 7px;
                ">
                    {{ $info['judul'] }}
                </div>

                <div style="
                    font-size: 12px;
                    line-height: 1.6;
                    color: {{ $info['color'] }};
                ">
                    {{ $info['pesan'] }}
                </div>

            </div>


            {{-- =================================================
                 TOMBOL NAVIGASI
            ================================================== --}}

            <div style="
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
            ">


                {{-- =================================================
                     BAYAR SEKARANG
                     HANYA MUNCUL SAAT MENUNGGU PEMBAYARAN
                ================================================== --}}

                @if ($reservasi->status === 'menunggu_pembayaran')

                    <a
                        href="{{ route('pembayaran.create', $reservasi->id) }}"
                        class="btn-primary"
                        style="
                            text-decoration: none;
                            padding: 11px 22px;
                            border-radius: 10px;
                            font-size: 13px;
                            font-weight: 800;
                            background: linear-gradient(
                                135deg,
                                #15803d,
                                #22c55e
                            );
                            color: white;
                            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.20);
                        "
                    >
                        Bayar Sekarang
                    </a>

                @endif


                {{-- =================================================
                     KEMBALI KE LAPANGAN
                ================================================== --}}

                <a
                    href="{{ route('lapangan.index') }}"
                    class="btn-outline"
                    style="
                        text-decoration: none;
                        padding: 11px 18px;
                        border-radius: 10px;
                        font-size: 13px;
                        font-weight: 700;
                    "
                >
                    Kembali ke Lapangan
                </a>


                {{-- =================================================
                     RESERVASI SAYA
                ================================================== --}}

                <a
                    href="{{ route('reservasi.index') }}"
                    class="btn-outline"
                    style="
                        text-decoration: none;
                        padding: 11px 18px;
                        border-radius: 10px;
                        font-size: 13px;
                        font-weight: 700;
                    "
                >
                    Reservasi Saya
                </a>


                {{-- =================================================
                     LIHAT JADWAL
                ================================================== --}}

                <a
                    href="{{ route('jadwal.index') }}"
                    class="btn-primary"
                    style="
                        text-decoration: none;
                        padding: 11px 18px;
                        border-radius: 10px;
                        font-size: 13px;
                        font-weight: 700;
                    "
                >
                    Lihat Jadwal
                </a>

            </div>

        </div>

    </div>
</section>

@endsection