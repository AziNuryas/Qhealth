@extends('layouts.app')

@section('content')
<style>
    :root {
        /* Light mode variables */
        --card-bg-light: #ffffff;
        --text-color-light: #333333;
        --border-color-light: rgba(0, 0, 0, 0.1);
        --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.05);
        --highlight-shadow-light: 0 8px 20px rgba(0, 0, 0, 0.08);
        --input-bg-light: #ffffff;
        
        /* Dark mode variables */
        --card-bg-dark: #1e2030;
        --text-color-dark: #e2e8f0;
        --border-color-dark: rgba(255, 255, 255, 0.1);
        --shadow-dark: 0 4px 15px rgba(0, 0, 0, 0.3);
        --highlight-shadow-dark: 0 8px 20px rgba(0, 0, 0, 0.4);
        --input-bg-dark: #2d3748;
    }
    
    /* Apply theme based on system preference */
    @media (prefers-color-scheme: dark) {
        :root {
            --card-bg: var(--card-bg-dark);
            --text-color: var(--text-color-dark);
            --border-color: var(--border-color-dark);
            --shadow: var(--shadow-dark);
            --highlight-shadow: var(--highlight-shadow-dark);
            --input-bg: var(--input-bg-dark);
        }
    }
    
    @media (prefers-color-scheme: light) {
        :root {
            --card-bg: var(--card-bg-light);
            --text-color: var(--text-color-light);
            --border-color: var(--border-color-light);
            --shadow: var(--shadow-light);
            --highlight-shadow: var(--highlight-shadow-light);
            --input-bg: var(--input-bg-light);
        }
    }
    
    body {
        color: var(--text-color);
    }
    
    .profile-card {
        border-radius: 18px;
        box-shadow: var(--shadow);
        background-color: var(--card-bg);
        border: none;
        transition: all 0.3s ease;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .profile-card:hover {
        box-shadow: var(--highlight-shadow);
    }
    
    .profile-title {
        background: linear-gradient(135deg, #86efac, #22c55e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-group label {
        font-weight: 500;
        color: var(--text-color);
        margin-bottom: 0.5rem;
        display: block;
        transition: all 0.3s ease;
    }
    
    .form-control {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        background-color: var(--input-bg);
        color: var(--text-color);
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
    }
    
    .form-control:focus {
        border-color: #86efac;
        box-shadow: 0 0 0 0.2rem rgba(134, 239, 172, 0.25);
    }
    
    .form-control::placeholder {
        color: rgba(113, 128, 150, 0.7);
    }
    
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2322c55e' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px;
        padding-right: 2.5rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #86efac, #22c55e);
        border: none;
        border-radius: 12px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(34, 197, 94, 0.2);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(34, 197, 94, 0.3);
    }
    
    /* Animation for elements */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeInUp 0.5s ease forwards;
    }
    
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }
</style>

<div class="container py-4" data-aos="fade-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="profile-title">Profil Pengguna</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>
    
    <div class="card profile-card" data-aos="fade-up" data-aos-delay="100">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group animate-fade-in delay-1">
                <label for="name">
                    <i class="bi bi-person-circle me-1"></i> Nama
                </label>
                <input type="text" class="form-control" name="name" id="name" 
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group animate-fade-in delay-2">
                <label for="email">
                    <i class="bi bi-envelope me-1"></i> Email
                </label>
                <input type="email" class="form-control" name="email" id="email" 
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group animate-fade-in delay-3">
                <label for="gender">
                    <i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin
                </label>
                <select name="gender" id="gender" class="form-control">
                    <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="form-group animate-fade-in delay-4">
                <label for="phone">
                    <i class="bi bi-telephone me-1"></i> Nomor HP
                </label>
                <input type="text" class="form-control" name="phone" id="phone" 
                    value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end animate-fade-in delay-5">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection