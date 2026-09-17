{{-- Shared Admin Sidebar --}}
<aside class="sidebar">
    <div class="brand">
        <div class="brand-logo">
            <img src="{{ asset('images/logo.1.png') }}" alt="Logo PermataTruf.Id">
        </div>
        <div class="brand-text">PermataTruf<span>.Id</span></div>
    </div>

    <div class="admin-label">Admin Panel</div>

    <nav class="menu" aria-label="Menu Admin">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">▣</span><span>Dashboard</span>
        </a>
        <a href="{{ route('admin.pembayaran.index') }}" class="{{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
            <span class="menu-icon">💳</span><span>Validasi Pembayaran</span>
        </a>
        <a href="{{ route('admin.reservasi.index') }}" class="{{ request()->routeIs('admin.reservasi.*') ? 'active' : '' }}">
            <span class="menu-icon">📋</span><span>Kelola Reservasi</span>
        </a>
        <a href="{{ route('admin.lapangan.index') }}" class="{{ request()->routeIs('admin.lapangan.*') ? 'active' : '' }}">
            <span class="menu-icon">⚽</span><span>Kelola Lapangan</span>
        </a>
        <a href="{{ route('admin.jadwal.index') }}" class="{{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
            <span class="menu-icon">🗓️</span><span>Kelola Jadwal</span>
        </a>
        <a href="{{ route('admin.harga.index') }}" class="{{ request()->routeIs('admin.harga.*') ? 'active' : '' }}">
            <span class="menu-icon">💰</span><span>Kelola Harga</span>
        </a>
        <a href="{{ route('admin.addon.index') }}" class="{{ request()->routeIs('admin.addon.*') ? 'active' : '' }}">
            <span class="menu-icon">➕</span><span>Kelola Add-on</span>
        </a>
        <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            <span class="menu-icon">📄</span><span>Laporan PDF</span>
        </a>
        <a href="{{ route('admin.auto-cancel.index') }}" class="{{ request()->routeIs('admin.auto-cancel.*') ? 'active' : '' }}">
            <span class="menu-icon">⏱️</span><span>Monitor Auto-Cancel</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">
                <span class="logout-icon">↪</span><span>Keluar</span>
            </button>
        </form>
    </div>
</aside>

<style>
    /* Final shared sidebar overrides page-specific sidebar styles. */
    .sidebar {
        width: 285px !important;
        min-height: calc(100vh - 32px) !important;
        position: fixed !important;
        left: 16px !important;
        top: 16px !important;
        bottom: 16px !important;
        padding: 24px 18px !important;
        display: flex !important;
        flex-direction: column !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        border-radius: 28px !important;
        background: linear-gradient(145deg, rgba(255,255,255,.72), rgba(231,248,239,.52)) !important;
        border: 1px solid rgba(255,255,255,.90) !important;
        box-shadow: 0 20px 50px rgba(39,83,66,.10), inset 0 1px 0 rgba(255,255,255,.78) !important;
        backdrop-filter: blur(25px) !important;
        -webkit-backdrop-filter: blur(25px) !important;
        z-index: 1000 !important;
    }
    .sidebar::-webkit-scrollbar{width:6px}
    .sidebar::-webkit-scrollbar-track{background:transparent}
    .sidebar::-webkit-scrollbar-thumb{background:rgba(87,140,113,.25);border-radius:999px}
    .sidebar .brand{display:flex;align-items:center;gap:12px;padding:8px 8px 22px;flex-shrink:0}
    .sidebar .brand-logo{width:48px;height:48px;flex-shrink:0;border-radius:15px;background:rgba(255,255,255,.68);border:1px solid rgba(255,255,255,.90);display:flex;align-items:center;justify-content:center;overflow:hidden;box-shadow:0 8px 22px rgba(39,83,66,.08),inset 0 1px 0 rgba(255,255,255,.80)}
    .sidebar .brand-logo img{width:100%;height:100%;object-fit:contain}
    .sidebar .brand-text{font-size:19px;font-weight:800;color:#26382f;white-space:nowrap}
    .sidebar .brand-text span{color:#16875a}
    .sidebar .admin-label{padding:10px 12px;margin-bottom:8px;flex-shrink:0;font-size:10px;font-weight:800;color:#8a9b93;text-transform:uppercase;letter-spacing:1px}
    .sidebar .menu{display:flex;flex-direction:column;gap:7px;flex:0 0 auto}
    .sidebar .menu a{position:relative;display:flex;align-items:center;gap:12px;padding:13px 14px;border-radius:16px;text-decoration:none;color:#52645b;font-size:13px;font-weight:600;border:1px solid transparent;transition:.25s ease}
    .sidebar .menu a:hover{background:rgba(255,255,255,.58);border-color:rgba(255,255,255,.78);color:#16875a;transform:translateX(2px);box-shadow:0 8px 20px rgba(39,83,66,.05)}
    .sidebar .menu a.active{background:linear-gradient(135deg,rgba(255,255,255,.76),rgba(219,244,229,.62));border-color:rgba(169,211,187,.60);color:#26382f;box-shadow:0 10px 24px rgba(39,83,66,.07),inset 0 1px 0 rgba(255,255,255,.90)}
    .sidebar .menu a.active::before{content:"";position:absolute;left:-1px;top:12px;bottom:12px;width:4px;border-radius:999px;background:#2ca873}
    .sidebar .menu-icon{width:36px;height:36px;flex-shrink:0;display:flex;align-items:center;justify-content:center;border-radius:12px;background:rgba(255,255,255,.58);border:1px solid rgba(255,255,255,.82);font-size:16px;box-shadow:inset 0 1px 0 rgba(255,255,255,.70)}
    .sidebar .menu a.active .menu-icon{background:rgba(215,242,226,.76);color:#16875a}
    .sidebar .sidebar-bottom{margin-top:14px;padding:12px 2px 2px;flex:0 0 auto;border-top:1px solid rgba(255,255,255,.62)}
    .sidebar .sidebar-bottom form{width:100%}
    .sidebar .logout-button{width:100%;min-height:46px;display:flex;align-items:center;justify-content:center;gap:10px;padding:0 16px;border-radius:16px;border:1px solid rgba(255,255,255,.88);background:linear-gradient(135deg,rgba(255,255,255,.58),rgba(255,238,238,.40));color:#c95050;font-size:13px;font-weight:800;cursor:pointer;box-shadow:0 10px 25px rgba(95,54,54,.06),inset 0 1px 0 rgba(255,255,255,.86)}
    .sidebar .logout-icon{width:28px;height:28px;display:flex;align-items:center;justify-content:center;border-radius:10px;background:rgba(255,255,255,.56);border:1px solid rgba(255,255,255,.76);font-size:15px}
    @media(max-width:900px){.sidebar{position:relative!important;left:auto!important;top:auto!important;bottom:auto!important;width:100%!important;min-height:auto!important;margin-bottom:15px!important;max-height:none!important;overflow-y:visible!important}.sidebar .menu{display:grid;grid-template-columns:repeat(2,minmax(0,1fr))}.sidebar .sidebar-bottom{margin-top:10px}}
    @media(max-width:650px){.sidebar .menu{grid-template-columns:1fr}}
</style>
