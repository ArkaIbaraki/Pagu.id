<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>RAB {{ $nomorRab }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0 0 5px 0;
            color: #000;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 16px;
            margin: 5px 0 15px 0;
            color: #333;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 10px;
        }

        .info-table td {
            padding: 3px 5px;
        }

        .info-table td:first-child {
            width: 100px;
            font-weight: bold;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.items thead tr {
            background-color: #f0f0f0;
            border-bottom: 2px solid #333;
            border-top: 2px solid #333;
        }

        table.items thead th {
            padding: 8px 5px;
            text-align: left;
            font-weight: bold;
            font-size: 10px;
        }

        table.items thead th.center {
            text-align: center;
        }

        table.items thead th.right {
            text-align: right;
        }

        table.items tbody tr {
            border-bottom: 1px solid #ddd;
        }

        table.items tbody td {
            padding: 8px 5px;
            font-size: 10px;
        }

        table.items tbody td.center {
            text-align: center;
        }

        table.items tbody td.right {
            text-align: right;
        }

        table.items tfoot tr {
            border-top: 2px solid #333;
            font-weight: bold;
            background-color: #f8f8f8;
        }

        table.items tfoot td {
            padding: 10px 5px;
            font-size: 12px;
        }

        .catatan {
            background-color: #fffbea;
            border: 1px solid #f0e68c;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 10px;
        }

        .catatan .label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .signatures {
            margin-top: 40px;
            width: 100%;
        }

        .signatures table {
            width: 100%;
        }

        .signatures td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            font-size: 10px;
        }

        .signatures .label {
            margin-bottom: 60px;
            color: #666;
        }

        .signatures .name {
            border-top: 1px solid #333;
            padding-top: 5px;
            font-weight: bold;
            display: inline-block;
            min-width: 150px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Rencana Anggaran Biaya</h1>
        <h2>{{ $namaProyek ?: 'NAMA PROYEK' }}</h2>
    </div>

    <table class="info-table">
        <tr>
            <td>No. RAB</td>
            <td>: {{ $nomorRab }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($tanggalRab)->format('d F Y') }}</td>
        </tr>
        @if ($lokasi)
            <tr>
                <td>Lokasi</td>
                <td>: {{ $lokasi }}</td>
            </tr>
        @endif
        @if ($namaPemilik)
            <tr>
                <td>Pemilik Proyek</td>
                <td>: {{ $namaPemilik }}</td>
            </tr>
        @endif
    </table>

    <table class="items">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th>Uraian Pekerjaan</th>
                <th class="center" style="width: 10%;">Volume</th>
                <th class="center" style="width: 10%;">Satuan</th>
                <th class="right" style="width: 18%;">Harga Satuan</th>
                <th class="right" style="width: 20%;">Jumlah Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $item['deskripsi'] ?: '-' }}</td>
                    <td class="center">{{ $item['volume'] ?? 1 }}</td>
                    <td class="center">{{ $item['satuan'] ?? 'unit' }}</td>
                    <td class="right">Rp {{ number_format((float) ($item['hargaSatuan'] ?? 0), 0, ',', '.') }}</td>
                    <td class="right"><strong>Rp
                            {{ number_format((float) ($item['volume'] ?? 1) * (float) ($item['hargaSatuan'] ?? 0), 0, ',', '.') }}</strong>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="right">TOTAL ANGGARAN:</td>
                <td class="right" style="font-size: 14px;">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    @if ($catatan)
        <div class="catatan">
            <div class="label">Catatan:</div>
            <div>{{ $catatan }}</div>
        </div>
    @endif

    @if ($namaPembuat || $namaPenyetuju)
        <div class="signatures">
            <table>
                <tr>
                    @if ($namaPembuat)
                        <td>
                            <div class="label">Dibuat Oleh,</div>
                            <div class="name">{{ $namaPembuat }}</div>
                        </td>
                    @endif
                    @if ($namaPenyetuju)
                        <td>
                            <div class="label">Disetujui Oleh,</div>
                            <div class="name">{{ $namaPenyetuju }}</div>
                        </td>
                    @endif
                </tr>
            </table>
        </div>
    @endif
</body>

</html>
