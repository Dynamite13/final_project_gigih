<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <style>
        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td, #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even){background-color: #f2f2f2;}

        #table tr:hover {background-color: #ddd;}

        #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
    <center>
        <h3 style="margin-bottom: 2em">Laporan Transaksi</h3>

        <table id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Menu</th>
                    <th>Jumlah</th>
                    <th>Nama Pegawai</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($transaksis as $transaksi)
                    @php
                        $total += $transaksi->total_harga;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->nama_pelanggan }}</td>
                        <td>{{ $transaksi->menu->nama_menu }}</td>
                        <td>{{ $transaksi->jumlah }}</td>
                        <td>{{ $transaksi->kasir->username }}</td>
                        <td>{{ $transaksi->tanggal }}</td>
                        <td>{{ 'Rp. ' . number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="6">Jumlah</th>
                    <th>{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
    </center>
</body>
</html>