@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .login-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    .login-card {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        padding: 32px;
        width: 100%;
        max-width: 420px;
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 50%;
        opacity: 0.08;
    }

    .login-header {
        text-align: center;
        margin-bottom: 28px;
        position: relative;
        z-index: 2;
    }

    .login-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 16px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
    }

    .login-icon i {
        font-size: 32px;
        color: white;
    }

    .login-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
        letter-spacing: -0.5px;
    }

    .login-subtitle {
        font-size: 13px;
        color: var(--text-secondary);
    }

    .form-group {
        margin-bottom: 18px;
        position: relative;
    }

    .form-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 6px;
        display: block;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: 16px;
        pointer-events: none;
        transition: all 0.2s ease;
    }

    .form-control {
        width: 100%;
        padding: 11px 14px 11px 42px;
        border: 1px solid var(--card-border);
        border-radius: 10px;
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-control:focus ~ .input-icon {
        color: var(--accent-primary);
    }

    .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-tertiary);
        cursor: pointer;
        padding: 4px;
        transition: all 0.2s ease;
        font-size: 16px;
    }

    .password-toggle:hover {
        color: var(--accent-primary);
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 12px;
    }

    .custom-checkbox {
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        color: var(--text-secondary);
    }

    .custom-checkbox input {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    .forgot-link {
        color: var(--accent-primary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .forgot-link:hover {
        color: var(--accent-secondary);
        text-decoration: underline;
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: white;
        border: none;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 24px 0;
        color: var(--text-tertiary);
        font-size: 12px;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--card-border);
    }

    .divider span {
        padding: 0 12px;
    }

    .register-link {
        text-align: center;
        font-size: 13px;
        color: var(--text-secondary);
    }

    .register-link a {
        color: var(--accent-primary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .register-link a:hover {
        color: var(--accent-secondary);
        text-decoration: underline;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 18px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.12), rgba(220, 38, 38, 0.12));
        border: 1px solid rgba(239, 68, 68, 0.25);
        color: #ef4444;
    }
</style>

<div class="login-container">
    <div class="login-card" data-aos="fade-up">
        <div class="login-header">
            <div class="login-icon">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h1 class="login-title">Selamat Datang Kembali</h1>
            <p class="login-subtitle">Masuk ke akun QHealth Anda</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>Email atau password salah</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope-fill input-icon"></i>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" name="password" id="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Masukkan password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="bi bi-eye-fill" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <div class="remember-forgot">
                <label class="custom-checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat Saya</span>
                </label>
                <a href="#" class="forgot-link">Lupa Password?</a>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Masuk
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
        }
    }
</script>
@endsection