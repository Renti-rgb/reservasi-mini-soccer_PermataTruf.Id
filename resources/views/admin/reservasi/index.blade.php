@extends('admin.layout')

@section('title', 'Kelola Reservasi')
@section('page-title', 'Kelola Reservasi')
@section('page-subtitle', 'Kelola dan pantau seluruh reservasi PermataTruf.Id.')

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
           GLASS EFFECT
        ========================================================= */

        .glass {
            background: rgba(255, 255, 255, 0.48);
            border: 1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 18px 45px rgba(39, 83, 66, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
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

            border-color: rgba(255, 255, 255, 0.72);

            color: #16875a;

            transform: translateX(2px);

            box-shadow:
                0 8px 20px rgba(39, 83, 66, 0.06);
        }

        .menu a.active {
            background: rgba(255, 255, 255, 0.68);

            border: 1px solid rgba(255, 255, 255, 0.88);

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

            background: rgba(218, 244, 229, 0.58);

            border: 1px solid rgba(255, 255, 255, 0.78);

            font-size: 15px;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.60);
        }

        /* =========================================================
           LOGOUT
           TEPAT DI BAWAH MONITOR AUTO-CANCEL
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

        /* =========================================================
           ADMIN PROFILE
        ========================================================= */

        .admin-profile {
            display: flex;

            align-items: center;

            gap: 11px;

            padding: 8px 13px;

            border-radius: 16px;

            background: rgba(255, 255, 255, 0.44);

            border: 1px solid rgba(255, 255, 255, 0.70);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
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

        /* =========================================================
           CONTENT
        ========================================================= */

        .content {
            padding: 25px 0 35px;
        }

        /* =========================================================
           WELCOME CARD
        ========================================================= */

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

        /* =========================================================
           SUCCESS ALERT
        ========================================================= */

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

            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }

        /* =========================================================
           RESERVASI PANEL
        ========================================================= */

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

        /* =========================================================
           TABLE
        ========================================================= */

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }

        table {
            width: 100%;

            min-width: 850px;

            border-collapse: collapse;
        }

        th {
            padding: 14px 22px;

            text-align: left;

            font-size: 10px;

            color: #899a92;

            text-transform: uppercase;

            letter-spacing: 0.8px;

            background: rgba(240, 249, 245, 0.40);
        }

        td {
            padding: 17px 22px;

            border-top:
                1px solid rgba(255, 255, 255, 0.62);

            font-size: 13px;

            color: #43574d;

            background: rgba(255, 255, 255, 0.08);
        }

        tbody tr {
            transition:
                background 0.2s ease,
                transform 0.2s ease;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.30);
        }

        .user-name {
            font-weight: 800;

            color: #30443a;
        }

        .user-id {
            margin-top: 3px;

            font-size: 11px;

            color: #96a49e;
        }

        .field-name {
            font-weight: 700;

            color: #42574c;
        }

        /* =========================================================
           STATUS BADGE
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
            background: rgba(255, 246, 213, 0.68);

            color: #98751b;
        }

        .status-confirmed {
            background: rgba(216, 244, 227, 0.68);

            color: #16875a;
        }

        .status-other {
            background: rgba(237, 242, 240, 0.65);

            color: #697a72;
        }

        /* =========================================================
           STATUS FORM
        ========================================================= */

        .status-form {
            display: flex;

            align-items: center;

            gap: 8px;
        }

        .status-select {
            min-width: 175px;

            padding: 9px 11px;

            border-radius: 12px;

            border:
                1px solid rgba(255, 255, 255, 0.82);

            background:
                rgba(255, 255, 255, 0.58);

            color: #4c6056;

            font-size: 11px;

            outline: none;

            cursor: pointer;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.60);
        }

        .status-select:focus {
            border-color:
                rgba(102, 177, 133, 0.45);

            box-shadow:
                0 0 0 3px rgba(102, 177, 133, 0.08);
        }

        /* =========================================================
           BUTTON SIMPAN
        ========================================================= */

        .btn-save {
            padding: 9px 14px;

            border-radius: 12px;

            border:
                1px solid rgba(255, 255, 255, 0.80);

            background:
                rgba(255, 255, 255, 0.58);

            color: #16875a;

            font-size: 11px;

            font-weight: 800;

            cursor: pointer;

            transition:
                background 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .btn-save:hover {
            background:
                rgba(218, 244, 229, 0.72);

            transform: translateY(-1px);

            box-shadow:
                0 7px 18px rgba(39, 83, 66, 0.08);
        }

        /* =========================================================
           EMPTY DATA
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
                margin-top: 10px;
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

            .welcome-card {
                padding: 24px 20px;
            }

            .welcome-card h2 {
                font-size: 21px;
            }

            .panel-header {
                padding: 20px;
            }

            .status-form {
                flex-direction: column;

                align-items: stretch;
            }

            .status-select {
                width: 100%;
            }

            .btn-save {
                width: 100%;
            }
        }
    
</style>
@endpush

@section('content')
{{-- TOPBAR --}}
        


        {{-- =================================================
             CONTENT
        ================================================== --}}

        <section class="content">

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))

                <div class="alert-success">

                    ✓ {{ session('success') }}

                </div>

            @endif


            {{-- =================================================
                 RESERVATION PANEL
            ================================================== --}}

            <div class="panel">


                {{-- PANEL HEADER --}}
                <div class="panel-header">

                    <h2 class="panel-title">
                        Daftar Reservasi
                    </h2>

                    <p class="panel-description">
                        Seluruh reservasi yang terdaftar pada sistem.
                    </p>

                </div>


                {{-- TABLE --}}
                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    User
                                </th>

                                <th>
                                    Lapangan
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Kelola Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($reservasi as $item)

                                <tr>

                                    {{-- ID --}}
                                    <td>
                                        #{{ $item->id }}
                                    </td>


                                    {{-- USER --}}
                                    <td>

                                        <div class="user-name">
                                            {{ $item->user->name ?? '-' }}
                                        </div>

                                        <div class="user-id">
                                            User ID:
                                            {{ $item->user_id ?? '-' }}
                                        </div>

                                    </td>


                                    {{-- LAPANGAN --}}
                                    <td>

                                        <div class="field-name">
                                            {{ $item->lapangan->nama ?? '-' }}
                                        </div>

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

                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- KELOLA STATUS --}}
                                    <td>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.reservasi.updateStatus', $item) }}"
                                            class="status-form"
                                        >

                                            @csrf

                                            @method('PUT')


                                            <select
                                                name="status"
                                                class="status-select"
                                            >

                                                <option
                                                    value="menunggu_verifikasi"
                                                    {{ $item->status === 'menunggu_verifikasi' ? 'selected' : '' }}
                                                >
                                                    Menunggu Verifikasi
                                                </option>


                                                <option
                                                    value="dikonfirmasi"
                                                    {{ $item->status === 'dikonfirmasi' ? 'selected' : '' }}
                                                >
                                                    Dikonfirmasi
                                                </option>

                                            </select>


                                            <button
                                                type="submit"
                                                class="btn-save"
                                            >
                                                Simpan
                                            </button>

                                        </form>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="empty"
                                    >

                                        <div class="empty-icon">
                                            📋
                                        </div>

                                        Belum ada reservasi.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>
@endsection

