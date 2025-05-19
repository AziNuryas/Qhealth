@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

<style>
    /* Kartu dengan efek blur akrilik */
    .register-card {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background-color: rgba(255, 255, 255, 0.65);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
        transition: all 0.3s ease;
        padding: 2.2rem;
        margin-bottom: 2rem;
        position: relative;
    }

    body.dark-mode .register-card {
        background-color: rgba(42, 42, 61, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .register-title {
        font-weight: 600;
        color: #22c55e;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    body.dark-mode .register-title {
        color: #4ade80;
    }

    /* Styling untuk form */
    .form-group {
        margin-bottom: 1.2rem;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(10px);
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.7rem 1rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        background-color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.3);
        border-color: #22c55e;
        outline: none;
    }

    body.dark-mode .form-control {
        background-color: rgba(42, 42, 61, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #f1f1f1;
    }

    .btn-register {
        background-color: #22c55e;
        border: none;
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(34, 197, 94, 0.15);
        width: 100%;
        color: white;
        margin-top: 0.5rem;
        opacity: 0;
        transform: translateY(10px);
    }

    .btn-register:hover {
        background-color: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(34, 197, 94, 0.2);
    }

    /* Animation classes */
    .animate-fade-in {
        animation: fadeIn 0.8s forwards;
    }

    .delay-1 {
        animation-delay: 0.1s;
    }

    .delay-2 {
        animation-delay: 0.2s;
    }

    .delay-3 {
        animation-delay: 0.3s;
    }

    .delay-4 {
        animation-delay: 0.4s;
    }

    .delay-5 {
        animation-delay: 0.5s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Decorative elements */
    .register-card::before {
        content: '';
        position: absolute;
        top: -10px;
        right: -10px;
        width: 50px;
        height: 50px;
        background-color: rgba(34, 197, 94, 0.3);
        border-radius: 50%;
        z-index: -1;
    }

    .register-card::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: -15px;
        width: 70px;
        height: 70px;
        background-color: rgba(34, 197, 94, 0.2);
        border-radius: 50%;
        z-index: -1;
    }

    .login-link {
        text-align: center;
        margin-top: 1rem;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.8s forwards;
        animation-delay: 0.6s;
    }

    .login-link a {
        color: #22c55e;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
    }

    .login-link a:hover {
        color: #16a34a;
        text-decoration: underline;
    }

    body.dark-mode .login-link a {
        color: #4ade80;
    }

    /* Illustration */
    .register-illustration {
        height: 120px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 1.5rem;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.8s forwards;
    }

    .register-icon {
        font-size: 80px;
        color: #22c55e;
        opacity: 0.7;
    }

    body.dark-mode .register-icon {
        color: #4ade80;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="register-card" data-aos="fade-up">
                <div class="register-illustration">
                    <i class="bi bi-person-plus-fill register-icon"></i>
                </div>

                <h3 class="register-title animate-fade-in">Daftar Akun Baru</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group animate-fade-in delay-1">
                        <label for="name">
                            <i class="bi bi-person-circle me-1"></i> Nama
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            name="name" id="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group animate-fade-in delay-2">
                        <label for="email">
                            <i class="bi bi-envelope me-1"></i> Email
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" id="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group animate-fade-in delay-3">
                        <label for="gender">
                            <i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin
                        </label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group animate-fade-in delay-3">
                        <label for="phone">
                            <i class="bi bi-telephone me-1"></i> Nomor HP
                        </label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                            name="phone" id="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group animate-fade-in delay-4">
                        <label for="password">
                            <i class="bi bi-lock me-1"></i> Kata Sandi
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" id="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group animate-fade-in delay-5">
                        <label for="password_confirmation">
                            <i class="bi bi-shield-lock me-1"></i> Konfirmasi Kata Sandi
                        </label>
                        <input type="password" class="form-control" 
                            name="password_confirmation" id="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-register animate-fade-in delay-5">
                        <i class="bi bi-check-circle me-1"></i> Daftar Sekarang
                    </button>
                </form>

                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Activate animations when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach(group => {
            group.classList.add('animate-fade-in');
        });
        
        const registerBtn = document.querySelector('.btn-register');
        registerBtn.classList.add('animate-fade-in');
    });
</script>

@endsection