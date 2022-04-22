@extends('layouts.app')

@section('title', 'Ubah data pengguna')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah data pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('users.index') }}">Data pengguna</a></div>
                <div class="breadcrumb-item "><a href="{{ route('users.edit', $user->id) }}">Edit data pengguna</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.update', $user->id) }}" class="needs-validation">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        tabindex="1" value="{{ $user->username }}">

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
                                            <option value="{{ $role }}" @if ($role == $user->role)
                                                selected
                                            @endif>{{ $role }}</option>
                                        @endforeach
                                    </select>

                                    @error('role')
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
