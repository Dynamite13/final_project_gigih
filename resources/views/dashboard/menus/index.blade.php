@extends('layouts.app')

@section('title', 'Data menu')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data menu</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('menus.index') }}">Data menu</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Tambah data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama menu</th>
                                            <th>Harga</th>
                                            <th>Deskripsi</th>
                                            <th>Stok / Ketersediaan</th>
                                            <th>Ditambahkan oleh</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $menu->nama_menu }}</td>
                                                <td>{{ 'Rp. ' . number_format($menu->harga, 0, ',', '.') }}</td>
                                                <td>{{ $menu->deskripsi }}</td>
                                                <td>{{ $menu->stok }}</td>
                                                <td>{{ $menu->manager->username }}</td>
                                                <td >
                                                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('menus.destroy', $menu->id) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $menu->id }}').submit();"><i class="fas fa-trash"></i></a>
                                                    <form id="delete-form-{{ $menu->id }}" action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $menus->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
