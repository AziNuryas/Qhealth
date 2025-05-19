@extends('layouts.app')

@section('title', 'Masuk')

@section('content')

<style>
    /* Kartu dengan efek blur akrilik */
    .login-card {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background-color: rgba(255, 255, 255, 0.65);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
        transition: all 0.3s ease;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        max-width: 450px;
        margin-left: auto;
        margin-right: auto;
    }

    body.dark-mode .login-card {
        background-color: rgba(42, 42, 61, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .login-title {
        font-weight: 600;
        color: #22c55e;
        margin-bottom: 1.2rem;
        text-align: center;
        font-size: 1.5rem;
    }

    body.dark-mode .login-title {
        color: #4ade80;
    }

    /* Styling untuk form */
    .form-group {
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(10px);
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.3rem;
        display: block;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .form-control {
        border-radius: 8px;
        padding: 0.6rem 0.8rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        background-color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        font-size: 0.9rem;
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

    .form-check {
        display: flex;
        align-items: center;
        opacity: 0;
        transform: translateY(10px);
    }

    .form-check-input {
        margin-right: 0.5rem;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #22c55e;
        border-color: #22c55e;
    }

    .form-check-label {
        font-size: 0.9rem;
        cursor: pointer;
    }

    .btn-login {
        background-color: #22c55e;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(34, 197, 94, 0.15);
        width: 100%;
        color: white;
        margin-top: 0.5rem;
        opacity: 0;
        transform: translateY(10px);
        font-size: 0.95rem;
    }

    .btn-login:hover {
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
    .login-card::before {
        content: '';
        position: absolute;
        top: -10px;
        right: -10px;
        width: 40px;
        height: 40px;
        background-color: rgba(34, 197, 94, 0.3);
        border-radius: 50%;
        z-index: -1;
    }

    .login-card::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: -15px;
        width: 60px;
        height: 60px;
        background-color: rgba(34, 197, 94, 0.2);
        border-radius: 50%;
        z-index: -1;
    }

    .register-link {
        text-align: center;
        margin-top: 0.8rem;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.8s forwards;
        animation-delay: 0.5s;
        font-size: 0.9rem;
    }

    .register-link a {
        color: #22c55e;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
    }

    .register-link a:hover {
        color: #16a34a;
        text-decoration: underline;
    }

    body.dark-mode .register-link a {
        color: #4ade80;
    }

    /* Illustration */
    .login-illustration {
        height: 90px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 1rem;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.8s forwards;
    }

    .login-icon {
        font-size: 60px;
        color: #22c55e;
        opacity: 0.7;
    }

    body.dark-mode .login-icon {
        color: #4ade80;
    }

    .alert-success {
        background-color: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #16a34a;
        border-radius: 8px;
        padding: 0.8rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    body.dark-mode .alert-success {
        background-color: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #4ade80;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="login-card" data-aos="fade-up">
                <div class="login-illustration">
                    <i class="bi bi-box-arrow-in-right login-icon"></i>
                </div>

                <h3 class="login-title animate-fade-in">Masuk ke QHealth</h3>

                @if (session('status'))
                    <div class="alert alert-success animate-fade-in">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group animate-fade-in delay-1">
                        <label for="email">
                            <i class="bi bi-envelope me-1"></i> Email
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" id="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group animate-fade-in delay-2">
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

                    <div class="form-check animate-fade-in delay-3">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember" 
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-login animate-fade-in delay-4">
                        <i class="bi bi-arrow-right-circle-fill me-1"></i> Masuk
                    </button>
                </form>

                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
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
        
        const formCheck = document.querySelector('.form-check');
        if (formCheck) formCheck.classList.add('animate-fade-in');
        
        const loginBtn = document.querySelector('.btn-login');
        if (loginBtn) loginBtn.classList.add('animate-fade-in');
    });
</script>

@endsection