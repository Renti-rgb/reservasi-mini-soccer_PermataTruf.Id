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
            rgba(105, 132, 95, 0.65) 0%,
            rgba(140, 180, 126, 0.53) 40%,
            #bfc2c100 100%
        );
}
            
.glass-strong {
    position: relative;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 40px;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}
.glass-strong::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(255,255,255,0.25),
        rgba(255,255,255,0.02) 50%,
        transparent 75%
    );
    pointer-events: none;
}
            .auth-wrapper {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 24px;
            }

            .auth-logo {
                display: flex;
                align-items: center;
                gap: 10px;
                text-decoration: none;
                color: #172033;
                margin-bottom: 24px;
            }
            .auth-logo img {
                width: 42px;
                height: 42px;
                object-fit: cover;
                border-radius: 50%;
            }
            .auth-logo span {
                font-size: 22px;
                font-weight: 800;
            }
            .auth-logo span em {
                color:linear-gradient(135deg, #477859 0%, #7eb190bb 50%, #15803d 100%);
                font-style: normal;
            }

            .auth-card {
    width: 100%;
    max-width: 420px;
    padding: 32px;
    border-radius: 40px;
}

            .auth-title {
    font-size: 24px;
    font-weight: 800;
    text-align: center;
    margin: 0 0 26px;
    color: #172033;
}

.auth-card input[type="text"],
.auth-card input[type="email"],
.auth-card input[type="password"] {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.75);
    outline: none;
    font-family: inherit;
    font-size: 14px;
    box-sizing: border-box;
    margin-bottom: 14px;
    transition: all 0.3s ease;
}
.auth-card input[type="text"]:focus,
.auth-card input[type="email"]:focus,
.auth-card input[type="password"]:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.9);
}

.auth-card input[type="text"]:focus,
.auth-card input[type="email"]:focus,
.auth-card input[type="password"]:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(138, 168, 149, 0.25);
    background: rgba(255,255,255,0.35);
}

.auth-card button[type="submit"] {
    width: 100%;
    background: radial-gradient(
        ellipse 70% 60% at 50% 50%,
        rgba(105, 132, 95, 0.65) 0%,
        rgba(140, 180, 126, 0.53) 40%,
        #bfc2c100 100%
    ), #eef7f4;
    color: #000000;
    text-shadow: none;
    border: 1px solid rgba(105, 132, 95, 0.4);
    padding: 13px 22px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.auth-card button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    color: #000000;
}
            
        </style>
    </head>
    <body>

        <div class="page-background"></div>

        <div class="auth-wrapper">

            <a href="{{ url('/') }}" class="auth-logo">
                <img src="{{ asset('images/logo.1.png') }}" alt="PermataTruf.Id">
                <span>PermataTruf<em>.Id</em></span>
            </a>

            <div class="auth-card glass-strong">
                {{ $slot }}
            </div>

        </div>

    </body>
</html>