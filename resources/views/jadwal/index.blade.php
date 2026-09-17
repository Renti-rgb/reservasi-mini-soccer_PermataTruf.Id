@extends('layouts.site')

@section('title', 'Jadwal Lapangan - PermataTruf.Id')

@section('content')

<style>
    .jadwal-page {
        padding-top: 140px;
        padding-bottom: 60px;
    }

    .jadwal-header {
        margin-bottom: 24px;
    }

    .jadwal-filter {
        padding: 20px;
        margin-bottom: 30px;
        border-radius: 18px;
    }

    .jadwal-filter-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .jadwal-filter-label {
        font-size: 13px;
        font-weight: 700;
        color: #172033;
    }

    .jadwal-date-input {
        padding: 11px 14px;
        border: 1px solid rgba(20, 100, 60, 0.15);
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.65);
        outline: none;
        font-family: inherit;
        font-size: 13px;
        color: #172033;
    }

    .jadwal-field-card {
        padding: 22px;
        margin-bottom: 22px;
        border-radius: 20px;
    }

    .jadwal-field-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .jadwal-field-title {
        margin: 0 0 5px;
        font-size: 19px;
        font-weight: 800;
        color: #172033;
    }

    .jadwal-field-meta {
        margin: 0;
        font-size: 12px;
        color: #687588;
    }

    .jadwal-detail-button {
        text-decoration: none;
        padding: 9px 15px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .jadwal-slot-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 12px;
    }

    .jadwal-slot {
        display: block;
        padding: 14px;
        border-radius: 12px;
        text-align: center;
        transition: all 0.2s ease;
    }

    .jadwal-slot-available {
        background: rgba(34, 197, 94, 0.08);
        border: 1px solid rgba(34, 197, 94, 0.20);
        text-decoration: none;
        cursor: pointer;
    }

    .jadwal-slot-available:hover {
        transform: translateY(-2px);
        background: rgba(34, 197, 94, 0.13);
        border-color: rgba(34, 197, 94, 0.30);
    }

    .jadwal-slot-filled {
        background: rgba(148, 163, 184, 0.10);
        border: 1px solid rgba(148, 163, 184, 0.20);
    }

    .jadwal-slot-time {
        font-size: 14px;
        font-weight: 800;
    }

    .jadwal-slot-available .jadwal-slot-time {
        color: #15803d;
    }

    .jadwal-slot-filled .jadwal-slot-time {
        color: #64748b;
    }

    .jadwal-slot-status {
        margin-top: 5px;
        font-size: 11px;
        font-weight: 700;
    }

    .jadwal-slot-available .jadwal-slot-status {
        color: #16a34a;
    }

    .jadwal-slot-filled .jadwal-slot-status {
        color: #64748b;
    }

    .jadwal-empty {
        padding: 25px;
        border-radius: 12px;
        background: rgba(148, 163, 184, 0.08);
        text-align: center;
    }

    .jadwal-empty p {
        margin: 0;
        color: #687588;
        font-size: 13px;
    }

    @media (max-width: 1000px) {
        .jadwal-slot-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .jadwal-page {
            padding-top: 110px;
        }

        .jadwal-filter-row {
            align-items: stretch;
            flex-direction: column;
        }

        .jadwal-date-input,
        .jadwal-filter .btn-primary {
            width: 100%;
        }

        .jadwal-slot-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 420px) {
        .jadwal-slot-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="section jadwal-page">
    <div class="container">

        {{-- HEADER --}}
        <div class="section-header jadwal-header">
            <div class="section-label">Jadwal Lapangan</div>

            <h2 class="section-title">
                Pilih Jadwal
            </h2>

            <p class="section-description">
                Lihat ketersediaan jadwal lapangan berdasarkan tanggal
            </p>
        </div>

        {{-- PILIH TANGGAL --}}
        <div class="glass jadwal-filter">
            <form method="GET" action="{{ route('jadwal.index') }}">
                <div class="jadwal-filter-row">
                    <label for="tanggal" class="jadwal-filter-label">
                        Pilih Tanggal:
                    </label>

                    <input
                        id="tanggal"
                        type="date"
                        name="tanggal"
                        value="{{ $tanggal }}"
                        min="{{ now()->toDateString() }}"
                        class="jadwal-date-input"
                    >

                    <button
                        type="submit"
                        class="btn-primary"
                        style="
                            border: none;
                            padding: 11px 22px;
                            border-radius: 10px;
                            font-family: inherit;
                            font-size: 13px;
                            font-weight: 700;
                            cursor: pointer;
                        "
                    >
                        Lihat Jadwal
                    </button>
                </div>
            </form>
        </div>

        {{-- DAFTAR JADWAL PER LAPANGAN --}}
        @forelse ($lapangans as $lapangan)
            <div class="glass jadwal-field-card">

                {{-- HEADER LAPANGAN --}}
                <div class="jadwal-field-header">
                    <div>
                        <h3 class="jadwal-field-title">
                            {{ $lapangan->nama }}
                        </h3>

                        <p class="jadwal-field-meta">
                            {{ $lapangan->jenis }} • {{ $lapangan->ukuran }}
                        </p>
                    </div>

                    <a
                        href="{{ route('lapangan.show', $lapangan->slug) }}"
                        class="btn-outline jadwal-detail-button"
                    >
                        Detail Lapangan
                    </a>
                </div>

                {{-- SLOT JADWAL --}}
                @php
                    $slotJadwal = $jadwals
                        ->get($lapangan->id, collect())
                        ->sortBy('jam_mulai');
                @endphp

                @if ($slotJadwal->count() > 0)
                    <div class="jadwal-slot-grid">

                        @foreach ($slotJadwal as $jadwal)
                            @php
                                $jamMulai = \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i');
                                $jamSelesai = \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i');
                            @endphp

                            {{-- SLOT TERSEDIA --}}
                            @if ($jadwal->status === 'tersedia')
                                <a
                                    href="{{ route('reservasi.pilihJadwal', [
                                        'lapangan' => $lapangan->slug,
                                        'tanggal' => $tanggal,
                                    ]) }}"
                                    class="jadwal-slot jadwal-slot-available"
                                >
                                    <div class="jadwal-slot-time">
                                        {{ $jamMulai }} - {{ $jamSelesai }}
                                    </div>

                                    <div class="jadwal-slot-status">
                                        ● Tersedia
                                    </div>
                                </a>

                            {{-- SLOT TERISI --}}
                            @else
                                <div class="jadwal-slot jadwal-slot-filled">
                                    <div class="jadwal-slot-time">
                                        {{ $jamMulai }} - {{ $jamSelesai }}
                                    </div>

                                    <div class="jadwal-slot-status">
                                        ● Terisi
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>

                {{-- JIKA BELUM ADA JADWAL --}}
                @else
                    <div class="jadwal-empty">
                        <p>
                            Belum ada jadwal untuk tanggal {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}.
                        </p>
                    </div>
                @endif

            </div>
        @empty
            <div class="glass jadwal-empty">
                <p>
                    Belum ada lapangan aktif yang tersedia.
                </p>
            </div>
        @endforelse

    </div>
</section>

@endsection
