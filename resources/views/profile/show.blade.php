@extends('layouts.app')

@section('content')

<style>
    /* Kartu dengan efek blur akrilik */
    .profile-card {
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
        overflow: hidden;
    }

    body.dark-mode .profile-card {
        background-color: rgba(42, 42, 61, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .profile-title {
        font-weight: 600;
        color: #22c55e;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    body.dark-mode .profile-title {
        color: #4ade80;
    }

    /* Styling untuk layout dua kartu */
    .profile-container {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 2rem;
        align-items: start;
    }

    /* Penyesuaian untuk responsif */
    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
    }

    /* Styling untuk gambar profil dengan efek modern */
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: white;
        font-size: 3rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        border: 4px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
        position: relative;
        transition: all 0.3s ease;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(34, 197, 94, 0.4);
    }

    /* Styling untuk informasi profil */
    .profile-info {
        text-align: center;
    }

    .profile-name {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #1f2937;
    }

    body.dark-mode .profile-name {
        color: #f1f1f1;
    }

    .profile-email {
        color: #6b7280;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .profile-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        background: rgba(34, 197, 94, 0.08);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        background: rgba(34, 197, 94, 0.12);
        transform: translateY(-2px);
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #22c55e;
        display: block;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    /* Styling untuk form */
    .form-section {
        margin-bottom: 2rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid rgba(34, 197, 94, 0.2);
    }

    .section-icon {
        width: 40px;
        height: 40px;
        background: rgba(34, 197, 94, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: #22c55e;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    body.dark-mode .section-title {
        color: #f1f1f1;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
        color: #374151;
        font-size: 0.95rem;
    }

    body.dark-mode .form-label {
        color: #d1d5db;
    }

    .form-control {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1.5px solid #e5e7eb;
        background-color: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #22c55e;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        background-color: white;
    }

    body.dark-mode .form-control {
        background-color: rgba(42, 42, 61, 0.9);
        border-color: #4b5563;
        color: #f1f1f1;
    }

    body.dark-mode .form-control:focus {
        border-color: #4ade80;
        box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
    }

    .btn-save {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: none;
        border-radius: 12px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        color: white;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);
        background: linear-gradient(135deg, #16a34a, #15803d);
    }

    /* Animasi */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }

    /* Decorative elements */
    .profile-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(34, 197, 94, 0.1) 0%, transparent 70%);
        z-index: -1;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="profile-title">
            <i class="bi bi-person-badge me-2"></i>Profil Pengguna
        </h2>
    </div>

    <div class="profile-container">
        <!-- Kartu kiri: Foto profil dan info pengguna -->
        <div class="profile-card animate-fade-in">
            <div class="profile-info">
                <div class="profile-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                
                <h3 class="profile-name">{{ $user->name }}</h3>
                <p class="profile-email">{{ $user->email }}</p>
                
                <div class="profile-details mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Jenis Kelamin:</span>
                        <strong>{{ $user->gender ?? 'Belum diatur' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Nomor HP:</span>
                        <strong>{{ $user->phone ?? 'Belum diatur' }}</strong>
                    </div>
                </div>

                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-number">0</span>
                        <span class="stat-label">Pertanyaan</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">0</span>
                        <span class="stat-label">Jawaban</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu kanan: Form Edit -->
        <div class="profile-card animate-fade-in delay-1">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <h4 class="section-title">Informasi Pribadi</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person me-1"></i> Nama Lengkap
                                </label>
                                <input type="text" class="form-control" name="name" id="name" 
                                    value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-1"></i> Alamat Email
                                </label>
                                <input type="email" class="form-control" name="email" id="email" 
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender" class="form-label">
                                    <i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin
                                </label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="form-label">
                                    <i class="bi bi-telephone me-1"></i> Nomor Telepon
                                </label>
                                <input type="text" class="form-control" name="phone" id="phone" 
                                    value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 081234567890">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection