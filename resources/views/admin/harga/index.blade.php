@extends('admin.layout')

@section('title', 'Kelola Harga')
@section('page-title', 'Kelola Harga')
@section('page-subtitle', 'Kelola dan perbarui harga sewa setiap lapangan.')

@push('styles')
<style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            font-family: "Instrument Sans", Arial, sans-serif;
            background:
                radial-gradient(
                    circle at top left,
                    rgba(211, 239, 220, 0.85),
                    transparent 34%
                ),
                radial-gradient(
                    circle at bottom right,
                    rgba(194, 231, 211, 0.75),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #f7fbf8 0%,
                    #edf7f0 48%,
                    #f8fcf9 100%
                );
            color: #26382f;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input {
            font: inherit;
        }

        /* =====================================================
           LAYOUT
        ===================================================== */

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 250px;
            min-height: 100vh;
            padding: 24px 16px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;

            background:
                linear-gradient(
                    180deg,
                    rgba(235, 248, 239, 0.94),
                    rgba(218, 240, 225, 0.88)
                );

            border-right: 1px solid rgba(255, 255, 255, 0.85);

            box-shadow:
                8px 0 30px rgba(43, 92, 73, 0.07);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 4px 9px 25px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            object-fit: contain;

            background: rgba(255, 255, 255, 0.70);

            border: 1px solid rgba(255, 255, 255, 0.90);

            box-shadow:
                0 7px 18px rgba(43, 92, 73, 0.10);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .brand-title {
            font-size: 17px;
            font-weight: 800;
            color: #173d2d;
        }

        .brand-subtitle {
            margin-top: 4px;
            font-size: 11px;
            color: #6d8779;
            font-weight: 600;
        }

        /* =====================================================
           MENU
        ===================================================== */

        .menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .menu-title {
            padding: 0 11px;
            margin: 8px 0 9px;

            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.3px;
            text-transform: uppercase;

            color: #7b9385;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 46px;
            padding: 0 13px;

            border-radius: 15px;

            color: #587064;

            font-size: 13px;
            font-weight: 650;

            transition: 0.22s ease;
        }

        .menu-item:hover {
            color: #0d6845;

            background:
                rgba(255, 255, 255, 0.54);

            transform: translateX(2px);
        }

        .menu-item.active {
            color: #0d6845;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.86),
                    rgba(215, 241, 224, 0.72)
                );

            border: 1px solid rgba(255, 255, 255, 0.86);

            box-shadow:
                0 8px 22px rgba(43, 92, 73, 0.09),
                inset 0 1px 0 rgba(255, 255, 255, 0.90);
        }

        .menu-icon {
            width: 31px;
            height: 31px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background:
                rgba(255, 255, 255, 0.54);

            border: 1px solid rgba(255, 255, 255, 0.75);

            font-size: 15px;
        }

        .menu-item.active .menu-icon {
            background:
                rgba(207, 239, 219, 0.82);

            border-color:
                rgba(255, 255, 255, 0.90);
        }

        /* =====================================================
           SIDEBAR BOTTOM
        ===================================================== */

        .sidebar-bottom {
            margin-top: 14px;
            padding-top: 14px;

            border-top:
                1px solid rgba(255, 255, 255, 0.72);
        }

        .logout-button {
            width: 100%;

            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 46px;
            padding: 0 13px;

            border: 0;
            border-radius: 15px;

            background: transparent;

            color: #687f73;

            font-size: 13px;
            font-weight: 650;

            cursor: pointer;

            transition: 0.22s ease;
        }

        .logout-button:hover {
            color: #a53d3d;

            background:
                rgba(255, 255, 255, 0.52);
        }

        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main-content {
            width: calc(100% - 250px);
            margin-left: 250px;

            min-height: 100vh;

            padding: 24px 30px 36px;
        }

        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;

            min-height: 64px;
            margin-bottom: 26px;

            padding: 0 4px;
        }

        .page-heading {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .page-heading h1 {
            font-size: 26px;
            line-height: 1.2;
            font-weight: 800;

            color: #183d2d;
        }

        .page-heading p {
            font-size: 13px;
            color: #71877b;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 11px;

            padding: 7px 9px 7px 12px;

            border-radius: 18px;

            background:
                rgba(255, 255, 255, 0.54);

            border:
                1px solid rgba(255, 255, 255, 0.82);

            box-shadow:
                0 7px 22px rgba(43, 92, 73, 0.07);

            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .admin-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end;

            line-height: 1.15;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 800;
            color: #2a4035;
        }

        .admin-role {
            margin-top: 4px;
            font-size: 10px;
            color: #7c9186;
        }

        .admin-avatar {
            width: 39px;
            height: 39px;

            border-radius: 50%;

            object-fit: cover;

            border:
                2px solid rgba(255, 255, 255, 0.92);

            box-shadow:
                0 5px 14px rgba(43, 92, 73, 0.10);
        }

        /* =====================================================
           CONTENT CARD
        ===================================================== */

        .content-card {
            width: 100%;

            padding: 25px;

            border-radius: 24px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.76),
                    rgba(239, 249, 242, 0.67)
                );

            border:
                1px solid rgba(255, 255, 255, 0.88);

            box-shadow:
                0 15px 40px rgba(43, 92, 73, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.94);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 22px;
        }

        .card-title-area {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .card-title {
            font-size: 17px;
            font-weight: 800;
            color: #264436;
        }

        .card-description {
            font-size: 12px;
            color: #789084;
        }

        /* =====================================================
           SUCCESS MESSAGE
        ===================================================== */

        .alert-success {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 20px;
            padding: 13px 16px;

            border-radius: 14px;

            background:
                rgba(216, 245, 226, 0.78);

            border:
                1px solid rgba(114, 190, 141, 0.28);

            color: #28704b;

            font-size: 13px;
            font-weight: 650;
        }

        .alert-icon {
            width: 25px;
            height: 25px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.62);

            color: #16875a;

            font-weight: 800;
        }

        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;

            border-radius: 18px;

            border:
                1px solid rgba(255, 255, 255, 0.82);

            background:
                rgba(255, 255, 255, 0.34);
        }

        table {
            width: 100%;
            min-width: 700px;

            border-collapse: collapse;
        }

        thead {
            background:
                rgba(218, 239, 225, 0.54);
        }

        th {
            padding: 15px 17px;

            text-align: left;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 0.35px;

            color: #5d7568;

            border-bottom:
                1px solid rgba(183, 214, 194, 0.48);
        }

        td {
            padding: 17px;

            font-size: 13px;
            color: #40594c;

            border-bottom:
                1px solid rgba(211, 229, 217, 0.55);
        }

        tbody tr {
            transition: 0.2s ease;
        }

        tbody tr:hover {
            background:
                rgba(255, 255, 255, 0.46);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* =====================================================
           FIELD NAME
        ===================================================== */

        .field-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .field-image {
            width: 48px;
            height: 48px;

            border-radius: 13px;

            object-fit: cover;

            background:
                rgba(221, 239, 226, 0.75);

            border:
                1px solid rgba(255, 255, 255, 0.85);

            box-shadow:
                0 5px 12px rgba(43, 92, 73, 0.08);
        }

        .field-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .field-name {
            font-size: 13px;
            font-weight: 800;
            color: #294637;
        }

        .field-label {
            font-size: 10px;
            color: #82958b;
        }

        /* =====================================================
           PRICE
        ===================================================== */

        .price {
            font-size: 14px;
            font-weight: 800;
            color: #16875a;
        }

        .price-unit {
            margin-left: 3px;

            font-size: 11px;
            font-weight: 600;

            color: #82958b;
        }

        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 11px;

            border-radius: 999px;

            font-size: 10px;
            font-weight: 750;
        }

        .status::before {
            content: "";

            width: 6px;
            height: 6px;

            border-radius: 50%;
        }

        .status-active {
            color: #28704b;

            background:
                rgba(213, 241, 222, 0.72);
        }

        .status-active::before {
            background: #35a86e;
        }

        .status-inactive {
            color: #956060;

            background:
                rgba(249, 225, 225, 0.68);
        }

        .status-inactive::before {
            background: #c96b6b;
        }

        /* =====================================================
           ACTION BUTTON
        ===================================================== */

        .edit-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 38px;
            padding: 0 14px;

            border-radius: 12px;

            color: #28704b;

            font-size: 11px;
            font-weight: 750;

            background:
                rgba(222, 243, 229, 0.68);

            border:
                1px solid rgba(255, 255, 255, 0.86);

            box-shadow:
                0 5px 14px rgba(43, 92, 73, 0.06);

            transition: 0.22s ease;
        }

        .edit-button:hover {
            color: #0d6845;

            transform: translateY(-2px);

            background:
                rgba(214, 241, 223, 0.90);

            box-shadow:
                0 10px 20px rgba(43, 92, 73, 0.10);
        }

        .edit-icon {
            font-size: 13px;
        }

        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty-state {
            padding: 55px 20px;

            text-align: center;
        }

        .empty-icon {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 15px;

            border-radius: 18px;

            background:
                rgba(220, 241, 227, 0.72);

            border:
                1px solid rgba(255, 255, 255, 0.85);

            font-size: 25px;
        }

        .empty-title {
            font-size: 16px;
            font-weight: 800;
            color: #365344;
        }

        .empty-text {
            max-width: 420px;

            margin: 7px auto 0;

            font-size: 12px;
            line-height: 1.6;

            color: #81948a;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .sidebar {
                width: 220px;
            }

            .main-content {
                width: calc(100% - 220px);
                margin-left: 220px;

                padding: 22px;
            }
        }

        @media (max-width: 700px) {

            .admin-wrapper {
                display: block;
            }

            .sidebar {
                position: relative;

                width: 100%;
                min-height: auto;

                padding: 18px;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .menu-title {
                grid-column: 1 / -1;
            }

            .sidebar-bottom {
                margin-top: 12px;
            }

            .main-content {
                width: 100%;
                margin-left: 0;

                padding: 20px 16px 30px;
            }

            .topbar {
                align-items: flex-start;
            }

            .admin-info {
                display: none;
            }

            .content-card {
                padding: 18px;
            }
        }

        @media (max-width: 500px) {

            .menu {
                grid-template-columns: 1fr;
            }

            .page-heading h1 {
                font-size: 22px;
            }

            .page-heading p {
                max-width: 240px;
                line-height: 1.5;
            }
        }
    
</style>
@endpush

@section('content')
{{-- TOPBAR --}}

        


        {{-- CONTENT CARD --}}

        <section class="content-card">


            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div class="alert-success">

                    <span class="alert-icon">
                        ✓
                    </span>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- CARD HEADER --}}

            <div class="card-header">

                <div class="card-title-area">

                    <div class="card-title">
                        Daftar Harga Lapangan
                    </div>

                    <div class="card-description">
                        Harga sewa yang digunakan pada proses reservasi.
                    </div>

                </div>

            </div>


            {{-- TABLE --}}

            @if($lapangans->count() > 0)

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Lapangan
                                </th>

                                <th>
                                    Harga Per Jam
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

                            @foreach($lapangans as $lapangan)

                                <tr>

                                    {{-- LAPANGAN --}}

                                    <td>

                                        <div class="field-cell">

                                            @if($lapangan->gambar)

                                                <img
                                                    src="{{ asset('images/' . basename($lapangan->gambar)) }}"
                                                    alt="{{ $lapangan->nama }}"
                                                    class="field-image"
                                                >

                                            @else

                                                <div class="field-image"
                                                    style="
                                                        display:flex;
                                                        align-items:center;
                                                        justify-content:center;
                                                        font-size:20px;
                                                    "
                                                >
                                                    ⚽
                                                </div>

                                            @endif


                                            <div class="field-details">

                                                <div class="field-name">
                                                    {{ $lapangan->nama }}
                                                </div>

                                                <div class="field-label">
                                                    Lapangan Mini Soccer
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- HARGA --}}

                                    <td>

                                        <span class="price">
                                            Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                        </span>

                                        <span class="price-unit">
                                            / jam
                                        </span>

                                    </td>


                                    {{-- STATUS --}}

                                    <td>

                                        @if($lapangan->status === 'aktif')

                                            <span class="status status-active">
                                                Aktif
                                            </span>

                                        @else

                                            <span class="status status-inactive">
                                                Nonaktif
                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}

                                    <td>

                                        <a
                                            href="{{ route('admin.harga.edit', $lapangan) }}"
                                            class="edit-button"
                                        >

                                            <span class="edit-icon">
                                                ✎
                                            </span>

                                            <span>
                                                Edit Harga
                                            </span>

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- EMPTY STATE --}}

                <div class="empty-state">

                    <div class="empty-icon">
                        💰
                    </div>

                    <div class="empty-title">
                        Belum Ada Data Lapangan
                    </div>

                    <div class="empty-text">
                        Belum terdapat data lapangan yang dapat dikelola harganya.
                        Silakan tambahkan lapangan terlebih dahulu melalui menu
                        Kelola Lapangan.
                    </div>

                </div>

            @endif

        </section>
@endsection

