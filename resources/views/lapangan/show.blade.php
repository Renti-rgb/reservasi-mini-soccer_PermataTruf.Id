@extends('layouts.site')

@section('title', $lapangan->nama . ' - PermataTruf.Id')

@section('content')

<section class="section" style="padding-top: 140px;">
    <div class="container">

        {{-- BREADCRUMB --}}
        <div style="margin-bottom: 24px; font-size: 13px; color: #687588;">
            <a href="{{ route('lapangan.index') }}" style="color: #159447; text-decoration: none; font-weight: 600;">
                Daftar Lapangan
            </a>
            <span style="margin: 0 6px;">/</span>
            {{ $lapangan->nama }}
        </div>

        <div style="display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 32px; align-items: start;">

            {{-- GAMBAR --}}
            <div class="glass" style="padding: 10px; border-radius: 22px;">
                <img
                    src="{{ asset('images/' . $lapangan->gambar) }}"
                    alt="{{ $lapangan->nama }}"
                    style="width: 100%; height: 420px; object-fit: cover; border-radius: 16px; display: block;"
                >
            </div>

            {{-- INFO --}}
            <div class="glass-strong" style="padding: 32px; border-radius: 22px;">

                <div style="
                    display: inline-block;
                    padding: 6px 14px;
                    border-radius: 20px;
                    background: rgba(34, 197, 94, 0.10);
                    color: #15803d;
                    font-size: 12px;
                    font-weight: 700;
                    margin-bottom: 14px;
                ">
                    {{ $lapangan->jenis }}
                </div>

                <h1 style="font-size: 28px; font-weight: 800; color: #172033; margin: 0 0 12px;">
                    {{ $lapangan->nama }}
                </h1>

                <p style="color: #627084; line-height: 1.7; font-size: 14px; margin-bottom: 22px;">
                    {{ $lapangan->deskripsi }}
                </p>

                <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 22px;">

                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(20,100,60,0.08);">
                        <span style="color: #687588; font-size: 13px;">📐 Ukuran</span>
                        <strong style="font-size: 13px;">{{ $lapangan->ukuran }}</strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(20,100,60,0.08);">
                        <span style="color: #687588; font-size: 13px;">🏟️ Jenis Rumput</span>
                        <strong style="font-size: 13px;">{{ $lapangan->jenis }}</strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 0;">
                        <span style="color: #687588; font-size: 13px;">Status</span>
                        @if ($lapangan->ketersediaan === 'tersedia')
                            <strong style="font-size: 13px; color: #15803d;">● Tersedia</strong>
                        @elseif ($lapangan->ketersediaan === 'terbatas')
                            <strong style="font-size: 13px; color: #b45309;">● Terbatas</strong>
                        @else
                            <strong style="font-size: 13px; color: #b91c1c;">● Tidak Tersedia</strong>
                        @endif
                    </div>

                </div>

                <div class="field-price" style="font-size: 22px; margin-bottom: 18px;">
                    Rp{{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}/jam
                </div>

                <a href="{{ route('reservasi.pilihJadwal', $lapangan->slug) }}" class="btn-primary">
    Reservasi Sekarang
</a>

            </div>

        </div>

    </div>
</section>

@endsection