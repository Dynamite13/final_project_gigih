@extends('layouts.app')

@section('title', 'Data transaksi')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('transaksis.index') }}">Data transaksi</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <a href="{{ route('transaksis.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Tambah data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama pelanggan</th>
                                            <th>Nama menu</th>
                                            <th>Jumlah</th>
                                            <th>Nama kasir</th>
                                            <th>Tanggal</th>
                                            <th>Total harga</th>
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
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6">Jumlah</th>
                                            <th>{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                {{ $transaksis->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
