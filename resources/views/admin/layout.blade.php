<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Panel') - PermataTruf.Id</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        :root {
            --admin-text: #26382f;
            --admin-muted: #7f9188;
            --admin-green: #16875a;
            --admin-green-2: #2ca873;
            --admin-bg-1: #edf8f4;
            --admin-bg-2: #e6f2ed;
            --admin-bg-3: #f4faf7;
            --glass-white: rgba(255, 255, 255, 0.66);
            --glass-border: rgba(255, 255, 255, 0.88);
            --shadow: rgba(39, 83, 66, 0.10);
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--admin-text);
            background:
                radial-gradient(circle at 10% 10%, rgba(111, 207, 151, 0.22), transparent 32%),
                radial-gradient(circle at 90% 20%, rgba(74, 160, 112, 0.16), transparent 30%),
                radial-gradient(circle at 50% 100%, rgba(143, 196, 161, 0.20), transparent 35%),
                linear-gradient(135deg, var(--admin-bg-1) 0%, var(--admin-bg-2) 45%, var(--admin-bg-3) 100%);
            overflow-x: hidden;
        }

        a { color: inherit; }

        .admin-wrapper {
            min-height: 100vh;
            padding: 16px;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 16px;
            top: 16px;
            bottom: 16px;
            width: 285px;
            padding: 24px 18px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            border-radius: 28px;
            background: linear-gradient(145deg, rgba(255,255,255,.62), rgba(231,248,239,.42));
            border: 1px solid var(--glass-border);
            box-shadow: 0 20px 50px var(--shadow), inset 0 1px 0 rgba(255,255,255,.78);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            z-index: 1000;
        }

        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(87, 140, 113, .25);
            border-radius: 999px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover { background: rgba(87, 140, 113, .40); }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 8px 22px;
            flex-shrink: 0;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 15px;
            background: rgba(255,255,255,.68);
            border: 1px solid rgba(255,255,255,.90);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 8px 22px rgba(39,83,66,.08), inset 0 1px 0 rgba(255,255,255,.80);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-text {
            font-size: 19px;
            font-weight: 800;
            color: var(--admin-text);
            white-space: nowrap;
        }

        .brand-text span { color: var(--admin-green); }

        .admin-label {
            padding: 10px 12px;
            margin-bottom: 8px;
            flex-shrink: 0;
            font-size: 10px;
            font-weight: 800;
            color: #8a9b93;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
            flex: 0 0 auto;
        }

        .menu a {
            position: relative;
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
            transition: background .25s ease, border .25s ease, color .25s ease, transform .25s ease, box-shadow .25s ease;
        }

        .menu a:hover {
            background: rgba(255,255,255,.52);
            border-color: rgba(255,255,255,.78);
            color: var(--admin-green);
            transform: translateX(2px);
            box-shadow: 0 8px 20px rgba(39,83,66,.05);
        }

        .menu a.active {
            background: linear-gradient(135deg, rgba(255,255,255,.72), rgba(219,244,229,.56));
            border-color: rgba(169,211,187,.58);
            color: var(--admin-text);
            box-shadow: 0 10px 24px rgba(39,83,66,.07), inset 0 1px 0 rgba(255,255,255,.90);
        }

        .menu a.active::before {
            content: "";
            position: absolute;
            left: -1px;
            top: 12px;
            bottom: 12px;
            width: 4px;
            border-radius: 999px;
            background: var(--admin-green-2);
        }

        .menu-icon {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255,255,255,.58);
            border: 1px solid rgba(255,255,255,.82);
            font-size: 16px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.70);
        }

        .menu a.active .menu-icon {
            background: rgba(215,242,226,.76);
            color: var(--admin-green);
        }

        .sidebar-bottom {
            margin-top: 14px;
            padding: 12px 2px 2px;
            flex: 0 0 auto;
            border-top: 1px solid rgba(255,255,255,.62);
        }

        .sidebar-bottom form { width: 100%; }

        .logout-button {
            width: 100%;
            min-height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 16px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,.88);
            background: linear-gradient(135deg, rgba(255,255,255,.58), rgba(255,238,238,.40));
            color: #c95050;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(95,54,54,.06), inset 0 1px 0 rgba(255,255,255,.86);
            transition: background .25s ease, border .25s ease, color .25s ease, transform .25s ease, box-shadow .25s ease;
        }

        .logout-button:hover {
            background: rgba(255,255,255,.75);
            border-color: rgba(228,171,171,.55);
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(95,54,54,.08), inset 0 1px 0 rgba(255,255,255,.90);
        }

        .logout-icon {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(255,255,255,.56);
            border: 1px solid rgba(255,255,255,.76);
            font-size: 15px;
        }

        /* MAIN */
        .main {
            min-height: calc(100vh - 32px);
            margin-left: 307px;
            padding: 8px 14px 28px 8px;
        }

        .topbar {
    min-height: 125px;
    margin-bottom: 22px;
    padding: 20px 28px;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 28px;

    border-radius: 28px;

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.58),
            rgba(225,245,234,.40)
        );

    border: 1px solid rgba(255,255,255,.72);

    box-shadow:
        0 18px 44px rgba(39,83,66,.08),
        inset 0 1px 0 rgba(255,255,255,.84);

    backdrop-filter: blur(26px) saturate(115%);
    -webkit-backdrop-filter: blur(26px) saturate(115%);
}

        .page-heading { min-width: 0; }

        .page-title {
    margin: 0;
    font-size: 34px;
    line-height: 1.15;
    font-weight: 800;
    color: #20372d;
}

        .page-subtitle {
    margin-top: 9px;
    font-size: 14px;
    line-height: 1.55;
    color: #7b9187;
}

        .admin-profile {
            min-width: 225px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 9px 16px 9px 9px;
            border-radius: 21px;
            background: rgba(255,255,255,.56);
            border: 1px solid rgba(255,255,255,.90);
            box-shadow: 0 12px 30px rgba(39,83,66,.07), inset 0 1px 0 rgba(255,255,255,.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .profile-avatar {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            border-radius: 50%;
            overflow: hidden;
            background: rgba(255,255,255,.84);
            border: 4px solid rgba(255,255,255,.94);
            box-shadow: 0 8px 20px rgba(39,83,66,.10), inset 0 1px 0 rgba(255,255,255,.90);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-name {
            font-size: 15px;
            font-weight: 800;
            color: #20372d;
        }

        .profile-role {
            margin-top: 4px;
            font-size: 11px;
            color: #87978f;
        }

        .content-card { width: 100%; }

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
            margin: 0;
            font-size: 17px;
            font-weight: 800;
            color: #264436;
        }

        .card-description {
            font-size: 12px;
            color: #789084;
        }

        /* COMMON CONTENT ELEMENTS */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 14px;
            background: rgba(216,245,226,.78);
            border: 1px solid rgba(114,190,141,.28);
            color: #28704b;
            font-size: 13px;
            font-weight: 650;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,.82);
            background: rgba(255,255,255,.34);
        }

        .table-wrapper table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-wrapper thead { background: rgba(218,239,225,.54); }

        .table-wrapper th {
            padding: 15px 17px;
            text-align: left;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .35px;
            color: #5d7568;
            border-bottom: 1px solid rgba(183,214,194,.48);
            white-space: nowrap;
        }

        .table-wrapper td {
            padding: 17px;
            font-size: 13px;
            color: #40594c;
            border-bottom: 1px solid rgba(211,229,217,.55);
        }

        .table-wrapper tbody tr { transition: background .2s ease; }
        .table-wrapper tbody tr:hover { background: rgba(255,255,255,.46); }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            .sidebar { width: 250px; }
            .main { margin-left: 272px; }
            .admin-profile { min-width: 0; }
        }

        @media (max-width: 820px) {
            .admin-wrapper { padding: 10px; }

            .sidebar {
                position: static;
                width: 100%;
                min-height: auto;
                max-height: none;
                margin-bottom: 14px;
            }

            .main {
                margin-left: 0;
                min-height: auto;
                padding: 0 2px 20px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .admin-profile { width: 100%; }
        }

        @media (max-width: 560px) {
            .page-title { font-size: 24px; }
            .content-card { padding: 18px; border-radius: 20px; }
            .brand-text { font-size: 17px; }
        }
    </style>
</head>

<body>
    <div class="admin-wrapper">
        @include('admin.partials.sidebar')

        <main class="main">
            <header class="topbar">
                <div class="page-heading">
                    <h1 class="page-title">@yield('page-title', 'Admin Panel')</h1>
                    <div class="page-subtitle">@yield('page-subtitle', 'Kelola sistem reservasi PermataTruf.Id')</div>
                </div>

                <div class="admin-profile">
                    <div class="profile-avatar">
                        <img src="{{ asset('images/logo.admin.png') }}" alt="Logo Admin">
                    </div>
                    <div>
                        <div class="profile-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="profile-role">Administrator</div>
                    </div>
                </div>
            </header>

            <section class="content">
                @yield('content')
            </section>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
