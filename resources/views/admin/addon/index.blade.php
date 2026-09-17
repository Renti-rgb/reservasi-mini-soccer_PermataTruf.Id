@extends('admin.layout')

@section('title', 'Kelola Add-on')
@section('page-title', 'Kelola Add-on')
@section('page-subtitle', 'Kelola layanan tambahan yang dapat dipilih saat melakukan reservasi.')

@push('styles')
<style>

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: "Instrument Sans", Arial, sans-serif;
        background:
            radial-gradient(
                circle at top left,
                rgba(214, 242, 226, 0.85),
                transparent 32%
            ),
            linear-gradient(
                135deg,
                #f4faf6 0%,
                #eef7f1 48%,
                #f8fbf9 100%
            );
        color: #26382f;
    }

    .admin-wrapper {
        min-height: 100vh;
        display: flex;
        background:
            radial-gradient(
                circle at 10% 10%,
                rgba(182, 224, 199, 0.20),
                transparent 28%
            ),
            linear-gradient(
                135deg,
                #f4faf6,
                #edf7f1,
                #f8fbf9
            );
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .sidebar {
        width: 260px;
        min-height: 100vh;
        padding: 28px 18px 22px;
        background:
            linear-gradient(
                180deg,
                rgba(255, 255, 255, 0.78),
                rgba(235, 247, 239, 0.76)
            );
        border-right: 1px solid rgba(255, 255, 255, 0.85);
        box-shadow:
            10px 0 35px rgba(46, 91, 70, 0.07);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        display: flex;
        flex-direction: column;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 6px 12px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.70);
    }

    .brand-logo {
        width: 42px;
        height: 42px;
        object-fit: contain;
        border-radius: 12px;
    }

    .brand-name {
        font-size: 19px;
        font-weight: 800;
        color: #164b35;
        letter-spacing: -0.4px;
    }

    .menu {
        margin-top: 25px;
        display: flex;
        flex-direction: column;
        gap: 7px;
        flex: 0 0 auto;
    }

    .menu-title {
        padding: 0 13px 8px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.1px;
        color: #8b9c92;
    }

    .menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        min-height: 46px;
        padding: 0 13px;
        border-radius: 13px;
        text-decoration: none;
        color: #53645b;
        font-size: 13px;
        font-weight: 650;
        transition: 0.25s ease;
    }

    .menu a:hover {
        color: #0e6d48;
        background:
            rgba(255, 255, 255, 0.70);
        transform: translateX(2px);
    }

    .menu a.active {
        color: #0c7048;
        background:
            linear-gradient(
                135deg,
                rgba(220, 245, 230, 0.90),
                rgba(255, 255, 255, 0.78)
            );
        border: 1px solid rgba(255, 255, 255, 0.82);
        box-shadow:
            0 7px 20px rgba(44, 103, 77, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.85);
    }

    .menu-icon {
        width: 28px;
        height: 28px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: rgba(216, 241, 226, 0.72);
        border: 1px solid rgba(255, 255, 255, 0.80);
        font-size: 15px;
    }

    .sidebar-bottom {
        margin-top: 10px;
        padding-top: 12px;
        border-top: 1px solid rgba(255, 255, 255, 0.60);
        flex: 0 0 auto;
    }

    .logout-button {
        width: 100%;
        border: 0;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        min-height: 44px;
        padding: 0 13px;
        border-radius: 13px;
        color: #68786f;
        font-size: 13px;
        font-weight: 650;
        transition: 0.25s ease;
    }

    .logout-button:hover {
        background: rgba(255, 255, 255, 0.70);
        color: #b34c4c;
    }

    /* =========================================================
       MAIN
    ========================================================= */

    .main-content {
        flex: 1;
        min-width: 0;
        padding: 25px 30px 30px;
    }

    .topbar {
        min-height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
        padding: 15px 20px;
        border-radius: 20px;
        background:
            linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.78),
                rgba(240, 249, 244, 0.68)
            );
        border: 1px solid rgba(255, 255, 255, 0.82);
        box-shadow:
            0 12px 35px rgba(45, 92, 70, 0.07);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .page-heading {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .breadcrumb {
        font-size: 12px;
        color: #8a9991;
    }

    .breadcrumb span {
        color: #4d6659;
        font-weight: 700;
    }

    .page-title {
        margin: 0;
        font-size: 24px;
        font-weight: 800;
        color: #183d2d;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        margin: 0;
        font-size: 13px;
        color: #78877f;
    }

    .admin-profile {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 5px 8px 5px 6px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.62);
        border: 1px solid rgba(255, 255, 255, 0.82);
    }

    .admin-profile img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.90);
    }

    .admin-name {
        font-size: 13px;
        font-weight: 800;
        color: #315144;
    }

    /* =========================================================
       PAGE ACTION
    ========================================================= */

    .page-actions {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

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

    /* =========================================================
       SUMMARY CARDS
    ========================================================= */

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .summary-card {
        padding: 20px;
        border-radius: 18px;
        background:
            linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.76),
                rgba(239, 249, 243, 0.66)
            );
        border: 1px solid rgba(255, 255, 255, 0.82);
        box-shadow:
            0 10px 28px rgba(45, 92, 70, 0.06);
        backdrop-filter: blur(17px);
        -webkit-backdrop-filter: blur(17px);
    }

    .summary-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .summary-label {
        font-size: 12px;
        font-weight: 700;
        color: #7b8c83;
    }

    .summary-icon {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: rgba(214, 241, 225, 0.72);
        border: 1px solid rgba(255, 255, 255, 0.82);
        font-size: 16px;
    }

    .summary-value {
        margin-top: 9px;
        font-size: 27px;
        font-weight: 850;
        color: #173f2e;
        line-height: 1;
    }

    .summary-description {
        margin-top: 7px;
        font-size: 11px;
        color: #89978f;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .alert-success {
        margin-bottom: 18px;
        padding: 13px 16px;
        border-radius: 14px;
        background:
            rgba(215, 243, 225, 0.72);
        border: 1px solid rgba(164, 216, 181, 0.55);
        color: #246342;
        font-size: 13px;
        font-weight: 650;
    }

    /* =========================================================
       TABLE CARD
    ========================================================= */

    .table-card {
        overflow: hidden;
        border-radius: 21px;
        background:
            linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.80),
                rgba(239, 248, 243, 0.72)
            );
        border: 1px solid rgba(255, 255, 255, 0.86);
        box-shadow:
            0 15px 40px rgba(45, 92, 70, 0.08);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .table-header {
        padding: 20px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-bottom: 1px solid rgba(208, 225, 215, 0.70);
    }

    .table-heading h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #234b39;
    }

    .table-heading p {
        margin: 4px 0 0;
        font-size: 12px;
        color: #84928b;
    }

    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 780px;
        border-collapse: collapse;
    }

    thead th {
        padding: 14px 20px;
        text-align: left;
        background:
            rgba(233, 244, 237, 0.62);
        color: #708178;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        border-bottom: 1px solid rgba(210, 226, 216, 0.72);
    }

    tbody td {
        padding: 17px 20px;
        color: #52645a;
        font-size: 13px;
        border-bottom: 1px solid rgba(218, 231, 222, 0.65);
        vertical-align: middle;
    }

    tbody tr:last-child td {
        border-bottom: 0;
    }

    tbody tr {
        transition: 0.20s ease;
    }

    tbody tr:hover {
        background: rgba(255, 255, 255, 0.46);
    }

    .addon-name {
        font-size: 14px;
        font-weight: 800;
        color: #274d3c;
    }

    .addon-description {
        max-width: 330px;
        margin-top: 4px;
        font-size: 11px;
        line-height: 1.5;
        color: #89978f;
    }

    .price {
        font-size: 14px;
        font-weight: 800;
        color: #176d4a;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-badge::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-active {
        color: #258253;
        background: rgba(211, 241, 222, 0.72);
        border: 1px solid rgba(167, 219, 184, 0.58);
    }

    .status-inactive {
        color: #a35d5d;
        background: rgba(247, 224, 224, 0.72);
        border: 1px solid rgba(233, 191, 191, 0.60);
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 68px;
        min-height: 34px;
        padding: 0 11px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        transition: 0.20s ease;
    }

    .edit-button {
        color: #196b49;
        background: rgba(216, 242, 226, 0.70);
        border: 1px solid rgba(171, 218, 188, 0.50);
    }

    .edit-button:hover {
        transform: translateY(-2px);
        background: rgba(202, 238, 215, 0.90);
    }

    .view-button {
        color: #53665d;
        background: rgba(239, 244, 241, 0.78);
        border: 1px solid rgba(214, 226, 218, 0.70);
    }

    .view-button:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 0.92);
    }

    .delete-button {
        color: #a24f4f;
        background: rgba(249, 226, 226, 0.72);
        border: 1px solid rgba(235, 196, 196, 0.60);
        cursor: pointer;
    }

    .delete-button:hover {
        transform: translateY(-2px);
        background: rgba(247, 214, 214, 0.92);
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 65px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 62px;
        height: 62px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 19px;
        background: rgba(218, 242, 227, 0.72);
        border: 1px solid rgba(255, 255, 255, 0.82);
        font-size: 27px;
    }

    .empty-state h3 {
        margin: 0;
        color: #2d4f40;
        font-size: 16px;
        font-weight: 800;
    }

    .empty-state p {
        max-width: 440px;
        margin: 7px auto 0;
        color: #8a9891;
        font-size: 12px;
        line-height: 1.6;
    }

    /* =========================================================
       FOOTER
    ========================================================= */

    .page-footer {
        padding: 25px 0 8px;
        text-align: center;
        color: #91a098;
        font-size: 11px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1050px) {
        .sidebar {
            width: 225px;
        }

        .main-content {
            padding: 20px;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .admin-wrapper {
            display: block;
        }

        .sidebar {
            width: 100%;
            min-height: auto;
            padding: 15px;
        }

        .brand {
            padding-bottom: 15px;
        }

        .menu {
            margin-top: 15px;
        }

        .sidebar-bottom {
            margin-top: 10px;
        }

        .main-content {
            padding: 15px;
        }

        .topbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-actions {
            justify-content: flex-start;
        }
    }

</style>
@endpush

@section('content')
{{-- TOPBAR --}}
        


        {{-- TOMBOL TAMBAH --}}
        <div class="page-actions">

            <a
                href="{{ route('admin.addon.create') }}"
                class="add-button"
            >
                <span class="add-icon">
                    +
                </span>

                <span>
                    Tambah Add-on
                </span>
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif


        {{-- ==================================================
             SUMMARY
        =================================================== --}}
        @php
            $totalAddOns = $addOns->count();
            $activeAddOns = $addOns->where('status', 'aktif')->count();
            $inactiveAddOns = $addOns->where('status', 'nonaktif')->count();
        @endphp

        <div class="summary-grid">

            <div class="summary-card">

                <div class="summary-top">

                    <div class="summary-label">
                        Total Add-on
                    </div>

                    <div class="summary-icon">
                        ➕
                    </div>

                </div>

                <div class="summary-value">
                    {{ $totalAddOns }}
                </div>

                <div class="summary-description">
                    Semua layanan tambahan
                </div>

            </div>


            <div class="summary-card">

                <div class="summary-top">

                    <div class="summary-label">
                        Add-on Aktif
                    </div>

                    <div class="summary-icon">
                        ✓
                    </div>

                </div>

                <div class="summary-value">
                    {{ $activeAddOns }}
                </div>

                <div class="summary-description">
                    Dapat dipilih oleh member
                </div>

            </div>


            <div class="summary-card">

                <div class="summary-top">

                    <div class="summary-label">
                        Tidak Aktif
                    </div>

                    <div class="summary-icon">
                        —
                    </div>

                </div>

                <div class="summary-value">
                    {{ $inactiveAddOns }}
                </div>

                <div class="summary-description">
                    Tidak tersedia sementara
                </div>

            </div>

        </div>


        {{-- ==================================================
             TABLE
        =================================================== --}}
        <section class="table-card">

            <div class="table-header">

                <div class="table-heading">

                    <h3>
                        Daftar Add-on
                    </h3>

                    <p>
                        Daftar layanan tambahan yang tersedia pada sistem.
                    </p>

                </div>

            </div>


            @if($addOns->count() > 0)

                <div class="table-container">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Add-on
                                </th>

                                <th>
                                    Harga
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

                            @foreach($addOns as $addOn)

                                <tr>

                                    <td>

                                        <div class="addon-name">
                                            {{ $addOn->nama }}
                                        </div>

                                        @if($addOn->deskripsi)

                                            <div class="addon-description">
                                                {{ $addOn->deskripsi }}
                                            </div>

                                        @else

                                            <div class="addon-description">
                                                Tidak ada deskripsi.
                                            </div>

                                        @endif

                                    </td>


                                    <td>

                                        <div class="price">
                                            Rp {{ number_format($addOn->harga, 0, ',', '.') }}
                                        </div>

                                    </td>


                                    <td>

                                        @if($addOn->status === 'aktif')

                                            <span class="status-badge status-active">
                                                Aktif
                                            </span>

                                        @else

                                            <span class="status-badge status-inactive">
                                                Tidak Aktif
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <div class="actions">

                                            <a
                                                href="{{ route('admin.addon.show', $addOn) }}"
                                                class="action-button view-button"
                                            >
                                                Detail
                                            </a>

                                            <a
                                                href="{{ route('admin.addon.edit', $addOn) }}"
                                                class="action-button edit-button"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('admin.addon.destroy', $addOn) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus add-on ini?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-button delete-button"
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

                <div class="empty-state">

                    <div class="empty-icon">
                        ➕
                    </div>

                    <h3>
                        Belum ada add-on
                    </h3>

                    <p>
                        Belum ada layanan tambahan yang tersimpan.
                        Silakan tambahkan add-on baru menggunakan tombol
                        "Tambah Add-on".
                    </p>

                </div>

            @endif

        </section>


        {{-- FOOTER --}}
        <footer class="page-footer">
            © 2026 PermataTruf.Id. Hak Cipta Dilindungi.
        </footer>
@endsection

