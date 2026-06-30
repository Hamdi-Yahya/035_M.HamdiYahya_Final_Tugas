<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #333; color: white; }
        .text-right { text-align: right; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi Perpustakaan</h2>
    <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Kode</th><th>Anggota</th><th>Buku</th>
                <th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $i => $trx)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $trx->kode_transaksi }}</td>
                <td>{{ $trx->anggota->nama }}</td>
                <td>{{ $trx->buku->judul }}</td>
                <td>{{ $trx->tanggal_pinjam->format('d/m/Y') }}</td>
                <td>{{ $trx->tanggal_dikembalikan?->format('d/m/Y') ?? '-' }}</td>
                <td>{{ $trx->status }}</td>
                <td>{{ $trx->denda ? 'Rp ' . number_format($trx->denda, 0, ',', '.') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-right"><strong>Total Denda:</strong></td>
                <td><strong>Rp {{ number_format($totalDenda, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
