@extends('layouts.app')

@section('title', 'Daftar Pertanyaan')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap');
    :root {
        --bg-primary: #f9fbfd;
        --bg-secondary: #ffffff;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --accent-green: #10b981;
        --accent-green-dark: #047857;
        --card-bg: rgba(255, 255, 255, 0.78);
        --card-border: rgba(15, 23, 42, 0.08);
        --shadow-sm: 0 2px 6px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 6px 16px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 12px 32px rgba(0, 0, 0, 0.12);
    }
    body.dark-mode {
        --bg-primary: #0f172a;
        --bg-secondary: #1e293b;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --card-bg: rgba(30, 41, 59, 0.78);
        --card-border: rgba(241, 245, 249, 0.12);
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        background: var(--bg-primary);
        color: var(--text-primary);
        font-family: 'Manrope', sans-serif;
        line-height: 1.5;
        overflow-x: hidden;
    }
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 80px 16px 24px;
    }
    .orb-container {
        position: fixed;
        inset: 0;
        z-index: -1;
        overflow: hidden;
        pointer-events: none;
    }
    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.09;
        animation: float 20s ease-in-out infinite;
    }
    .orb-1 {
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.4), transparent 70%);
        top: -200px;
        left: -200px;
    }
    .orb-2 {
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.35), transparent 70%);
        bottom: -150px;
        right: -150px;
        animation-delay: 7s;
    }
    @keyframes float {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(30px, -30px); }
    }
    .page-header {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-md);
    }
    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
        font-family: 'Manrope', sans-serif;
    }
    .search-container {
        position: relative;
        width: 300px;
    }
    .search-input {
        width: 100%;
        padding: 12px 20px 12px 48px;
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 56px;
        font-size: 15px;
        color: var(--text-primary);
        outline: none;
        font-family: 'Manrope', sans-serif;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    .search-input:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
    }
    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-size: 20px;
    }
    .filter-section {
        display: flex;
        gap: 10px;
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        padding: 6px;
        border-radius: 14px;
        border: 1.5px solid var(--card-border);
        margin-bottom: 24px;
    }
    .filter-chip {
        padding: 10px 20px;
        background: transparent;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        color: var(--text-secondary);
        cursor: pointer;
        font-family: 'Manrope', sans-serif;
    }
    .filter-chip.active {
        background: #10b981;
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }
    .questions-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }
    .question-card {
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .question-header {
        padding: 20px 24px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    .character-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 16px;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        font-family: 'Space Grotesk', sans-serif;
        letter-spacing: -0.5px;
    }
    .question-main {
        flex: 1;
        min-width: 0;
    }
    .question-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    .user-name {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 15px;
        letter-spacing: -0.2px;
        color: var(--text-primary);
    }
    .question-time {
        font-size: 13px;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 14px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        font-family: 'Space Grotesk', sans-serif;
    }
    .status-answered {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }
    .status-waiting {
        background: rgba(147, 51, 234, 0.15);
        color: #9333ea;
    }
    .question-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 10px 0;
        line-height: 1.4;
        font-family: 'Manrope', sans-serif;
    }
    .question-content {
        font-size: 15px;
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
        font-family: 'Manrope', sans-serif;
    }
    .question-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 24px;
        border-top: 1.5px solid var(--card-border);
    }
    .question-stats {
        display: flex;
        gap: 16px;
        font-size: 13px;
        color: var(--text-secondary);
    }
    .stat-item i {
        color: var(--accent-green);
    }
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    .btn-action {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        border: 1.8px solid transparent;
        background: transparent;
        font-family: 'Manrope', sans-serif;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        text-decoration: none;
        color: var(--text-primary);
    }
    .btn-action:hover {
        background: rgba(16, 185, 129, 0.1);
        border-color: rgba(16, 185, 129, 0.3);
        color: var(--accent-green);
    }
    /* ===== INLINE ANSWER FORM ===== */
    .answer-form-container {
        padding: 0 24px 20px;
        border-top: 1.5px solid var(--card-border);
        display: none;
    }
    .answer-form {
        display: flex;
        gap: 12px;
        align-items-start;
    }
    .answer-input {
        flex: 1;
        padding: 12px 16px;
        border: 1.5px solid var(--card-border);
        border-radius: 16px;
        background: var(--bg-primary);
        font-family: 'Manrope', sans-serif;
        font-size: 14px;
        color: var(--text-primary);
        resize: vertical;
        min-height: 90px;
        max-height: 200px;
    }
    .answer-submit {
        padding: 12px 20px;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
        border: none;
        border-radius: 16px;
        font-weight: 700;
        cursor: pointer;
        font-family: 'Manrope', sans-serif;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 64px 24px;
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 2px dashed var(--card-border);
        border-radius: 20px;
    }
    .empty-icon {
        font-size: 52px;
        color: var(--text-secondary);
        margin-bottom: 18px;
        opacity: 0.5;
    }
    .empty-title {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 10px 0;
        font-family: 'Manrope', sans-serif;
    }
    .empty-text {
        font-size: 15px;
        color: var(--text-secondary);
        margin: 0;
        font-family: 'Manrope', sans-serif;
    }
    .btn-primary-action {
        padding: 12px 24px;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
        border: none;
        border-radius: 18px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 10px 24px rgba(16, 185, 129, 0.35);
        font-family: 'Manrope', sans-serif;
        text-decoration: none;
    }
    /* AVATAR COLORS */
    .avatar-orange { background: #f97316; }
    .avatar-purple { background: #a855f7; }
    .avatar-pink { background: #ec4899; }
    .avatar-slate { background: #64748b; }
    .avatar-blue { background: #3b82f6; }
    .avatar-lime { background: #84cc16; }
    .avatar-amber { background: #f59e0b; }
    .avatar-slate-dark { background: #475569; }
    .avatar-blue-dark { background: #2563eb; }
    .avatar-red-dark { background: #dc2626; }
    .avatar-green { background: #22c55e; }
    .avatar-red { background: #ef4444; }
    .avatar-green-dark { background: #059669; }
    .avatar-black { background: #000000; }
    .avatar-purple-deep { background: #7e22ce; }
    .avatar-green-deep { background: #059669; }
    @media (max-width: 768px) {
        .search-container { width: 100%; }
        .header-content { flex-direction: column; align-items: stretch; }
        .filter-section { flex-wrap: wrap; justify-content: center; }
        .question-header { flex-direction: column; align-items: flex-start; gap: 12px; }
        .question-footer, .answer-form { flex-direction: column; gap: 12px; }
        .btn-action, .answer-submit { width: 100%; justify-content: center; }
    }
</style>

<div class="orb-container">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
</div>

<div class="container">
    <div class="page-header" data-aos="fade-in">
        <div class="header-content">
            <h1 class="page-title">
                <i class="bi bi-chat-dots-fill"></i>
                Daftar Pertanyaan
            </h1>
            <div class="search-container">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari pertanyaan...">
            </div>
        </div>
    </div>

    <div class="filter-section" data-aos="fade-in" data-aos-delay="100">
        <button class="filter-chip active" data-filter="all">Semua</button>
        <button class="filter-chip" data-filter="unanswered">Belum Dijawab</button>
        <button class="filter-chip" data-filter="answered">Terjawab</button>
    </div>

    <div class="questions-list">
        @php
            $characters = [/* ... daftar karakter sama seperti di dashboard ... */];
            $profiles = session()->get('qhealth_v3_profiles', []);
        @endphp

        @forelse($questions as $q)
            @php
                $isAnswered = $q->answers && $q->answers->count() > 0;
                $qid = 'q_' . $q->id;
                if (!isset($profiles[$qid])) {
                    $rand = $characters[array_rand($characters)];
                    $profiles[$qid] = $rand;
                    session()->put('qhealth_v3_profiles', $profiles);
                }
                $profile = $profiles[$qid];
                $answerCount = $q->answers ? $q->answers->count() : 0;
            @endphp
            <div class="question-card question-item {{ $isAnswered ? 'answered-question' : 'unanswered-question' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="question-header">
                    <div class="character-avatar {{ $profile['avatar_class'] }}">
                        {{ $profile['name'][0] }}
                    </div>
                    <div class="question-main">
                        <div class="question-meta">
                            <span class="user-name">{{ $profile['name'] }}</span>
                            <span class="question-time">
                                <i class="bi bi-clock"></i>
                                {{ $q->created_at->diffForHumans() }}
                            </span>
                            <span class="status-badge {{ $isAnswered ? 'status-answered' : 'status-waiting' }}">
                                {{ $isAnswered ? '✓ Terjawab' : '• Menunggu' }}
                            </span>
                        </div>
                        <h3 class="question-title">{{ $q->title }}</h3>
                        <p class="question-content">{{ Str::limit($q->question, 150) }}</p>
                    </div>
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
                        <button class="btn-action answer-toggle-btn" data-id="{{ $q->id }}">
                            <i class="bi bi-reply-fill"></i>
                            Jawab
                        </button>
                    </div>
                </div>
                <!-- INLINE ANSWER FORM -->
                <div class="answer-form-container" id="answer-form-{{ $q->id }}">
                    <form class="answer-form" data-question-id="{{ $q->id }}">
                        @csrf
                        <textarea name="content" class="answer-input" placeholder="Tulis jawaban Anda..." required></textarea>
                        <button type="submit" class="answer-submit">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state" data-aos="zoom-in">
                <div class="empty-icon">🔒</div>
                <h3 class="empty-title">Belum ada pertanyaan</h3>
                <p class="empty-text">Jadilah yang pertama bertanya — dengan nama karakter favoritmu!</p>
                <a href="{{ route('dashboard') }}" class="btn-primary-action">
                    <i class="bi bi-plus-circle-fill"></i>
                    Ajukan Pertanyaan
                </a>
            </div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle Answer Form
    document.querySelectorAll('.answer-toggle-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const qid = this.dataset.id;
            const formContainer = document.getElementById(`answer-form-${qid}`);
            formContainer.style.display = formContainer.style.display === 'block' ? 'none' : 'block';
        });
    });

    // Submit Answer via AJAX
    document.querySelectorAll('.answer-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const qid = this.dataset.questionId;
            const content = this.querySelector('textarea').value;
            const submitBtn = this.querySelector('.answer-submit');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = 'Mengirim...';
            submitBtn.disabled = true;

            try {
                const res = await fetch(`/questions/${qid}/answer`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ content })
                });

                const data = await res.json();
                if (data.success) {
                    // Refresh halaman atau tambahkan jawaban dinamis
                    location.reload();
                } else {
                    alert('Gagal mengirim jawaban: ' + (data.message || 'Coba lagi'));
                }
            } catch (err) {
                alert('Terjadi kesalahan. Coba lagi.');
                console.error(err);
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    });

    // Filter & Search (sama seperti sebelumnya)
    document.querySelectorAll('.filter-chip').forEach(chip => {
        chip.addEventListener('click', function() {
            document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('.question-item').forEach(item => {
                const isAnswered = item.classList.contains('answered-question');
                item.style.display = (filter === 'all' || 
                    (filter === 'answered' && isAnswered) || 
                    (filter === 'unanswered' && !isAnswered)) ? 'block' : 'none';
            });
        });
    });

    document.getElementById('searchInput')?.addEventListener('input', function() {
        const t = this.value.toLowerCase();
        document.querySelectorAll('.question-item').forEach(item => {
            const title = item.querySelector('.question-title')?.textContent.toLowerCase() || '';
            const content = item.querySelector('.question-content')?.textContent.toLowerCase() || '';
            const author = item.querySelector('.user-name')?.textContent.toLowerCase() || '';
            item.style.display = (title.includes(t) || content.includes(t) || author.includes(t)) ? 'block' : 'none';
        });
    });
});
</script>
@endsection