@extends('layouts.app')

@section('title', 'Tambah data pengguna')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah data pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('users.index') }}">Data pengguna</a></div>
                <div class="breadcrumb-item "><a href="{{ route('users.create') }}">Tambah data pengguna</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.store') }}" class="needs-validation">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        tabindex="1" value="{{old('username')}}">

                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role"
                                        tabindex="1">
                                        <option value="">---Role---</option>
                                        @php
                                            $roles = ['admin', 'kasir'];
                                        @endphp
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>

                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password" class="control-label">Password</label>
                                            </div>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invallid @enderror"
                                                name="password" tabindex="2">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password_confirmation" class="control-label">Password
                                                    Confirmation</label>
                                            </div>
                                            <input id="password_confirmation" type="password"
                                                class="form-control @error('password_confirmation') is-invallid @enderror"
                                                name="password_confirmation" tabindex="2">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Tambah data
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
