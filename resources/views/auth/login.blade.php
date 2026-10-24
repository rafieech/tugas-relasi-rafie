@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card card-berita">
            <div class="filter-header">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login Pengelola
            </div>
            <div class="card-body">
                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control" value="{{ old('email') }}" autofocus>
                        @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control">
                        @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="ingat" id="ingat">
                        <label class="form-check-label" for="ingat">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection