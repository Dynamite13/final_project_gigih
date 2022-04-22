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
