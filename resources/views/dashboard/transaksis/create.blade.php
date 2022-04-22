@extends('layouts.app')

@section('title', 'Tambah data transaksi')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah data transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('transaksis.index') }}">Data transaksi</a></div>
                <div class="breadcrumb-item "><a href="{{ route('transaksis.create') }}">Tambah data transaksi</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('transaksis.store') }}" class="needs-validation">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama pelanggan</label>
                                    <input id="nama_pelanggan" type="text"
                                        class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan"
                                        tabindex="1" value="{{old('nama_pelanggan')}}">

                                    @error('nama_pelanggan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="menu">Menu</label>
                                    <select id="menu" class="form-control @error('menu') is-invalid @enderror" name="menu"
                                        tabindex="1">
                                        <option value="">---Menu---</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                                        @endforeach
                                    </select>

                                    @error('menu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="jumlah" class="control-label">Jumlah</label>
                                    </div>
                                    <input id="jumlah" type="number"
                                        class="form-control @error('jumlah') is-invallid @enderror"
                                        name="jumlah" tabindex="2">
                                    @error('jumlah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Tambah transaksi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
