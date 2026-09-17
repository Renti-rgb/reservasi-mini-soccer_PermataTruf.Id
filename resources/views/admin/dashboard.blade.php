@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')

@section('page-subtitle', 'Ringkasan aktivitas dan informasi sistem PermataTruf.Id')

@push('styles')
<style>
    /* =========================
       DASHBOARD WELCOME
    ========================== */
    .dashboard-welcome {
        position: relative;
        overflow: hidden;

        min-height: 185px;
        padding: 36px 38px;
        margin-bottom: 22px;

        border-radius: 26px;

        background:
            linear-gradient(
                135deg,
                rgba(255,255,255,.70),
                rgba(222,245,232,.48)
            );

        border: 1px solid rgba(255,255,255,.82);

        box-shadow:
            0 18px 42px rgba(39,83,66,.07),
            inset 0 1px 0 rgba(255,255,255,.90);

        backdrop-filter: blur(24px) saturate(115%);
        -webkit-backdrop-filter: blur(24px) saturate(115%);
    }

    /* Tidak ada dekorasi lingkaran hijau di pojok kanan. */

    .welcome-label {
        margin-bottom: 9px;

        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.15px;
        text-transform: uppercase;

        color: #7e9288;
    }

    .welcome-title {
        margin: 0;

        font-size: 31px;
        line-height: 1.2;
        font-weight: 800;

        color: #20372d;
    }

    .welcome-text {
        margin: 10px 0 0;
        max-width: 860px;

        font-size: 14px;
        line-height: 1.75;

        color: #71877c;
    }

    /* =========================
       STATISTICS
    ========================== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));

        gap: 18px;
        margin-bottom: 22px;
    }

    .stat-card {
        min-height: 148px;
        padding: 21px;

        border-radius: 21px;

        background:
            linear-gradient(
                135deg,
                rgba(255,255,255,.68),
                rgba(239,250,245,.46)
            );

        border: 1px solid rgba(255,255,255,.82);

        box-shadow:
            0 14px 34px rgba(39,83,66,.06),
            inset 0 1px 0 rgba(255,255,255,.88);

        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);

        transition:
            transform .22s ease,
            box-shadow .22s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);

        box-shadow:
            0 19px 40px rgba(39,83,66,.09),
            inset 0 1px 0 rgba(255,255,255,.92);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .stat-label {
        font-size: 11px;
        font-weight: 700;

        color: #84958d;
    }

    .stat-icon {
        width: 41px;
        height: 41px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 13px;

        background: rgba(215,242,226,.70);
        border: 1px solid rgba(255,255,255,.86);

        color: #16875a;
        font-size: 17px;

        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.82);
    }

    .stat-number {
        margin-top: 17px;

        font-size: 28px;
        line-height: 1.15;
        font-weight: 800;

        color: #20372d;
    }

    /* =========================
       QUICK ACTIONS
    ========================== */
    .quick-card {
        margin-bottom: 22px;
        padding: 24px;

        border-radius: 24px;

        background:
            linear-gradient(
                135deg,
                rgba(255,255,255,.64),
                rgba(239,249,244,.42)
            );

        border: 1px solid rgba(255,255,255,.80);

        box-shadow:
            0 16px 38px rgba(39,83,66,.065),
            inset 0 1px 0 rgba(255,255,255,.86);

        backdrop-filter: blur(21px);
        -webkit-backdrop-filter: blur(21px);
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;

        margin-bottom: 17px;
    }

    .section-title {
        margin: 0;

        font-size: 19px;
        font-weight: 800;

        color: #20372d;
    }

    .section-description {
        margin: 5px 0 0;

        font-size: 11px;

        color: #87978f;
    }

    .quick-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));

        gap: 13px;
    }

    .quick-link {
        min-height: 78px;

        display: flex;
        align-items: center;
        gap: 12px;

        padding: 13px;

        border-radius: 17px;

        text-decoration: none;

        background: rgba(255,255,255,.42);
        border: 1px solid rgba(255,255,255,.76);

        color: #53675d;

        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.78);

        transition:
            transform .2s ease,
            background .2s ease,
            border .2s ease,
            color .2s ease;
    }

    .quick-link:hover {
        transform: translateY(-2px);

        background: rgba(255,255,255,.66);
        border-color: rgba(163,211,182,.50);

        color: #16875a;
    }

    .quick-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: rgba(215,242,226,.64);
        border: 1px solid rgba(255,255,255,.82);

        font-size: 15px;

        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.80);
    }

    .quick-title {
        font-size: 11px;
        font-weight: 800;
        color: #53675d;
    }

    .quick-text {
        margin-top: 3px;

        font-size: 9px;
        color: #8a9b93;
    }

    /* =========================
       RECENT RESERVATIONS
    ========================== */
    .reservation-card {
        overflow: hidden;

        padding: 24px;

        border-radius: 24px;

        background:
            linear-gradient(
                135deg,
                rgba(255,255,255,.60),
                rgba(241,249,245,.40)
            );

        border: 1px solid rgba(255,255,255,.80);

        box-shadow:
            0 16px 38px rgba(39,83,66,.065),
            inset 0 1px 0 rgba(255,255,255,.86);

        backdrop-filter: blur(21px);
        -webkit-backdrop-filter: blur(21px);
    }

    .reservation-card .card-header {
        padding: 0 0 17px;
        margin-bottom: 0;

        border-bottom:
            1px solid rgba(120,150,135,.10);
    }

    .card-title {
        margin: 0;

        font-size: 18px;
        font-weight: 800;

        color: #20372d;
    }

    .card-subtitle {
        margin: 5px 0 0;

        font-size: 11px;

        color: #84958e;
    }

    .reservation-card .table-wrapper {
        margin-top: 18px;
    }

    .reservation-code,
    .user-name,
    .field-name {
        font-size: 12px;
        font-weight: 800;

        color: #31473c;
    }

    .user-id {
        margin-top: 3px;

        font-size: 10px;
        color: #8b9b94;
    }

    .status {
        display: inline-flex;
        align-items: center;

        padding: 6px 10px;

        border-radius: 999px;

        font-size: 9px;
        font-weight: 800;

        white-space: nowrap;
    }

    .status-waiting {
        background: rgba(255,222,112,.18);
        color: #9b7411;
        border: 1px solid rgba(255,204,75,.20);
    }

    .status-confirmed {
        background: rgba(53,190,121,.12);
        color: #16875a;
        border: 1px solid rgba(53,190,121,.18);
    }

    .status-rejected {
        background: rgba(239,68,68,.09);
        color: #c53b3b;
        border: 1px solid rgba(239,68,68,.15);
    }

    .status-other {
        background: rgba(148,163,184,.10);
        color: #687770;
        border: 1px solid rgba(148,163,184,.14);
    }

    .empty {
        padding: 48px 18px;
        text-align: center;
        color: #87978f;
    }

    .empty-icon {
        width: 54px;
        height: 54px;

        margin: 0 auto 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 17px;

        background: rgba(218,244,229,.58);
        border: 1px solid rgba(255,255,255,.80);

        font-size: 23px;
    }

    .empty-title {
        font-size: 15px;
        font-weight: 800;

        color: #365344;
    }

    .empty-text {
        margin-top: 6px;

        font-size: 11px;
        color: #81948a;
    }

    @media (max-width: 1200px) {
        .stats-grid,
        .quick-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .stats-grid,
        .quick-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-welcome {
            min-height: auto;
            padding: 27px;
        }

        .welcome-title {
            font-size: 25px;
        }

        .welcome-text {
            font-size: 13px;
        }
    }
</style>
@endpush

@section('content')

    <section class="dashboard-welcome">
        <div class="welcome-label">Admin Panel</div>

        <h2 class="welcome-title">
            Selamat Datang, {{ auth()->user()->name ?? 'Admin' }} 👋
        </h2>

        <p class="welcome-text">
            Pantau aktivitas reservasi, pembayaran, lapangan, jadwal, add-on,
            laporan, dan proses auto-cancel melalui dashboard administrasi
            PermataTruf.Id.
        </p>
    </section>

    @php
        $totalReservasiDashboard =
            $totalReservasi ??
            (isset($reservasis) ? $reservasis->count() : 0);

        $totalPendapatanDashboard =
            $totalPendapatan ?? 0;

        $totalLapanganDashboard =
            $totalLapangan ?? 0;

        $totalPendingDashboard =
            $totalPending ??
            (isset($reservasis)
                ? $reservasis
                    ->whereIn('status', [
                        'menunggu_pembayaran',
                        'menunggu_verifikasi'
                    ])
                    ->count()
                : 0);
    @endphp

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Total Reservasi</div>
                <div class="stat-icon">📋</div>
            </div>

            <div class="stat-number">
                {{ $totalReservasiDashboard }}
            </div>

            <div class="stat-label">
                Reservasi terdaftar
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Total Pendapatan</div>
                <div class="stat-icon">💰</div>
            </div>

            <div class="stat-number">
                Rp {{ number_format($totalPendapatanDashboard, 0, ',', '.') }}
            </div>

            <div class="stat-label">
                Pendapatan reservasi
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Total Lapangan</div>
                <div class="stat-icon">⚽</div>
            </div>

            <div class="stat-number">
                {{ $totalLapanganDashboard }}
            </div>

            <div class="stat-label">
                Lapangan tersedia di sistem
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Menunggu</div>
                <div class="stat-icon">⏳</div>
            </div>

            <div class="stat-number">
                {{ $totalPendingDashboard }}
            </div>

            <div class="stat-label">
                Pembayaran / verifikasi
            </div>
        </div>

    </div>

    <section class="quick-card">
        <div class="section-header">
            <div>
                <h2 class="section-title">Akses Cepat</h2>
                <p class="section-description">
                    Buka fitur administrasi yang tersedia.
                </p>
            </div>
        </div>

        <div class="quick-grid">

            <a href="{{ route('admin.pembayaran.index') }}" class="quick-link">
                <span class="quick-icon">💳</span>
                <span>
                    <div class="quick-title">Validasi Pembayaran</div>
                    <div class="quick-text">Periksa pembayaran</div>
                </span>
            </a>

            <a href="{{ route('admin.reservasi.index') }}" class="quick-link">
                <span class="quick-icon">📋</span>
                <span>
                    <div class="quick-title">Kelola Reservasi</div>
                    <div class="quick-text">Kelola status reservasi</div>
                </span>
            </a>

            <a href="{{ route('admin.lapangan.index') }}" class="quick-link">
                <span class="quick-icon">⚽</span>
                <span>
                    <div class="quick-title">Kelola Lapangan</div>
                    <div class="quick-text">Kelola data lapangan</div>
                </span>
            </a>

            <a href="{{ route('admin.jadwal.index') }}" class="quick-link">
                <span class="quick-icon">🗓️</span>
                <span>
                    <div class="quick-title">Kelola Jadwal</div>
                    <div class="quick-text">Atur jadwal lapangan</div>
                </span>
            </a>

            <a href="{{ route('admin.harga.index') }}" class="quick-link">
                <span class="quick-icon">💰</span>
                <span>
                    <div class="quick-title">Kelola Harga</div>
                    <div class="quick-text">Atur harga lapangan</div>
                </span>
            </a>

            <a href="{{ route('admin.addon.index') }}" class="quick-link">
                <span class="quick-icon">➕</span>
                <span>
                    <div class="quick-title">Kelola Add-on</div>
                    <div class="quick-text">Kelola layanan tambahan</div>
                </span>
            </a>

            <a href="{{ route('admin.laporan.index') }}" class="quick-link">
                <span class="quick-icon">📄</span>
                <span>
                    <div class="quick-title">Laporan PDF</div>
                    <div class="quick-text">Lihat laporan reservasi</div>
                </span>
            </a>

            <a href="{{ route('admin.auto-cancel.index') }}" class="quick-link">
                <span class="quick-icon">⏱️</span>
                <span>
                    <div class="quick-title">Monitor Auto-Cancel</div>
                    <div class="quick-text">Pantau auto-cancel</div>
                </span>
            </a>

        </div>
    </section>

    <section class="reservation-card">
        <div class="card-header">

            <div class="card-title-area">
                <h2 class="card-title">
                    Reservasi Terbaru
                </h2>

                <p class="card-subtitle">
                    Ringkasan reservasi terbaru yang masuk ke sistem.
                </p>
            </div>

        </div>

        @if(isset($reservasis) && $reservasis->count() > 0)

            <div class="table-wrapper">
                <table>

                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>User</th>
                            <th>Lapangan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($reservasis->take(5) as $reservasi)

                            <tr>

                                <td>
                                    <div class="reservation-code">
                                        {{ $reservasi->kode_reservasi ?? '#' . $reservasi->id }}
                                    </div>
                                </td>

                                <td>
                                    <div class="user-name">
                                        {{ $reservasi->user->name ?? '-' }}
                                    </div>

                                    <div class="user-id">
                                        User ID: {{ $reservasi->user_id ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="field-name">
                                        {{ $reservasi->lapangan->nama ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    @if($reservasi->jadwal)
                                        {{ \Carbon\Carbon::parse($reservasi->jadwal->tanggal)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>

                                    @if($reservasi->status === 'menunggu_pembayaran')

                                        <span class="status status-waiting">
                                            Menunggu Pembayaran
                                        </span>

                                    @elseif($reservasi->status === 'menunggu_verifikasi')

                                        <span class="status status-waiting">
                                            Menunggu Verifikasi
                                        </span>

                                    @elseif($reservasi->status === 'dikonfirmasi')

                                        <span class="status status-confirmed">
                                            Dikonfirmasi
                                        </span>

                                    @elseif(
                                        $reservasi->status === 'ditolak' ||
                                        $reservasi->status === 'dibatalkan'
                                    )

                                        <span class="status status-rejected">
                                            {{ ucfirst(str_replace('_', ' ', $reservasi->status)) }}
                                        </span>

                                    @else

                                        <span class="status status-other">
                                            {{ ucfirst(str_replace('_', ' ', $reservasi->status)) }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        @else

            <div class="empty">
                <div class="empty-icon">📋</div>

                <div class="empty-title">
                    Belum Ada Reservasi
                </div>

                <div class="empty-text">
                    Belum terdapat data reservasi pada sistem.
                </div>
            </div>

        @endif

    </section>

@endsection
