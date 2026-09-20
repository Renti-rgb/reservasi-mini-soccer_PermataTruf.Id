<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PermataTruf.Id - Reservasi Lapangan Mini Soccer')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.1.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: 'Instrument Sans', sans-serif;
            color: #172033;
            background: #eef7f4;
            overflow-x: hidden;
        }

        .page-background {
            position: fixed; inset: 0; z-index: -2;
            background:
                radial-gradient(
                    ellipse 70% 60% at 50% 50%,
                    rgba(124, 148, 115, 0.65) 0%,
                    rgba(150, 175, 140, 0.4) 40%,
                    rgba(238, 247, 244, 0.15) 70%,
                    #eef7f4 100%
                );
        }
        .glass {
            position: relative;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 40px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .glass-strong {
            position: relative;
            background: rgba(255,255,255,0.78);
            border: 1px solid rgba(255,255,255,0.96);
            backdrop-filter: blur(25px) saturate(150%);
            -webkit-backdrop-filter: blur(25px) saturate(150%);
            box-shadow: 0 12px 40px rgba(25,75,55,0.12), 0 3px 10px rgba(25,75,55,0.04),
                inset 0 1px 0 rgba(255,255,255,1);
            overflow: hidden;
        }
        .glass-strong::before {
            content: ""; position: absolute; inset: 0;
            background: radial-gradient(circle at 20% 0%, rgba(255,255,255,0.45), transparent 35%);
            pointer-events: none;
        }

        /* PERBAIKAN TOMBOL: BACKGROUND SAGE GRADIENT & TEKS HITAM */
        .btn-primary, 
        .field-button,
        button[type="submit"] {
            background: radial-gradient(
                ellipse 70% 60% at 50% 50%,
                rgba(105, 132, 95, 0.65) 0%,
                rgba(140, 180, 126, 0.53) 40%,
                #bfc2c100 100%
            ), #eef7f4 !important;
            color: #000000 !important;
            font-weight: 700 !important;
            border: 1px solid rgba(105, 132, 95, 0.4) !important;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .btn-primary:hover, 
        .field-button:hover,
        button[type="submit"]:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); 
            color: #000000 !important;
        }

        .btn-outline {
            background: rgba(255,255,255,0.45);
            color: #000000 !important;
            border: 1px solid #22a957;
            transition: transform 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
        }
        .btn-outline:hover { background: rgba(34,197,94,0.09); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(22,163,74,0.10); color: #000000 !important; }

        .navbar { position: sticky; top: 16px; z-index: 50; width: calc(100% - 40px); max-width: 1280px; margin: 16px auto 0; border-radius: 20px; }
        .navbar-inner { height: 72px; padding: 0 28px; display: flex; align-items: center; justify-content: space-between; }
        .logo-area { display: flex; align-items: center; gap: 10px; text-decoration: none; color: #172033; }
        .logo-area img { width: 38px; height: 38px; object-fit: cover; border-radius: 50%; }
        .logo-text { font-size: 20px; font-weight: 800; }
        .logo-text span { color: #16a34a; }
        .nav-links { display: flex; align-items: center; gap: 34px; }
        .nav-links a { text-decoration: none; color: #273447; font-size: 14px; font-weight: 500; transition: 0.2s; }
        .nav-links a:hover { color: #16a34a; }
        .nav-buttons { display: flex; align-items: center; gap: 12px; }

        .container { width: calc(100% - 40px); max-width: 1280px; margin: auto; }

        .section { padding: 65px 0; }
        .section-header { text-align: center; margin-bottom: 38px; }
        .section-label { color: #159447; font-size: 13px; font-weight: 800; text-transform: uppercase; margin-bottom: 7px; }
        .section-title { margin: 0; color: #172033; font-size: 32px; font-weight: 800; }
        .section-description { color: #627084; margin-top: 12px; font-size: 14px; }

        .fields-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
        .field-card {
            position: relative;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(25px) saturate(140%);
            -webkit-backdrop-filter: blur(25px) saturate(140%);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .field-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 50px rgba(0,0,0,0.12);
        }
        .field-image { padding: 8px; }
        .field-image img { width: 100%; height: 190px; object-fit: cover; border-radius: 14px; display: block; }
        .field-content { padding: 8px 16px 18px; }
        .field-name { font-size: 17px; font-weight: 800; color: #172033; margin: 6px 0 10px; }
        .field-description { color: #687588; font-size: 13px; line-height: 1.55; min-height: 42px; }
        .field-price { color: #159447; font-weight: 800; margin: 14px 0; font-size: 14px; }
        .field-button { display: block; text-align: center; text-decoration: none; padding: 11px; border-radius: 8px; font-size: 13px; font-weight: 700; }

        /* PERBAIKAN FOOTER: BACKGROUND SAGE GRADIENT & SEMUA TEKS HITAM */
        footer {
            background: radial-gradient(
                ellipse 70% 60% at 50% 50%,
                rgba(105, 132, 95, 0.65) 0%,
                rgba(140, 180, 126, 0.53) 40%,
                #bfc2c100 100%
            ), #eef7f4 !important;
            color: #000000 !important;
        }

        footer p, 
        footer span, 
        footer div, 
        footer h3, 
        footer h4, 
        footer strong,
        footer a,
        footer .footer-text,
        footer .footer-links a,
        footer .footer-contact,
        footer .footer-bottom,
        footer .social-icons a {
            color: #000000 !important;
        }

        footer a:hover {
            color: #000000 !important;
            text-decoration: underline;
        }

        .footer-container { width: calc(100% - 40px); max-width: 1180px; margin: auto; padding: 42px 0 20px; }
        .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 50px; }
        .footer-logo { display: flex; align-items: center; gap: 9px; margin-bottom: 14px; }
        .footer-logo img { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
        .footer-logo span { font-weight: 800; font-size: 16px; }
        .footer-text { font-size: 12px; line-height: 1.6; max-width: 270px; }
        .footer-title { font-weight: 800; font-size: 14px; margin-bottom: 12px; }
        .footer-links { display: flex; flex-direction: column; gap: 7px; }
        .footer-links a { font-size: 12px; text-decoration: underline; }
        .footer-contact { font-size: 12px; line-height: 1.7; }
        .footer-bottom { border-top: 1px solid rgba(0, 0, 0, 0.15); margin-top: 28px; padding-top: 12px; text-align: center; font-size: 11px; }
        .social-icons { margin-top: 7px; display: flex; justify-content: center; gap: 14px; }
        .social-icons a { text-decoration: none; }

        @media (max-width: 900px) {
            .nav-links { display: none; }
            .fields-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .navbar { width: calc(100% - 20px); margin-top: 10px; }
            .navbar-inner { padding: 0 15px; }
            .logo-text { font-size: 16px; }
            .nav-buttons a { padding: 8px 12px !important; }
            .container { width: calc(100% - 24px); }
            .footer-grid { grid-template-columns: 1fr; gap: 25px; }
        }

        @yield('page-style')
    </style>
</head>

<body>

    <div class="page-background"></div>

    <nav class="navbar glass-strong">
    <div class="navbar-inner">

        <!-- LOGO -->
        <a href="{{ url('/') }}" class="logo-area">
            <img src="{{ asset('images/logo.1.png') }}" alt="PermataTruf.Id">
            <div class="logo-text">
                PermataTruf<span>.Id</span>
            </div>
        </a>

        <!-- MENU NAVBAR -->
        <div class="nav-links">
            <a href="{{ url('/') }}#beranda">Home</a>
            <a href="{{ route('lapangan.index') }}">Daftar Lapangan</a>
            <a href="{{ url('/') }}#cara-reservasi">Jadwal</a>
        </div>

        <!-- TOMBOL KANAN -->
        <div class="nav-buttons">

            @if (Route::has('login'))

                @auth

                    <a href="{{ url('/dashboard') }}"
                       class="btn-primary px-5 py-2 rounded-lg text-sm font-semibold no-underline">
                        Dashboard
                    </a>

                    <form method="POST"
                          action="{{ route('logout') }}"
                          style="display: inline;">
                        @csrf

                        <button type="submit"
                                class="btn-primary px-5 py-2 rounded-lg text-sm font-semibold"
                                style="border: none; cursor: pointer;">
                            Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}"
                       class="btn-primary px-5 py-2 rounded-lg text-sm font-semibold no-underline">
                        Login
                    </a>

                    @if (Route::has('register'))

                        <a href="{{ route('register') }}"
                           class="btn-outline px-5 py-2 rounded-lg text-sm font-semibold no-underline">
                            Daftar
                        </a>

                    @endif

                @endauth

            @endif

        </div>

    </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo.1.png') }}" alt="PermataTruf.Id">
                        <span>PermataTruf.Id</span>
                    </div>
                    <p class="footer-text">
                        PermataTruf.Id adalah platform reservasi lapangan mini soccer terbaik di Indonesia.
                        Kembangkan minat dan bakat bermain bola kapan saja secara real-time.
                    </p>
                </div>

                <div>
                    <div class="footer-title">Navigasi</div>
                    <div class="footer-links">
                        <a href="{{ url('/#beranda') }}">Beranda</a>
                        <a href="{{ route('lapangan.index') }}">Daftar Lapangan</a>
                        <a href="{{ url('/#cara-reservasi') }}">Jadwal</a>
                        <a href="#">FAQ</a>
                    </div>
                </div>

                <div id="kontak">
                    <div class="footer-title">Hubungi Kami</div>
                    <div class="footer-contact">
                        +62 851-2290-4538<br>
                        info@permataturf.id<br>
                        Jl. Permata Hijau Raya No. 12,<br>
                        Jakarta Selatan
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                © 2026 PermataTruf.Id. Hak Cipta Dilindungi.
                <div class="social-icons">
                    <a href="#">f</a>
                    <a href="#">𝕏</a>
                    <a href="#">◎</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>