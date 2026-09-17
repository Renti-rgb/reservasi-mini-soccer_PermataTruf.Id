<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Lapangan - PermataTruf.Id</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #20352b;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(111, 207, 151, 0.20),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 90% 20%,
                    rgba(74, 160, 112, 0.14),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 50% 100%,
                    rgba(143, 196, 161, 0.18),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #edf8f4 0%,
                    #e6f2ed 45%,
                    #f4faf7 100%
                );

            min-height: 100vh;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            position: sticky;
            top: 16px;
            z-index: 50;

            width: calc(100% - 32px);
            max-width: 1250px;

            margin: 16px auto 0;
            padding: 13px 20px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            border-radius: 22px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.72),
                    rgba(245, 252, 248, 0.48)
                );

            border: 1px solid rgba(255, 255, 255, 0.86);

            box-shadow:
                0 14px 35px rgba(43, 92, 73, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.85);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 11px;

            text-decoration: none;
            color: #26372f;
        }

        .navbar-logo {
            width: 48px;
            height: 48px;

            border-radius: 50%;
            padding: 4px;

            background: rgba(255, 255, 255, 0.75);

            border: 1px solid rgba(255, 255, 255, 0.9);

            box-shadow:
                0 7px 18px rgba(43, 92, 73, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.85);

            overflow: hidden;
        }

        .navbar-logo img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;
            border-radius: 50%;
        }

        .brand-text {
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.4px;
        }

        .brand-text span {
            color: #2b9a67;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .nav-links a {
            padding: 10px 14px;

            border-radius: 13px;

            text-decoration: none;

            color: #65786f;

            font-size: 14px;
            font-weight: 700;

            transition: 0.25s ease;
        }

        .nav-links a:hover {
            color: #16875a;
            background: rgba(255, 255, 255, 0.55);
        }

        .nav-links a.active {
            color: #16875a;

            background:
                rgba(220, 244, 231, 0.65);

            border:
                1px solid rgba(108, 180, 139, 0.28);
        }

        /* =========================
           PAGE
        ========================= */

        .page-wrapper {
            width: 100%;
            max-width: 1250px;

            margin: 0 auto;

            padding:
                45px 20px
                60px;
        }

        /* =========================
           HERO
        ========================= */

        .hero-card {
            position: relative;

            overflow: hidden;

            padding: 42px 40px;

            margin-bottom: 30px;

            border-radius: 30px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.70),
                    rgba(226, 245, 235, 0.45)
                );

            border:
                1px solid rgba(255, 255, 255, 0.86);

            box-shadow:
                0 18px 45px rgba(43, 92, 73, 0.09),
                inset 0 1px 0 rgba(255, 255, 255, 0.85);

            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }

        .hero-card::before {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            right: -70px;
            top: -90px;

            border-radius: 50%;

            background:
                rgba(91, 187, 133, 0.12);
        }

        .hero-card h1 {
            position: relative;

            margin: 0;

            font-size: 38px;
            font-weight: 800;

            letter-spacing: -1px;

            color: #20382d;
        }

        .hero-card p {
            position: relative;

            margin: 10px 0 0;

            max-width: 700px;

            color: #71847b;

            font-size: 15px;

            line-height: 1.7;
        }

        /* =========================
           SECTION HEADER
        ========================= */

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 20px;
        }

        .section-title {
            margin: 0;

            font-size: 29px;
            font-weight: 800;

            color: #20372d;

            letter-spacing: -0.6px;
        }

        .section-subtitle {
            margin: 6px 0 0;

            color: #7c9086;

            font-size: 14px;
        }

        /* =========================
           LAPANGAN GRID
        ========================= */

        .lapangan-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 22px;
        }

        /* =========================
           CARD
        ========================= */

        .lapangan-card {
            position: relative;

            overflow: hidden;

            display: flex;
            flex-direction: column;

            border-radius: 27px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.70),
                    rgba(245, 251, 248, 0.46)
                );

            border:
                1px solid rgba(255, 255, 255, 0.86);

            box-shadow:
                0 15px 38px rgba(43, 92, 73, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.82);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

            transition:
                transform 0.28s ease,
                box-shadow 0.28s ease,
                border 0.28s ease;
        }

        .lapangan-card:hover {
            transform: translateY(-6px);

            border-color:
                rgba(106, 174, 135, 0.42);

            box-shadow:
                0 23px 48px rgba(43, 92, 73, 0.13),
                inset 0 1px 0 rgba(255, 255, 255, 0.90);
        }

        /* =========================
           IMAGE
        ========================= */

        .lapangan-image {
            position: relative;

            width: 100%;
            height: 225px;

            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #dceee5,
                    #edf7f2
                );
        }

        .lapangan-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform 0.45s ease;
        }

        .lapangan-card:hover
        .lapangan-image img {
            transform: scale(1.04);
        }

        /* =========================
           STATUS
        ========================= */

        .status-badge {
            position: absolute;

            top: 14px;
            right: 14px;

            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 8px 13px;

            border-radius: 999px;

            font-size: 11px;
            font-weight: 800;

            background:
                rgba(255, 255, 255, 0.76);

            border:
                1px solid rgba(255, 255, 255, 0.90);

            box-shadow:
                0 8px 20px rgba(43, 92, 73, 0.10);

            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .status-badge::before {
            content: "";

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: currentColor;
        }

        .status-active {
            color: #16875a;
        }

        .status-inactive {
            color: #c87932;
        }

        /* =========================
           CARD BODY
        ========================= */

        .card-body {
            padding: 22px;

            display: flex;
            flex-direction: column;

            flex: 1;
        }

        .card-name {
            margin: 0;

            min-height: 53px;

            font-size: 21px;
            font-weight: 800;

            line-height: 1.25;

            color: #24372e;
        }

        .card-description {
            margin: 8px 0 18px;

            min-height: 42px;

            color: #81918a;

            font-size: 13px;

            line-height: 1.6;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }

        /* =========================
           INFO
        ========================= */

        .info-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 10px;

            margin-bottom: 20px;
        }

        .info-box {
            min-height: 65px;

            padding: 11px 13px;

            border-radius: 15px;

            background:
                rgba(255, 255, 255, 0.42);

            border:
                1px solid rgba(255, 255, 255, 0.72);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.72);

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-label {
            display: block;

            margin-bottom: 5px;

            font-size: 10px;

            color: #96a49e;

            text-transform: uppercase;

            letter-spacing: 0.5px;

            font-weight: 700;
        }

        .info-value {
            display: block;

            font-size: 13px;

            color: #40554b;

            font-weight: 800;

            line-height: 1.3;

            word-break: break-word;
        }

        .price {
            color: #26754b;
        }

        .available {
            color: #16875a;
        }

        .not-available {
            color: #b55353;
        }

        /* =========================
           DETAIL BUTTON
        ========================= */

        .detail-button {
            width: 100%;

            min-height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            margin-top: auto;

            border-radius: 14px;

            text-decoration: none;

            color: #287957;

            background:
                rgba(221, 244, 231, 0.58);

            border:
                1px solid rgba(255, 255, 255, 0.80);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.78);

            font-size: 13px;
            font-weight: 800;

            transition: 0.25s ease;
        }

        .detail-button:hover {
            color: #146c49;

            background:
                rgba(207, 239, 220, 0.80);

            transform: translateY(-2px);

            border-color:
                rgba(101, 176, 132, 0.35);
        }

        /* =========================
           EMPTY
        ========================= */

        .empty-card {
            grid-column: 1 / -1;

            padding: 65px 25px;

            text-align: center;

            border-radius: 28px;

            background:
                rgba(255, 255, 255, 0.58);

            border:
                1px solid rgba(255, 255, 255, 0.84);

            box-shadow:
                0 15px 38px rgba(43, 92, 73, 0.07);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .empty-icon {
            font-size: 48px;

            margin-bottom: 14px;
        }

        .empty-card h3 {
            margin: 0 0 8px;

            font-size: 21px;

            color: #2a3d34;
        }

        .empty-card p {
            margin: 0;

            color: #879790;

            font-size: 14px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1050px) {
            .lapangan-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 750px) {

            .navbar {
                width: calc(100% - 24px);
                margin-top: 12px;

                flex-direction: column;
                align-items: stretch;
            }

            .nav-links {
                justify-content: center;
                flex-wrap: wrap;
            }

            .page-wrapper {
                padding:
                    30px 15px
                    45px;
            }

            .hero-card {
                padding: 30px 25px;
            }

            .hero-card h1 {
                font-size: 30px;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .lapangan-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 500px) {

            .brand-text {
                font-size: 18px;
            }

            .navbar-logo {
                width: 43px;
                height: 43px;
            }

            .nav-links a {
                font-size: 13px;
            }

            .hero-card h1 {
                font-size: 26px;
            }

            .section-title {
                font-size: 25px;
            }

            .lapangan-image {
                height: 215px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         NAVBAR
    ========================= -->

    <nav class="navbar">

        <a href="{{ url('/') }}" class="navbar-brand">

            <div class="navbar-logo">
                <img
                    src="{{ asset('images/logo.1.png') }}"
                    alt="Logo PermataTruf.Id"
                >
            </div>

            <div class="brand-text">
                PermataTruf<span>.Id</span>
            </div>

        </a>

        <div class="nav-links">

            <a href="{{ url('/') }}">
                Home
            </a>

            <a
                href="{{ route('lapangan.index') }}"
                class="active"
            >
                Daftar Lapangan
            </a>

            <a href="{{ route('jadwal.index') }}">
                Jadwal
            </a>

            @auth
                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}">
                    Login
                </a>
            @endauth

        </div>

    </nav>


    <!-- =========================
         PAGE
    ========================= -->

    <main class="page-wrapper">


        <!-- =========================
             HERO
        ========================= -->

        <section class="hero-card">

            <h1>
                Daftar Lapangan
            </h1>

            <p>
                Pilih lapangan mini soccer yang sesuai
                dengan kebutuhanmu. Lihat informasi,
                fasilitas, harga, dan ketersediaan
                sebelum melakukan reservasi.
            </p>

        </section>


        <!-- =========================
             SECTION HEADER
        ========================= -->

        <div class="section-header">

            <div>

                <h2 class="section-title">
                    Pilihan Lapangan
                </h2>

                <p class="section-subtitle">
                    Tersedia berbagai pilihan lapangan
                    untuk kebutuhan olahraga kamu.
                </p>

            </div>

        </div>


        <!-- =========================
             LAPANGAN
        ========================= -->

        @if ($lapangans->count() > 0)

            @php

                /*
                 * Mapping gambar berdasarkan
                 * kode Lapangan A sampai F.
                 *
                 * File berada di:
                 * public/images/
                 */

                $gambarLapangan = [

                    'A' => 'lapangan-a.png',

                    'B' => 'lapangan-b.jpeg',

                    'C' => 'lapangan-c.jpeg',

                    'D' => 'lapangan-d.jpeg',

                    'E' => 'lapangan-e.jpeg',

                    'F' => 'lapangan-f.jpeg',

                ];

            @endphp


            <div class="lapangan-grid">

                @foreach ($lapangans as $lapangan)

                    @php

                        /*
                         * Mengambil kode A-F
                         * dari nama lapangan.
                         *
                         * Contoh:
                         * "Lapangan A - Premium"
                         * menjadi "A"
                         */

                        preg_match(
                            '/^Lapangan\s+([A-F])\b/i',
                            trim($lapangan->nama),
                            $matches
                        );

                        $kode = isset($matches[1])
                            ? strtoupper($matches[1])
                            : null;

                        $gambarFile =
                            $kode && isset($gambarLapangan[$kode])
                                ? $gambarLapangan[$kode]
                                : null;

                        $gambarPath =
                            $gambarFile
                                ? public_path(
                                    'images/' . $gambarFile
                                )
                                : null;

                    @endphp


                    <article class="lapangan-card">


                        <!-- =========================
                             IMAGE
                        ========================= -->

                        <div class="lapangan-image">

                            @if (
                                $gambarFile &&
                                $gambarPath &&
                                file_exists($gambarPath)
                            )

                                <img
                                    src="{{ asset('images/' . $gambarFile) }}"
                                    alt="{{ $lapangan->nama }}"
                                    loading="lazy"
                                >

                            @else

                                <div
                                    style="
                                        width:100%;
                                        height:100%;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        flex-direction:column;
                                        gap:8px;
                                        color:#769080;
                                        background:
                                            linear-gradient(
                                                135deg,
                                                rgba(220,239,227,.85),
                                                rgba(242,250,245,.75)
                                            );
                                    "
                                >

                                    <span style="font-size:42px;">
                                        ⚽
                                    </span>

                                    <p
                                        style="
                                            margin:0;
                                            font-size:13px;
                                            font-weight:700;
                                        "
                                    >
                                        Gambar belum tersedia
                                    </p>

                                </div>

                            @endif


                            <!-- STATUS -->

                            @if ($lapangan->status === 'aktif')

                                <span
                                    class="
                                        status-badge
                                        status-active
                                    "
                                >
                                    Aktif
                                </span>

                            @else

                                <span
                                    class="
                                        status-badge
                                        status-inactive
                                    "
                                >
                                    Nonaktif
                                </span>

                            @endif

                        </div>


                        <!-- =========================
                             BODY
                        ========================= -->

                        <div class="card-body">

                            <h3 class="card-name">
                                {{ $lapangan->nama }}
                            </h3>


                            <p class="card-description">

                                {{
                                    $lapangan->deskripsi
                                    ?: 'Lapangan mini soccer dengan fasilitas yang nyaman untuk kegiatan olahraga.'
                                }}

                            </p>


                            <!-- =========================
                                 INFO
                            ========================= -->

                            <div class="info-grid">


                                <!-- HARGA -->

                                <div class="info-box">

                                    <span class="info-label">
                                        Harga / Jam
                                    </span>

                                    <span
                                        class="
                                            info-value
                                            price
                                        "
                                    >

                                        Rp
                                        {{
                                            number_format(
                                                $lapangan->harga_per_jam,
                                                0,
                                                ',',
                                                '.'
                                            )
                                        }}

                                    </span>

                                </div>


                                <!-- JENIS -->

                                <div class="info-box">

                                    <span class="info-label">
                                        Jenis
                                    </span>

                                    <span class="info-value">
                                        {{ $lapangan->jenis ?: '-' }}
                                    </span>

                                </div>


                                <!-- UKURAN -->

                                <div class="info-box">

                                    <span class="info-label">
                                        Ukuran
                                    </span>

                                    <span class="info-value">
                                        {{ $lapangan->ukuran ?: '-' }}
                                    </span>

                                </div>


                                <!-- KETERSEDIAAN -->

                                <div class="info-box">

                                    <span class="info-label">
                                        Ketersediaan
                                    </span>


                                    @if (
                                        $lapangan->ketersediaan
                                        === 'tersedia'
                                    )

                                        <span
                                            class="
                                                info-value
                                                available
                                            "
                                        >
                                            Tersedia
                                        </span>

                                    @else

                                        <span
                                            class="
                                                info-value
                                                not-available
                                            "
                                        >
                                            Tidak Tersedia
                                        </span>

                                    @endif

                                </div>

                            </div>


                            <!-- =========================
                                 DETAIL
                            ========================= -->

                            <a
                                href="{{
                                    route(
                                        'lapangan.show',
                                        $lapangan->slug
                                    )
                                }}"
                                class="detail-button"
                            >
                                👁 Lihat Detail
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


        @else

            <!-- =========================
                 EMPTY
            ========================= -->

            <div class="empty-card">

                <div class="empty-icon">
                    ⚽
                </div>

                <h3>
                    Belum Ada Lapangan
                </h3>

                <p>
                    Saat ini belum ada data lapangan
                    yang tersedia.
                </p>

            </div>

        @endif


    </main>

</body>
</html>