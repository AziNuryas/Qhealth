@extends('layouts.app')

@section('title', 'Daftar Pertanyaan')

@section('content')
<style>
    .page-header {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 20px 24px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-md);
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .page-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .page-title i {
        font-size: 24px;
        color: var(--accent-primary);
    }

    .header-actions {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .search-container {
        position: relative;
        width: 280px;
    }

    .search-input {
        width: 100%;
        padding: 9px 14px 9px 38px;
        border: 1px solid var(--card-border);
        border-radius: 10px;
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: 15px;
        pointer-events: none;
    }

    .filter-section {
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
    }

    .filter-chip {
        padding: 8px 16px;
        border-radius: 20px;
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        color: var(--text-primary);
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        backdrop-filter: blur(20px);
    }

    .filter-chip:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateY(-1px);
    }

    .filter-chip.active {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: white;
        border-color: transparent;
        box-shadow: 0 3px 10px rgba(16, 185, 129, 0.3);
    }

    .question-card {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 14px;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        border-left: 3px solid var(--accent-primary);
    }

    .question-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .question-header {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 14px;
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 3px 10px rgba(16, 185, 129, 0.2);
    }

    .question-meta {
        flex: 1;
        min-width: 0;
    }

    .question-author {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 3px;
    }

    .question-time {
        font-size: 11px;
        color: var(--text-tertiary);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .status-badge {
        padding: 5px 11px;
        border-radius: 16px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        flex-shrink: 0;
    }

    .status-answered {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .status-waiting {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    .question-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .question-content {
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 14px;
    }

    .question-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 12px;
        border-top: 1px solid var(--card-border);
    }

    .question-stats {
        display: flex;
        gap: 16px;
        font-size: 12px;
        color: var(--text-tertiary);
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .stat-item i {
        color: var(--accent-primary);
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        padding: 7px 14px;
        border-radius: 8px;
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        color: var(--text-primary);
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-action:hover {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: white;
        border-color: transparent;
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(16, 185, 129, 0.3);
    }

    .btn-action i {
        font-size: 13px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        box-shadow: var(--shadow-md);
    }

    .empty-icon {
        font-size: 64px;
        color: var(--accent-primary);
        opacity: 0.3;
        margin-bottom: 16px;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .empty-text {
        font-size: 13px;
        color: var(--text-secondary);
        margin-bottom: 20px;
    }

    .btn-primary-action {
        padding: 10px 20px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: white;
        border: none;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-primary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4);
        color: white;
    }

    @media (max-width: 768px) {
        .search-container {
            width: 100%;
        }

        .header-content {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-section {
            overflow-x: auto;
            flex-wrap: nowrap;
            padding-bottom: 8px;
        }

        .filter-chip {
            white-space: nowrap;
        }
    }
</style>

<div class="container py-3">
    <div class="page-header" data-aos="fade-in">
        <div class="header-content">
            <h1 class="page-title">
                <i class="bi bi-chat-dots-fill"></i>
                Daftar Pertanyaan
            </h1>
            <div class="header-actions">
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" id="searchInput" placeholder="Cari pertanyaan...">
                </div>
            </div>
        </div>
    </div>

    <div class="filter-section" data-aos="fade-in" data-aos-delay="100">
        <button class="filter-chip active" data-filter="all">
            <i class="bi bi-grid-fill"></i> Semua
        </button>
        <button class="filter-chip" data-filter="unanswered">
            <i class="bi bi-clock-fill"></i> Belum Dijawab
        </button>
        <button class="filter-chip" data-filter="answered">
            <i class="bi bi-check-circle-fill"></i> Terjawab
        </button>
    </div>

    <div class="questions-list">
        @forelse($questions as $q)
            <?php
                $isAnswered = $q->answers && $q->answers->count() > 0;
                $questionClass = $isAnswered ? 'answered-question' : 'unanswered-question';
                $answerCount = $q->answers ? $q->answers->count() : 0;
            ?>
            <div class="question-card question-item {{ $questionClass }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="question-header">
                    <div class="user-avatar">
                        {{ strtoupper(substr($q->user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="question-meta">
                        <div class="question-author">{{ $q->user->name ?? 'Anonim' }}</div>
                        <div class="question-time">
                            <i class="bi bi-calendar3"></i>
                            {{ $q->created_at->format('d M Y') }}
                            <span>•</span>
                            <i class="bi bi-clock"></i>
                            {{ $q->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <span class="status-badge {{ $isAnswered ? 'status-answered' : 'status-waiting' }}">
                        <i class="bi {{ $isAnswered ? 'bi-check-circle-fill' : 'bi-clock-fill' }}"></i>
                        {{ $isAnswered ? 'Terjawab' : 'Menunggu' }}
                    </span>
                </div>

                <div class="question-title">{{ $q->title ?? $q->question }}</div>
                <div class="question-content">
                    {{ Str::limit($q->question, 150) }}
                </div>

                <div class="question-footer">
                    <div class="question-stats">
                        <div class="stat-item">
                            <i class="bi bi-chat-left-text-fill"></i>
                            <span>{{ $answerCount }} Jawaban</span>
                        </div>
                        <div class="stat-item">
                            <i class="bi bi-eye-fill"></i>
                            <span>{{ $q->views_count ?? 0 }} Dilihat</span>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('questions.show', $q->id) }}" class="btn-action">
                            <i class="bi bi-eye-fill"></i>
                            Lihat
                        </a>
                        <a href="{{ route('questions.answerForm', $q->id) }}" class="btn-action">
                            <i class="bi bi-reply-fill"></i>
                            Jawab
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state" data-aos="zoom-in">
                <div class="empty-icon">
                    <i class="bi bi-question-circle"></i>
                </div>
                <div class="empty-title">Belum Ada Pertanyaan</div>
                <div class="empty-text">Jadilah yang pertama mengajukan pertanyaan kesehatan!</div>
                <a href="{{ route('dashboard') }}" class="btn-primary-action">
                    <i class="bi bi-plus-circle-fill"></i>
                    Ajukan Pertanyaan
                </a>
            </div>
        @endforelse
    </div>
</div>

<script>
    // Filter functionality
    document.querySelectorAll('.filter-chip').forEach(chip => {
        chip.addEventListener('click', function() {
            document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            document.querySelectorAll('.question-item').forEach(item => {
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
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.question-item').forEach(item => {
            const title = item.querySelector('.question-title').innerText.toLowerCase();
            const content = item.querySelector('.question-content').innerText.toLowerCase();
            const author = item.querySelector('.question-author').innerText.toLowerCase();
            
            if (title.includes(searchTerm) || content.includes(searchTerm) || author.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endsection