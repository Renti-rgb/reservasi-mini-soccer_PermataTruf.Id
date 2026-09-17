@extends('layouts.site')

@section('title', 'Pilih Jadwal - PermataTruf.Id')

@section('content')

<section class="section" style="padding-top: 140px;">
    <div class="container">

        {{-- HEADER --}}
        <div class="section-header">

            <div class="section-label">
                Reservasi
            </div>

            <h2 class="section-title">
                Pilih Jadwal
            </h2>

            <p class="section-description">
                Pilih tanggal dan jam yang tersedia untuk
                <strong>{{ $lapangan->nama }}</strong>
            </p>

        </div>


        {{-- INFO LAPANGAN --}}
        <div class="glass" style="
            padding: 25px;
            margin-bottom: 25px;
            border-radius: 30px;
        ">

            <div style="
                display: flex;
                align-items: center;
                gap: 20px;
                flex-wrap: wrap;
            ">

                {{-- GAMBAR LAPANGAN --}}
                <img
                    src="{{ asset('images/' . $lapangan->gambar) }}"
                    alt="{{ $lapangan->nama }}"
                    style="
                        width: 120px;
                        height: 80px;
                        object-fit: cover;
                        border-radius: 16px;
                    "
                >

                {{-- INFORMASI LAPANGAN --}}
                <div>

                    <h3 style="
                        margin: 0 0 6px;
                        font-size: 20px;
                    ">
                        {{ $lapangan->nama }}
                    </h3>

                    <p style="
                        margin: 0;
                        color: #627084;
                        font-size: 13px;
                    ">
                        {{ $lapangan->jenis }} •
                        {{ $lapangan->ukuran }}
                    </p>

                    <div style="
                        margin-top: 8px;
                        font-weight: 700;
                        color: #15803d;
                    ">
                        Rp{{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}/jam
                    </div>

                </div>

            </div>

        </div>


        {{-- PILIH TANGGAL --}}
        <div class="glass" style="
            padding: 25px;
            margin-bottom: 25px;
            border-radius: 30px;
        ">

            <form
                method="GET"
                action="{{ route('reservasi.pilihJadwal', $lapangan->slug) }}"
            >

                <label style="
                    display: block;
                    margin-bottom: 8px;
                    font-size: 13px;
                    font-weight: 700;
                    color: #172033;
                ">
                    Pilih Tanggal
                </label>

                <div style="
                    display: flex;
                    gap: 12px;
                    align-items: center;
                    flex-wrap: wrap;
                ">

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ $tanggal }}"
                        min="{{ now()->toDateString() }}"
                        style="
                            padding: 12px 15px;
                            border: 1px solid rgba(20, 100, 60, 0.15);
                            border-radius: 12px;
                            background: rgba(255,255,255,0.75);
                            outline: none;
                            font-family: inherit;
                            font-size: 13px;
                        "
                    >

                    <button
                        type="submit"
                        class="btn-primary"
                        style="
                            border: none;
                            padding: 12px 22px;
                            border-radius: 12px;
                            font-family: inherit;
                            font-size: 13px;
                            font-weight: 700;
                            cursor: pointer;
                        "
                    >
                        Tampilkan Jadwal
                    </button>

                </div>

            </form>

        </div>


        {{-- DAFTAR JADWAL --}}
        <div class="glass" style="
            padding: 25px;
            border-radius: 30px;
        ">

            {{-- JUDUL JADWAL --}}
            <div style="
                margin-bottom: 20px;
            ">

                <h3 style="
                    margin: 0 0 5px;
                    font-size: 20px;
                ">
                    Jadwal Tanggal
                </h3>

                <p style="
                    margin: 0;
                    color: #627084;
                    font-size: 13px;
                ">
                    {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                </p>

            </div>


            {{-- PESAN BERHASIL --}}
            @if (session('success'))

                <div style="
                    margin-bottom: 20px;
                    padding: 14px 18px;
                    border-radius: 12px;
                    background: rgba(34, 197, 94, 0.10);
                    border: 1px solid rgba(34, 197, 94, 0.20);
                    color: #15803d;
                    font-size: 13px;
                    font-weight: 600;
                ">
                    {{ session('success') }}
                </div>

            @endif


            {{-- PESAN ERROR --}}
            @if ($errors->any())

                <div style="
                    margin-bottom: 20px;
                    padding: 14px 18px;
                    border-radius: 12px;
                    background: rgba(239, 68, 68, 0.10);
                    border: 1px solid rgba(239, 68, 68, 0.20);
                    color: #b91c1c;
                    font-size: 13px;
                ">

                    @foreach ($errors->all() as $error)

                        <div style="margin-bottom: 4px;">
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            {{-- JIKA ADA JADWAL --}}
            @if ($jadwals->count() > 0)

                <div style="
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                    gap: 15px;
                ">

                    @foreach ($jadwals as $jadwal)

                        {{-- ==========================================
                             JADWAL TERSEDIA
                             ========================================== --}}
                        @if ($jadwal->status === 'tersedia')

                            <form
                                method="POST"
                                action="{{ route('reservasi.store') }}"
                                style="margin: 0;"
                            >

                                @csrf

                                {{-- 
                                    ID JADWAL YANG DIPILIH USER
                                    Akan diterima oleh ReservasiController
                                --}}
                                <input
                                    type="hidden"
                                    name="jadwal_id"
                                    value="{{ $jadwal->id }}"
                                >

                                <button
                                    type="submit"
                                    style="
                                        width: 100%;
                                        padding: 18px;
                                        border-radius: 18px;
                                        background: rgba(255,255,255,0.45);
                                        border: 1px solid rgba(34,197,94,0.30);
                                        backdrop-filter: blur(15px);
                                        -webkit-backdrop-filter: blur(15px);
                                        transition: all 0.3s ease;
                                        cursor: pointer;
                                        text-align: left;
                                        font-family: inherit;
                                        color: inherit;
                                    "
                                    onmouseover="
                                        this.style.transform='translateY(-3px)';
                                        this.style.boxShadow='0 10px 25px rgba(34,197,94,0.15)';
                                    "
                                    onmouseout="
                                        this.style.transform='translateY(0)';
                                        this.style.boxShadow='none';
                                    "
                                >

                                    {{-- JAM --}}
                                    <div style="
                                        font-size: 18px;
                                        font-weight: 800;
                                        margin-bottom: 8px;
                                    ">
                                        {{ substr($jadwal->jam_mulai, 0, 5) }}
                                        -
                                        {{ substr($jadwal->jam_selesai, 0, 5) }}
                                    </div>


                                    {{-- STATUS --}}
                                    <div style="
                                        display: inline-block;
                                        padding: 5px 10px;
                                        border-radius: 20px;
                                        background: rgba(34,197,94,0.12);
                                        color: #15803d;
                                        font-size: 11px;
                                        font-weight: 700;
                                    ">
                                        ● Tersedia
                                    </div>


                                    {{-- PETUNJUK --}}
                                    <div style="
                                        margin-top: 10px;
                                        font-size: 11px;
                                        color: #687588;
                                    ">
                                        Klik untuk memilih jadwal
                                    </div>

                                </button>

                            </form>


                        {{-- ==========================================
                             JADWAL SUDAH TERISI
                             ========================================== --}}
                        @else

                            <div style="
                                padding: 18px;
                                border-radius: 18px;
                                background: rgba(255,255,255,0.20);
                                border: 1px solid rgba(255,255,255,0.25);
                                opacity: 0.65;
                            ">

                                {{-- JAM --}}
                                <div style="
                                    font-size: 18px;
                                    font-weight: 800;
                                    margin-bottom: 8px;
                                ">
                                    {{ substr($jadwal->jam_mulai, 0, 5) }}
                                    -
                                    {{ substr($jadwal->jam_selesai, 0, 5) }}
                                </div>


                                {{-- STATUS --}}
                                <div style="
                                    display: inline-block;
                                    padding: 5px 10px;
                                    border-radius: 20px;
                                    background: rgba(239,68,68,0.10);
                                    color: #b91c1c;
                                    font-size: 11px;
                                    font-weight: 700;
                                ">
                                    ● Sudah Terisi
                                </div>

                            </div>

                        @endif

                    @endforeach

                </div>


            {{-- ==========================================
                 JIKA BELUM ADA JADWAL
                 ========================================== --}}
            @else

                <div style="
                    padding: 40px;
                    text-align: center;
                ">

                    <div style="
                        font-size: 40px;
                        margin-bottom: 12px;
                    ">
                        📅
                    </div>

                    <h3 style="
                        margin: 0 0 8px;
                        font-size: 18px;
                    ">
                        Belum Ada Jadwal
                    </h3>

                    <p style="
                        margin: 0;
                        color: #687588;
                        font-size: 13px;
                    ">
                        Belum tersedia jadwal untuk tanggal yang dipilih.
                    </p>

                </div>

            @endif

        </div>

    </div>
</section>

@endsection