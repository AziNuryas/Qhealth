@extends('layouts.app')

@section('title', 'Detail Pertanyaan - Qhealth')

@section('content')
<style>
    /* Variabel warna dan tema */
    :root {
        /* Light mode variables */
        --card-bg-light: rgba(255, 255, 255, 0.75);
        --question-bg-light: rgba(255, 255, 255, 0.75);
        --answer-bg-light: rgba(255, 255, 255, 0.75);
        --text-color-light: #333333;
        --border-color-light: rgba(255, 255, 255, 0.3);
        --shadow-light: 0 8px 32px rgba(31, 38, 135, 0.1);
        --highlight-shadow-light: 0 12px 28px rgba(34, 197, 94, 0.15);
        --question-border-light: rgba(255, 255, 255, 0.3);
        --answer-border-light: rgba(255, 255, 255, 0.3);
        
        /* Dark mode variables */
        --card-bg-dark: rgba(42, 42, 61, 0.8);
        --question-bg-dark: rgba(42, 42, 61, 0.8);
        --answer-bg-dark: rgba(42, 42, 61, 0.8);
        --text-color-dark: #e2e8f0;
        --border-color-dark: rgba(255, 255, 255, 0.1);
        --shadow-dark: 0 8px 32px rgba(0, 0, 0, 0.2);
        --highlight-shadow-dark: 0 12px 28px rgba(34, 197, 94, 0.2);
        --question-border-dark: rgba(255, 255, 255, 0.1);
        --answer-border-dark: rgba(255, 255, 255, 0.1);
    }
    
    /* Apply theme based on system preference */
    @media (prefers-color-scheme: dark) {
        :root {
            --card-bg: var(--card-bg-dark);
            --question-bg: var(--question-bg-dark);
            --answer-bg: var(--answer-bg-dark);
            --text-color: var(--text-color-dark);
            --border-color: var(--border-color-dark);
            --shadow: var(--shadow-dark);
            --highlight-shadow: var(--highlight-shadow-dark);
            --question-border: var(--question-border-dark);
            --answer-border: var(--answer-border-dark);
        }
    }
    
    @media (prefers-color-scheme: light) {
        :root {
            --card-bg: var(--card-bg-light);
            --question-bg: var(--question-bg-light);
            --answer-bg: var(--answer-bg-light);
            --text-color: var(--text-color-light);
            --border-color: var(--border-color-light);
            --shadow: var(--shadow-light);
            --highlight-shadow: var(--highlight-shadow-light);
            --question-border: var(--question-border-light);
            --answer-border: var(--answer-border-light);
        }
    }
    
    body {
        color: var(--text-color);
    }
    
    /* Content container */
    .content-container {
        max-width: 900px;
        margin: 0 auto;
        padding-bottom: 120px; /* Extra padding untuk sticky form */
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
        border: 1px solid var(--question-border);
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

    /* Comment/Answer card */
    .comment-item {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        background-color: var(--answer-bg);
        border-radius: 16px;
        border: 1px solid var(--answer-border);
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        opacity: 0;
        transform: translateY(10px);
    }
    
    .comment-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--highlight-shadow);
    }
    
    .comment-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #93c5fd, #60a5fa);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
        margin-right: 12px;
        flex-shrink: 0;
        box-shadow: 0 3px 8px rgba(96, 165, 250, 0.2);
    }
    
    .comment-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .comment-user-info {
        flex-grow: 1;
    }
    
    .comment-username {
        font-weight: 600;
        font-size: 0.95rem;
        color: #60a5fa;
        margin-bottom: 0.2rem;
    }
    
    .comment-time {
        font-size: 0.8rem;
        color: #718096;
        display: flex;
        align-items: center;
    }
    
    .comment-text {
        font-size: 1rem;
        line-height: 1.5;
        padding: 0.5rem 0;
        white-space: pre-wrap;
    }
    
    /* Animation effect */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
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
    
    /* Answers section */
    .answers-section {
        margin-top: 1.5rem;
    }
    
    .answers-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #60a5fa;
        display: flex;
        align-items: center;
    }
    
    .answers-title i {
        margin-right: 0.5rem;
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
        background: linear-gradient(135deg, #93c5fd, #60a5fa);
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
    
    /* ChatGPT-style sticky input form */
    .sticky-comment-form {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem 0;
        z-index: 1000;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
    }
    
    .comment-form-container {
        max-width: 900px;
        width: 100%;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .comment-input-container {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 24px;
        padding: 0.5rem 1rem;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    body.dark-mode .comment-input-container {
        background-color: rgba(42, 42, 61, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .comment-textarea {
        border: none;
        background: transparent !important;
        resize: none;
        padding: 0.7rem 0;
        flex-grow: 1;
        max-height: 150px;
        overflow-y: auto;
        font-size: 0.95rem;
        line-height: 1.5;
        color: #000000 !important;
    }
    
    .comment-textarea:focus {
        outline: none;
        box-shadow: none;
        color: #000000 !important;
    }
    
    body.dark-mode .comment-textarea {
        color: #ffffff !important;
    }
    
    body.dark-mode .comment-textarea::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .comment-textarea::placeholder {
        color: rgba(0, 0, 0, 0.7);
    }
    
    .send-button {
        border-radius: 12px;
        min-width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #86efac, #22c55e);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        padding: 0 12px;
    }
    
    .send-button:hover {
        transform: scale(1.05);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #22c55e, #16a34a);
    }
    
    /* Form background blur overlay */
    .form-blur-background {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(to top, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0));
        z-index: 999;
        pointer-events: none;
    }
    
    body.dark-mode .form-blur-background {
        background: linear-gradient(to top, rgba(15, 15, 25, 0.9), rgba(15, 15, 25, 0));
    }
</style>

<div class="container py-4">
    <div class="content-container">
        <!-- Header Card hanya dengan judul (tanpa tombol kembali) -->
        <div class="header-card">
            <div class="d-flex justify-content-center align-items-center">
                <h4 class="mb-0 fw-bold text-success">
                    <i class="bi bi-question-circle me-2"></i>Detail Pertanyaan
                </h4>
            </div>
        </div>
        
        <!-- Card posting pertanyaan dengan efek akrilik -->
        <div class="post-card" data-aos="fade-up">            
            <div class="post-header">
                <div class="post-avatar">
                    {{ isset($question->user) ? strtoupper(substr($question->user->name, 0, 1)) : 'A' }}
                </div>
                <div class="post-user-info">
                    <div class="post-username">{{ isset($question->user) ? $question->user->name : 'Anonim' }}</div>
                    <div class="post-time">
                        <i class="bi bi-clock me-1"></i> {{ $question->created_at->diffForHumans() }}
                    </div>
                </div>
                <div class="ms-auto">
                    <span class="status-badge {{ $question->answers->count() > 0 ? 'status-answered' : 'status-waiting' }}">
                        <i class="bi {{ $question->answers->count() > 0 ? 'bi-check-circle-fill' : 'bi-clock-fill' }}"></i>
                        {{ $question->answers->count() > 0 ? 'Terjawab' : 'Menunggu' }}
                    </span>
                </div>
            </div>
            
            <div class="post-content">
                {{ $question->question }}
            </div>
            
            <div class="post-stats">
                <div class="post-stat-item">
                    <i class="bi bi-chat-dots-fill post-stat-icon"></i>
                    <span>{{ $question->answers->count() }} Jawaban</span>
                </div>
                <div class="post-stat-item">
                    <i class="bi bi-eye-fill post-stat-icon"></i>
                    <span>{{ $question->views_count ?? 0 }} Dilihat</span>
                </div>
            </div>
        </div>
        
        <!-- Answers Section -->
        <div class="answers-section">
            <h5 class="answers-title">
                <i class="bi bi-chat-square-text"></i>
                Jawaban ({{ $question->answers->count() }})
            </h5>
            
            @forelse ($question->answers as $answer)
                <div class="comment-item" style="--item-index: {{ $loop->index }}" data-aos="fade-up" data-aos-delay="{{ 100 + $loop->index * 50 }}">
                    <div class="comment-header">
                        <div class="comment-avatar">
                            {{ isset($answer->user) ? strtoupper(substr($answer->user->name, 0, 1)) : 'A' }}
                        </div>
                        <div class="comment-user-info">
                            <div class="comment-username">{{ isset($answer->user) ? $answer->user->name : 'Anonim' }}</div>
                            <div class="comment-time">
                                <i class="bi bi-clock me-1"></i> {{ $answer->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="comment-text">{{ $answer->content }}</div>
                </div>
            @empty
                <div class="empty-state" data-aos="zoom-in">
                    <i class="bi bi-chat-dots empty-icon"></i>
                    <p class="mb-2">Belum ada jawaban untuk pertanyaan ini</p>
                    <p class="mb-0">Jadilah yang pertama memberikan jawaban!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Form background blur gradient -->
<div class="form-blur-background"></div>

<!-- Form komentar sticky seperti ChatGPT -->
<div class="sticky-comment-form">
    <div class="comment-form-container">
        <form action="{{ route('questions.answer.store', $question->id) }}" method="POST">
            @csrf
            <input type="hidden" name="redirect_back" value="1">
            <div class="comment-input-container">
                <textarea name="content" class="comment-textarea form-control" 
                    placeholder="Tulis jawaban Anda..." rows="1" required></textarea>
                <button type="submit" class="send-button">
                    <i class="bi bi-send-fill text-white"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate post cards and answer items sequentially
        const postCard = document.querySelector('.post-card');
        const commentItems = document.querySelectorAll('.comment-item');
        
        setTimeout(() => {
            if (postCard) {
                postCard.style.opacity = '1';
                postCard.style.transform = 'translateY(0)';
            }
        }, 300);
        
        commentItems.forEach((item, index) => {
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, 500 + (index * 150));
        });
        
        // Auto-resize textarea
        const textarea = document.querySelector('.comment-textarea');
        
        function autoResize() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        }
        
        // Apply to the textarea
        if (textarea) {
            textarea.addEventListener('input', autoResize);
            
            // Initially set the height correctly (for when there's content)
            setTimeout(function() {
                textarea.dispatchEvent(new Event('input'));
            }, 100);
            
            // Focus handling for mobile
            textarea.addEventListener('focus', function() {
                setTimeout(function() {
                    window.scrollTo(0, document.body.scrollHeight);
                }, 300);
            });
        }
    });
</script>
@endsection