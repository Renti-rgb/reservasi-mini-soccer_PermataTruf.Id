@extends('admin.layout')

@section('title', 'Kelola Lapangan')
@section('page-title', 'Kelola Lapangan')
@section('page-subtitle', 'Kelola informasi, harga, status, dan ketersediaan lapangan.')

@push('styles')
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
            color: #20302a;
            min-height: 100vh;

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
        }


        /* =====================================================
           ADMIN WRAPPER
        ===================================================== */

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
            gap: 22px;
            padding: 16px;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 285px;
            min-height: calc(100vh - 32px);

            position: fixed;
            left: 16px;
            top: 16px;
            bottom: 16px;

            z-index: 20;

            padding: 24px 16px;

            border-radius: 30px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.64),
                    rgba(236, 248, 243, 0.48)
                );

            border: 1px solid rgba(255, 255, 255, 0.86);

            box-shadow:
                0 18px 45px rgba(43, 92, 73, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);

            overflow-y: auto;
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;

            padding: 12px 14px 28px;
        }

        .brand-logo {
            width: 62px;
            height: 62px;

            border-radius: 50%;
            padding: 5px;

            background: rgba(255, 255, 255, 0.68);

            border: 1px solid rgba(255, 255, 255, 0.90);

            box-shadow:
                0 8px 22px rgba(43, 92, 73, 0.12),
                inset 0 1px 0 rgba(255, 255, 255, 0.85);

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
            overflow: hidden;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;

            object-fit: cover;
            border-radius: 50%;
        }

        .brand-text {
            font-size: 22px;
            font-weight: 800;

            color: #26362f;

            letter-spacing: -0.4px;
        }

        .brand-text span {
            color: #2b9a67;
        }


        /* =====================================================
           ADMIN LABEL
        ===================================================== */

        .admin-label {
            padding: 4px 20px 14px;

            font-size: 13px;
            font-weight: 800;

            color: #81928a;

            text-transform: uppercase;
            letter-spacing: 1.2px;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .menu a {
            position: relative;

            text-decoration: none;
            color: #667970;

            padding: 14px 16px;

            border-radius: 17px;

            display: flex;
            align-items: center;

            gap: 14px;

            font-size: 15px;
            font-weight: 700;

            border: 1px solid transparent;

            transition:
                background 0.25s ease,
                color 0.25s ease,
                border 0.25s ease,
                box-shadow 0.25s ease,
                transform 0.25s ease;
        }

        .menu a:hover {
            color: #16875a;

            background: rgba(255, 255, 255, 0.50);

            border-color: rgba(255, 255, 255, 0.80);

            box-shadow:
                0 8px 22px rgba(43, 92, 73, 0.07);

            transform: translateX(2px);
        }

        .menu a.active {
            color: #20382d;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.72),
                    rgba(223, 244, 233, 0.48)
                );

            border: 1px solid rgba(106, 170, 136, 0.38);

            box-shadow:
                0 10px 25px rgba(44, 109, 77, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.80);
        }

        .menu a.active::before {
            content: "";

            position: absolute;

            left: -1px;
            top: 18%;
            bottom: 18%;

            width: 4px;

            border-radius: 10px;

            background:
                linear-gradient(
                    180deg,
                    #57b985,
                    #23885d
                );

            box-shadow:
                0 0 10px rgba(46, 148, 96, 0.30);
        }

        .menu-icon {
            width: 38px;
            height: 38px;

            border-radius: 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 17px;

            background:
                rgba(255, 255, 255, 0.52);

            border:
                1px solid rgba(255, 255, 255, 0.72);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            flex-shrink: 0;
        }

        .menu a.active .menu-icon {
            background:
                rgba(214, 242, 226, 0.72);

            border-color:
                rgba(93, 169, 124, 0.25);

            color: #16875a;
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .sidebar-bottom {
            margin-top: 18px;
            padding-top: 15px;

            border-top:
                1px solid rgba(255, 255, 255, 0.65);
        }

        .logout-button {
            width: 100%;

            border:
                1px solid rgba(255, 150, 150, 0.35);

            background:
                rgba(255, 239, 239, 0.55);

            color: #c64b4b;

            padding: 13px;

            border-radius: 16px;

            cursor: pointer;

            font-size: 14px;
            font-weight: 800;

            box-shadow:
                0 8px 22px rgba(185, 74, 74, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.70);

            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            transition: 0.25s ease;
        }

        .logout-button:hover {
            background:
                rgba(255, 226, 226, 0.72);

            border-color:
                rgba(214, 115, 115, 0.40);

            transform:
                translateY(-1px);

            box-shadow:
                0 10px 25px rgba(185, 74, 74, 0.10);
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            margin-left: 307px;

            width:
                calc(100% - 307px);

            min-height:
                calc(100vh - 32px);

            padding-bottom: 30px;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            min-height: 120px;

            margin-bottom: 25px;

            padding: 22px 34px;

            border-radius: 30px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.66),
                    rgba(255, 255, 255, 0.42)
                );

            border:
                1px solid rgba(255, 255, 255, 0.84);

            box-shadow:
                0 14px 35px rgba(43, 92, 73, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.80);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

            position: sticky;
            top: 16px;

            z-index: 10;
        }

        .page-title {
            font-size: 36px;
            font-weight: 800;

            margin: 0;

            color: #20342b;

            letter-spacing: -1px;
        }

        .page-subtitle {
            font-size: 16px;

            color: #7d9087;

            margin-top: 7px;
        }


        /* =====================================================
           ADMIN PROFILE
        ===================================================== */

        .admin-profile {
            display: flex;
            align-items: center;

            gap: 12px;

            padding: 8px 14px 8px 10px;

            min-width: 190px;

            border-radius: 20px;

            background:
                rgba(255, 255, 255, 0.50);

            border:
                1px solid rgba(255, 255, 255, 0.78);

            box-shadow:
                0 8px 22px rgba(43, 92, 73, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.80);

            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .profile-avatar {
            width: 50px;
            height: 50px;

            border-radius: 50%;
            padding: 4px;

            background:
                rgba(255, 255, 255, 0.90);

            border:
                1px solid rgba(255, 255, 255, 0.95);

            box-shadow:
                0 5px 15px rgba(43, 92, 73, 0.10);

            overflow: hidden;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;
            object-position: center;

            border-radius: 50%;
        }

        .profile-name {
            font-size: 16px;
            font-weight: 800;

            color: #26372f;

            line-height: 1.2;
        }

        .profile-role {
            font-size: 13px;

            color: #8b9b94;

            margin-top: 4px;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding:
                0 0 35px;
        }

        .content-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 24px;
        }

        .section-title {
            margin: 0;

            font-size: 30px;
            font-weight: 800;

            color: #20372d;

            letter-spacing: -0.7px;
        }

        .section-subtitle {
            margin: 7px 0 0;

            color: #7b8f86;

            font-size: 15px;

            line-height: 1.5;
        }


        /* =====================================================
           TAMBAH LAPANGAN
        ===================================================== */

        .add-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 46px;
    padding: 0 20px;
    border-radius: 999px;
    text-decoration: none;
    color: #26382f;
    font-size: 14px;
    font-weight: 700;
    background:
        linear-gradient(
            135deg,
            rgba(255, 255, 255, 0.55),
            rgba(214, 238, 222, 0.55)
        );
    border: 1px solid rgba(255, 255, 255, 0.80);
    box-shadow:
        0 4px 14px rgba(43, 92, 73, 0.08);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    transition: 0.25s ease;
}

        .add-button:hover {
            color: #0d6845;

            transform:
                translateY(-3px);

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.86),
                    rgba(214, 242, 226, 0.65)
                );

            border-color:
                rgba(108, 180, 139, 0.42);

            box-shadow:
                0 15px 35px rgba(43, 92, 73, 0.13),
                inset 0 1px 0 rgba(255, 255, 255, 0.92);
        }

        .add-icon {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                rgba(215, 242, 226, 0.70);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            color: #16875a;

            font-size: 19px;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.80);
        }


        /* =====================================================
           LAPANGAN GRID
        ===================================================== */

        .lapangan-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 22px;

            align-items: stretch;
        }


        /* =====================================================
           CARD LAPANGAN
        ===================================================== */

        .lapangan-card {
            position: relative;

            display: flex;
            flex-direction: column;

            overflow: hidden;

            border-radius: 27px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.67),
                    rgba(245, 251, 248, 0.44)
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
            transform:
                translateY(-5px);

            border-color:
                rgba(106, 174, 135, 0.42);

            box-shadow:
                0 22px 45px rgba(43, 92, 73, 0.13),
                inset 0 1px 0 rgba(255, 255, 255, 0.88);
        }


        /* =====================================================
           IMAGE
        ===================================================== */

        .lapangan-image {
            position: relative;

            width: 100%;
            height: 220px;

            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #dceee5,
                    #edf7f2
                );

            flex-shrink: 0;
        }

        .lapangan-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform 0.45s ease;
        }

        .lapangan-card:hover .lapangan-image img {
            transform:
                scale(1.04);
        }


        /* =====================================================
           IMAGE PLACEHOLDER
        ===================================================== */

        .image-placeholder {
            width: 100%;
            height: 100%;

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            gap: 8px;

            color: #769080;

            background:
                linear-gradient(
                    135deg,
                    rgba(220, 239, 227, 0.85),
                    rgba(242, 250, 245, 0.75)
                );
        }

        .image-placeholder span {
            font-size: 42px;
        }

        .image-placeholder p {
            margin: 0;

            font-size: 13px;
            font-weight: 700;
        }


        /* =====================================================
           STATUS BADGE
        ===================================================== */

        .status-badge {
            position: absolute;

            top: 14px;
            right: 14px;

            display: inline-flex;

            align-items: center;
            gap: 6px;

            padding:
                8px 13px;

            border-radius: 999px;

            font-size: 11px;
            font-weight: 800;

            background:
                rgba(255, 255, 255, 0.70);

            border:
                1px solid rgba(255, 255, 255, 0.88);

            box-shadow:
                0 8px 20px rgba(43, 92, 73, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.90);

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

        .status-aktif {
            color: #16875a;
        }

        .status-nonaktif {
            color: #c87932;
        }


        /* =====================================================
           CARD BODY
        ===================================================== */

        .lapangan-body {
            padding: 22px;

            display: flex;
            flex-direction: column;

            flex: 1;
        }

        .lapangan-name {
            margin: 0;

            min-height: 53px;

            font-size: 21px;
            font-weight: 800;

            color: #24372e;

            line-height: 1.25;
        }

        .lapangan-description {
            margin:
                8px 0 19px;

            min-height: 40px;

            color: #81918a;

            font-size: 13px;

            line-height: 1.55;

            display: -webkit-box;

            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }


        /* =====================================================
           INFO GRID
        ===================================================== */

        .info-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 10px;

            margin-bottom: 19px;
        }

        .info-box {
            min-height: 66px;

            padding:
                12px 13px;

            border-radius: 15px;

            background:
                rgba(255, 255, 255, 0.40);

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

            font-size: 10px;

            color: #96a49e;

            margin-bottom: 5px;

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

        .info-value.price {
            color: #26754b;
        }

        .availability {
            color: #16875a;
        }

        .availability.not-available {
            color: #b55353;
        }


        /* =====================================================
           CARD ACTION
        ===================================================== */

        .card-actions {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 10px;

            margin-top: auto;
        }

        .action-button {
            min-height: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            border-radius: 14px;

            text-decoration: none;

            font-size: 12px;
            font-weight: 800;

            transition:
                0.25s ease;

            cursor: pointer;
        }

        .detail-button {
            color: #287957;

            background:
                rgba(221, 244, 231, 0.55);

            border:
                1px solid rgba(255, 255, 255, 0.78);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.75);
        }

        .detail-button:hover {
            background:
                rgba(207, 239, 220, 0.78);

            transform:
                translateY(-2px);
        }

        .edit-button {
            color: #5c7067;

            background:
                rgba(255, 255, 255, 0.46);

            border:
                1px solid rgba(255, 255, 255, 0.78);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.75);
        }

        .edit-button:hover {
            color: #16875a;

            background:
                rgba(255, 255, 255, 0.70);

            border-color:
                rgba(102, 177, 133, 0.38);

            transform:
                translateY(-2px);
        }


        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty-card {
            grid-column:
                1 / -1;

            padding:
                70px 30px;

            text-align: center;

            border-radius: 28px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.63),
                    rgba(248, 252, 250, 0.45)
                );

            border:
                1px solid rgba(255, 255, 255, 0.84);

            box-shadow:
                0 15px 38px rgba(43, 92, 73, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.78);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .empty-icon {
            width: 72px;
            height: 72px;

            margin:
                0 auto 18px;

            border-radius: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 32px;

            background:
                rgba(218, 244, 229, 0.65);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.80);
        }

        .empty-title {
            margin: 0;

            font-size: 20px;
            font-weight: 800;

            color: #2a3d34;
        }

        .empty-text {
            margin:
                8px 0 22px;

            font-size: 14px;

            color: #879790;
        }


        /* =====================================================
           SCROLLBAR
        ===================================================== */

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background:
                rgba(255, 255, 255, 0.20);
        }

        ::-webkit-scrollbar-thumb {
            background:
                rgba(89, 146, 114, 0.35);

            border-radius: 20px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background:
                rgba(89, 146, 114, 0.50);
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1200px) {

            .sidebar {
                width: 255px;
            }

            .main {
                margin-left: 277px;

                width:
                    calc(100% - 277px);
            }

            .lapangan-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 900px) {

            .admin-wrapper {
                display: block;

                padding: 12px;
            }

            .sidebar {
                position: relative;

                left: auto;
                top: auto;
                bottom: auto;

                width: 100%;

                min-height: auto;

                margin-bottom: 15px;
            }

            .main {
                margin-left: 0;

                width: 100%;
            }

            .sidebar-bottom {
                position: static;

                margin-top: 20px;
            }

            .topbar {
                position: relative;

                top: auto;

                min-height: 100px;

                padding: 20px;
            }

            .page-title {
                font-size: 28px;
            }

            .content-header {
                align-items: flex-start;

                flex-direction: column;
            }

            .add-button {
                width: 100%;
            }

        }


        @media (max-width: 650px) {

            .lapangan-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .admin-profile {
                width: 100%;

                min-width: 0;
            }

            .section-title {
                font-size: 25px;
            }

            .lapangan-image {
                height: 210px;
            }

            .brand-text {
                font-size: 19px;
            }

        }

    
</style>
@endpush

@section('content')
<!-- =================================================
             TOPBAR
        ================================================== -->

        



        <!-- =================================================
             CONTENT
        ================================================== -->

        <section class="content">


            <!-- HEADER DAFTAR LAPANGAN -->

            <div class="content-header">


                <div>

                    <h2 class="section-title">
                        Daftar Lapangan
                    </h2>

                    <p class="section-subtitle">
                        Tambahkan, ubah, lihat detail, atau hapus data lapangan.
                    </p>

                </div>


                <!-- TOMBOL TAMBAH -->

                <a
                    href="{{ route('admin.lapangan.create') }}"
                    class="add-button"
                >

                    <span class="add-icon">
                        +
                    </span>

                    <span>
                        Tambah Lapangan
                    </span>

                </a>

            </div>



            <!-- =================================================
                 DATA LAPANGAN A - F
            ================================================== -->

            @php

                /*
                 * Mencari data berdasarkan kode A sampai F.
                 * Dengan cara ini halaman selalu memiliki
                 * urutan Lapangan A, B, C, D, E, F.
                 */

                $lapanganByKode = [];

                foreach (range('A', 'F') as $kode) {

                    $lapanganByKode[$kode] = $lapangans->first(function ($item) use ($kode) {

                        return preg_match(
                            '/^Lapangan\s+' . preg_quote($kode, '/') . '\b/i',
                            trim($item->nama)
                        );

                    });

                }


                /*
                 * File gambar yang memang berada
                 * di public/images/
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


                @foreach (range('A', 'F') as $kode)

                    @php

                        $lapangan = $lapanganByKode[$kode];

                        $gambarFile = $gambarLapangan[$kode];

                        $gambarPath = public_path(
                            'images/' . $gambarFile
                        );

                    @endphp


                    @if ($lapangan)


                        <!-- =================================================
                             CARD LAPANGAN
                        ================================================== -->

                        <article class="lapangan-card">


                            <!-- IMAGE -->

                            <div class="lapangan-image">


                                @if (file_exists($gambarPath))

                                    <img
                                        src="{{ asset('images/' . $gambarFile) }}"
                                        alt="{{ $lapangan->nama }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="image-placeholder">

                                        <span>
                                            ⚽
                                        </span>

                                        <p>
                                            Gambar {{ $kode }} belum tersedia
                                        </p>

                                    </div>

                                @endif


                                <!-- STATUS -->

                                @if ($lapangan->status === 'aktif')

                                    <span
                                        class="status-badge status-aktif"
                                    >
                                        Aktif
                                    </span>

                                @else

                                    <span
                                        class="status-badge status-nonaktif"
                                    >
                                        Nonaktif
                                    </span>

                                @endif

                            </div>



                            <!-- BODY -->

                            <div class="lapangan-body">


                                <!-- NAMA -->

                                <h3 class="lapangan-name">

                                    {{ $lapangan->nama }}

                                </h3>


                                <!-- DESKRIPSI -->

                                <p class="lapangan-description">

                                    {{ $lapangan->deskripsi
                                        ?? 'Lapangan mini soccer dengan fasilitas yang nyaman untuk kegiatan olahraga.'
                                    }}

                                </p>



                                <!-- INFO -->

                                <div class="info-grid">


                                    <!-- JENIS -->

                                    <div class="info-box">

                                        <span class="info-label">
                                            Jenis
                                        </span>

                                        <span class="info-value">

                                            {{ $lapangan->jenis ?? '-' }}

                                        </span>

                                    </div>



                                    <!-- UKURAN -->

                                    <div class="info-box">

                                        <span class="info-label">
                                            Ukuran
                                        </span>

                                        <span class="info-value">

                                            {{ $lapangan->ukuran ?? '-' }}

                                        </span>

                                    </div>



                                    <!-- HARGA -->

                                    <div class="info-box">

                                        <span class="info-label">
                                            Harga / Jam
                                        </span>

                                        <span class="info-value price">

                                            @if ($lapangan->harga_per_jam !== null)

                                                Rp
                                                {{ number_format(
                                                    $lapangan->harga_per_jam,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}

                                            @else

                                                -

                                            @endif

                                        </span>

                                    </div>



                                    <!-- KETERSEDIAAN -->

                                    <div class="info-box">

                                        <span class="info-label">
                                            Ketersediaan
                                        </span>

                                        <span
                                            class="
                                                info-value
                                                availability
                                                {{ $lapangan->ketersediaan === 'tersedia'
                                                    ? ''
                                                    : 'not-available'
                                                }}
                                            "
                                        >

                                            @if ($lapangan->ketersediaan === 'tersedia')

                                                Tersedia

                                            @elseif ($lapangan->ketersediaan === 'tidak_tersedia')

                                                Tidak Tersedia

                                            @elseif ($lapangan->status === 'aktif')

                                                Tersedia

                                            @else

                                                Tidak Tersedia

                                            @endif

                                        </span>

                                    </div>


                                </div>



                                <!-- ACTION -->

                                <div class="card-actions">


                                    <!-- DETAIL -->

                                    <a
                                        href="{{ route(
                                            'admin.lapangan.show',
                                            $lapangan->id
                                        ) }}"
                                        class="
                                            action-button
                                            detail-button
                                        "
                                    >

                                        👁

                                        Detail

                                    </a>



                                    <!-- EDIT -->

                                    <a
                                        href="{{ route(
                                            'admin.lapangan.edit',
                                            $lapangan->id
                                        ) }}"
                                        class="
                                            action-button
                                            edit-button
                                        "
                                    >

                                        ✏️

                                        Edit

                                    </a>


                                </div>


                            </div>


                        </article>


                    @else


                        <!-- =================================================
                             DATA BELUM DITEMUKAN
                        ================================================== -->

                        <article class="lapangan-card">


                            <div class="lapangan-image">

                                <div class="image-placeholder">

                                    <span>
                                        ⚽
                                    </span>

                                    <p>
                                        Lapangan {{ $kode }}
                                    </p>

                                </div>

                            </div>


                            <div class="lapangan-body">

                                <h3 class="lapangan-name">
                                    Lapangan {{ $kode }}
                                </h3>

                                <p class="lapangan-description">
                                    Data lapangan belum tersedia di database.
                                </p>


                                <div class="info-grid">

                                    <div class="info-box">

                                        <span class="info-label">
                                            Jenis
                                        </span>

                                        <span class="info-value">
                                            -
                                        </span>

                                    </div>


                                    <div class="info-box">

                                        <span class="info-label">
                                            Ukuran
                                        </span>

                                        <span class="info-value">
                                            -
                                        </span>

                                    </div>


                                    <div class="info-box">

                                        <span class="info-label">
                                            Harga / Jam
                                        </span>

                                        <span class="info-value price">
                                            -
                                        </span>

                                    </div>


                                    <div class="info-box">

                                        <span class="info-label">
                                            Ketersediaan
                                        </span>

                                        <span class="info-value">
                                            -
                                        </span>

                                    </div>

                                </div>


                                <div class="card-actions">

                                    <a
                                        href="{{ route('admin.lapangan.create') }}"
                                        class="
                                            action-button
                                            detail-button
                                        "
                                    >
                                        ＋ Tambah
                                    </a>

                                </div>

                            </div>

                        </article>


                    @endif


                @endforeach


            </div>


        </section>
@endsection

