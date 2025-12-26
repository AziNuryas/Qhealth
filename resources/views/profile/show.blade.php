@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap');
    
    :root {
        --bg-primary: #f9fbfd;
        --bg-secondary: #ffffff;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --accent-green: #10b981;
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

    body {
        background: var(--bg-primary);
        color: var(--text-primary);
        font-family: 'Manrope', sans-serif;
    }

    /* ===== BACKGROUND ORBS ===== */
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

    /* ===== CONTAINER ===== */
    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 100px 16px 40px;
    }

    /* ===== HEADER CARD ===== */
    .profile-header-card {
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: linear-gradient(140deg, rgba(16, 185, 129, 0.92), rgba(4, 120, 87, 0.88));
        border-radius: 24px;
        padding: 40px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .profile-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 4px solid rgba(255, 255, 255, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 800;
        color: white;
        font-family: 'Space Grotesk', sans-serif;
        flex-shrink: 0;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    }

    .profile-header-info {
        flex: 1;
        color: white;
    }

    .profile-name-large {
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 8px 0;
        font-family: 'Space Grotesk', sans-serif;
        letter-spacing: -0.5px;
    }

    .profile-email-large {
        font-size: 16px;
        opacity: 0.9;
        margin: 0;
        font-weight: 500;
    }

    .profile-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        margin-top: 12px;
    }

    /* ===== STATS ROW ===== */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        text-align: center;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 22px;
    }

    .stat-icon-green {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .stat-icon-blue {
        background: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    .stat-icon-purple {
        background: rgba(139, 92, 246, 0.15);
        color: #8b5cf6;
    }

    .stat-icon-orange {
        background: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-primary);
        font-family: 'Space Grotesk', sans-serif;
        margin: 0 0 4px 0;
    }

    .stat-label {
        font-size: 13px;
        color: var(--text-secondary);
        font-weight: 600;
        margin: 0;
    }

    /* ===== CONTENT LAYOUT ===== */
    .profile-content {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 24px;
    }

    /* ===== FORM CARD ===== */
    .profile-form-card {
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 22px;
        padding: 32px;
        box-shadow: var(--shadow-md);
    }

    .form-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--card-border);
    }

    .section-icon-box {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #10b981, #047857);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0;
        font-family: 'Space Grotesk', sans-serif;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .form-label i {
        color: var(--accent-green);
        margin-right: 6px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        background: var(--bg-primary);
        border: 1.8px solid var(--card-border);
        border-radius: 12px;
        font-size: 15px;
        color: var(--text-primary);
        font-family: 'Manrope', sans-serif;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-control:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        background: var(--bg-secondary);
    }

    .btn-save {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        transition: all 0.3s ease;
        margin-top: 8px;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(16, 185, 129, 0.4);
    }

    /* ===== INFO CARD ===== */
    .profile-info-card {
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 22px;
        padding: 28px;
        box-shadow: var(--shadow-md);
    }

    .info-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 20px 0;
        font-family: 'Space Grotesk', sans-serif;
    }

    .info-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px;
        background: var(--bg-primary);
        border-radius: 12px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateX(4px);
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-label {
        font-size: 14px;
        color: var(--text-secondary);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* ===== ACTIVITY CARD ===== */
    .activity-card {
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 22px;
        padding: 28px;
        box-shadow: var(--shadow-md);
        margin-top: 24px;
    }

    .activity-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 20px 0;
        font-family: 'Space Grotesk', sans-serif;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        background: var(--bg-primary);
        border-radius: 12px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        transform: translateX(4px);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .activity-icon-green {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .activity-icon-blue {
        background: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    .activity-content {
        flex: 1;
    }

    .activity-text {
        font-size: 14px;
        color: var(--text-primary);
        font-weight: 600;
        margin: 0 0 4px 0;
    }

    .activity-time {
        font-size: 12px;
        color: var(--text-secondary);
        margin: 0;
    }

    @media (max-width: 1024px) {
        .profile-content {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .profile-header-card {
            flex-direction: column;
            text-align: center;
        }
        .profile-name-large {
            font-size: 26px;
        }
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="orb-container">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
</div>

<div class="profile-container">
    <!-- Header Card -->
    <div class="profile-header-card">
        <div class="profile-avatar-large">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="profile-header-info">
            <h1 class="profile-name-large">{{ $user->name }}</h1>
            <p class="profile-email-large">{{ $user->email }}</p>
            <div class="profile-badge">
                <i class="bi bi-shield-check"></i>
                Member sejak {{ $user->created_at->format('M Y') }}
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon stat-icon-green">
                <i class="bi bi-chat-dots-fill"></i>
            </div>
            <div class="stat-value">{{ $user->questions_count ?? 0 }}</div>
            <div class="stat-label">Pertanyaan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <i class="bi bi-chat-left-text-fill"></i>
            </div>
            <div class="stat-value">{{ $user->answers_count ?? 0 }}</div>
            <div class="stat-label">Jawaban</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-purple">
                <i class="bi bi-hand-thumbs-up-fill"></i>
            </div>
            <div class="stat-value">{{ $user->likes_count ?? 0 }}</div>
            <div class="stat-label">Likes Diterima</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-orange">
                <i class="bi bi-trophy-fill"></i>
            </div>
            <div class="stat-value">{{ $user->reputation ?? 0 }}</div>
            <div class="stat-label">Reputasi</div>
        </div>
    </div>

    <!-- Content Layout -->
    <div class="profile-content">
        <!-- Form Card -->
        <div class="profile-form-card">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-section-header">
                    <div class="section-icon-box">
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <h2 class="section-title">Edit Profil</h2>
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="bi bi-person"></i> Nama Lengkap
                    </label>
                    <input type="text" class="form-control" name="name" id="name" 
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope"></i> Alamat Email
                    </label>
                    <input type="email" class="form-control" name="email" id="email" 
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender" class="form-label">
                                <i class="bi bi-gender-ambiguous"></i> Jenis Kelamin
                            </label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                <i class="bi bi-telephone"></i> Nomor Telepon
                            </label>
                            <input type="text" class="form-control" name="phone" id="phone" 
                                value="{{ old('phone', $user->phone) }}" placeholder="081234567890">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-save">
                    <i class="bi bi-check-circle"></i>
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Info Card -->
            <div class="profile-info-card">
                <h3 class="info-title">Informasi Akun</h3>
                
                <div class="info-item">
                    <span class="info-label">
                        <i class="bi bi-gender-ambiguous"></i>
                        Jenis Kelamin
                    </span>
                    <span class="info-value">{{ $user->gender ?? 'Belum diatur' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">
                        <i class="bi bi-telephone"></i>
                        Nomor HP
                    </span>
                    <span class="info-value">{{ $user->phone ?? 'Belum diatur' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">
                        <i class="bi bi-calendar-check"></i>
                        Bergabung
                    </span>
                    <span class="info-value">{{ $user->created_at->format('d M Y') }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">
                        <i class="bi bi-clock-history"></i>
                        Terakhir Update
                    </span>
                    <span class="info-value">{{ $user->updated_at->diffForHumans() }}</span>
                </div>
            </div>

            <!-- Activity Card -->
            <div class="activity-card">
                <h3 class="activity-title">
                    <i class="bi bi-activity"></i>
                    Aktivitas Terbaru
                </h3>

                <div class="activity-item">
                    <div class="activity-icon activity-icon-green">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <div class="activity-content">
                        <p class="activity-text">Bertanya tentang kesehatan</p>
                        <p class="activity-time">2 jam yang lalu</p>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon activity-icon-blue">
                        <i class="bi bi-chat-left-text-fill"></i>
                    </div>
                    <div class="activity-content">
                        <p class="activity-text">Memberikan jawaban</p>
                        <p class="activity-time">5 jam yang lalu</p>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon activity-icon-green">
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                    </div>
                    <div class="activity-content">
                        <p class="activity-text">Menerima 3 likes</p>
                        <p class="activity-time">1 hari yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection