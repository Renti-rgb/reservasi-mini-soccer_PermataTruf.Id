@extends('layouts.site')

@section('title', 'Riwayat Reservasi - PermataTruf.Id')

@section('page-style')

.reservasi-page {
    padding-top: 140px;
    padding-bottom: 60px;
}

.page-header {
    margin-bottom: 30px;
}

.page-header h1 {
    margin: 0 0 8px;
    font-size: 28px;
    font-weight: 800;
    color: #172033;
}

.page-header p {
    margin: 0;
    color: #687588;
    font-size: 14px;
}

.reservasi-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.reservasi-card {
    padding: 22px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.45);
    border: 1px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(20px) saturate(140%);
    -webkit-backdrop-filter: blur(20px) saturate(140%);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
}

.reservasi-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 18px;
}

.kode-reservasi {
    font-size: 15px;
    font-weight: 800;
    color: #172033;
}

.reservasi-date {
    font-size: 12px;
    color: #687588;
    margin-top: 4px;
}

.status-badge {
    display: inline-block;
    padding: 6px 13px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.reservasi-info {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    padding-top: 16px;
    border-top: 1px solid rgba(0, 0, 0, 0.06);
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.info-label {
    font-size: 11px;
    color: #687588;
    font-weight: 700;
}

.info-value {
    font-size: 13px;
    color: #172033;
    font-weight: 600;
}

.reservasi-bottom {
    display: flex;
    justify-content: flex-end;
    margin-top: 18px;
}

.btn-detail {
    display: inline-block;
    padding: 9px 16px;
    border-radius: 9px;
    background: radial-gradient(
        ellipse 70% 60% at 50% 50%,
        rgba(105, 132, 95, 0.65) 0%,
        rgba(140, 180, 126, 0.53) 40%,
        #bfc2c100 100%
    ), #eef7f4;
    color: #000000;
    border: 1px solid rgba(105, 132, 95, 0.4);
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.btn-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    color: #000000;
}

.empty-state {
    padding: 50px 30px;
    border-radius: 20px;
    text-align: center;
    background: rgba(255, 255, 255, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(20px);
}

.empty-icon {
    font-size: 42px;
    margin-bottom: 12px;
}

.empty-state h3 {
    margin: 0 0 7px;
    font-size: 18px;
    color: #172033;
}

.empty-state p {
    margin: 0;
    color: #687588;
    font-size: 13px;
}

.pagination-wrapper {
    margin-top: 25px;
}

@media (max-width: 700px) {

    .reservasi-page {
        padding-top: 120px;
    }

    .page-header h1 {
        font-size: 23px;
    }

    .reservasi-top {
        align-items: flex-start;
        flex-direction: column;
    }

    .reservasi-info {
        grid-template-columns: 1fr;
    }

    .reservasi-bottom {
        justify-content: flex-start;
    }

}

@endsection


@section('content')

<section class="section reservasi-page">

    <div class="container">

        {{-- HEADER --}}

        <div class="page-header">

            <h1>
                Riwayat Reservasi
            </h1>

            <p>
                Daftar reservasi yang telah selesai, ditolak, atau dibatalkan.
            </p>

        </div>


        {{-- DAFTAR RIWAYAT --}}

        @if ($reservasis->count() > 0)

            <div class="reservasi-list">

                @foreach ($reservasis as $reservasi)

                    @php

                        $statusMap = [

                            'selesai' => [
                                'Selesai',
                                '#1d4ed8',
                                'rgba(59,130,246,0.12)'
                            ],

                            'ditolak' => [
                                'Ditolak',
                                '#b91c1c',
                                'rgba(239,68,68,0.10)'
                            ],

                            'dibatalkan' => [
                                'Dibatalkan',
                                '#b91c1c',
                                'rgba(239,68,68,0.10)'
                            ],

                        ];

                        $statusInfo =
                            $statusMap[$reservasi->status]
                            ?? [
                                '-',
                                '#64748b',
                                'rgba(148,163,184,0.15)'
                            ];

                    @endphp


                    <div class="reservasi-card">

                        {{-- BAGIAN ATAS --}}

                        <div class="reservasi-top">

                            <div>

                                <div class="kode-reservasi">
                                    {{ $reservasi->kode_reservasi }}
                                </div>

                                <div class="reservasi-date">

                                    Dibuat
                                    {{ $reservasi->created_at
                                        ? $reservasi->created_at->format('d M Y, H:i')
                                        : '-'
                                    }}

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <span
                                class="status-badge"
                                style="
                                    color: {{ $statusInfo[1] }};
                                    background: {{ $statusInfo[2] }};
                                "
                            >
                                {{ $statusInfo[0] }}
                            </span>

                        </div>


                        {{-- INFORMASI --}}

                        <div class="reservasi-info">


                            {{-- LAPANGAN --}}

                            <div class="info-item">

                                <span class="info-label">
                                    Lapangan
                                </span>

                                <span class="info-value">
                                    {{ $reservasi->lapangan->nama ?? '-' }}
                                </span>

                            </div>


                            {{-- JADWAL --}}

                            <div class="info-item">

                                <span class="info-label">
                                    Jadwal
                                </span>

                                <span class="info-value">

                                    @if ($reservasi->jadwal)

                                        {{ \Illuminate\Support\Carbon::parse(
                                            $reservasi->jadwal->tanggal
                                        )->format('d M Y') }}

                                        <br>

                                        {{ substr(
                                            $reservasi->jadwal->jam_mulai,
                                            0,
                                            5
                                        ) }}

                                        -

                                        {{ substr(
                                            $reservasi->jadwal->jam_selesai,
                                            0,
                                            5
                                        ) }}

                                    @else

                                        -

                                    @endif

                                </span>

                            </div>


                            {{-- TOTAL --}}

                            <div class="info-item">

                                <span class="info-label">
                                    Total Harga
                                </span>

                                <span class="info-value">

                                    Rp{{ number_format(
                                        $reservasi->total_harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </div>

                        </div>


                        {{-- DETAIL --}}

                        <div class="reservasi-bottom">

                            <a
                                href="{{ route(
                                    'reservasi.detail',
                                    $reservasi->id
                                ) }}"
                                class="btn-detail"
                            >
                                Lihat Detail
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- PAGINATION --}}

            @if ($reservasis->hasPages())

                <div class="pagination-wrapper">

                    {{ $reservasis->links() }}

                </div>

            @endif


        @else

            {{-- BELUM ADA RIWAYAT --}}

            <div class="empty-state">

                <div class="empty-icon">
                    🕓
                </div>

                <h3>
                    Belum Ada Riwayat Reservasi
                </h3>

                <p>
                    Reservasi yang sudah selesai, ditolak,
                    atau dibatalkan akan muncul di sini.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection