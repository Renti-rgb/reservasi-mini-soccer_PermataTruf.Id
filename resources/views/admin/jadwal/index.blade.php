@extends('admin.layout')

@section('title', 'Kelola Jadwal')
@section('page-title', 'Kelola Jadwal')
@section('page-subtitle', 'Atur jadwal bermain untuk setiap lapangan PermataTruf.Id.')

@push('styles')
<style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: #17352b;
            background:
                radial-gradient(circle at top left, rgba(52, 211, 153, 0.25), transparent 32%),
                radial-gradient(circle at bottom right, rgba(16, 185, 129, 0.20), transparent 30%),
                linear-gradient(135deg, #effff8 0%, #e7f8f0 50%, #f4fffb 100%);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input,
        select {
            font: inherit;
        }

        /* ====================================================
           ADMIN WRAPPER
        ==================================================== */

        .admin-wrapper {
            display: flex;
            gap: 22px;
            min-height: 100vh;
            padding: 16px;
        }

        /* ====================================================
           SIDEBAR
        ==================================================== */

        .sidebar {
            position: fixed;
            top: 16px;
            left: 16px;
            bottom: 16px;

            width: 285px;

            padding: 22px 18px;

            border: 1px solid rgba(255, 255, 255, 0.70);
            border-radius: 28px;

            background: rgba(255, 255, 255, 0.72);

            box-shadow:
                0 20px 45px rgba(32, 91, 67, 0.12),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            overflow-y: auto;
            z-index: 20;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 4px 8px 22px;
        }

        .brand-logo {
            width: 48px;
            height: 48px;

            object-fit: cover;

            border-radius: 14px;

            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.18);
        }

        .brand-text {
            font-size: 20px;
            font-weight: 800;
            color: #163d30;
            letter-spacing: -0.4px;
        }

        .brand-text span {
            color: #19a974;
        }

        .admin-label {
            padding: 0 8px 18px;

            font-size: 12px;
            font-weight: 700;

            color: #6c8178;

            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 48px;

            padding: 10px 13px;

            border: 1px solid transparent;
            border-radius: 15px;

            color: #4e665d;

            font-size: 14px;
            font-weight: 600;

            transition: all 0.2s ease;
        }

        .menu a:hover {
            background: rgba(25, 169, 116, 0.08);
            color: #16865d;
            transform: translateX(2px);
        }

        .menu a.active {
            background: linear-gradient(
                135deg,
                rgba(25, 169, 116, 0.16),
                rgba(25, 169, 116, 0.08)
            );

            border-color: rgba(25, 169, 116, 0.18);

            color: #128257;

            box-shadow: 0 7px 18px rgba(25, 169, 116, 0.08);
        }

        .menu-icon {
            width: 27px;
            min-width: 27px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
        }

        .logout-area {
            margin-top: 18px;
            padding-top: 16px;

            border-top: 1px solid rgba(93, 124, 111, 0.12);
        }

        .logout-button {
            width: 100%;

            display: flex;
            align-items: center;
            gap: 12px;

            padding: 11px 13px;

            border: none;
            border-radius: 15px;

            background: transparent;

            color: #b34c4c;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        .logout-button:hover {
            background: rgba(179, 76, 76, 0.08);
        }

        /* ====================================================
           MAIN CONTENT
        ==================================================== */

        .main-content {
            width: calc(100% - 307px);
            margin-left: 307px;

            padding: 4px 4px 24px;
        }

        /* ====================================================
           TOPBAR
        ==================================================== */

        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 20px;
            padding: 22px 24px;

            border: 1px solid rgba(255, 255, 255, 0.75);
            border-radius: 25px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.78),
                    rgba(238, 255, 248, 0.72)
                );

            box-shadow:
                0 18px 38px rgba(32, 91, 67, 0.09),
                inset 0 1px 0 rgba(255, 255, 255, 0.80);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .topbar-title h1 {
            margin: 0 0 8px;

            font-size: 25px;
            line-height: 1.2;

            color: #173c30;
        }

        .topbar-title p {
            margin: 0 0 6px;

            max-width: 720px;

            color: #71847d;

            font-size: 13px;
            line-height: 1.7;
        }

        .topbar-title p:last-child {
            margin-bottom: 0;
        }

        .topbar-title .topbar-desc {
            color: #6d8078;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 11px;

            padding: 7px 10px 7px 7px;

            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 18px;

            background: rgba(255, 255, 255, 0.55);

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            flex-shrink: 0;
        }

        .admin-profile img {
            width: 42px;
            height: 42px;

            object-fit: cover;

            border-radius: 50%;

            border: 2px solid rgba(25, 169, 116, 0.18);
        }

        .admin-profile-info {
            line-height: 1.2;
        }

        .admin-profile-info strong {
            display: block;

            font-size: 13px;
            color: #23483a;
        }

        .admin-profile-info span {
            display: block;

            margin-top: 3px;

            font-size: 11px;
            color: #7b8c85;
        }

        /* ====================================================
           ALERT
        ==================================================== */

        .alert-success {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 20px;
            padding: 13px 16px;

            border: 1px solid rgba(25, 169, 116, 0.18);
            border-radius: 15px;

            background: rgba(220, 252, 231, 0.55);

            color: #16734f;

            font-size: 13px;
            font-weight: 600;

            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* ====================================================
           SECTION HEADER
        ==================================================== */

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 15px;
        }

        .section-title h3 {
            margin: 0 0 4px;

            font-size: 18px;
            color: #1d4034;
        }

        .section-title p {
            margin: 0;

            font-size: 12px;
            color: #7b8d86;
        }

        /* ====================================================
   ADD BUTTON — GLASSMORPHISM
==================================================== */

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
    transform: translateY(-3px);
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

        /* ====================================================
           TABLE PANEL
        ==================================================== */

        .table-panel {
            overflow: hidden;

            border: 1px solid rgba(255, 255, 255, 0.75);
            border-radius: 24px;

            background: rgba(255, 255, 255, 0.65);

            box-shadow:
                0 18px 40px rgba(32, 91, 67, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;

            border-collapse: collapse;
        }

        thead {
            background: rgba(235, 249, 242, 0.55);

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        th {
            padding: 15px 17px;

            border-bottom: 1px solid rgba(90, 122, 108, 0.10);

            color: #60766c;

            font-size: 11px;
            font-weight: 800;

            text-align: left;

            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 17px;

            border-bottom: 1px solid rgba(90, 122, 108, 0.08);

            color: #4f665c;

            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: rgba(25, 169, 116, 0.05);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .id-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 35px;
            height: 30px;

            padding: 0 8px;

            border: 1px solid rgba(25, 169, 116, 0.18);
            border-radius: 10px;

            background: rgba(255, 255, 255, 0.50);

            color: #14865e;

            font-size: 12px;
            font-weight: 800;

            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .field-name {
            font-weight: 700;
            color: #244c3d;
        }

        .date-text {
            font-weight: 600;
            color: #385a4d;
        }

        .time-wrapper {
            display: flex;
            align-items: center;
            gap: 7px;

            white-space: nowrap;
        }

        .time-badge {
            display: inline-flex;
            align-items: center;

            padding: 7px 9px;

            border: 1px solid rgba(90, 122, 108, 0.14);
            border-radius: 9px;

            background: rgba(255, 255, 255, 0.55);

            color: #466158;

            font-size: 12px;
            font-weight: 700;

            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .time-separator {
            color: #8da097;
            font-size: 12px;
        }

        /* ====================================================
           STATUS
        ==================================================== */

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 10px;

            border-radius: 999px;

            font-size: 11px;
            font-weight: 800;

            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .status-badge::before {
            content: "";

            width: 6px;
            height: 6px;

            border-radius: 50%;
        }

        .status-tersedia {
            border: 1px solid rgba(25, 169, 116, 0.22);
            background: rgba(220, 252, 231, 0.55);
            color: #16804f;
        }

        .status-tersedia::before {
            background: #20a965;
        }

        .status-terisi {
            border: 1px solid rgba(220, 91, 91, 0.22);
            background: rgba(254, 226, 226, 0.55);
            color: #b44747;
        }

        .status-terisi::before {
            background: #dc5b5b;
        }

        /* ====================================================
           ACTION
        ==================================================== */

        .action-wrapper {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 35px;
            height: 34px;

            padding: 0 10px;

            border-radius: 10px;

            font-size: 11px;
            font-weight: 700;

            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);

            transition: all 0.2s ease;
        }

        .action-view {
            border: 1px solid rgba(59, 130, 246, 0.18);
            background: rgba(59, 130, 246, 0.08);
            color: #3975bb;
        }

        .action-view:hover {
            background: rgba(59, 130, 246, 0.16);
        }

        .action-edit {
            border: 1px solid rgba(25, 169, 116, 0.20);
            background: rgba(25, 169, 116, 0.09);
            color: #16875f;
        }

        .action-edit:hover {
            background: rgba(25, 169, 116, 0.17);
        }

        .action-delete {
            border: 1px solid rgba(239, 68, 68, 0.18);

            background: rgba(239, 68, 68, 0.08);
            color: #bd5050;

            cursor: pointer;
        }

        .action-delete:hover {
            background: rgba(239, 68, 68, 0.16);
        }

        /* ====================================================
           EMPTY STATE
        ==================================================== */

        .empty-state {
            padding: 55px 25px;

            text-align: center;
        }

        .empty-icon {
            width: 65px;
            height: 65px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 15px;

            border: 1px solid rgba(25, 169, 116, 0.18);
            border-radius: 20px;

            background: rgba(25, 169, 116, 0.08);

            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);

            font-size: 28px;
        }

        .empty-state h4 {
            margin: 0 0 7px;

            font-size: 16px;
            color: #345548;
        }

        .empty-state p {
            margin: 0;

            font-size: 12px;
            color: #81918a;
        }

        /* ====================================================
           FOOTER INFO
        ==================================================== */

        .page-info {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 15px;
            padding: 12px 18px;

            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 16px;

            background: rgba(255, 255, 255, 0.45);

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            color: #84948d;
            font-size: 11px;
        }

        /* ====================================================
           RESPONSIVE
        ==================================================== */

        @media (max-width: 1100px) {

            .sidebar {
                width: 245px;
            }

            .main-content {
                width: calc(100% - 267px);
                margin-left: 267px;
            }

            .menu a {
                font-size: 13px;
            }
        }

        @media (max-width: 900px) {

            .admin-wrapper {
                display: block;
            }

            .sidebar {
                position: relative;

                top: auto;
                left: auto;
                bottom: auto;

                width: 100%;

                margin-bottom: 18px;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .logout-area {
                margin-top: 15px;
            }

            .main-content {
                width: 100%;
                margin-left: 0;
            }
        }

        @media (max-width: 600px) {

            .admin-wrapper {
                padding: 10px;
            }

            .sidebar {
                border-radius: 22px;
                padding: 17px 14px;
            }

            .menu {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                padding: 17px;
            }

            .admin-profile {
                width: 100%;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .add-button {
                width: 100%;
            }

            .page-info {
                flex-direction: column;
                gap: 5px;
                align-items: flex-start;
            }
        }
    
</style>
@endpush

@section('content')
<!-- ====================================================
             TOPBAR (judul + deskripsi digabung di sini)
        ==================================================== -->

        


        <!-- ====================================================
             SUCCESS ALERT
        ==================================================== -->

        @if(session('success'))

            <div class="alert-success">

                <span>
                    ✓
                </span>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        <!-- ====================================================
             SECTION HEADER
        ==================================================== -->

        <div class="section-header">

            <div class="section-title">

                <h3>
                    Daftar Jadwal
                </h3>

                <p>
                    Seluruh jadwal bermain yang tersedia pada sistem.
                </p>

            </div>

            <a
    href="{{ route('admin.jadwal.create') }}"
    class="add-button"
>
    <span class="add-icon">
        +
    </span>
    <span>
        Tambah Jadwal
    </span>
</a>

        </div>


        <!-- ====================================================
             TABLE
        ==================================================== -->

        <div class="table-panel">

            @if($jadwals->count() > 0)

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Lapangan
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Jam
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

                            @foreach($jadwals as $jadwal)

                                <tr>

                                    <!-- ID -->

                                    <td>

                                        <span class="id-badge">
                                            #{{ $jadwal->id }}
                                        </span>

                                    </td>


                                    <!-- LAPANGAN -->

                                    <td>

                                        <span class="field-name">

                                            {{ $jadwal->lapangan->nama ?? 'Lapangan tidak ditemukan' }}

                                        </span>

                                    </td>


                                    <!-- TANGGAL -->

                                    <td>

                                        <span class="date-text">

                                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}

                                        </span>

                                    </td>


                                    <!-- JAM -->

                                    <td>

                                        <div class="time-wrapper">

                                            <span class="time-badge">

                                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}

                                            </span>

                                            <span class="time-separator">
                                                -
                                            </span>

                                            <span class="time-badge">

                                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}

                                            </span>

                                        </div>

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        @if($jadwal->status === 'tersedia')

                                            <span class="status-badge status-tersedia">
                                                Tersedia
                                            </span>

                                        @else

                                            <span class="status-badge status-terisi">
                                                Terisi
                                            </span>

                                        @endif

                                    </td>


                                    <!-- AKSI -->

                                    <td>

                                        <div class="action-wrapper">

                                            <a
                                                href="{{ route('admin.jadwal.show', $jadwal->id) }}"
                                                class="action-button action-view"
                                            >
                                                Lihat
                                            </a>

                                            <a
                                                href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                                                class="action-button action-edit"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('admin.jadwal.destroy', $jadwal->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-button action-delete"
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <!-- ====================================================
                     EMPTY STATE
                ==================================================== -->

                <div class="empty-state">

                    <div class="empty-icon">
                        🗓
                    </div>

                    <h4>
                        Belum Ada Jadwal
                    </h4>

                    <p>
                        Belum terdapat jadwal bermain.
                        Silakan tambahkan jadwal baru.
                    </p>

                </div>

            @endif

        </div>


        <!-- ====================================================
             PAGE INFO
        ==================================================== -->

        <div class="page-info">

            <span>
                Total jadwal:
                <strong>{{ $jadwals->count() }}</strong>
            </span>

            <span>
                PermataTruf.Id © 2026
            </span>

        </div>
@endsection

