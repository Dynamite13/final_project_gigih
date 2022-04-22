@extends('layouts.app')

@section('title', 'Ubah data menu')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah data menu</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('menus.index') }}">Data menu</a></div>
                <div class="breadcrumb-item "><a href="{{ route('menus.edit', $menu->id) }}">Ubah data menu</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('menus.update', $menu->id) }}" class="needs-validation">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama_menu">Nama Menu</label>
                                    <input id="nama_menu" type="text"
                                        class="form-control @error('nama_menu') is-invalid @enderror" name="nama_menu"
                                        tabindex="1" value="{{ $menu->nama_menu }}">

                                    @error('nama_menu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga Menu</label>
                                    <input id="harga" type="text"
                                        class="form-control @error('harga') is-invalid @enderror" name="harga"
                                        tabindex="1" value="{{ $menu->harga }}">

                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi Menu</label>
                                    <textarea id="deskripsi"
                                    class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                    tabindex="1" cols="30" rows="5">{{ $menu->deskripsi }}</textarea>

                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="stok">Stok / Ketersediaan Menu</label>
                                    <input id="stok" type="text"
                                        class="form-control @error('stok') is-invalid @enderror" name="stok"
                                        tabindex="1" value="{{ $menu->stok }}">

                                    @error('stok')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                                

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Ubah data
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
