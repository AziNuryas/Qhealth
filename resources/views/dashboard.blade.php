@extends('layouts.app')

@section('title', 'Dashboard - Qhealth')

@section('content')
<style>
    /* Kartu dengan efek blur akrilik */
    .akrilik-card {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background-color: rgba(255, 255, 255, 0.65);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
        transition: all 0.3s ease;
        padding: 1.5rem;
        position: relative;
    }

    body.dark-mode .akrilik-card {
        background-color: rgba(42, 42, 61, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .question-card {
        transition: all 0.3s ease;
        border-left: 3px solid #22c55e;
    }
    
    .question-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .section-title {
        font-weight: 600;
        color: #22c55e;
        margin-bottom: 1rem;
        font-size: 1.3rem;
    }

    body.dark-mode .section-title {
        color: #4ade80;
    }

    /* Styling untuk form */
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

    .btn-qhealth {
        background-color: #22c55e;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(34, 197, 94, 0.15);
        color: white;
        font-size: 0.95rem;
    }

    .btn-qhealth:hover {
        background-color: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(34, 197, 94, 0.2);
    }

    .btn-filter {
        color: #22c55e;
        border: 1px solid #22c55e;
        background-color: transparent;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-filter:hover, .btn-filter.active {
        background-color: #22c55e;
        color: white;
    }

    /* Animation classes */
    .animate-fade-in {
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.8s forwards;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }

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
    .welcome-card::before {
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

    .welcome-card::after {
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

    .stat-icon {
        height: 60px;
        width: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        background-color: rgba(34, 197, 94, 0.15);
    }

    .stat-icon i {
        font-size: 1.8rem;
        color: #22c55e;
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

    .status-badge {
        font-size: 0.8rem;
        padding: 0.35rem 0.6rem;
        border-radius: 50px;
    }

    .status-waiting {
        background-color: rgba(234, 179, 8, 0.15);
        color: #b45309;
    }

    .status-answered {
        background-color: rgba(34, 197, 94, 0.15);
        color: #16a34a;
    }

    .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background-color: transparent;
    }
</style>

<div class="container py-4">
    {{-- Header --}}
    <div class="akrilik-card welcome-card mb-4 animate-fade-in">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h1 class="display-6 fw-bold text-success mb-2">Selamat Datang Di Qhealth</h1>
                <p class="lead mb-0 text-muted">Ajukan pertanyaan seputar kesehatan kamu di sini!</p>
            </div>
            <div class="col-md-3 text-end d-none d-md-block">
                <i class="bi bi-heart-pulse-fill text-success opacity-60" style="font-size: 4rem;"></i>
            </div>
        </div>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success animate-fade-in">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="row mb-4">
        {{-- Form Pertanyaan --}}
        <div class="col-lg-5 mb-4 mb-lg-0">
            <div class="akrilik-card h-100 animate-fade-in delay-1">
                <h4 class="section-title">
                    <i class="bi bi-plus-circle-fill me-2"></i>Ajukan Pertanyaan
                </h4>
                <p class="text-muted small mb-3">Tanyakan masalah kesehatan anda dan dapatkan solusinya.</p>
                
                <form action="{{ route('dashboard.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="question" class="form-label">Pertanyaan Anda</label>
                        <input type="text" name="question" id="question" class="form-control form-control-lg" 
                               placeholder="Apa yang ingin Anda tanyakan?" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-qhealth">
                            <i class="bi bi-send-fill me-2"></i>Kirim Pertanyaan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="col-lg-7">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="akrilik-card text-center animate-fade-in delay-2">
                        <div class="stat-icon">
                            <i class="bi bi-question-circle-fill"></i>
                        </div>
                        <h3 class="h1 mb-1">{{ count($questions) }}</h3>
                        <p class="text-muted mb-0">Pertanyaan</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="akrilik-card text-center animate-fade-in delay-3">
                        <div class="stat-icon">
                            <i class="bi bi-chat-left-text-fill"></i>
                        </div>
                        <?php
                            // Hitung jumlah jawaban dari collection pertanyaan
                            // Misalkan ada relasi hasMany answers di model Question
                            // atau kita bisa menggunakan properti untuk menentukan status jawaban
                            $answeredCount = 0;
                            $userIds = [];
                            
                            foreach ($questions as $q) {
                                // Tambahkan user ID ke array untuk menghitung unik pengguna
                                if (isset($q->user) && isset($q->user->id)) {
                                    $userIds[] = $q->user->id;
                                }
                                
                                // Cek apakah sudah dijawab (3 cara pengecekan berbeda)
                                if (
                                    (isset($q->answers) && count($q->answers) > 0) || 
                                    (isset($q->answer) && $q->answer) || 
                                    (isset($q->answered) && $q->answered) ||
                                    (isset($q->status) && $q->status === 'answered')
                                ) {
                                    $answeredCount++;
                                }
                            }
                        ?>
                        <h3 class="h1 mb-1">{{ $answeredCount }}</h3>
                        <p class="text-muted mb-0">Jawaban</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="akrilik-card text-center animate-fade-in delay-4">
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <?php
                            // Hitung jumlah pengguna unik dari daftar pertanyaan
                            // Jika $users_count tersedia, gunakan itu. Jika tidak, hitung dari pertanyaan
                            $uniqueUsersCount = isset($users_count) ? $users_count : count(array_unique($userIds));
                        ?>
                        <h3 class="h1 mb-1">{{ $uniqueUsersCount }}</h3>
                        <p class="text-muted mb-0">Pengguna</p>
                    </div>
                </div>
            </div>

            {{-- Pencarian --}}
            <div class="akrilik-card mt-3 animate-fade-in delay-5">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-0" 
                           placeholder="Cari pertanyaan kesehatan..." id="searchInput">
                    <button class="btn btn-qhealth" type="button">Cari</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigasi Pertanyaan --}}
    <div class="d-flex justify-content-between align-items-center mb-3 animate-fade-in">
        <h4 class="section-title mb-0">
            <i class="bi bi-list-ul me-2"></i>Daftar Pertanyaan
        </h4>
        <div class="btn-group" role="group" id="filterButtons">
            <button type="button" class="btn btn-filter active" data-filter="all">Semua</button>
            <button type="button" class="btn btn-filter" data-filter="unanswered">Belum Dijawab</button>
            <button type="button" class="btn btn-filter" data-filter="answered">Terjawab</button>
        </div>
    </div>

    {{-- Daftar Pertanyaan --}}
    <div class="row g-4" id="questionsList">
        @forelse($questions as $q)
            <?php
                // Menentukan status pertanyaan dengan metode yang lebih komprehensif
                $isAnswered = false;
                
                // Cek berbagai kemungkinan properti yang menandakan pertanyaan sudah dijawab
                if (
                    (isset($q->answers) && count($q->answers) > 0) || 
                    (isset($q->answer) && $q->answer) || 
                    (isset($q->answered) && $q->answered) ||
                    (isset($q->status) && $q->status === 'answered') ||
                    (isset($q->answer_count) && $q->answer_count > 0)
                ) {
                    $isAnswered = true;
                }
                
                $questionClass = $isAnswered ? 'answered-question' : 'unanswered-question';
            ?>
            <div class="col-md-6 question-item {{ $questionClass }} animate-fade-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="akrilik-card h-100 question-card">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center" 
                                         style="width: 45px; height: 45px; background-color: rgba(34, 197, 94, 0.15);">
                                        <i class="bi bi-person-fill text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0 text-success">
                                        {{ $q->user->name ?? 'Anonim' }}
                                    </h5>
                                    <small class="text-muted">{{ $q->created_at->format('d F Y') }}</small>
                                </div>
                                <div class="ms-auto">
                                    <span class="status-badge {{ $isAnswered ? 'status-answered' : 'status-waiting' }}">
                                        <i class="bi {{ $isAnswered ? 'bi-check-circle-fill' : 'bi-clock-fill' }} me-1"></i>
                                        {{ $isAnswered ? 'Terjawab' : 'Menunggu' }}
                                    </span>
                                </div>
                            </div>
                            <h6 class="mb-2">{{ $q->question }}</h6>
                            <p class="text-muted small">
                                {{ Str::limit($q->details ?? $q->question, 100) }}
                            </p>
                        </div>
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="bi bi-clock-history me-1"></i>{{ $q->created_at->diffForHumans() }}
                            </small>
                            <a href="{{ route('questions.answer.store', $q->id) }}" class="btn btn-filter btn-sm">
                                <i class="bi bi-reply-fill me-1"></i>Jawab
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 animate-fade-in">
                <div class="display-1 text-muted mb-4">
                    <i class="bi bi-question-circle text-success opacity-25" style="font-size: 5rem;"></i>
                </div>
                <h3 class="text-muted">Belum ada pertanyaan</h3>
                <p class="text-muted mb-4">Jadilah yang pertama mengajukan pertanyaan kesehatan!</p>
            </div>
        @endforelse
    </div>
</div>

{{-- Script --}}
<script>
    // Auto dismiss alerts after 5 seconds
    window.setTimeout(function() {
        document.querySelectorAll(".alert").forEach(function(alert) {
            setTimeout(function() {
                alert.style.opacity = "0";
                setTimeout(function() {
                    alert.style.display = "none";
                }, 500);
            }, 5000);
        });
    }, 500);

    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('#filterButtons .btn-filter');
        const questionItems = document.querySelectorAll('.question-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                
                // Show/hide questions based on filter
                questionItems.forEach(item => {
                    if (filter === 'all') {
                        item.style.display = 'block';
                    } else if (filter === 'answered' && item.classList.contains('answered-question')) {
                        item.style.display = 'block';
                    } else if (filter === 'unanswered' && item.classList.contains('unanswered-question')) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                
                questionItems.forEach(item => {
                    const questionText = item.querySelector('h6').innerText.toLowerCase();
                    const detailsText = item.querySelector('p').innerText.toLowerCase();
                    
                    if (questionText.includes(searchTerm) || detailsText.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection