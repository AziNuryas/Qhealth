@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<style>
    .register-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    .register-card {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        padding: 32px;
        width: 100%;
        max-width: 520px;
        position: relative;
        overflow: hidden;
    }

    .register-card::before {
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

    .register-header {
        text-align: center;
        margin-bottom: 24px;
        position: relative;
        z-index: 2;
    }

    .register-icon {
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

    .register-icon i {
        font-size: 32px;
        color: white;
    }

    .register-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
        letter-spacing: -0.5px;
    }

    .register-subtitle {
        font-size: 13px;
        color: var(--text-secondary);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .form-group {
        margin-bottom: 16px;
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

    .form-control, .form-select {
        width: 100%;
        padding: 11px 14px 11px 42px;
        border: 1px solid var(--card-border);
        border-radius: 10px;
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
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

    .btn-register {
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
        margin-top: 8px;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 20px 0;
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

    .login-link {
        text-align: center;
        font-size: 13px;
        color: var(--text-secondary);
    }

    .login-link a {
        color: var(--accent-primary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .login-link a:hover {
        color: var(--accent-secondary);
        text-decoration: underline;
    }

    .password-strength {
        margin-top: 6px;
        font-size: 11px;
        color: var(--text-tertiary);
    }

    .strength-bar {
        height: 3px;
        border-radius: 2px;
        background: var(--card-border);
        margin-top: 4px;
        overflow: hidden;
    }

    .strength-fill {
        height: 100%;
        width: 0;
        background: linear-gradient(135deg, #ef4444, #f59e0b, var(--accent-primary));
        transition: width 0.3s ease;
    }

    @media (max-width: 576px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="register-container">
    <div class="register-card" data-aos="fade-up">
        <div class="register-header">
            <div class="register-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h1 class="register-title">Buat Akun Baru</h1>
            <p class="register-subtitle">Bergabung dengan QHealth sekarang</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-wrapper">
                    <i class="bi bi-person-circle input-icon"></i>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
                </div>
                @error('name')
                    <small style="color: #ef4444; font-size: 11px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope-fill input-icon"></i>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <small style="color: #ef4444; font-size: 11px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="input-wrapper">
                        <i class="bi bi-gender-ambiguous input-icon"></i>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor HP</label>
                    <div class="input-wrapper">
                        <i class="bi bi-telephone-fill input-icon"></i>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               placeholder="08xxxxxxxxxx" value="{{ old('phone') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" name="password" id="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Minimal 8 karakter" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                        <i class="bi bi-eye-fill" id="toggleIcon1"></i>
                    </button>
                </div>
                <div class="password-strength">
                    <span id="strengthText">Kekuatan password</span>
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthBar"></div>
                    </div>
                </div>
                @error('password')
                    <small style="color: #ef4444; font-size: 11px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-shield-lock-fill input-icon"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="form-control" placeholder="Ketik ulang password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                        <i class="bi bi-eye-fill" id="toggleIcon2"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-check-circle-fill"></i>
                Daftar Sekarang
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
        }
    }

    // Password strength checker
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');
        
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        const percentage = (strength / 4) * 100;
        strengthBar.style.width = percentage + '%';
        
        if (strength === 0) {
            strengthText.textContent = 'Kekuatan password';
        } else if (strength <= 2) {
            strengthText.textContent = 'Password lemah';
        } else if (strength === 3) {
            strengthText.textContent = 'Password sedang';
        } else {
            strengthText.textContent = 'Password kuat';
        }
    });
</script>
@endsection