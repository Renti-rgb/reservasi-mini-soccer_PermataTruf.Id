@extends('admin.layout')

@section('title', 'Monitor Auto-Cancel')
@section('page-title', 'Monitor Auto-Cancel')
@section('page-subtitle', 'Pantau reservasi yang masih menunggu pembayaran.')

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
            min-height: 100vh;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #26382f;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(111, 207, 151, 0.22),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 90% 20%,
                    rgba(74, 160, 112, 0.16),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 50% 100%,
                    rgba(143, 196, 161, 0.20),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #edf8f4 0%,
                    #e6f2ed 45%,
                    #f4faf7 100%
                );

            overflow-x: hidden;
        }


        /* =========================================================
           GLASS
        ========================================================= */

        .glass {

            background:
                rgba(255, 255, 255, 0.48);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 18px 45px rgba(39, 83, 66, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            backdrop-filter:
                blur(20px);

            -webkit-backdrop-filter:
                blur(20px);
        }


        /* =========================================================
           WRAPPER
        ========================================================= */

        .admin-wrapper {

            min-height: 100vh;

            display: flex;

            gap: 22px;

            padding: 16px;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {

            width: 285px;

            min-height:
                calc(100vh - 32px);

            position: fixed;

            left: 16px;
            top: 16px;
            bottom: 16px;

            padding:
                24px 18px;

            border-radius:
                28px;

            background:
                rgba(255, 255, 255, 0.48);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 18px 45px rgba(39, 83, 66, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);

            backdrop-filter:
                blur(20px);

            -webkit-backdrop-filter:
                blur(20px);

            display: flex;

            flex-direction: column;

            z-index: 100;
        }


        /* =========================================================
           BRAND
        ========================================================= */

        .brand {

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                8px 8px 20px;
        }

        .brand-logo {

            width: 48px;
            height: 48px;

            border-radius: 15px;

            background:
                rgba(255, 255, 255, 0.58);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            display: flex;

            align-items: center;
            justify-content: center;

            overflow: hidden;
        }

        .brand-logo img {

            width: 100%;
            height: 100%;

            object-fit: contain;
        }

        .brand-text {

            font-size: 19px;

            font-weight: 800;

            color: #26382f;
        }

        .brand-text span {

            color: #16875a;
        }


        /* =========================================================
           LABEL
        ========================================================= */

        .admin-label {

            padding: 10px 12px;

            margin-bottom: 8px;

            font-size: 10px;

            font-weight: 800;

            color: #8a9b93;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        /* =========================================================
           MENU
        ========================================================= */

        .menu {

            display: grid;

            gap: 7px;
        }

        .menu a {

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                13px 14px;

            border-radius:
                16px;

            text-decoration: none;

            color: #52645b;

            font-size: 13px;

            font-weight: 600;

            border:
                1px solid transparent;

            transition:
                background 0.25s ease,
                border-color 0.25s ease,
                color 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .menu a:hover {

            background:
                rgba(255, 255, 255, 0.52);

            border-color:
                rgba(255, 255, 255, 0.72);

            color:
                #16875a;

            transform:
                translateX(2px);

            box-shadow:
                0 8px 20px rgba(39, 83, 66, 0.06);
        }

        .menu a.active {

            background:
                rgba(255, 255, 255, 0.68);

            border:
                1px solid rgba(255, 255, 255, 0.88);

            color:
                #16875a;

            box-shadow:
                0 8px 22px rgba(39, 83, 66, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.80);
        }

        .menu-icon {

            width: 32px;
            height: 32px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                rgba(218, 244, 229, 0.58);

            border:
                1px solid rgba(255, 255, 255, 0.78);

            font-size: 15px;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.60);
        }


        /* =========================================================
           LOGOUT
        ========================================================= */

        .sidebar-bottom {

            margin-top: 10px;

            padding-top: 12px;

            border-top:
                1px solid rgba(255, 255, 255, 0.60);
        }

        .logout-button {

            width: 100%;

            padding:
                13px 15px;

            border-radius:
                15px;

            border:
                1px solid rgba(255, 255, 255, 0.80);

            background:
                rgba(255, 235, 235, 0.58);

            color:
                #b35f5f;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            transition:
                background 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .logout-button:hover {

            background:
                rgba(255, 225, 225, 0.78);

            transform:
                translateY(-1px);

            box-shadow:
                0 8px 20px rgba(150, 70, 70, 0.08);
        }


        /* =========================================================
           MAIN
        ========================================================= */

        .main {

            margin-left:
                307px;

            width:
                calc(100% - 307px);

            min-width: 0;
        }


        /* =========================================================
           TOPBAR
        ========================================================= */

        .topbar {

            min-height:
                92px;

            padding:
                20px 28px;

            border-radius:
                24px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            background:
                rgba(255, 255, 255, 0.46);

            border:
                1px solid rgba(255, 255, 255, 0.80);

            box-shadow:
                0 12px 35px rgba(39, 83, 66, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);
        }

        .page-title {

            margin: 0;

            font-size: 29px;

            color:
                #26382f;

            letter-spacing:
                -0.7px;
        }

        .page-subtitle {

            margin-top: 6px;

            font-size: 12px;

            color:
                #87968f;
        }


        /* =========================================================
           PROFILE
        ========================================================= */

        .admin-profile {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                8px 13px;

            border-radius:
                16px;

            background:
                rgba(255, 255, 255, 0.44);

            border:
                1px solid rgba(255, 255, 255, 0.70);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
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

            font-size: 13px;

            font-weight: 800;

            color:
                #30443a;
        }

        .profile-role {

            margin-top: 3px;

            font-size: 11px;

            color:
                #8a9a93;
        }


        /* =========================================================
           CONTENT
        ========================================================= */

        .content {

            padding:
                25px 0 35px;
        }


        /* =========================================================
           WELCOME
        ========================================================= */

        .welcome-card {

            padding:
                26px 30px;

            margin-bottom:
                20px;

            border-radius:
                24px;

            background:
                rgba(255, 255, 255, 0.48);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 12px 35px rgba(39, 83, 66, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);
        }

        .welcome-card h2 {

            margin:
                0 0 8px;

            font-size:
                24px;

            color:
                #26382f;
        }

        .welcome-card p {

            margin: 0;

            font-size:
                13px;

            color:
                #82928a;

            line-height:
                1.7;
        }


        /* =========================================================
           STAT GRID
        ========================================================= */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 16px;

            margin-bottom:
                20px;
        }

        .stat-card {

            padding:
                22px;

            border-radius:
                22px;

            background:
                rgba(255, 255, 255, 0.48);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 12px 35px rgba(39, 83, 66, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);
        }

        .stat-label {

            font-size:
                11px;

            font-weight:
                800;

            color:
                #899a92;

            text-transform:
                uppercase;

            letter-spacing:
                0.6px;
        }

        .stat-number {

            margin-top:
                9px;

            font-size:
                30px;

            font-weight:
                800;

            color:
                #16875a;
        }

        .stat-description {

            margin-top:
                5px;

            font-size:
                11px;

            color:
                #8c9a94;
        }

        .stat-warning .stat-number {

            color:
                #b47722;
        }


        /* =========================================================
           PANEL
        ========================================================= */

        .panel {

            overflow:
                hidden;

            border-radius:
                24px;

            background:
                rgba(255, 255, 255, 0.48);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 12px 35px rgba(39, 83, 66, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);

            margin-bottom:
                20px;
        }

        .panel-header {

            padding:
                23px 26px;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.62);

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }

        .panel-title {

            margin: 0;

            font-size:
                17px;

            color:
                #30443a;
        }

        .panel-description {

            margin:
                5px 0 0;

            font-size:
                12px;

            color:
                #899a92;
        }


        /* =========================================================
           MONITORING BADGE
        ========================================================= */

        .monitoring-badge {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding:
                8px 12px;

            border-radius:
                999px;

            background:
                rgba(216, 244, 227, 0.68);

            border:
                1px solid rgba(255, 255, 255, 0.80);

            color:
                #16875a;

            font-size:
                10px;

            font-weight:
                800;

            white-space:
                nowrap;
        }

        .monitoring-dot {

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background:
                #22a263;
        }


        /* =========================================================
           TABLE
        ========================================================= */

        .table-wrapper {

            width: 100%;

            overflow-x: auto;
        }

        table {

            width: 100%;

            min-width:
                1050px;

            border-collapse:
                collapse;
        }

        th {

            padding:
                14px 20px;

            text-align:
                left;

            font-size:
                10px;

            color:
                #899a92;

            text-transform:
                uppercase;

            letter-spacing:
                0.8px;

            background:
                rgba(240, 249, 245, 0.40);

            white-space:
                nowrap;
        }

        td {

            padding:
                17px 20px;

            border-top:
                1px solid rgba(255, 255, 255, 0.62);

            font-size:
                12px;

            color:
                #43574d;

            background:
                rgba(255, 255, 255, 0.08);

            vertical-align:
                middle;
        }

        tbody tr {

            transition:
                background 0.2s ease;
        }

        tbody tr:hover {

            background:
                rgba(255, 255, 255, 0.30);
        }


        /* =========================================================
           DATA
        ========================================================= */

        .kode {

            color:
                #16875a;

            font-weight:
                800;

            white-space:
                nowrap;
        }

        .field-name {

            font-weight:
                700;

            color:
                #30443a;
        }

        .date-main {

            color:
                #43574d;

            font-weight:
                600;

            white-space:
                nowrap;
        }

        .date-sub {

            margin-top:
                4px;

            font-size:
                10px;

            color:
                #96a49e;

            white-space:
                nowrap;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .status {

            display:
                inline-flex;

            align-items:
                center;

            padding:
                7px 11px;

            border-radius:
                999px;

            font-size:
                10px;

            font-weight:
                800;

            border:
                1px solid rgba(255, 255, 255, 0.70);

            white-space:
                nowrap;
        }

        .status-reservasi {

            background:
                rgba(255, 246, 213, 0.68);

            color:
                #98751b;
        }

        .status-waiting {

            background:
                rgba(216, 244, 227, 0.68);

            color:
                #16875a;
        }

        .status-warning {

            background:
                rgba(255, 230, 184, 0.68);

            color:
                #a66c18;
        }

        .status-danger {

            background:
                rgba(250, 215, 215, 0.70);

            color:
                #a34747;
        }


        /* =========================================================
           COUNTDOWN
        ========================================================= */

        .countdown {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            min-width:
                78px;

            padding:
                9px 12px;

            border-radius:
                12px;

            background:
                rgba(216, 244, 227, 0.68);

            border:
                1px solid rgba(255, 255, 255, 0.78);

            color:
                #16875a;

            font-size:
                12px;

            font-weight:
                800;

            font-variant-numeric:
                tabular-nums;

            white-space:
                nowrap;
        }

        .countdown-warning {

            background:
                rgba(255, 230, 184, 0.68);

            color:
                #a66c18;
        }

        .countdown-danger {

            background:
                rgba(250, 215, 215, 0.70);

            color:
                #a34747;
        }


        /* =========================================================
           EMPTY
        ========================================================= */

        .empty {

            padding:
                60px 25px;

            text-align:
                center;

            color:
                #8b9993;

            font-size:
                13px;
        }

        .empty-icon {

            width:
                58px;

            height:
                58px;

            margin:
                0 auto 15px;

            border-radius:
                18px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                rgba(218, 244, 229, 0.58);

            border:
                1px solid rgba(255, 255, 255, 0.78);

            font-size:
                24px;
        }


        /* =========================================================
           INFO GRID
        ========================================================= */

        .info-grid {

            display:
                grid;

            grid-template-columns:
                1fr 1fr;

            gap:
                20px;
        }

        .info-item {

            display:
                flex;

            align-items:
                flex-start;

            gap:
                12px;

            margin-bottom:
                15px;
        }

        .info-number {

            width:
                30px;

            height:
                30px;

            flex-shrink:
                0;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                10px;

            background:
                rgba(218, 244, 229, 0.65);

            border:
                1px solid rgba(255, 255, 255, 0.78);

            color:
                #16875a;

            font-size:
                12px;

            font-weight:
                800;
        }

        .info-text {

            padding-top:
                2px;

            font-size:
                12px;

            color:
                #65756d;

            line-height:
                1.6;
        }

        .info-text strong {

            color:
                #30443a;
        }


        /* =========================================================
           REFRESH
        ========================================================= */

        .refresh-button {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                8px;

            padding:
                10px 15px;

            border-radius:
                13px;

            text-decoration:
                none;

            background:
                rgba(255, 255, 255, 0.58);

            border:
                1px solid rgba(255, 255, 255, 0.80);

            color:
                #16875a;

            font-size:
                11px;

            font-weight:
                800;

            transition:
                0.25s ease;
        }

        .refresh-button:hover {

            background:
                rgba(218, 244, 229, 0.72);

            transform:
                translateY(-1px);

            box-shadow:
                0 7px 18px rgba(39, 83, 66, 0.08);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .sidebar {

                width:
                    260px;
            }

            .main {

                margin-left:
                    282px;

                width:
                    calc(100% - 282px);
            }

            .stats-grid {

                grid-template-columns:
                    1fr 1fr;
            }
        }


        @media (max-width: 900px) {

            .admin-wrapper {

                display:
                    block;

                padding:
                    12px;
            }

            .sidebar {

                position:
                    relative;

                left:
                    auto;

                top:
                    auto;

                bottom:
                    auto;

                width:
                    100%;

                min-height:
                    auto;

                margin-bottom:
                    15px;
            }

            .main {

                margin-left:
                    0;

                width:
                    100%;
            }

            .info-grid {

                grid-template-columns:
                    1fr;
            }
        }


        @media (max-width: 600px) {

            .topbar {

                flex-direction:
                    column;

                align-items:
                    flex-start;
            }

            .admin-profile {

                width:
                    100%;
            }

            .stats-grid {

                grid-template-columns:
                    1fr;
            }

            .welcome-card {

                padding:
                    24px 20px;
            }

            .panel-header {

                align-items:
                    flex-start;

                flex-direction:
                    column;
            }
        }

    
</style>
@endpush

@section('content')
{{-- TOPBAR --}}

        


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <section class="content">


            {{-- =================================================
                 WELCOME
            ================================================== --}}

            <div class="welcome-card">

                <h2>
                    Monitoring Pembayaran Reservasi
                </h2>

                <p>
                    Halaman ini digunakan untuk memantau reservasi
                    dengan status <strong>Menunggu Pembayaran</strong>.
                    Sistem memberikan waktu pembayaran selama
                    <strong>30 menit</strong> dan melakukan pemeriksaan
                    otomatis setiap <strong>5 menit</strong>.
                </p>

            </div>


            {{-- =================================================
                 STATISTIK
            ================================================== --}}

            <div class="stats-grid">


                {{-- TOTAL --}}

                <div class="stat-card">

                    <div class="stat-label">
                        Total Dipantau
                    </div>

                    <div class="stat-number">
                        {{ $dataMonitor->count() }}
                    </div>

                    <div class="stat-description">
                        Reservasi menunggu pembayaran
                    </div>

                </div>


                {{-- MENUNGGU --}}

                <div class="stat-card">

                    <div class="stat-label">
                        Menunggu Pembayaran
                    </div>

                    <div class="stat-number">
                        {{ $jumlahMenunggu }}
                    </div>

                    <div class="stat-description">
                        Masih dalam batas waktu pembayaran
                    </div>

                </div>


                {{-- SEGERA --}}

                <div class="stat-card stat-warning">

                    <div class="stat-label">
                        Segera Auto-Cancel
                    </div>

                    <div class="stat-number">
                        {{ $jumlahSegera }}
                    </div>

                    <div class="stat-description">
                        Mendekati atau melewati batas waktu
                    </div>

                </div>


            </div>


            {{-- =================================================
                 MONITOR TABLE
            ================================================== --}}

            <div class="panel">


                <div class="panel-header">

                    <div>

                        <h2 class="panel-title">
                            Daftar Reservasi yang Dipantau
                        </h2>

                        <p class="panel-description">
                            Reservasi dengan status menunggu pembayaran.
                        </p>

                    </div>


                    <div style="display:flex;align-items:center;gap:8px;">

                        <a
                            href="{{ route('admin.auto-cancel.index') }}"
                            class="refresh-button"
                        >
                            ↻ Refresh Data
                        </a>

                        <span class="monitoring-badge">

                            <span class="monitoring-dot"></span>

                            Monitoring Aktif

                        </span>

                    </div>

                </div>


                <div class="table-wrapper">

                    <table>


                        <thead>

                            <tr>

                                <th>
                                    Kode Reservasi
                                </th>

                                <th>
                                    Lapangan
                                </th>

                                <th>
                                    Tanggal Main
                                </th>

                                <th>
                                    Status Reservasi
                                </th>

                                <th>
                                    Waktu Booking
                                </th>

                                <th>
                                    Batas Pembayaran
                                </th>

                                <th>
                                    Monitoring
                                </th>

                                <th>
                                    Countdown
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @forelse ($dataMonitor as $reservasi)


                                <tr>


                                    {{-- KODE --}}

                                    <td>

                                        <div class="kode">

                                            {{ $reservasi->kode_reservasi }}

                                        </div>

                                    </td>


                                    {{-- LAPANGAN --}}

                                    <td>

                                        <div class="field-name">

                                            {{ $reservasi->lapangan->nama ?? '-' }}

                                        </div>

                                    </td>


                                    {{-- TANGGAL MAIN --}}

                                    <td>

                                        @if ($reservasi->jadwal)

                                            <div class="date-main">

                                                {{ \Carbon\Carbon::parse($reservasi->jadwal->tanggal)->format('d M Y') }}

                                            </div>

                                            <div class="date-sub">

                                                {{ \Carbon\Carbon::parse($reservasi->jadwal->jam_mulai)->format('H:i') }}

                                                -

                                                {{ \Carbon\Carbon::parse($reservasi->jadwal->jam_selesai)->format('H:i') }}

                                            </div>

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- STATUS RESERVASI --}}

                                    <td>

                                        <span class="status status-reservasi">

                                            Menunggu Pembayaran

                                        </span>

                                    </td>


                                    {{-- WAKTU BOOKING --}}

                                    <td>

                                        <div class="date-main">

                                            {{ $reservasi->created_at->format('d M Y') }}

                                        </div>

                                        <div class="date-sub">

                                            {{ $reservasi->created_at->format('H:i:s') }}

                                        </div>

                                    </td>


                                    {{-- BATAS PEMBAYARAN --}}

                                    <td>

                                        <div class="date-main">

                                            {{ $reservasi->batas_pembayaran->format('d M Y') }}

                                        </div>

                                        <div class="date-sub">

                                            {{ $reservasi->batas_pembayaran->format('H:i:s') }}

                                        </div>

                                    </td>


                                    {{-- MONITORING --}}

                                    <td>


                                        @if ($reservasi->status_class === 'danger')

                                            <span class="status status-danger">

                                                {{ $reservasi->monitor_status }}

                                            </span>

                                        @elseif ($reservasi->status_class === 'warning')

                                            <span class="status status-warning">

                                                {{ $reservasi->monitor_status }}

                                            </span>

                                        @else

                                            <span class="status status-waiting">

                                                {{ $reservasi->monitor_status }}

                                            </span>

                                        @endif


                                    </td>


                                    {{-- COUNTDOWN --}}

                                    <td>


                                        @if ($reservasi->status_class === 'danger')

                                            <span class="countdown countdown-danger">

                                                {{ $reservasi->sisa_waktu }}

                                            </span>

                                        @elseif ($reservasi->status_class === 'warning')

                                            <span class="countdown countdown-warning">

                                                {{ $reservasi->sisa_waktu }}

                                            </span>

                                        @else

                                            <span class="countdown">

                                                {{ $reservasi->sisa_waktu }}

                                            </span>

                                        @endif


                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td
                                        colspan="8"
                                        class="empty"
                                    >

                                        <div class="empty-icon">
                                            ✓
                                        </div>

                                        Tidak ada reservasi yang sedang menunggu pembayaran.

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>


                    </table>

                </div>


            </div>


            {{-- =================================================
                 INFORMATION
            ================================================== --}}

            <div class="info-grid">


                {{-- CARA KERJA --}}

                <div class="panel">

                    <div class="panel-header">

                        <div>

                            <h2 class="panel-title">
                                Cara Kerja Auto-Cancel
                            </h2>

                            <p class="panel-description">
                                Mekanisme otomatis sistem reservasi.
                            </p>

                        </div>

                    </div>


                    <div style="padding:23px 26px;">


                        <div class="info-item">

                            <div class="info-number">
                                1
                            </div>

                            <div class="info-text">

                                Reservasi dibuat dengan status
                                <strong>Menunggu Pembayaran</strong>.

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-number">
                                2
                            </div>

                            <div class="info-text">

                                Member memiliki batas waktu pembayaran
                                selama <strong>30 menit</strong>.

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-number">
                                3
                            </div>

                            <div class="info-text">

                                Scheduler melakukan pemeriksaan
                                otomatis setiap <strong>5 menit</strong>.

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-number">
                                4
                            </div>

                            <div class="info-text">

                                Jika batas waktu terlewati,
                                status reservasi menjadi
                                <strong>Dibatalkan</strong>.

                            </div>

                        </div>


                        <div class="info-item" style="margin-bottom:0;">

                            <div class="info-number">
                                5
                            </div>

                            <div class="info-text">

                                Jadwal lapangan yang sebelumnya terisi
                                dikembalikan menjadi <strong>Tersedia</strong>.

                            </div>

                        </div>


                    </div>

                </div>


                {{-- AKTIVITAS SISTEM --}}

                <div class="panel">

                    <div class="panel-header">

                        <div>

                            <h2 class="panel-title">
                                Aktivitas Sistem
                            </h2>

                            <p class="panel-description">
                                Status monitoring auto-cancel.
                            </p>

                        </div>

                    </div>


                    <div style="padding:23px 26px;">


                        <div class="info-item">

                            <div class="info-number">
                                ✓
                            </div>

                            <div class="info-text">

                                Monitor auto-cancel sedang aktif.

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-number">
                                30
                            </div>

                            <div class="info-text">

                                Batas pembayaran:
                                <strong>30 menit</strong> sejak reservasi dibuat.

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-number">
                                5
                            </div>

                            <div class="info-text">

                                Pemeriksaan scheduler:
                                <strong>setiap 5 menit</strong>.

                            </div>

                        </div>


                        <div class="info-item" style="margin-bottom:0;">

                            <div class="info-number">
                                #
                            </div>

                            <div class="info-text">

                                Saat ini ada
                                <strong>{{ $dataMonitor->count() }}</strong>
                                reservasi yang sedang dipantau.

                            </div>

                        </div>


                    </div>

                </div>


            </div>


        </section>
@endsection

