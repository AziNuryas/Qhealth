@extends('layouts.app')

@section('title', 'Detail Pertanyaan')

@section('content')
<style>
    .detail-container {
        max-width: 900px;
        margin: 0 auto;
        padding-bottom: 120px;
    }

    .question-detail-card {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-md);
        border-left: 4px solid var(--accent-primary);
    }

    .question-header {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 16px;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    .question-meta {
        flex: 1;
        min-width: 0;
    }

    .question-author {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .question-time {
        font-size: 12px;
        color: var(--text-tertiary);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 18px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        flex-shrink: 0;
    }

    .status-answered {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: white;
        box-shadow: 0 3px 10px rgba(16, 185, 129, 0.3);
    }

    .status-waiting {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        box-shadow: 0 3px 10px rgba(245, 158, 11, 0.3);
    }

    .question-content {
        font-size: 15px;
        color: var(--text-primary);
        line-height: 1.7;
        margin-bottom: 16px;
        padding: 16px 0;
    }

    .question-stats {
        display: flex;
        gap: 20px;
        padding-top: 14px;
        border-top: 1px solid var(--card-border);
        font-size: 12px;
        color: var(--text-tertiary);
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stat-item i {
        color: var(--accent-primary);
        font-size: 14px;
    }

    .answers-section {
        margin-top: 24px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        font-size: 20px;
        color: var(--accent-primary);
    }

    .answer-card {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 12px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .answer-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .answer-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .answer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 3px 10px rgba(59, 130, 246, 0.25);
    }

    .answer-meta {
        flex: 1;
    }

    .answer-author {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 2px;
    }

    .answer-time {
        font-size: 11px;
        color: var(--text-tertiary);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .answer-content {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.6;
        white-space: pre-wrap;
    }

    .empty-answers {
        text-align: center;
        padding: 40px 20px;
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        box-shadow: var(--shadow-sm);
    }

    .empty-icon {
        font-size: 48px;
        color: var(--accent-primary);
        opacity: 0.3;
        margin-bottom: 12px;
    }

    .empty-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 6px;
    }

    .empty-text {
        font-size: 13px;
        color: var(--text-secondary);
    }

    /* Sticky Answer Form */
    .answer-form-sticky {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 14px 0;
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border-top: 1px solid var(--card-border);
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
    }

    .answer-form-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 16px;
    }

    .answer-input-wrapper {
        display: flex;
        align-items: flex-end;
        gap: 10px;
        background: var(--bg-secondary);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 8px 12px;
        transition: all 0.2s ease;
    }

    .answer-input-wrapper:focus-within {
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .answer-textarea {
        flex: 1;
        border: none;
        background: transparent;
        color: var(--text-primary);
        font-size: 13px;
        resize: none;
        outline: none;
        max-height: 100px;
        min-height: 36px;
        padding: 6px 0;
        line-height: 1.5;
    }

    .answer-textarea::placeholder {
        color: var(--text-tertiary);
    }

    .btn-send {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 3px 10px rgba(16, 185, 129, 0.3);
        flex-shrink: 0;
    }

    .btn-send:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
    }

    .btn-send i {
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .question-stats {
            flex-wrap: wrap;
        }
    }
</style>

<div class="container py-3">
    <div class="detail-container">
        <div class="question-detail-card" data-aos="fade-up">
            <div class="question-header">
                <div class="user-avatar">
                    {{ strtoupper(substr($question->user->name ?? 'A', 0, 1)) }}
                </div>
                <div class="question-meta">
                    <div class="question-author">{{ $question->user->name ?? 'Anonim' }}</div>
                    <div class="question-time">
                        <i class="bi bi-calendar3"></i>
                        {{ $question->created_at->format('d M Y, H:i') }}
                        <span>•</span>
                        {{ $question->created_at->diffForHumans() }}
                    </div>
                </div>
                <span class="status-badge {{ $question->answers->count() > 0 ? 'status-answered' : 'status-waiting' }}">
                    <i class="bi {{ $question->answers->count() > 0 ? 'bi-check-circle-fill' : 'bi-clock-fill' }}"></i>
                    {{ $question->answers->count() > 0 ? 'Terjawab' : 'Menunggu' }}
                </span>
            </div>

            <div class="question-content">
                {{ $question->question }}
            </div>

            <div class="question-stats">
                <div class="stat-item">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <span>{{ $question->answers->count() }} Jawaban</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-eye-fill"></i>
                    <span>{{ $question->views_count ?? 0 }} Dilihat</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-clock-history"></i>
                    <span>Diperbarui {{ $question->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <div class="answers-section">
            <h2 class="section-title" data-aos="fade-in">
                <i class="bi bi-chat-square-text-fill"></i>
                Jawaban ({{ $question->answers->count() }})
            </h2>

            @forelse($question->answers as $answer)
                <div class="answer-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="answer-header">
                        <div class="answer-avatar">
                            {{ strtoupper(substr($answer->user->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="answer-meta">
                            <div class="answer-author">{{ $answer->user->name ?? 'Anonim' }}</div>
                            <div class="answer-time">
                                <i class="bi bi-clock"></i>
                                {{ $answer->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="answer-content">{{ $answer->content }}</div>
                </div>
            @empty
                <div class="empty-answers" data-aos="zoom-in">
                    <div class="empty-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <div class="empty-title">Belum ada jawaban</div>
                    <div class="empty-text">Jadilah yang pertama memberikan jawaban!</div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Sticky Answer Form -->
<div class="answer-form-sticky">
    <div class="answer-form-container">
        <form action="{{ route('questions.answer.store', $question->id) }}" method="POST">
            @csrf
            <input type="hidden" name="redirect_back" value="1">
            <div class="answer-input-wrapper">
                <textarea name="content" class="answer-textarea" placeholder="Tulis jawaban Anda..." rows="1" required></textarea>
                <button type="submit" class="btn-send">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-resize textarea
    const textarea = document.querySelector('.answer-textarea');
    
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Focus handling
    textarea.addEventListener('focus', function() {
        setTimeout(() => {
            window.scrollTo(0, document.body.scrollHeight);
        }, 300);
    });
</script>
@endsection