<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Atlet StartingVano</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 20px;
            font-size: 11px;
            line-height: 1.5;
        }
        @page {
            margin: 120px 50px 80px 50px;
        }
        header {
            position: fixed;
            top: -95px;
            left: 0px;
            right: 0px;
            height: 80px;
            border-bottom: 2px solid #0f1d3a;
            padding-bottom: 10px;
        }
        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 40px;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }
        .logo-img {
            max-height: 50px;
            display: block;
        }
        .title-container {
            text-align: right;
        }
        .report-title {
            font-size: 16px;
            font-weight: bold;
            color: #0f1d3a;
            margin: 0 0 3px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .report-subtitle {
            font-size: 9px;
            color: #d1b442;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1px;
        }
        .print-date {
            font-size: 9px;
            color: #555;
            margin-bottom: 15px;
            text-align: right;
            font-style: italic;
        }
        .page-number::after {
            content: counter(page);
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
        }
        .data-table th {
            background-color: #0f1d3a;
            color: #ffffff;
            font-weight: bold;
            text-align: left;
            padding: 10px 8px;
            font-size: 10px;
            text-transform: uppercase;
            border: 1px solid #0f1d3a;
        }
        .data-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
            font-size: 9.5px;
            vertical-align: middle;
        }
        .data-table tr:nth-child(even) td {
            background-color: #fcfcfc;
        }
        .badge-id {
            background-color: #e8f0fe;
            color: #1a73e8;
            border: 1px solid #d2e3fc;
        }
    </style>
</head>
<body>

    <!-- Header Section on every page -->
    <header>
        <table class="header-table">
            <tr>
                <td style="width: 80px;">
                    <img src="{{ public_path('images/logo.png') }}" class="logo-img" alt="Logo">
                </td>
                <td class="title-container">
                    <h1 class="report-title">Laporan Data Atlet</h1>
                    <div class="report-subtitle">STARTINGVANO SPORTS ATHLETES DATABASE</div>
                </td>
            </tr>
        </table>
    </header>

    <!-- Footer Section on every page -->
    <footer>
        <table style="width: 100%; border: none;">
            <tr>
                <td style="text-align: left; border: none; font-size: 8px; color: #777;">&copy; {{ date('Y') }} StartingVano. All rights reserved.</td>
                <td style="text-align: right; border: none; font-size: 8px; color: #777;">Halaman <span class="page-number"></span></td>
            </tr>
        </table>
    </footer>

    <!-- Main Content -->
    <div class="print-date">
        Tanggal Cetak: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }} WIB
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 15%;">ID Atlet</th>
                <th style="width: 30%;">Nama Atlet</th>
                <th style="width: 20%;">Cabang Olahraga</th>
                <th style="width: 20%;">Klub</th>
                <th style="width: 10%; text-align: center;">Usia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $index => $player)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        <span class="badge badge-id">{{ $player->id_pemain }}</span>
                    </td>
                    <td style="font-weight: bold; color: #0f1d3a;">{{ $player->nama_pemain }}</td>
                    <td>{{ $player->cabang_olahraga }}</td>
                    <td>{{ $player->klub }}</td>
                    <td style="text-align: center;">{{ $player->usia }} Tahun</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
