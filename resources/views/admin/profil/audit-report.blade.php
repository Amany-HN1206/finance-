<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Audit - {{ $admin->nama_lengkap }}</title>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #17191c;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e6d8dc;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #17191c;
        }
        .header p {
            margin: 5px 0;
            color: #777b86;
        }
        .summary {
            background: #f2f2f3;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .summary h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #17191c;
        }
        .summary-grid {
            display: table;
            width: 100%;
        }
        .summary-item {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            padding: 10px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #17191c;
        }
        .summary-label {
            font-size: 11px;
            color: #979799;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #17191c;
            color: #ffffff;
            padding: 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #f2f2f3;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background: #fafafb;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f2f2f3;
            text-align: center;
            font-size: 10px;
            color: #979799;
        }
        .status-inflow {
            color: #059669;
            font-weight: bold;
        }
        .status-outflow {
            color: #ba1a1a;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN AUDIT TRANSAKSI</h1>
        <p>IPJ Finance - Sistem Manajemen Keuangan</p>
        <p>Periode: {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
        <p>Admin: {{ $admin->nama_lengkap }}</p>
    </div>

    <div class="summary">
        <h3>Ringkasan Transaksi</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-value">{{ $totalTransactions }}</div>
                <div class="summary-label">Total Transaksi</div>
            </div>
            <div class="summary-item">
                <div class="summary-value" style="color: #059669;">Rp {{ number_format($totalInflow, 0, ',', '.') }}</div>
                <div class="summary-label">Total Inflow</div>
            </div>
            <div class="summary-item">
                <div class="summary-value" style="color: #ba1a1a;">Rp {{ number_format($totalOutflow, 0, ',', '.') }}</div>
                <div class="summary-label">Total Outflow</div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Jenis</th>
                <th>Sumber</th>
                <th>Nominal</th>
                <th>Saldo Sebelum</th>
                <th>Saldo Sesudah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mutations as $mutation)
                <tr>
                    <td>{{ $mutation->created_at->format('d/m/Y') }}</td>
                    <td>{{ $mutation->created_at->format('H:i') }}</td>
                    <td>
                        <span class="{{ $mutation->jenis_mutasi === 'Inflow' ? 'status-inflow' : 'status-outflow' }}">
                            {{ $mutation->jenis_mutasi }}
                        </span>
                    </td>
                    <td>{{ $mutation->sumber_saldo }}</td>
                    <td>Rp {{ number_format($mutation->nominal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($mutation->saldo_sebelum, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($mutation->saldo_sesudah, 0, ',', '.') }}</td>
                    <td>{{ Str::limit($mutation->catatan, 50) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem IPJ Finance</p>
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }} WIB</p>
    </div>
</body>
</html>