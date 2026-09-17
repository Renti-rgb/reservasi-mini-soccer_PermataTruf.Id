<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PermataTruf.Id') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/logo.1.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { box-sizing: border-box; }
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
                        rgba(124, 148, 115, 0.35) 0%,
                        rgba(150, 175, 140, 0.2) 40%,
                        rgba(238, 247, 244, 0.1) 70%,
                        #eef7f4 100%
                    );
            }

            .glass {
                position: relative;
                background: rgba(255, 255, 255, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.6);
                border-radius: 30px;
                backdrop-filter: blur(25px) saturate(140%);
                -webkit-backdrop-filter: blur(25px) saturate(140%);
                box-shadow: 0 15px 40px rgba(0,0,0,0.08);
                overflow: hidden;
            }

            .app-navbar {
                position: sticky;
                top: 16px;
                z-index: 50;
                width: calc(100% - 40px);
                max-width: 1280px;
                margin: 16px auto 0;
                border-radius: 20px;
                background: rgba(255,255,255,0.6);
                border: 1px solid rgba(255,255,255,0.7);
                backdrop-filter: blur(30px) saturate(150%);
                -webkit-backdrop-filter: blur(30px) saturate(150%);
                box-shadow: 0 12px 35px rgba(25,75,55,0.10);
            }
            .app-navbar-inner {
                height: 72px;
                padding: 0 28px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .app-logo {
                display: flex;
                align-items: center;
                gap: 10px;
                text-decoration: none;
                color: #172033;
            }
            .app-logo img {
                width: 38px; height: 38px;
                object-fit: cover;
                border-radius: 50%;
            }
            .app-logo span {
                font-size: 20px;
                font-weight: 800;
            }
            .app-logo span em {
                color: #16a34a;
                font-style: normal;
            }
            .app-nav-links {
                display: flex;
                align-items: center;
                gap: 28px;
            }
            .app-nav-links a {
                text-decoration: none;
                color: #273447;
                font-size: 14px;
                font-weight: 600;
                transition: 0.2s;
            }
            .app-nav-links a:hover, .app-nav-links a.active {
                color: #16a34a;
            }

            .page-content {
                max-width: 1280px;
                width: calc(100% - 40px);
                margin: 32px auto;
            }

            .page-header {
                font-size: 26px;
                font-weight: 800;
                color: #172033;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>

        <div class="page-background"></div>

        <nav class="app-navbar">
            <div class="app-navbar-inner">
                <a href="{{ route('dashboard') }}" class="app-logo">
                    <img src="{{ asset('images/logo.1.png') }}" alt="PermataTruf.Id">
                    <span>PermataTruf<em>.Id</em></span>
                </a>

                <div class="app-nav-links">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('profile.edit') }}">Profil</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:#b91c1c; font-size:14px; font-weight:600; cursor:pointer; font-family:inherit; padding:0;">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="page-content">
            @isset($header)
                <div class="page-header">
                    {{ $header }}
                </div>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>

    </body>
</html>