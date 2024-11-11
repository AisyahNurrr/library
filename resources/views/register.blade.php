@extends('layouts.app')

@section('content')
<div class="container mt-5" style="background: linear-gradient(to right, #f0f4f8, #e1e8ed); padding: 50px 0;">
    <h2 class="text-center mb-4" style="color: #4A4A4A; font-weight: bold;">Registrasi</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg" style="border-radius: 15px; border: 1px solid #d1e3ef;">
                <div class="card-header text-center" style="background-color: #98d9e1; color: #fff; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h4>Buat Akun Baru</h4>
                </div>
                <div class="card-body" style="padding: 30px;">
                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama:</label>
                            <input type="text" name="name" class="form-control" required style="border-radius: 10px; border: 1px solid #d1d1d1;">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" required style="border-radius: 10px; border: 1px solid #d1d1d1;">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" required style="border-radius: 10px; border: 1px solid #d1d1d1;">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password:</label>
                            <input type="password" name="password_confirmation" class="form-control" required style="border-radius: 10px; border: 1px solid #d1d1d1;">
                        </div>
                        <button type="submit" class="btn btn-success w-100" style="border-radius: 50px; padding: 10px 0; font-size: 16px;">Registrasi</button>
                    </form>
                </div>
                <div class="card-footer text-center" style="background-color: #f9f9f9; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                    <p>Sudah punya akun? <a href="{{ route('login') }}" style="color: #98d9e1;">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
