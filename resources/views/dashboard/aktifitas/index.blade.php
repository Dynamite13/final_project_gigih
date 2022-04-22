@extends('layouts.app')

@section('title', 'Aktifitas pegawai')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Aktifitas pegawai</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('laporan') }}">Aktifitas pegawai</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Deskripsi</th>
                                            <th>Nama pegawai / pengguna</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aktifitas as $aktif)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $aktif->deskripsi }}</td>
                                                <td>{{ $aktif->pegawai->username }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $aktifitas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
