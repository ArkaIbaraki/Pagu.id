<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $nomorInvoice }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0 0 10px 0;
            color: #000;
        }
        .invoice-info {
            font-size: 11px;
            color: #666;
        }
        .invoice-info div {
            margin: 3px 0;
        }
        .kepada {
            margin-bottom: 20px;
            font-size: 11px;
        }
        .kepada .label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table thead tr {
            border-bottom: 2px solid #333;
        }
        table thead th {
            padding: 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        table thead th.center {
            text-align: center;
        }
        table thead th.right {
            text-align: right;
        }
        table tbody tr {
            border-bottom: 1px solid #ddd;
        }
        table tbody td {
            padding: 8px;
            font-size: 11px;
        }
        table tbody td.center {
            text-align: center;
        }
        table tbody td.right {
            text-align: right;
        }
        .calculations {
            float: right;
            width: 300px;
            margin-bottom: 20px;
        }
        .calculations .row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-size: 11px;
        }
        .calculations .row.total {
            border-top: 2px solid #333;
            padding-top: 8px;
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
        }
        .calculations .row.discount {
            color: #d00;
        }
        .terbilang {
            clear: both;
            background-color: #fffbea;
            border: 1px solid #f0e68c;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .terbilang .label {
            font-size: 10px;
            color: #666;
            margin-bottom: 3px;
        }
        .terbilang .value {
            font-size: 11px;
            font-weight: bold;
            font-style: italic;
        }
        .catatan {
            margin-bottom: 20px;
            font-size: 11px;
        }
        .catatan .label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .signature {
            text-align: right;
            margin-top: 40px;
        }
        .signature .label {
            font-size: 11px;
            color: #666;
            margin-bottom: 60px;
        }
        .signature .name {
            font-size: 11px;
            font-weight: bold;
            border-top: 1px solid #333;
            display: inline-block;
            padding-top: 5px;
            padding-left: 20px;
            padding-right: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <!-- Logo/Kop Jika Ada -->
        @if($useKopPerusahaan && $kopPerusahaan)
        <div style="margin-bottom: 10px; text-align: center;">
            <img src="{{ $kopPerusahaan }}" alt="Kop" style="height: 50px; display: inline-block;">
        </div>
        @endif
        
        @if($headerStyle === 'title')
            <h1 style="text-align: center; font-size: 32px; margin-bottom: 20px;">INVOICE</h1>
        @else
            <h1>{{ $namaUsaha ?: 'NAMA USAHA' }}</h1>
        @endif
    </div>
    
    <!-- Header Info -->
    <div style="margin-bottom: 20px; font-size: 11px;">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
            <tr>
                <td style="width: 50%; padding: 0; vertical-align: top;">
                    <div><strong>No. Invoice:</strong> {{ $nomorInvoice }}</div>
                </td>
                <td style="width: 50%; padding: 0; vertical-align: top; text-align: right;">
                    <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($tanggalInvoice)->format('d F Y') }}</div>
                </td>
            </tr>
        </table>
        @if($namaPenerima)
        <div style="margin-bottom: 8px;">
            <strong>Pelanggan:</strong> {{ $namaPenerima }}
        </div>
        @endif
        @if($alamat)
        <div>
            <strong>Alamat:</strong> {{ $alamat }}
        </div>
        @endif
    </div>
    
    <!-- Items Table -->
    <table style="margin-bottom: 0;">
        <thead>
            <tr style="border-bottom: 2px solid #000;">
                <th style="text-align: center; padding: 8px; width: 5%; font-weight: bold; font-size: 11px;">No</th>
                <th style="text-align: left; padding: 8px; font-weight: bold; font-size: 11px;">Keterangan</th>
                @if($modeQuantity)
                <th style="text-align: center; padding: 8px; width: 10%; font-weight: bold; font-size: 11px;">Qty</th>
                <th style="text-align: right; padding: 8px; width: 20%; font-weight: bold; font-size: 11px;">Harga</th>
                @endif
                <th style="text-align: right; padding: 8px; width: 20%; font-weight: bold; font-size: 11px;">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $idx => $item)
            <tr style="border-bottom: 1px solid #ccc;">
                <td style="text-align: center; padding: 8px; font-size: 11px;">{{ $idx + 1 }}</td>
                <td style="text-align: left; padding: 8px; font-size: 11px;">{{ $item['deskripsi'] ?: '-' }}</td>
                @if($modeQuantity)
                <td style="text-align: center; padding: 8px; font-size: 11px;">{{ $item['qty'] ?? 1 }}</td>
                <td style="text-align: right; padding: 8px; font-size: 11px;">Rp {{ number_format((float)($item['harga'] ?? 0), 0, ',', '.') }}</td>
                @endif
                <td style="text-align: right; padding: 8px; font-size: 11px;">Rp {{ number_format((float)($modeQuantity ? ($item['qty'] ?? 1) : 1) * (float)($item['harga'] ?? 0), 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="{{ $modeQuantity ? 5 : 3 }}" style="text-align: center; padding: 8px; color: #999;">Belum ada item</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Summary Table -->
    <table style="margin-bottom: 20px;">
        <tbody>
            <tr style="border-bottom: 1px solid #ccc;">
                <td style="padding: 5px 8px; text-align: right; font-size: 11px;" colspan="{{ $modeQuantity ? 3 : 1 }}"></td>
                <td style="padding: 5px 8px; text-align: right; font-weight: bold; font-size: 11px;">Subtotal</td>
                <td style="padding: 5px 8px; text-align: right; font-size: 11px; width: 15%;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            @if($useDiskon && $diskonValue > 0)
            <tr style="border-bottom: 1px solid #ccc;">
                <td style="padding: 5px 8px; text-align: right; font-size: 11px;" colspan="{{ $modeQuantity ? 3 : 1 }}"></td>
                <td style="padding: 5px 8px; text-align: right; font-weight: bold; font-size: 11px;">Diskon</td>
                <td style="padding: 5px 8px; text-align: right; font-size: 11px;">Rp {{ number_format($diskonValue, 0, ',', '.') }}</td>
            </tr>
            @endif
            @if($usePpn)
            <tr style="border-bottom: 1px solid #ccc;">
                <td style="padding: 5px 8px; text-align: right; font-size: 11px;" colspan="{{ $modeQuantity ? 3 : 1 }}"></td>
                <td style="padding: 5px 8px; text-align: right; font-weight: bold; font-size: 11px;">PPN 11%</td>
                <td style="padding: 5px 8px; text-align: right; font-size: 11px;">Rp {{ number_format($ppnValue, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="border-top: 2px solid #000; border-bottom: 2px solid #000;">
                <td style="padding: 8px; text-align: right; font-size: 11px;" colspan="{{ $modeQuantity ? 3 : 1 }}"></td>
                <td style="padding: 8px; text-align: right; font-weight: bold; font-size: 12px;">Total</td>
                <td style="padding: 8px; text-align: right; font-weight: bold; font-size: 12px;">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    
    @if($showTerbilang)
    <div style="margin-bottom: 20px; font-size: 11px;">
        <strong>Terbilang :</strong> <em>{{ $totalTerbilang }}</em>
    </div>
    @endif
    
    @if($catatan)
    <div style="margin-bottom: 20px; font-size: 11px;">
        <strong>Catatan:</strong> {{ $catatan }}
    </div>
    @endif
    
    @if($namaTtd)
    <div style="margin-top: 40px; text-align: right;">
        <div style="font-size: 11px; color: #666; margin-bottom: 60px;">Hormat Saya,</div>
        <div style="font-size: 11px; font-weight: bold; border-top: 1px solid #333; display: inline-block; padding-top: 5px; padding-left: 20px; padding-right: 20px;">{{ $namaTtd }}</div>
    </div>
    @endif
</body>
</html>
