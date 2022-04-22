@extends('layouts.app')

@section('title', 'Data transaksi')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pesanan.index') }}">Data transaksi</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Tambah data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama menu</th>
                                            <th>Jumlah</th>
                                            <th>Status Pembayaran / Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                            <th>Total harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp    
                                        @foreach ($pesanans as $pesanan)
                                            @php
                                                $total += $pesanan->total_harga;
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pesanan->menu->nama_menu }}</td>
                                                <td>{{ $pesanan->jumlah }}</td>
                                                <td>
                                                    <span class="badge badge-{{$pesanan->status == 'new' ? 'danger' : 'success'}}">{{$pesanan->status}}</span>
                                                </td>
                                                <td>{{ $pesanan->tanggal }}</td>
                                                <td>
                                                    @if ($pesanan->status == 'new')
                                                        <form action="{{route('pesanan.bayar', $pesanan->id)}}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">Bayar</button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-primary btn-sm">Dibayar</button>
                                                    @endif
                                                </td>
                                                <td>{{ 'Rp. ' . number_format($pesanan->total_harga, 0, ',', '.') }}</td>
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
                                {{ $pesanans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
