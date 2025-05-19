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
        padding: 1.8rem;
        margin-bottom: 2rem;
        position: relative;
        text-align: center;
    }

    body.dark-mode .profile-card {
        background-color: rgba(42, 42, 61, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .profile-title {
        font-weight: 600;
        color: #22c55e;
        margin-bottom: 1.5rem;
    }

    body.dark-mode .profile-title {
        color: #4ade80;
    }

    /* Styling untuk layout dua kartu */
    .profile-container {
        display: flex;
        justify-content: flex-start; /* Letakkan kartu di sebelah kiri */
        gap: 2rem;
    }

    .profile-left-card, .profile-right-card {
        flex: 1;
    }

    /* Penyesuaian untuk responsif */
    @media (max-width: 768px) {
        .profile-container {
            flex-direction: column;
        }

        .profile-left-card, .profile-right-card {
            flex: none;
            width: 100%;
        }
    }

    /* Styling untuk gambar profil bulat dan di tengah */
    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-color: #22c55e; /* Warna latar belakang untuk huruf */
        color: white;
        font-size: 70px; /* Huruf besar di tengah */
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 0; /* Memastikan gambar berada di tengah */
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        border: 4px solid white;
    }

    /* Styling untuk informasi profil */
    .profile-info {
        margin-top: 100px; /* Memberi ruang untuk gambar */
    }

    .profile-name {
        font-size: 1.25rem;
        font-weight: bold;
        margin-top: 0.75rem;
    }

    .profile-details {
        font-size: 0.9rem;
        color: #4b5563;
        margin-top: 10px;
    }

    .profile-details p {
        margin: 5px 0;
    }

    /* Styling untuk form */
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

    body.dark-mode .form-control {
        background-color: rgba(42, 42, 61, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #f1f1f1;
    }

    .btn-primary {
        background-color: #22c55e;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(34, 197, 94, 0.15);
    }

    .btn-primary:hover {
        background-color: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(34, 197, 94, 0.2);
    }
</style>

<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="profile-title">Profil Pengguna</h2>
    </div>

    <div class="profile-container">
        <!-- Kartu kiri: Foto profil dan info pengguna -->
        <div class="card profile-card profile-left-card" data-aos="fade-up" data-aos-delay="100">
            <!-- Gambar Profil -->
            <div class="profile-image">
                <!-- Menampilkan huruf pertama dari nama pengguna -->
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div class="profile-info">
                <h4 class="profile-name">{{ $user->name }}</h4>
                <div class="profile-details">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $user->gender }}</p>
                    <p><strong>Nomor HP:</strong> {{ $user->phone }}</p>
                </div>
            </div>
        </div>

        <!-- Kartu kanan: Form Edit -->
        <div class="card profile-card profile-right-card" data-aos="fade-up" data-aos-delay="100">
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
                        value="{{ old('phone', $user->phone) }}"/>
                </div>

                <div class="d-flex justify-content-end animate-fade-in delay-5">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
