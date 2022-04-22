@extends('layouts.app')

@section('title', 'Data pengguna')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Data pengguna</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Tambah data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>
                                                    <span class="badge badge-">{{ $user->role }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
