@extends('admin.layout')

@section('title', 'Laporan Reservasi')
@section('page-title', 'Laporan Reservasi')
@section('page-subtitle', 'Lihat dan cetak laporan reservasi PermataTruf.Id.')

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
            font-family: Arial, Helvetica, sans-serif;
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
            min-height: calc(100vh - 32px);

            position: fixed;
            left: 16px;
            top: 16px;
            bottom: 16px;

            padding: 24px 18px;

            border-radius: 28px;

            background: rgba(255, 255, 255, 0.48);

            border: 1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 18px 45px rgba(39, 83, 66, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

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

            padding: 8px 8px 20px;
        }

        .brand-logo {
            width: 48px;
            height: 48px;

            border-radius: 15px;

            background: rgba(255, 255, 255, 0.58);

            border: 1px solid rgba(255, 255, 255, 0.82);

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
           ADMIN LABEL
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

            padding: 13px 14px;

            border-radius: 16px;

            text-decoration: none;

            color: #52645b;

            font-size: 13px;
            font-weight: 600;

            border: 1px solid transparent;

            transition:
                background 0.25s ease,
                border-color 0.25s ease,
                color 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, 0.52);

            border-color:
                rgba(255, 255, 255, 0.72);

            color: #16875a;

            transform: translateX(2px);

            box-shadow:
                0 8px 20px rgba(39, 83, 66, 0.06);
        }

        .menu a.active {
            background: rgba(255, 255, 255, 0.68);

            border:
                1px solid rgba(255, 255, 255, 0.88);

            color: #16875a;

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
           SIDEBAR BOTTOM
        ========================================================= */

        .sidebar-bottom {
            margin-top: 10px;
            padding-top: 12px;

            border-top:
                1px solid rgba(255, 255, 255, 0.60);
        }

        .logout-button {
            width: 100%;

            padding: 13px 15px;

            border-radius: 15px;

            border:
                1px solid rgba(255, 255, 255, 0.80);

            background:
                rgba(255, 235, 235, 0.58);

            color: #b35f5f;

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

            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(150, 70, 70, 0.08);
        }

        /* =========================================================
           MAIN
        ========================================================= */

        .main {
            margin-left: 307px;
            width: calc(100% - 307px);
            min-width: 0;
        }

        /* =========================================================
           TOPBAR
        ========================================================= */

        .topbar {
            min-height: 92px;

            padding: 20px 28px;

            border-radius: 24px;

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

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .page-title {
            margin: 0;

            font-size: 29px;

            color: #26382f;

            letter-spacing: -0.7px;
        }

        .page-subtitle {
            margin-top: 6px;

            font-size: 12px;

            color: #87968f;
        }

        /* =========================================================
           ADMIN PROFILE
        ========================================================= */

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 11px;

            padding: 8px 13px;

            border-radius: 16px;

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

            color: #30443a;
        }

        .profile-role {
            margin-top: 3px;

            font-size: 11px;

            color: #8a9a93;
        }

        /* =========================================================
           CONTENT
        ========================================================= */

        .content {
            padding: 25px 0 35px;
        }

        /* =========================================================
           REPORT PANEL
        ========================================================= */

        .panel {
            overflow: hidden;

            border-radius: 24px;

            background:
                rgba(255, 255, 255, 0.48);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 12px 35px rgba(39, 83, 66, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            margin-bottom: 20px;
        }

        .panel-header {
            padding: 23px 26px;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.62);
        }

        .panel-title {
            margin: 0;

            font-size: 17px;

            color: #30443a;
        }

        .panel-description {
            margin: 5px 0 0;

            font-size: 12px;

            color: #899a92;
        }

        /* =========================================================
           FILTER
        ========================================================= */

        .filter-box {
            padding: 22px 26px;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.62);
        }

        .filter-grid {
            display: grid;

            grid-template-columns:
                1fr 1fr 1fr auto;

            gap: 14px;

            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .filter-label {
            font-size: 11px;

            font-weight: 800;

            color: #7e9087;

            text-transform: uppercase;

            letter-spacing: 0.7px;
        }

        .filter-input,
        .filter-select {
            width: 100%;

            min-height: 43px;

            padding: 10px 12px;

            border-radius: 13px;

            border:
                1px solid rgba(255, 255, 255, 0.82);

            background:
                rgba(255, 255, 255, 0.58);

            color: #43574d;

            font-size: 12px;

            outline: none;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.60);
        }

        .filter-input:focus,
        .filter-select:focus {
            border-color:
                rgba(102, 177, 133, 0.45);

            box-shadow:
                0 0 0 3px rgba(102, 177, 133, 0.08);
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .button-group {
            display: flex;
            gap: 8px;
        }

        .btn-filter,
        .btn-reset,
        .btn-pdf {
            min-height: 43px;

            padding: 10px 16px;

            border-radius: 13px;

            text-decoration: none;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            font-size: 12px;
            font-weight: 800;

            cursor: pointer;

            transition:
                background 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .btn-filter {
            border:
                1px solid rgba(255, 255, 255, 0.80);

            background:
                rgba(218, 244, 229, 0.72);

            color: #16875a;
        }

        .btn-filter:hover {
            background:
                rgba(202, 238, 216, 0.85);

            transform: translateY(-1px);

            box-shadow:
                0 7px 18px rgba(39, 83, 66, 0.08);
        }

        .btn-reset {
            border:
                1px solid rgba(255, 255, 255, 0.80);

            background:
                rgba(255, 255, 255, 0.58);

            color: #6e8178;
        }

        .btn-reset:hover {
            background:
                rgba(255, 255, 255, 0.78);

            transform: translateY(-1px);
        }

        .btn-pdf {
            border:
                1px solid rgba(255, 255, 255, 0.82);

            background:
                rgba(255, 235, 235, 0.65);

            color: #b35f5f;

            box-shadow:
                0 6px 16px rgba(150, 70, 70, 0.05);
        }

        .btn-pdf:hover {
            background:
                rgba(255, 222, 222, 0.80);

            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(150, 70, 70, 0.08);
        }

        /* =========================================================
           SUMMARY
        ========================================================= */

        .summary-grid {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 16px;

            padding: 22px 26px;
        }

        .summary-card {
            padding: 20px;

            border-radius: 18px;

            background:
                rgba(255, 255, 255, 0.42);

            border:
                1px solid rgba(255, 255, 255, 0.72);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .summary-title {
            font-size: 11px;

            color: #84948d;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 0.7px;

            margin-bottom: 10px;
        }

        .summary-number {
            font-size: 25px;

            font-weight: 800;

            color: #26382f;
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

            min-width: 1000px;

            border-collapse: collapse;
        }

        th {
            padding: 14px 22px;

            text-align: left;

            font-size: 10px;

            color: #899a92;

            text-transform: uppercase;

            letter-spacing: 0.8px;

            background:
                rgba(240, 249, 245, 0.40);
        }

        td {
            padding: 16px 22px;

            border-top:
                1px solid rgba(255, 255, 255, 0.62);

            font-size: 12px;

            color: #43574d;

            background:
                rgba(255, 255, 255, 0.08);
        }

        tbody tr {
            transition:
                background 0.2s ease;
        }

        tbody tr:hover {
            background:
                rgba(255, 255, 255, 0.30);
        }

        .reservation-code {
            font-weight: 800;

            color: #30443a;
        }

        .user-name {
            font-weight: 700;

            color: #30443a;
        }

        .field-name {
            font-weight: 700;

            color: #42574c;
        }

        .price {
            font-weight: 800;

            color: #16875a;
        }

        /* =========================================================
           STATUS
        ========================================================= */

        .status {
            display: inline-flex;

            align-items: center;

            padding: 7px 12px;

            border-radius: 999px;

            font-size: 10px;

            font-weight: 800;

            border:
                1px solid rgba(255, 255, 255, 0.70);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.50);
        }

        .status-waiting {
            background:
                rgba(255, 246, 213, 0.68);

            color: #98751b;
        }

        .status-confirmed {
            background:
                rgba(216, 244, 227, 0.68);

            color: #16875a;
        }

        .status-other {
            background:
                rgba(237, 242, 240, 0.65);

            color: #697a72;
        }

        /* =========================================================
           PAYMENT
        ========================================================= */

        .payment-paid {
            color: #16875a;
            font-weight: 800;
        }

        .payment-waiting {
            color: #98751b;
            font-weight: 700;
        }

        .payment-none {
            color: #9a9995;
            font-weight: 700;
        }

        /* =========================================================
           EMPTY
        ========================================================= */

        .empty {
            padding: 60px 25px;

            text-align: center;

            color: #8b9993;

            font-size: 13px;
        }

        .empty-icon {
            width: 58px;
            height: 58px;

            margin: 0 auto 15px;

            border-radius: 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                rgba(218, 244, 229, 0.58);

            border:
                1px solid rgba(255, 255, 255, 0.78);

            font-size: 24px;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .sidebar {
                width: 260px;
            }

            .main {
                margin-left: 282px;
                width: calc(100% - 282px);
            }

            .filter-grid {
                grid-template-columns:
                    1fr 1fr;
            }

            .button-group {
                grid-column: 1 / -1;
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

            .topbar {
                min-height: 100px;
            }
        }

        @media (max-width: 600px) {

            .topbar {
                flex-direction: column;

                align-items: flex-start;
            }

            .admin-profile {
                width: 100%;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                grid-column: auto;

                flex-direction: column;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .panel-header {
                padding: 20px;
            }

            .filter-box {
                padding: 20px;
            }

            .summary-grid {
                padding: 20px;
            }
        }
    
</style>
@endpush

@section('content')
{{-- TOPBAR --}}
        


        {{-- CONTENT --}}
        <section class="content">


            {{-- =================================================
                 FILTER PANEL
            ================================================== --}}

            <div class="panel">

                <div class="panel-header">

                    <h2 class="panel-title">
                        Filter Laporan
                    </h2>

                    <p class="panel-description">
                        Tentukan rentang tanggal dan status reservasi yang ingin ditampilkan.
                    </p>

                </div>


                <form
                    method="GET"
                    action="{{ route('admin.laporan.index') }}"
                    class="filter-box"
                >

                    <div class="filter-grid">

                        {{-- TANGGAL MULAI --}}
                        <div class="filter-group">

                            <label class="filter-label">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                class="filter-input"
                                value="{{ request('tanggal_mulai') }}"
                            >

                        </div>


                        {{-- TANGGAL SELESAI --}}
                        <div class="filter-group">

                            <label class="filter-label">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="filter-input"
                                value="{{ request('tanggal_selesai') }}"
                            >

                        </div>


                        {{-- STATUS --}}
                        <div class="filter-group">

                            <label class="filter-label">
                                Status Reservasi
                            </label>

                            <select
                                name="status"
                                class="filter-select"
                            >

                                <option value="">
                                    Semua Status
                                </option>

                                <option
                                    value="menunggu_verifikasi"
                                    {{ request('status') === 'menunggu_verifikasi' ? 'selected' : '' }}
                                >
                                    Menunggu Verifikasi
                                </option>

                                <option
                                    value="dikonfirmasi"
                                    {{ request('status') === 'dikonfirmasi' ? 'selected' : '' }}
                                >
                                    Dikonfirmasi
                                </option>

                                <option
                                    value="selesai"
                                    {{ request('status') === 'selesai' ? 'selected' : '' }}
                                >
                                    Selesai
                                </option>

                                <option
                                    value="dibatalkan"
                                    {{ request('status') === 'dibatalkan' ? 'selected' : '' }}
                                >
                                    Dibatalkan
                                </option>

                            </select>

                        </div>


                        {{-- BUTTON --}}
                        <div class="button-group">

                            <button
                                type="submit"
                                class="btn-filter"
                            >
                                🔎 Filter
                            </button>

                            <a
                                href="{{ route('admin.laporan.index') }}"
                                class="btn-reset"
                            >
                                ↻ Reset
                            </a>

                            <a
                                href="{{ route('admin.laporan.pdf', request()->query()) }}"
                                class="btn-pdf"
                                target="_blank"
                            >
                                📄 PDF
                            </a>

                        </div>

                    </div>

                </form>

            </div>


            {{-- =================================================
                 SUMMARY
            ================================================== --}}

            <div class="panel">

                <div class="panel-header">

                    <h2 class="panel-title">
                        Ringkasan Laporan
                    </h2>

                    <p class="panel-description">
                        Ringkasan berdasarkan data yang sedang ditampilkan.
                    </p>

                </div>

                <div class="summary-grid">

                    {{-- TOTAL RESERVASI --}}
                    <div class="summary-card">

                        <div class="summary-title">
                            Total Reservasi
                        </div>

                        <div class="summary-number">
                            {{ $reservasis->count() }}
                        </div>

                    </div>


                    {{-- TOTAL PENDAPATAN --}}
                    <div class="summary-card">

                        <div class="summary-title">
                            Total Pendapatan
                        </div>

                        <div class="summary-number">
                            Rp {{ number_format(
                                $reservasis
                                    ->whereIn('status', ['dikonfirmasi', 'selesai'])
                                    ->sum('total_harga'),
                                0,
                                ',',
                                '.'
                            ) }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 TABLE
            ================================================== --}}

            <div class="panel">

                <div class="panel-header">

                    <h2 class="panel-title">
                        Daftar Laporan Reservasi
                    </h2>

                    <p class="panel-description">
                        Menampilkan seluruh data reservasi berdasarkan filter yang dipilih.
                    </p>

                </div>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Kode
                                </th>

                                <th>
                                    User
                                </th>

                                <th>
                                    Lapangan
                                </th>

                                <th>
                                    Jadwal
                                </th>

                                <th>
                                    Total
                                </th>

                                <th>
                                    Pembayaran
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Dibuat
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($reservasis as $item)

                                <tr>

                                    {{-- KODE --}}
                                    <td>

                                        <div class="reservation-code">
                                            {{ $item->kode_reservasi ?? '#' . $item->id }}
                                        </div>

                                    </td>


                                    {{-- USER --}}
                                    <td>

                                        <div class="user-name">
                                            {{ $item->user->name ?? '-' }}
                                        </div>

                                    </td>


                                    {{-- LAPANGAN --}}
                                    <td>

                                        <div class="field-name">
                                            {{ $item->lapangan->nama ?? '-' }}
                                        </div>

                                    </td>


                                    {{-- JADWAL --}}
                                    <td>

                                        @if ($item->jadwal)

                                            {{ \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d/m/Y') }}

                                            <br>

                                            <small>
                                                {{ $item->jadwal->jam_mulai }}
                                                -
                                                {{ $item->jadwal->jam_selesai }}
                                            </small>

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- TOTAL --}}
                                    <td>

                                        <div class="price">

                                            Rp {{ number_format(
                                                $item->total_harga ?? 0,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </div>

                                    </td>


                                    {{-- PEMBAYARAN --}}
                                    <td>

                                        @if ($item->pembayaran)

                                            @if ($item->pembayaran->status === 'diterima')

                                                <span class="payment-paid">
                                                    Diterima
                                                </span>

                                            @elseif ($item->pembayaran->status === 'menunggu')

                                                <span class="payment-waiting">
                                                    Menunggu
                                                </span>

                                            @else

                                                <span class="payment-none">
                                                    {{ ucfirst(
                                                        str_replace(
                                                            '_',
                                                            ' ',
                                                            $item->pembayaran->status
                                                        )
                                                    ) }}
                                                </span>

                                            @endif

                                        @else

                                            <span class="payment-none">
                                                Belum ada
                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if ($item->status === 'menunggu_verifikasi')

                                            <span class="status status-waiting">
                                                Menunggu Verifikasi
                                            </span>

                                        @elseif ($item->status === 'dikonfirmasi')

                                            <span class="status status-confirmed">
                                                Dikonfirmasi
                                            </span>

                                        @else

                                            <span class="status status-other">
                                                {{ ucfirst(
                                                    str_replace(
                                                        '_',
                                                        ' ',
                                                        $item->status
                                                    )
                                                ) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- CREATED --}}
                                    <td>

                                        {{ $item->created_at
                                            ? $item->created_at->format('d/m/Y H:i')
                                            : '-'
                                        }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="empty"
                                    >

                                        <div class="empty-icon">
                                            📄
                                        </div>

                                        Belum ada data laporan reservasi.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>
@endsection

