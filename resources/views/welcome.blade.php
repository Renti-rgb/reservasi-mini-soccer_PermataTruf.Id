@extends('layouts.site')

@section('title', 'PermataTruf.Id - Reservasi Lapangan Mini Soccer')


@section('page-style')

/* =========================================================
   HERO
========================================================= */

.hero {
    padding: 42px 0 70px;
}

.hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    align-items: center;
}

.hero-content {
    padding: 34px;
    min-height: 360px;
    border-radius: 25px;
}

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 30px;
    color: #263443;
    font-size: 14px;
}

.hero-label span {
    color: #f59e0b;
}

.hero-small-title {
    color: #15803d;
    font-weight: 700;
    font-size: 15px;
    margin-bottom: 8px;
}

.hero-title {
    font-size: clamp(36px, 4vw, 56px);
    line-height: 1.08;
    font-weight: 800;
    margin: 0 0 16px;
    color: #172033;
}

.hero-description {
    max-width: 540px;
    color: #526173;
    line-height: 1.7;
    font-size: 16px;
    margin-bottom: 28px;
}

.hero-buttons {
    display: flex;
    gap: 16px;
}

.hero-buttons a {
    padding: 13px 24px;
    border-radius: 9px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
}


/* =========================================================
   HERO IMAGE
========================================================= */

.hero-image-wrapper {
    position: relative;
}

.hero-image-card {
    overflow: hidden;
    border-radius: 25px;
    padding: 8px;
}

.hero-image-card img {
    width: 100%;
    height: 360px;
    object-fit: cover;
    border-radius: 18px;
    display: block;
}

.quality-badge {
    position: absolute;
    right: 12px;
    bottom: -18px;
    background: rgba(255, 255, 255, 0.88);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.90);
    border-radius: 13px;
    padding: 10px 16px;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.10);
    font-size: 13px;
    font-weight: 600;
}

.quality-badge span {
    color: #f59e0b;
}


/* =========================================================
   DAFTAR LAPANGAN
========================================================= */

.fields-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    align-items: stretch;
}

.field-card {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    border-radius: 22px;
    background: rgba(255, 255, 255, 0.58);
    border: 1px solid rgba(255, 255, 255, 0.70);
    backdrop-filter: blur(20px) saturate(140%);
    -webkit-backdrop-filter: blur(20px) saturate(140%);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.07);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.field-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.11);
}


/* =========================================================
   GAMBAR LAPANGAN
========================================================= */

.field-image {
    width: 100%;
    height: 220px;
    overflow: hidden;
    flex-shrink: 0;
    background: #e5e7eb;
}

.field-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}

.field-card:hover .field-image img {
    transform: scale(1.04);
}


/* =========================================================
   KONTEN LAPANGAN
========================================================= */

.field-content {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 22px;
}

.field-name {
    margin: 0 0 10px;
    font-size: 18px;
    font-weight: 800;
    color: #172033;
}


/* =========================================================
   JENIS LAPANGAN
========================================================= */

.field-type {
    display: inline-flex;
    align-items: center;
    width: fit-content;
    padding: 7px 13px;
    margin-bottom: 14px;
    border-radius: 20px;
    background: rgba(187, 247, 208, 0.65);
    color: #15803d;
    font-size: 12px;
    font-weight: 700;
}


/* =========================================================
   DESKRIPSI
========================================================= */

.field-description {
    color: #687588;
    font-size: 13px;
    line-height: 1.6;
    min-height: 62px;
    margin: 0 0 14px;
}


/* =========================================================
   UKURAN
========================================================= */

.field-size {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #687588;
    font-size: 13px;
    margin-bottom: 14px;
}

.field-size strong {
    color: #526173;
}


/* =========================================================
   HARGA
========================================================= */

.field-price {
    color: #159447;
    font-size: 17px;
    font-weight: 800;
    margin-bottom: 14px;
}


/* =========================================================
   STATUS
========================================================= */

.field-status {
    display: inline-flex;
    align-items: center;
    width: fit-content;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 18px;
}

.field-status.available {
    background: rgba(187, 247, 208, 0.70);
    color: #14532d;
}

.field-status.limited {
    background: rgba(254, 243, 199, 0.85);
    color: #b45309;
}

.field-status.unavailable {
    background: rgba(254, 226, 226, 0.85);
    color: #b91c1c;
}


/* =========================================================
   TOMBOL LIHAT DETAIL
========================================================= */

.field-button {
    display: block;
    width: 100%;
    box-sizing: border-box;
    text-align: center;
    text-decoration: none;

    margin-top: auto;

    padding: 13px 16px;

    border-radius: 10px;

    font-size: 14px;
    font-weight: 700;

    color: #172033;

    background: linear-gradient(
        135deg,
        #dcfce7,
        #bbf7d0
    );

    border: 1px solid rgba(22, 163, 74, 0.20);

    box-shadow: 0 6px 16px rgba(22, 163, 74, 0.10);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        background 0.25s ease;
}

.field-button:hover {
    background: linear-gradient(
        135deg,
        #bbf7d0,
        #86efac
    );

    transform: translateY(-2px);

    box-shadow: 0 9px 22px rgba(22, 163, 74, 0.16);
}


/* =========================================================
   HOW IT WORKS
========================================================= */

.steps-box {
    position: relative;
    border-radius: 26px;
    padding: 38px 30px;
    background: rgba(255, 255, 255, 0.35);
    border: 1px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(25px) saturate(140%);
    -webkit-backdrop-filter: blur(25px) saturate(140%);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.step {
    text-align: center;
    position: relative;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin: 0 auto 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: white;
    font-size: 22px;
    box-shadow: 0 8px 18px rgba(22, 163, 74, 0.20);
}

.step h3 {
    font-size: 15px;
    margin: 0 0 8px;
    color: #172033;
}

.step p {
    font-size: 13px;
    line-height: 1.5;
    color: #687588;
    margin: 0;
}


/* =========================================================
   BENEFITS
========================================================= */

.benefits-box {
    position: relative;
    border-radius: 26px;
    padding: 35px 25px;
    background: rgba(255, 255, 255, 0.35);
    border: 1px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(25px) saturate(140%);
    -webkit-backdrop-filter: blur(25px) saturate(140%);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.benefit-card {
    position: relative;
    padding: 24px 18px;
    border-radius: 20px;
    text-align: center;
    background: rgba(255, 255, 255, 0.35);
    border: 1px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(20px) saturate(140%);
    -webkit-backdrop-filter: blur(20px) saturate(140%);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.10);
}

.benefit-icon {
    width: 46px;
    height: 46px;
    margin: 0 auto 14px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: white;
    font-size: 19px;
    box-shadow: 0 7px 16px rgba(22, 163, 74, 0.18);
}

.benefit-card h3 {
    font-size: 14px;
    margin: 0 0 8px;
    color: #172033;
}

.benefit-card p {
    color: #687588;
    font-size: 12px;
    line-height: 1.5;
    margin: 0;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1000px) {

    .fields-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .steps-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .benefits-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 900px) {

    .hero-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {

    .hero-content {
        padding: 24px;
    }

    .hero-title {
        font-size: 34px;
    }

    .hero-buttons {
        flex-direction: column;
    }

    .fields-grid {
        grid-template-columns: 1fr;
    }

    .steps-grid {
        grid-template-columns: 1fr;
    }

    .benefits-grid {
        grid-template-columns: 1fr;
    }
}

@endsection


@section('content')

<main id="beranda">


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="hero">

        <div class="container">

            <div class="hero-grid">


                {{-- HERO LEFT --}}

                <div class="hero-content glass">

                    <div class="hero-label">

                        <span>⚡</span>

                        Platform Reservasi Tercepat #1

                    </div>


                    <div class="hero-small-title">

                        Pesan Sekarang, Mainkan Nanti!

                    </div>


                    <h1 class="hero-title">

                        Reservasi Lapangan
                        Mini Soccer dengan Mudah

                    </h1>


                    <p class="hero-description">

                        Lihat ketersediaan lapangan, jadwal,
                        harga, dan lakukan reservasi secara online.
                        Praktis, cepat, dan terpercaya.

                    </p>


                    <div class="hero-buttons">

                        @if (Route::has('register'))

                            <a
                                href="{{ route('register') }}"
                                class="btn-primary"
                            >
                                Booking Sekarang
                            </a>

                        @endif


                        <a
                            href="#daftar-lapangan"
                            class="btn-outline"
                        >
                            Lihat Lapangan
                        </a>

                    </div>

                </div>


                {{-- HERO RIGHT --}}

                <div class="hero-image-wrapper">

                    <div class="hero-image-card glass">

                        <img
                            src="{{ asset('images/hero-lapangan.jpeg') }}"
                            alt="Lapangan Mini Soccer"
                        >

                    </div>


                    <div class="quality-badge">

                        <span>⭐</span>

                        Rumput Sintetis Quality

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- =====================================================
         DAFTAR LAPANGAN
    ====================================================== --}}

    <section
        id="daftar-lapangan"
        class="section"
    >

        <div class="container">


            <div class="section-header">

                <div class="section-label">

                    Daftar Lapangan

                </div>


                <h2 class="section-title">

                    Lapangan Pilihan

                </h2>


                <p class="section-description">

                    Temukan lapangan terbaik untuk pertandingan Anda

                </p>

            </div>



            {{-- =================================================
                 MENCARI LAPANGAN A - F DARI DATABASE
            ================================================== --}}

            @php

                /*
                |--------------------------------------------------------------------------
                | MENCARI DATA LAPANGAN A - F
                |--------------------------------------------------------------------------
                |
                | Data nama, jenis, harga, deskripsi, ukuran,
                | ketersediaan, dan slug tetap berasal dari database.
                |
                | Gambar TIDAK diambil dari database karena file gambar
                | berada langsung di public/images.
                |
                */

                $lapanganByKode = collect();

                foreach (range('A', 'F') as $kode) {

                    $lapangan = $lapangans->first(function ($item) use ($kode) {

                        return preg_match(
                            '/^Lapangan\s+' . preg_quote($kode, '/') . '\b/i',
                            trim($item->nama)
                        );

                    });


                    if ($lapangan) {

                        $lapanganByKode->put(
                            $kode,
                            $lapangan
                        );

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | PEMETAAN GAMBAR LAPANGAN
                |--------------------------------------------------------------------------
                |
                | Semua gambar berada di:
                |
                | public/images/
                |
                */

                $imageMap = [

                    'A' => 'lapangan-a.png',

                    'B' => 'lapangan-b.jpeg',

                    'C' => 'lapangan-c.jpeg',

                    'D' => 'lapangan-d.jpeg',

                    'E' => 'lapangan-e.jpeg',

                    'F' => 'lapangan-f.jpeg',

                ];

            @endphp



            {{-- =================================================
                 GRID LAPANGAN A - F
            ================================================== --}}

            <div class="fields-grid">


                @foreach (range('A', 'F') as $kode)

                    @php

                        $lapangan = $lapanganByKode->get($kode);

                        $imageFile = $imageMap[$kode];

                    @endphp


                    @if ($lapangan)


                        <div class="field-card">


                            {{-- =================================
                                 GAMBAR LAPANGAN
                            ================================== --}}

                            <div class="field-image">

                                <img
                                    src="{{ asset('images/' . $imageFile) }}"
                                    alt="{{ $lapangan->nama }}"
                                    onerror="
                                        this.onerror=null;
                                        this.src='{{ asset('images/hero-lapangan.jpeg') }}';
                                    "
                                >

                            </div>



                            {{-- =================================
                                 KONTEN LAPANGAN
                            ================================== --}}

                            <div class="field-content">


                                {{-- NAMA --}}

                                <h3 class="field-name">

                                    {{ $lapangan->nama }}

                                </h3>



                                {{-- JENIS --}}

                                @if (!empty($lapangan->jenis))


                                    <div class="field-type">

                                        {{ $lapangan->jenis }}

                                    </div>


                                @endif



                                {{-- DESKRIPSI --}}

                                @if (!empty($lapangan->deskripsi))


                                    <p class="field-description">

                                        {{ $lapangan->deskripsi }}

                                    </p>


                                @else


                                    <p class="field-description">

                                        Lapangan mini soccer
                                        dengan fasilitas terbaik
                                        untuk kebutuhan bermain Anda.

                                    </p>


                                @endif



                                {{-- UKURAN --}}

                                @if (!empty($lapangan->ukuran))


                                    <div class="field-size">

                                        <span>📐</span>

                                        <span>

                                            Ukuran:

                                            <strong>

                                                {{ $lapangan->ukuran }}

                                            </strong>

                                        </span>

                                    </div>


                                @endif



                                {{-- HARGA --}}

                                <div class="field-price">

                                    Rp{{ number_format(
                                        $lapangan->harga_per_jam,
                                        0,
                                        ',',
                                        '.'
                                    ) }}/jam

                                </div>



                                {{-- STATUS KETERSEDIAAN --}}

                                @if ($lapangan->ketersediaan === 'tersedia')


                                    <div class="field-status available">

                                        • Tersedia

                                    </div>


                                @elseif ($lapangan->ketersediaan === 'tidak_tersedia')


                                    <div class="field-status unavailable">

                                        • Tidak Tersedia

                                    </div>


                                @else


                                    <div class="field-status limited">

                                        • Terbatas

                                    </div>


                                @endif



                                {{-- TOMBOL DETAIL --}}

                                <a
                                    href="{{ route(
                                        'lapangan.show',
                                        $lapangan->slug
                                    ) }}"
                                    class="field-button"
                                >

                                    Lihat Detail

                                </a>


                            </div>


                        </div>


                    @endif


                @endforeach



                {{-- =================================================
                     JIKA DATABASE TIDAK MEMILIKI DATA
                ================================================== --}}

                @if ($lapanganByKode->isEmpty())


                    <div
                        style="
                            grid-column: 1 / -1;
                            text-align: center;
                            padding: 50px 20px;
                        "
                    >

                        <h3>

                            Belum ada lapangan tersedia.

                        </h3>


                        <p>

                            Silakan kembali lagi nanti.

                        </p>

                    </div>


                @endif


            </div>

        </div>

    </section>



    {{-- =====================================================
         CARA RESERVASI
    ====================================================== --}}

    <section
        id="cara-reservasi"
        class="section"
    >

        <div class="container">


            <div class="steps-box">


                <div class="section-header">

                    <div class="section-label">

                        Alur Pembooking

                    </div>


                    <h2 class="section-title">

                        Cara Reservasi

                    </h2>


                    <p class="section-description">

                        Proses booking mudah hanya dalam 4 langkah

                    </p>

                </div>



                <div class="steps-grid">


                    {{-- STEP 1 --}}

                    <div class="step">

                        <div class="step-icon">

                            🔍

                        </div>


                        <h3>

                            Pilih Lapangan

                        </h3>


                        <p>

                            Jelajahi dan pilih lapangan
                            yang sesuai kebutuhan Anda.

                        </p>

                    </div>



                    {{-- STEP 2 --}}

                    <div class="step">

                        <div class="step-icon">

                            📅

                        </div>


                        <h3>

                            Pilih Jadwal

                        </h3>


                        <p>

                            Tentukan tanggal dan jam bermain
                            yang tersedia.

                        </p>

                    </div>



                    {{-- STEP 3 --}}

                    <div class="step">

                        <div class="step-icon">

                            ✓

                        </div>


                        <h3>

                            Konfirmasi

                        </h3>


                        <p>

                            Periksa detail dan konfirmasi
                            pemesanan Anda.

                        </p>

                    </div>



                    {{-- STEP 4 --}}

                    <div class="step">

                        <div class="step-icon">

                            ⬆

                        </div>


                        <h3>

                            Upload Bukti

                        </h3>


                        <p>

                            Unggah bukti transfer untuk
                            menyelesaikan booking.

                        </p>

                    </div>


                </div>

            </div>

        </div>

    </section>



    {{-- =====================================================
         KEUNGGULAN
    ====================================================== --}}

    <section class="section">

        <div class="container">


            <div class="benefits-box">


                <div class="section-header">

                    <div class="section-label">

                        Mengapa Kami

                    </div>


                    <h2 class="section-title">

                        Keunggulan PermataTruf.Id

                    </h2>


                    <p class="section-description">

                        Mengapa memilih kami untuk reservasi lapangan Anda

                    </p>

                </div>



                <div class="benefits-grid">


                    {{-- BENEFIT 1 --}}

                    <div class="benefit-card">

                        <div class="benefit-icon">

                            📅

                        </div>


                        <h3>

                            Jadwal Real-Time

                        </h3>


                        <p>

                            Ketersediaan lapangan bisa dilihat
                            secara langsung dan akurat.

                        </p>

                    </div>



                    {{-- BENEFIT 2 --}}

                    <div class="benefit-card">

                        <div class="benefit-icon">

                            🌐

                        </div>


                        <h3>

                            Reservasi Online

                        </h3>


                        <p>

                            Booking kapan saja dan dari mana saja
                            tanpa perlu datang.

                        </p>

                    </div>



                    {{-- BENEFIT 3 --}}

                    <div class="benefit-card">

                        <div class="benefit-icon">

                            💳

                        </div>


                        <h3>

                            Pembayaran Mudah

                        </h3>


                        <p>

                            Opsi pembayaran beragam,
                            konfirmasi cepat dan aman.

                        </p>

                    </div>



                    {{-- BENEFIT 4 --}}

                    <div class="benefit-card">

                        <div class="benefit-icon">

                            ✓

                        </div>


                        <h3>

                            Status Reservasi Jelas

                        </h3>


                        <p>

                            Lacak status booking Anda
                            secara transparan.

                        </p>

                    </div>


                </div>

            </div>

        </div>

    </section>


</main>

@endsection