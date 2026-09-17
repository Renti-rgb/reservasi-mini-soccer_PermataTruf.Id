@extends('admin.layout')

@section('title', 'Validasi Pembayaran')
@section('page-title', 'Validasi Pembayaran')
@section('page-subtitle', 'Kelola dan verifikasi pembayaran member PermataTruf.Id.')

@push('styles')
<style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: #26382f;

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

            overflow-x: hidden;
        }

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
            gap: 22px;
            padding: 16px;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 285px;

            height: calc(100vh - 32px);
            min-height: 0;
            max-height: calc(100vh - 32px);

            position: fixed;
            left: 16px;
            top: 16px;
            bottom: 16px;

            padding: 24px 18px 20px;

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

            /* Sidebar bisa di-scroll */
            overflow-y: auto;
            overflow-x: hidden;

            /* Scroll sidebar tidak mengganggu halaman utama */
            overscroll-behavior: contain;

            z-index: 10;

            /* Scrollbar Firefox */
            scrollbar-width: thin;
            scrollbar-color:
                rgba(87, 140, 113, 0.30)
                transparent;
        }

        /* Scrollbar Chrome / Edge */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(87, 140, 113, 0.25);
            border-radius: 999px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(87, 140, 113, 0.40);
        }

        /* =========================
           BRAND
        ========================= */

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

        /* =========================
           ADMIN LABEL
        ========================= */

        .admin-label {
            padding: 10px 12px;
            margin-bottom: 8px;

            font-size: 10px;
            font-weight: 800;

            color: #8a9b93;

            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* =========================
           MENU
        ========================= */

        .menu {
            display: grid;
            gap: 7px;

            flex: 0 0 auto;
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

            transition: all 0.25s ease;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, 0.52);

            border-color: rgba(255, 255, 255, 0.72);

            color: #16875a;

            transform: translateX(2px);
        }

        .menu a.active {
            background: rgba(255, 255, 255, 0.65);

            border: 1px solid rgba(255, 255, 255, 0.84);

            color: #16875a;

            box-shadow:
                0 8px 22px rgba(39, 83, 66, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.78);
        }

        .menu-icon {
            width: 32px;
            height: 32px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: rgba(218, 244, 229, 0.58);

            border: 1px solid rgba(255, 255, 255, 0.78);

            font-size: 15px;
        }

        /* =========================
           SIDEBAR BOTTOM
        ========================= */

        .sidebar-bottom {
            flex: 0 0 auto;

            margin-top: 20px;

            padding-top: 20px;
            padding-bottom: 8px;
        }

        /* =========================
           LOGOUT
        ========================= */

        .logout-button {
            width: 100%;

            padding: 13px 15px;

            border-radius: 15px;

            border: 1px solid rgba(255, 255, 255, 0.78);

            background: rgba(255, 235, 235, 0.55);

            color: #b35f5f;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: all 0.25s ease;
        }

        .logout-button:hover {
            background: rgba(255, 225, 225, 0.72);

            transform: translateY(-1px);
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 307px;

            width: calc(100% - 307px);

            min-width: 0;
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            min-height: 92px;

            padding: 20px 28px;

            border-radius: 24px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            background: rgba(255, 255, 255, 0.46);

            border: 1px solid rgba(255, 255, 255, 0.80);

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

        /* =========================
           ADMIN PROFILE
        ========================= */

        .admin-profile {
            display: flex;
            align-items: center;

            gap: 11px;

            padding: 8px 13px;

            border-radius: 16px;

            background: rgba(255, 255, 255, 0.44);

            border: 1px solid rgba(255, 255, 255, 0.70);
        }

        .profile-avatar {
            width: 50px;
            height: 50px;

            border-radius: 50%;

            padding: 4px;

            background: rgba(255, 255, 255, 0.90);

            border: 1px solid rgba(255, 255, 255, 0.95);

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

        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 25px 0 35px;
        }

        .welcome-card {
            padding: 26px 30px;

            margin-bottom: 20px;

            border-radius: 24px;

            background: rgba(255, 255, 255, 0.48);

            border: 1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 12px 35px rgba(39, 83, 66, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .welcome-card h2 {
            margin: 0 0 8px;

            font-size: 24px;

            color: #26382f;
        }

        .welcome-card p {
            margin: 0;

            font-size: 13px;

            color: #82928a;

            line-height: 1.7;
        }

        /* =========================
           ALERT
        ========================= */

        .alert-success {
            margin-bottom: 20px;

            padding: 14px 18px;

            border-radius: 17px;

            background: rgba(216, 244, 227, 0.60);

            border: 1px solid rgba(255, 255, 255, 0.80);

            color: #16875a;

            font-size: 13px;
            font-weight: 700;

            box-shadow:
                0 8px 22px rgba(39, 83, 66, 0.05);
        }

        .alert-error {
            margin-bottom: 20px;

            padding: 14px 18px;

            border-radius: 17px;

            background: rgba(255, 230, 230, 0.65);

            border: 1px solid rgba(255, 255, 255, 0.80);

            color: #b35f5f;

            font-size: 13px;
            font-weight: 700;
        }

        /* =========================
           PANEL
        ========================= */

        .panel {
            overflow: hidden;

            border-radius: 24px;

            background: rgba(255, 255, 255, 0.48);

            border: 1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 12px 35px rgba(39, 83, 66, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
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

        /* =========================
           TABLE
        ========================= */

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
            padding: 14px 20px;

            text-align: left;

            font-size: 10px;

            color: #899a92;

            text-transform: uppercase;

            letter-spacing: 0.8px;

            background: rgba(240, 249, 245, 0.40);
        }

        td {
            padding: 17px 20px;

            border-top:
                1px solid rgba(255, 255, 255, 0.62);

            font-size: 13px;

            color: #43574d;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.28);
        }

        /* =========================
           PAYMENT DATA
        ========================= */

        .payment-code {
            font-weight: 800;
            color: #30443a;
        }

        .payment-id {
            margin-top: 3px;

            font-size: 11px;

            color: #96a49e;
        }

        .user-name {
            font-weight: 800;
            color: #30443a;
        }

        .user-email {
            margin-top: 3px;

            font-size: 11px;

            color: #96a49e;
        }

        .field-name {
            font-weight: 700;
            color: #42574c;
        }

        .amount {
            font-weight: 800;

            color: #16875a;

            white-space: nowrap;
        }

        /* =========================
           METHOD
        ========================= */

        .method {
            display: inline-flex;

            align-items: center;

            padding: 7px 11px;

            border-radius: 999px;

            background: rgba(237, 242, 240, 0.65);

            border: 1px solid rgba(255, 255, 255, 0.70);

            color: #607269;

            font-size: 10px;

            font-weight: 800;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-flex;

            align-items: center;

            padding: 7px 12px;

            border-radius: 999px;

            font-size: 10px;

            font-weight: 800;

            border: 1px solid rgba(255, 255, 255, 0.70);
        }

        .status-waiting {
            background: rgba(255, 246, 213, 0.68);

            color: #98751b;
        }

        .status-confirmed {
            background: rgba(216, 244, 227, 0.68);

            color: #16875a;
        }

        .status-rejected {
            background: rgba(255, 226, 226, 0.68);

            color: #b35f5f;
        }

        .status-other {
            background: rgba(237, 242, 240, 0.65);

            color: #697a72;
        }

        /* =========================
           DETAIL BUTTON
        ========================= */

        .btn-detail {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 9px 14px;

            border-radius: 12px;

            border: 1px solid rgba(255, 255, 255, 0.80);

            background: rgba(255, 255, 255, 0.58);

            color: #16875a;

            font-size: 11px;
            font-weight: 800;

            text-decoration: none;

            transition: all 0.25s ease;
        }

        .btn-detail:hover {
            background: rgba(218, 244, 229, 0.72);

            transform: translateY(-1px);
        }

        /* =========================
           ACTION BUTTONS
        ========================= */

        .action-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-confirm {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 9px 14px;

            border-radius: 12px;

            border: 1px solid rgba(255, 255, 255, 0.80);

            background: rgba(216, 244, 227, 0.68);

            color: #16875a;

            font-size: 11px;
            font-weight: 800;

            cursor: pointer;

            transition: all 0.25s ease;
        }

        .btn-confirm:hover {
            background: rgba(191, 236, 209, 0.85);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(39, 83, 66, 0.08);
        }

        /* =========================
           EMPTY
        ========================= */

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

            background: rgba(218, 244, 229, 0.58);

            border: 1px solid rgba(255, 255, 255, 0.78);

            font-size: 24px;
        }

        /* =========================
           RESPONSIVE 900PX
        ========================= */

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

                height: auto;
                min-height: auto;
                max-height: none;

                margin-bottom: 15px;

                overflow-y: auto;
                overflow-x: hidden;

                overscroll-behavior: contain;
            }

            .main {
                margin-left: 0;

                width: 100%;
            }

            .sidebar-bottom {
                margin-top: 20px;
            }

            .topbar {
                min-height: 100px;
            }
        }

        /* =========================
           RESPONSIVE 600PX
        ========================= */

        @media (max-width: 600px) {

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .admin-profile {
                width: 100%;
            }

            .welcome-card {
                padding: 24px 20px;
            }

            .welcome-card h2 {
                font-size: 21px;
            }

            .panel-header {
                padding: 20px;
            }
        }
    
</style>
@endpush

@section('content')
<!-- TOPBAR -->

            

            <!-- CONTENT -->

            <section class="content">

                @if (session('success'))

                    <div class="alert-success">
                        ✓ {{ session('success') }}
                    </div>

                @endif

                @if (session('error'))

                    <div class="alert-error">
                        ✕ {{ session('error') }}
                    </div>

                @endif

                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            Daftar Pembayaran
                        </h2>

                        <p class="panel-description">
                            Seluruh pembayaran yang masuk ke dalam sistem.
                        </p>

                    </div>

                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>
                                        Pembayaran
                                    </th>

                                    <th>
                                        User
                                    </th>

                                    <th>
                                        Lapangan
                                    </th>

                                    <th>
                                        Jumlah
                                    </th>

                                    <th>
                                        Metode
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($pembayarans as $pembayaran)

                                    <tr>

                                        <td>

                                            <div class="payment-code">
                                                {{ $pembayaran->kode_pembayaran }}
                                            </div>

                                            <div class="payment-id">
                                                ID #{{ $pembayaran->id }}
                                            </div>

                                        </td>

                                        <td>

                                            <div class="user-name">
                                                {{ $pembayaran->reservasi->user->name ?? '-' }}
                                            </div>

                                            <div class="user-email">
                                                {{ $pembayaran->reservasi->user->email ?? '-' }}
                                            </div>

                                        </td>

                                        <td>

                                            <div class="field-name">
                                                {{ $pembayaran->reservasi->lapangan->nama ?? '-' }}
                                            </div>

                                        </td>

                                        <td>

                                            <div class="amount">
                                                Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                                            </div>

                                        </td>

                                        <td>

                                            <span class="method">

                                                @if ($pembayaran->metode === 'transfer_bank')

                                                    Transfer Bank

                                                @elseif ($pembayaran->metode === 'qris')

                                                    QRIS

                                                @else

                                                    {{ ucfirst($pembayaran->metode ?? '-') }}

                                                @endif

                                            </span>

                                        </td>

                                        <td>

                                            @if ($pembayaran->status === 'menunggu')

                                                <span class="status status-waiting">
                                                    Menunggu Verifikasi
                                                </span>

                                            @elseif ($pembayaran->status === 'diverifikasi')

                                                <span class="status status-confirmed">
                                                    Diverifikasi
                                                </span>

                                            @elseif ($pembayaran->status === 'ditolak')

                                                <span class="status status-rejected">
                                                    Ditolak
                                                </span>

                                            @else

                                                <span class="status status-other">
                                                    {{ ucfirst(str_replace('_', ' ', $pembayaran->status ?? '-')) }}
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            <div class="action-wrapper">

                                                {{-- DETAIL --}}
                                                <a
                                                    href="{{ route('admin.pembayaran.show', $pembayaran) }}"
                                                    class="btn-detail"
                                                >
                                                    Detail
                                                </a>

                                                {{-- KONFIRMASI / VERIFIKASI --}}
                                                @if ($pembayaran->status === 'menunggu')

                                                    <form
                                                        method="POST"
                                                        action="{{ route('admin.pembayaran.terima', $pembayaran) }}"
                                                        onsubmit="return confirm('Apakah kamu yakin ingin mengonfirmasi pembayaran ini?');"
                                                    >
                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="btn-confirm"
                                                        >
                                                            ✓ Konfirmasi
                                                        </button>
                                                    </form>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="7"
                                            class="empty"
                                        >

                                            <div class="empty-icon">
                                                💳
                                            </div>

                                            Belum ada pembayaran.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </section>
@endsection

