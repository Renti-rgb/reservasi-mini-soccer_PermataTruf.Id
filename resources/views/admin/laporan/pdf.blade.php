<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Laporan Reservasi Mini Soccer</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 14px;
        }

        .header p {
            margin: 3px 0;
            color: #666;
        }

        .line {
            border-bottom: 2px solid #222;
            margin-top: 10px;
        }

        .summary {
            width: 100%;
            margin-bottom: 18px;
        }

        .summary td {
            width: 50%;
            padding: 8px;
            border: 1px solid #ddd;
        }

        .summary-title {
            font-size: 10px;
            color: #666;
        }

        .summary-value {
            font-size: 15px;
            font-weight: bold;
            margin-top: 3px;
        }

        table.report {
            width: 100%;
            border-collapse: collapse;
        }

        table.report th {
            background-color: #eeeeee;
            border: 1px solid #999;
            padding: 7px 5px;
            text-align: center;
            font-size: 10px;
        }

        table.report td {
            border: 1px solid #999;
            padding: 6px 5px;
            font-size: 9px;
            vertical-align: middle;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .status {
            text-align: center;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">

        <h1>PERMATATRUF.ID</h1>

        <h2>LAPORAN RESERVASI LAPANGAN MINI SOCCER</h2>

        <p>
            Laporan Data Reservasi
        </p>

        <div class="line"></div>

    </div>


    {{-- RINGKASAN --}}
    <table class="summary">
        <tr>

            <td>
                <div class="summary-title">
                    TOTAL RESERVASI
                </div>

                <div class="summary-value">
                    {{ $totalReservasi }}
                </div>
            </td>

            <td>
                <div class="summary-title">
                    TOTAL PENDAPATAN
                </div>

                <div class="summary-value">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </div>
            </td>

        </tr>
    </table>


    {{-- TABEL RESERVASI --}}
    <table class="report">

        <thead>
            <tr>
                <th width="4%">No</th>

                <th width="12%">
                    Kode Reservasi
                </th>

                <th width="13%">
                    Pelanggan
                </th>

                <th width="13%">
                    Lapangan
                </th>

                <th width="10%">
                    Tanggal
                </th>

                <th width="10%">
                    Jam
                </th>

                <th width="12%">
                    Total Harga
                </th>

                <th width="9%">
                    Status
                </th>

                <th width="9%">
                    Pembayaran
                </th>
            </tr>
        </thead>

        <tbody>

            @forelse($reservasis as $reservasi)

                <tr>

                    <td class="center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $reservasi->kode_reservasi }}
                    </td>

                    <td>
                        {{ $reservasi->user->name ?? '-' }}
                    </td>

                    <td>
                        {{ $reservasi->lapangan->nama ?? '-' }}
                    </td>

                    <td class="center">
                        {{ optional($reservasi->jadwal)->tanggal
                            ? \Carbon\Carbon::parse($reservasi->jadwal->tanggal)->format('d-m-Y')
                            : '-' }}
                    </td>

                    <td class="center">
                        {{ optional($reservasi->jadwal)->jam_mulai ?? '-' }}
                        -
                        {{ optional($reservasi->jadwal)->jam_selesai ?? '-' }}
                    </td>

                    <td class="right">
                        Rp {{ number_format($reservasi->total_harga ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="status">
                        {{ ucfirst(str_replace('_', ' ', $reservasi->status ?? '-')) }}
                    </td>

                    <td class="status">
                        {{ ucfirst($reservasi->pembayaran->status ?? 'Belum ada') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="center">
                        Tidak ada data reservasi.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- FOOTER --}}
    <div class="footer">

        Dicetak pada:
        {{ now()->format('d-m-Y H:i') }}

    </div>

</body>
</html>