@extends('layouts.app')

@section('title', 'Daftar Pertanyaan - Qhealth')

@section('content')
<style>
    /* Variabel warna dan tema */
    :root {
        /* Light mode variables */
        --card-bg-light: rgba(255, 255, 255, 0.75);
        --question-bg-light: rgba(255, 255, 255, 0.75);
        --text-color-light: #333333;
        --border-color-light: rgba(255, 255, 255, 0.3);
        --shadow-light: 0 8px 32px rgba(31, 38, 135, 0.1);
        --highlight-shadow-light: 0 12px 28px rgba(34, 197, 94, 0.15);
        --question-border-light: rgba(255, 255, 255, 0.3);
        
        /* Dark mode variables */
        --card-bg-dark: rgba(42, 42, 61, 0.8);
        --question-bg-dark: rgba(42, 42, 61, 0.8);
        --text-color-dark: #e2e8f0;
        --border-color-dark: rgba(255, 255, 255, 0.1);
        --shadow-dark: 0 8px 32px rgba(0, 0, 0, 0.2);
        --highlight-shadow-dark: 0 12px 28px rgba(34, 197, 94, 0.2);
        --question-border-dark: rgba(255, 255, 255, 0.1);
    }
    
    /* Apply theme based on system preference */
    @media (prefers-color-scheme: dark) {
        :root {
            --card-bg: var(--card-bg-dark);
            --question-bg: var(--question-bg-dark);
            --text-color: var(--text-color-dark);
            --border-color: var(--border-color-dark);
            --shadow: var(--shadow-dark);
            --highlight-shadow: var(--highlight-shadow-dark);
            --question-border: var(--question-border-dark);
        }
    }
    
    @media (prefers-color-scheme: light) {
        :root {
            --card-bg: var(--card-bg-light);
            --question-bg: var(--question-bg-light);
            --text-color: var(--text-color-light);
            --border-color: var(--border-color-light);
            --shadow: var(--shadow-light);
            --highlight-shadow: var(--highlight-shadow-light);
            --question-border: var(--question-border-light);
        }
    }
    
    body {
        color: var(--text-color);
    }
    
    /* Content container */
    .content-container {
        max-width: 900px;
        margin: 0 auto;
        padding-bottom: 50px;
    }
    
    /* Header card */
    .header-card {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        background-color: var(--card-bg);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        padding: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.8s forwards;
    }
    
    .header-card::before {
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

    .header-card::after {
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

    /* Post card dengan efek akrilik - QUESTION */
    .post-card {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        background-color: var(--question-bg);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        opacity: 0;
        transform: translateY(10px);
    }
    
    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--highlight-shadow);
    }
    
    .post-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .post-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #86efac, #22c55e);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
        margin-right: 12px;
        box-shadow: 0 3px 8px rgba(34, 197, 94, 0.2);
    }
    
    .post-user-info {
        flex-grow: 1;
    }
    
    .post-username {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.2rem;
        color: #22c55e;
    }
    
    .post-time {
        font-size: 0.8rem;
        color: #718096;
        display: flex;
        align-items: center;
    }
    
    .post-content {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        line-height: 1.5;
        padding: 0.5rem 0;
    }
    
    .post-stats {
        display: flex;
        align-items: center;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }
    
    .post-stat-item {
        display: flex;
        align-items: center;
        margin-right: 1.5rem;
    }
    
    .post-stat-icon {
        margin-right: 0.4rem;
        color: #22c55e;
    }
    
    /* Animation effect */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Button styling */
    .answer-button {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 24px;
        background-color: #22c55e;
        color: white;
        border: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        font-weight: 600;
        box-shadow: 0 3px 8px rgba(34, 197, 94, 0.2);
        text-decoration: none;
    }
    
    .answer-button:hover {
        transform: scale(1.03);
        box-shadow: 0 5px 15px rgba(34, 197, 94, 0.3);
        background-color: #16a34a;
        color: white;
        text-decoration: none;
    }
    
    .answer-button i {
        margin-right: 0.5rem;
    }
    
    /* Back button */
    .back-button {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        background-color: transparent;
        color: #22c55e;
        border: 1px solid #22c55e;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        text-decoration: none;
    }
    
    .back-button:hover {
        background-color: rgba(34, 197, 94, 0.1);
        transform: translateX(-3px);
        color: #22c55e;
        text-decoration: none;
    }
    
    /* Search bar styling */
    .search-container {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .search-input {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 3rem;
        border-radius: 24px;
        border: 1px solid var(--border-color);
        background-color: var(--card-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: var(--shadow);
        color: var(--text-color);
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        outline: none;
        box-shadow: var(--highlight-shadow);
        border-color: rgba(34, 197, 94, 0.3);
    }
    
    .search-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #22c55e;
        font-size: 1.1rem;
    }
    
    /* Empty state styling */
    .empty-state {
        text-align: center;
        padding: 2rem;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        background-color: var(--card-bg);
        border-radius: 16px;
        margin: 1rem 0;
        animation: fadeIn 0.8s forwards;
    }
    
    .empty-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #86efac, #22c55e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    /* Pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .pagination .page-item .page-link {
        border: none;
        border-radius: 8px;
        margin: 0 0.2rem;
        background: var(--card-bg);
        color: var(--text-color);
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #86efac, #22c55e);
        color: white;
    }
    
    .pagination .page-item .page-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Filter buttons */
    .filter-container {
        display: flex;
        justify-content: flex-end; /* Berubah dari center menjadi flex-end (ke kanan) */
        margin-bottom: 1.5rem;
    }
    
    .filter-buttons {
        display: flex;
        background-color: var(--card-bg);
        border-radius: 12px;
        padding: 0.3rem;
        box-shadow: var(--shadow);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: none;
        background: transparent;
        color: var(--text-color);
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        margin: 0 0.1rem;
    }
    
    .filter-btn.active {
        background: linear-gradient(135deg, #86efac, #22c55e);
        color: white;
        box-shadow: 0 2px 8px rgba(34, 197, 94, 0.2);
    }
    
    .filter-btn:hover:not(.active) {
        background-color: rgba(34, 197, 94, 0.1);
    }
    
    /* Status badge */
    .status-badge {
        padding: 0.25rem 0.7rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .status-badge i {
        margin-right: 0.3rem;
    }
    
    .status-answered {
        background-color: rgba(34, 197, 94, 0.15);
        color: #16a34a;
    }
    
    .status-waiting {
        background-color: rgba(234, 179, 8, 0.15);
        color: #b45309;
    }

    /* Tambahan style untuk layout baru */
    .header-actions {
        display: flex;
        flex-direction: column;
        margin-bottom: 1.5rem;
    }

    .action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .title-section {
        text-align: center;
    }
</style>

<div class="container py-4">
    <div class="content-container">
        <!-- Layout baru: Header untuk title dan tombol kembali dipisah -->
        <div class="header-card">
            <div class="action-row">
                <a href="{{ route('dashboard') }}" class="back-button">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <h4 class="mb-0 fw-bold text-success">
                    <i class="bi bi-question-circle me-2"></i>Daftar Pertanyaan Kesehatan
                </h4>
                <div style="width: 88px;"></div> <!-- Elemen penyeimbang -->
            </div>
        </div>
        
        <!-- Layout baru: Search diposisikan di atas dan filter di kanan -->
        <div class="header-actions">
            <!-- Search bar -->
            <div class="search-container">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari pertanyaan...">
            </div>
            
            <!-- Filter buttons pindah ke kanan -->
            <div class="filter-container">
                <div class="filter-buttons">
                    <button type="button" class="filter-btn active" data-filter="all">Semua</button>
                    <button type="button" class="filter-btn" data-filter="unanswered">Belum Dijawab</button>
                    <button type="button" class="filter-btn" data-filter="answered">Terjawab</button>
                </div>
            </div>
        </div>
        
        <!-- List Pertanyaan -->
        <div class="question-list">
            @forelse($questions as $question)
                <?php
                    // Menentukan status pertanyaan secara komprehensif
                    $isAnswered = false;
                    
                    // Cek berbagai kemungkinan properti yang menandakan pertanyaan sudah dijawab
                    if (
                        (isset($question->answers) && count($question->answers) > 0) || 
                        (isset($question->answer) && $question->answer) || 
                        (isset($question->answered) && $question->answered) ||
                        (isset($question->status) && $question->status === 'answered') ||
                        (isset($question->answer_count) && $question->answer_count > 0)
                    ) {
                        $isAnswered = true;
                    }
                    
                    $questionClass = $isAnswered ? 'answered-question' : 'unanswered-question';
                    
                    // Hitung jumlah jawaban
                    $answerCount = 0;
                    if (isset($question->answers)) {
                        $answerCount = count($question->answers);
                    } elseif (isset($question->answer_count)) {
                        $answerCount = $question->answer_count;
                    }
                    
                    // Ambil inisial untuk avatar
                    $initial = 'A'; // Default
                    if (isset($question->user) && isset($question->user->name)) {
                        $initial = strtoupper(substr($question->user->name, 0, 1));
                    }
                    
                    // Format username
                    $username = 'Anonim';
                    if (isset($question->user) && isset($question->user->name)) {
                        $username = $question->user->name;
                    }
                ?>
                <div class="post-card question-item {{ $questionClass }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">            
                    <div class="post-header">
                        <div class="post-avatar">
                            {{ $initial }}
                        </div>
                        <div class="post-user-info">
                            <div class="post-username">{{ $username }}</div>
                            <div class="post-time">
                                <i class="bi bi-clock me-1"></i> {{ $question->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="ms-auto">
                            <span class="status-badge {{ $isAnswered ? 'status-answered' : 'status-waiting' }}">
                                <i class="bi {{ $isAnswered ? 'bi-check-circle-fill' : 'bi-clock-fill' }}"></i>
                                {{ $isAnswered ? 'Terjawab' : 'Menunggu' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="post-content">
                        {{ $question->question }}
                    </div>
                    
                    <div class="post-stats">
                        <div class="post-stat-item">
                            <i class="bi bi-chat-dots-fill post-stat-icon"></i>
                            <span>{{ $answerCount }} Jawaban</span>
                        </div>
                        <div class="post-stat-item">
                            <i class="bi bi-eye-fill post-stat-icon"></i>
                            <span>{{ $question->views_count ?? 0 }} Dilihat</span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('questions.show', $question->id) }}" class="back-button">
                            <i class="bi bi-eye-fill me-2"></i> Lihat Detail
                        </a>
                        <a href="{{ route('questions.answer.store', $question->id) }}" class="answer-button">
                            <i class="bi bi-reply-fill"></i> Jawab Pertanyaan
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-question-circle empty-icon"></i>
                    <h5 class="mb-2">Belum ada pertanyaan</h5>
                    <p class="mb-3">Jadilah yang pertama mengajukan pertanyaan kesehatan!</p>
                    <a href="{{ route('dashboard') }}" class="answer-button">
                        <i class="bi bi-plus-circle-fill me-2"></i> Ajukan Pertanyaan
                    </a>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination (hanya tampilkan jika benar-benar instance dari paginator) -->
        @if (isset($questions) && $questions instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="pagination-container">
                {{ $questions->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate question items sequentially
        const postCards = document.querySelectorAll('.post-card');
        postCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 300 + (index * 100));
        });
        
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
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
                    const questionText = item.querySelector('.post-content').innerText.toLowerCase();
                    const usernameText = item.querySelector('.post-username').innerText.toLowerCase();
                    
                    if (questionText.includes(searchTerm) || usernameText.includes(searchTerm)) {
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