{{-- resources/views/admin/users/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Pengguna - Qhealth')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
    
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-ultra-light: #6ee7b7;
        --success: #22c55e;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --purple: #8b5cf6;
        --indigo: #6366f1;
        
        --glass-primary: rgba(16, 185, 129, 0.1);
        --glass-white: rgba(255, 255, 255, 0.15);
        --glass-dark: rgba(0, 0, 0, 0.05);
        --glass-border: rgba(255, 255, 255, 0.2);
        
        --shadow-glow: 0 0 40px rgba(16, 185, 129, 0.25);
        --shadow-soft: 0 10px 25px rgba(0, 0, 0, 0.06);
        --shadow-medium: 0 20px 40px rgba(0, 0, 0, 0.08);
        --shadow-hard: 0 30px 60px rgba(0, 0, 0, 0.12);
        
        --gradient-primary: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --gradient-hero: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(5, 150, 105, 0.9) 50%, rgba(4, 120, 87, 0.85) 100%);
        --gradient-card: linear-gradient(145deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.6) 100%);
        --gradient-text: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        
        --timing-smooth: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --timing-bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55);
        --timing-elastic: cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    /* Light Mode Colors */
    body {
        --bg-primary: #f8fafc;
        --bg-secondary: #e2e8f0;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --border-color: rgba(255, 255, 255, 0.2);
        --card-bg: rgba(255, 255, 255, 0.9);
        --search-bg: rgba(255, 255, 255, 0.8);
        --search-focus-bg: rgba(255, 255, 255, 0.95);
    }
    
    /* Dark Mode Colors - Enhanced coverage */
    [data-theme="dark"],
    [data-bs-theme="dark"], 
    .dark-mode,
    body.dark-mode,
    html.dark-mode,
    html[data-theme="dark"],
    body[data-theme="dark"],
    html[data-bs-theme="dark"],
    body[data-bs-theme="dark"] {
        --bg-primary: #0f172a;
        --bg-secondary: #1e293b;
        --text-primary: #f8fafc;
        --text-secondary: #cbd5e1;
        --text-muted: #64748b;
        --border-color: rgba(255, 255, 255, 0.1);
        --card-bg: rgba(30, 41, 59, 0.8);
        --search-bg: rgba(30, 41, 59, 0.8);
        --search-focus-bg: rgba(30, 41, 59, 0.95);
        
        --gradient-card: linear-gradient(145deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.8) 100%);
        --gradient-hero: linear-gradient(135deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.8) 50%, rgba(4, 120, 87, 0.7) 100%);
        --glass-border: rgba(255, 255, 255, 0.1);
        --shadow-soft: 0 10px 25px rgba(0, 0, 0, 0.3);
        --shadow-medium: 0 20px 40px rgba(0, 0, 0, 0.4);
        --shadow-hard: 0 30px 60px rgba(0, 0, 0, 0.5);
    }
    
    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        box-sizing: border-box;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }
    
    body {
        background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
        min-height: 100vh;
        overflow-x: hidden;
        color: var(--text-primary);
    }
    
    /* Hero Section */
    .hero-section {
        background: var(--gradient-hero);
        backdrop-filter: blur(20px) saturate(200%);
        -webkit-backdrop-filter: blur(20px) saturate(200%);
        border-radius: 28px;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        padding: 3rem 2rem;
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow-medium), var(--shadow-glow);
        will-change: transform;
        transform: translateZ(0);
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: 
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        animation: aurora 8s ease-in-out infinite;
        pointer-events: none;
        will-change: opacity, transform;
    }
    
    .hero-section::after {
        content: '';
        position: absolute;
        inset: -100%;
        background: conic-gradient(from 0deg at 50% 50%, transparent 0deg, rgba(255, 255, 255, 0.08) 60deg, transparent 120deg);
        animation: rotate 20s linear infinite;
        pointer-events: none;
        will-change: transform;
    }
    
    @keyframes aurora {
        0%, 100% { 
            opacity: 1; 
            transform: translateY(0) scale(1); 
        }
        50% { 
            opacity: 0.8; 
            transform: translateY(-8px) scale(1.01); 
        }
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Premium Card System */
    .premium-card {
        background: var(--gradient-card);
        backdrop-filter: blur(25px) saturate(180%);
        -webkit-backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 2.5rem;
        position: relative;
        transition: all 0.4s var(--timing-smooth);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        will-change: transform, box-shadow;
        transform: translateZ(0);
        margin-bottom: 2rem;
    }
    
    .premium-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-primary);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.6s var(--timing-elastic);
        border-radius: 24px 24px 0 0;
    }
    
    .premium-card::after {
        content: '';
        position: absolute;
        inset: -100%;
        background: radial-gradient(circle, var(--glass-primary) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.6s var(--timing-smooth);
        pointer-events: none;
    }
    
    .premium-card:hover {
        transform: translateY(-8px) scale(1.005);
        box-shadow: var(--shadow-hard), var(--shadow-glow);
        border-color: rgba(16, 185, 129, 0.3);
    }
    
    .premium-card:hover::before {
        transform: scaleX(1);
    }
    
    .premium-card:hover::after {
        opacity: 1;
    }
    
    /* Typography */
    .page-title {
        background: var(--gradient-text);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.5rem;
        font-weight: 900;
        letter-spacing: -0.03em;
        line-height: 1.1;
        margin-bottom: 1rem;
        will-change: transform;
        animation: slideInDown 0.8s var(--timing-bounce);
    }
    
    .subtitle {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.1rem;
        font-weight: 500;
        letter-spacing: -0.01em;
        margin-bottom: 2rem;
        animation: slideInUp 0.8s var(--timing-smooth) 0.2s both;
    }
    
    /* Premium Buttons */
    .premium-btn {
        background: var(--gradient-primary);
        border: none;
        border-radius: 14px;
        padding: 14px 28px;
        color: white;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s var(--timing-smooth);
        position: relative;
        overflow: hidden;
        font-size: 0.95rem;
        letter-spacing: -0.01em;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.35);
        cursor: pointer;
        will-change: transform, box-shadow;
        transform: translateZ(0);
    }
    
    .premium-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.4) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s var(--timing-smooth);
        pointer-events: none;
    }
    
    .premium-btn:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.4), var(--shadow-glow);
        color: white;
        text-decoration: none;
    }
    
    .premium-btn:hover::before {
        transform: translateX(100%);
    }
    
    .premium-btn:active {
        transform: translateY(-2px) scale(1.02);
        transition: all 0.1s var(--timing-smooth);
    }
    
    .premium-btn.secondary {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
    }
    
    .premium-btn.secondary:hover {
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4), 0 0 40px rgba(99, 102, 241, 0.25);
    }
    
    .premium-btn.danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 8px 24px rgba(239, 68, 68, 0.35);
    }
    
    .premium-btn.danger:hover {
        box-shadow: 0 20px 40px rgba(239, 68, 68, 0.4), 0 0 40px rgba(239, 68, 68, 0.25);
    }
    
    /* Quick Info Cards */
    .quick-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }
    
    .quick-info-card {
        background: var(--gradient-card);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.4s var(--timing-smooth);
        position: relative;
        overflow: hidden;
        will-change: transform;
        transform: translateZ(0);
    }
    
    .quick-info-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.05) 50%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s var(--timing-smooth);
        pointer-events: none;
    }
    
    .quick-info-card:hover {
        transform: translateY(-6px) rotateX(3deg);
        box-shadow: var(--shadow-medium);
    }
    
    .quick-info-card:hover::before {
        opacity: 1;
    }
    
    .quick-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: white;
        position: relative;
        transition: all 0.4s var(--timing-bounce);
        will-change: transform;
    }
    
    .quick-icon.created {
        background: linear-gradient(135deg, var(--info) 0%, #1d4ed8 100%);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
    }
    
    .quick-icon.updated {
        background: linear-gradient(135deg, var(--success) 0%, #16a34a 100%);
        box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
    }
    
    .quick-icon.status {
        background: linear-gradient(135deg, var(--purple) 0%, #7c3aed 100%);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
    }
    
    .quick-info-card:hover .quick-icon {
        transform: scale(1.1) rotateY(10deg);
    }
    
    .quick-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
    }
    
    .quick-value {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1.2;
    }
    
    /* Form Elements */
    .premium-form-group {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .premium-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .premium-input,
    .premium-select {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid var(--glass-border);
        border-radius: 14px;
        background: var(--search-bg);
        backdrop-filter: blur(10px);
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-primary);
        transition: all 0.3s var(--timing-smooth);
        position: relative;
        will-change: transform, box-shadow;
    }
    
    .premium-input:focus,
    .premium-select:focus {
        outline: none;
        border-color: var(--primary);
        background: var(--search-focus-bg);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15), 0 8px 25px rgba(16, 185, 129, 0.2);
        transform: translateY(-2px);
    }
    
    .premium-input.is-invalid,
    .premium-select.is-invalid {
        border-color: var(--danger);
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
    }
    
    .premium-input::placeholder {
        color: var(--text-muted);
        font-weight: 500;
    }
    
    /* Invalid Feedback */
    .invalid-feedback {
        color: var(--danger);
        font-size: 0.9rem;
        font-weight: 700;
        margin-top: 0.75rem;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        background: rgba(239, 68, 68, 0.1);
        border-radius: 10px;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    
    .invalid-feedback::before {
        content: '⚠️';
        font-size: 1rem;
    }
    
    /* Alerts */
    .alert {
        padding: 1.5rem 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        border: none;
        font-weight: 700;
        backdrop-filter: blur(15px);
        animation: slideInDown 0.6s var(--timing-bounce);
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }
    
    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        border-radius: 20px 20px 0 0;
    }
    
    .alert-success {
        background: rgba(34, 197, 94, 0.15);
        color: #047857;
        border: 2px solid rgba(34, 197, 94, 0.3);
    }
    
    .alert-success::before {
        background: linear-gradient(90deg, #22c55e 0%, #10b981 100%);
    }
    
    .alert-danger {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        border: 2px solid rgba(239, 68, 68, 0.3);
    }
    
    .alert-danger::before {
        background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
    }
    
    /* Dark mode alert colors */
    [data-theme="dark"] .alert-success,
    [data-bs-theme="dark"] .alert-success,
    .dark-mode .alert-success,
    body.dark-mode .alert-success,
    html.dark-mode .alert-success,
    html[data-theme="dark"] .alert-success,
    body[data-theme="dark"] .alert-success,
    html[data-bs-theme="dark"] .alert-success,
    body[data-bs-theme="dark"] .alert-success {
        background: rgba(34, 197, 94, 0.2);
        color: #34d399;
        border-color: rgba(34, 197, 94, 0.4);
    }
    
    [data-theme="dark"] .alert-danger,
    [data-bs-theme="dark"] .alert-danger,
    .dark-mode .alert-danger,
    body.dark-mode .alert-danger,
    html.dark-mode .alert-danger,
    html[data-theme="dark"] .alert-danger,
    body[data-theme="dark"] .alert-danger,
    html[data-bs-theme="dark"] .alert-danger,
    body[data-bs-theme="dark"] .alert-danger {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.4);
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1.5rem;
        padding-top: 3rem;
        border-top: 2px solid var(--glass-border);
        margin-top: 3rem;
    }
    
    /* User Avatar in Quick Info */
    .user-avatar-large {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-weight: 900;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        transition: all 0.4s var(--timing-bounce);
        will-change: transform;
    }
    
    .quick-info-card:hover .user-avatar-large {
        transform: scale(1.1) rotateZ(5deg);
        box-shadow: 0 12px 25px rgba(16, 185, 129, 0.5);
    }
    
    /* Loading States */
    .loading {
        position: relative;
        overflow: hidden;
    }
    
    .loading::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.4) 50%, transparent 100%);
        animation: loading 1.5s infinite;
        pointer-events: none;
    }
    
    @keyframes loading {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    /* Animations */
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-40px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .fade-in {
        animation: fadeInUp 0.8s var(--timing-smooth) forwards;
        opacity: 0;
    }
    
    .fade-in:nth-child(1) { animation-delay: 0.1s; }
    .fade-in:nth-child(2) { animation-delay: 0.2s; }
    .fade-in:nth-child(3) { animation-delay: 0.3s; }
    .fade-in:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    /* Responsive Design */
            @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 1.5rem;
            border-radius: 20px;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .quick-info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .premium-card {
            padding: 1.5rem;
            border-radius: 16px;
        }
        
        .form-actions {
            flex-direction: column-reverse;
            gap: 1rem;
        }
        
        .premium-btn {
            justify-content: center;
            width: 100%;
        }
        
        .quick-info-card {
            padding: 1.25rem;
        }
        
        .user-avatar-large {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }
        
        .quick-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }
    }
    
    @media (max-width: 576px) {
        .hero-section {
            padding: 1.5rem 1rem;
        }
        
        .premium-card {
            padding: 1rem;
        }
        
        .premium-input,
        .premium-select {
            padding: 14px 16px;
        }
        
        .quick-info-grid {
            gap: 1rem;
        }
        
        .quick-info-card {
            padding: 1rem;
        }
    }
    
    /* Performance Optimizations */
    .premium-card,
    .quick-info-card,
    .premium-btn {
        contain: layout style paint;
    }
    
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<div class="container-fluid py-4">
    {{-- Premium Hero Section --}}
    <div class="hero-section text-center text-white position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="page-title">
                    <i class="bi bi-pencil-square me-3" style="color: rgba(255,255,255,0.95);"></i>
                    Edit Pengguna Premium
                </h1>
                <p class="subtitle">Modifikasi informasi pengguna dengan antarmuka yang modern dan performa tinggi untuk sistem Qhealth</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('admin.users.index') }}" class="premium-btn secondary">
                        <i class="bi bi-list"></i>Daftar Pengguna
                    </a>
                    <a href="{{ route('admin.index') }}" class="premium-btn">
                        <i class="bi bi-speedometer2"></i>Dashboard Admin
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Premium Alerts --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Quick Info Section --}}
    <div class="quick-info-grid">
        <div class="quick-info-card fade-in">
            <div class="user-avatar-large">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="quick-title">Current User</div>
            <div class="quick-value">{{ $user->name }}</div>
        </div>
        
        <div class="quick-info-card fade-in">
            <div class="quick-icon status">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="quick-title">Status Verifikasi</div>
            <div class="quick-value">
                @if($user->email_verified_at)
                    <span style="color: var(--success);">✅ Verified</span>
                @else
                    <span style="color: var(--warning);">⏳ Pending</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Premium Edit Form --}}
    <div class="premium-card fade-in">
        <div class="text-center mb-4">
            <h2 style="color: var(--text-primary); font-weight: 800; margin-bottom: 0.5rem;">
                <i class="bi bi-person-gear me-2" style="color: var(--primary);"></i>
                Form Edit Pengguna
            </h2>
            <p style="color: var(--text-secondary); font-weight: 500;">
                Perbarui informasi pengguna dengan aman dan mudah
            </p>
        </div>
        
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="editUserForm" novalidate>
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="premium-form-group">
                        <label for="name" class="premium-label">
                            <i class="bi bi-person"></i>Nama Lengkap
                        </label>
                        <input type="text" 
                               class="premium-input @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name) }}" 
                               required
                               autocomplete="name"
                               placeholder="Masukkan nama lengkap pengguna">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="premium-form-group">
                        <label for="email" class="premium-label">
                            <i class="bi bi-envelope"></i>Email Address
                        </label>
                        <input type="email" 
                               class="premium-input @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               required
                               autocomplete="email"
                               placeholder="contoh@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="premium-form-group">
                        <label for="role" class="premium-label">
                            <i class="bi bi-shield-check"></i>Role Pengguna
                        </label>
                        <select class="premium-select @error('role') is-invalid @enderror" 
                                id="role" 
                                name="role" 
                                required>
                            <option value="">Pilih Role Pengguna</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                👑 Administrator
                            </option>
                            <option value="doctor" {{ old('role', $user->role) == 'doctor' ? 'selected' : '' }}>
                                🩺 Doctor/Dokter
                            </option>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                👤 Regular User
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="premium-form-group">
                        <label for="password" class="premium-label">
                            <i class="bi bi-lock"></i>Password Baru 
                            <small style="color: var(--text-muted); font-weight: 500; text-transform: none;">(Opsional - Kosongkan jika tidak ingin mengubah)</small>
                        </label>
                        <input type="password" 
                               class="premium-input @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password"
                               autocomplete="new-password"
                               placeholder="Masukkan password baru (minimal 8 karakter)">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="premium-form-group">
                        <label for="password_confirmation" class="premium-label">
                            <i class="bi bi-lock-fill"></i>Konfirmasi Password Baru
                        </label>
                        <input type="password" 
                               class="premium-input" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               autocomplete="new-password"
                               placeholder="Ulangi password baru untuk konfirmasi">
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="premium-form-group">
                        <label class="premium-label">
                            <i class="bi bi-info-circle"></i>Informasi Tambahan
                        </label>
                        <div style="padding: 16px 20px; background: var(--search-bg); border-radius: 14px; border: 2px solid var(--glass-border);">
                            <p style="margin: 0; color: var(--text-secondary); font-weight: 500; font-size: 0.95rem;">
                                <strong>Tips:</strong> Password harus minimal 8 karakter dan sebaiknya menggunakan kombinasi huruf, angka, dan simbol untuk keamanan optimal.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.users.show', $user->id) }}" class="premium-btn secondary">
                    <i class="bi bi-x-circle"></i>Batal Perubahan
                </a>
                <button type="submit" class="premium-btn">
                    <i class="bi bi-check-circle"></i>Update Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Premium Edit User page loaded - initializing enhanced theme system');
    
    // Enhanced theme detection with comprehensive coverage
    function detectAndApplyTheme() {
        const html = document.documentElement;
        const body = document.body;
        
        // Comprehensive theme detection
        const bsTheme = html.getAttribute('data-bs-theme') || body.getAttribute('data-bs-theme');
        
        if (bsTheme === 'dark') {
            console.log('✅ Dark theme detected via data-bs-theme');
            html.setAttribute('data-theme', 'dark');
            body.setAttribute('data-theme', 'dark');
            return 'dark';
        } else if (bsTheme === 'light') {
            console.log('✅ Light theme detected via data-bs-theme');
            html.setAttribute('data-theme', 'light');
            body.setAttribute('data-theme', 'light');
            return 'light';
        }
        
        // Fallback checks
        const legacyChecks = [
            html.getAttribute('data-theme'),
            body.getAttribute('data-theme'),
            localStorage.getItem('theme'),
            localStorage.getItem('bs-theme')
        ];
        
        for (const check of legacyChecks) {
            if (check === 'dark') {
                console.log('✅ Dark theme detected via fallback');
                return 'dark';
            }
        }
        
        // CSS class checks
        if (html.classList.contains('dark-mode') || body.classList.contains('dark-mode')) {
            console.log('✅ Dark theme detected via CSS class');
            return 'dark';
        }
        
        console.log('✅ Light theme detected (default)');
        return 'light';
    }
    
    // Theme observer
    const createThemeObserver = () => {
        const callback = (mutations) => {
            let themeChanged = false;
            
            mutations.forEach((mutation) => {
                if (mutation.type === 'attributes') {
                    const attr = mutation.attributeName;
                    if (['data-bs-theme', 'data-theme', 'class'].includes(attr)) {
                        themeChanged = true;
                    }
                }
            });
            
            if (themeChanged) {
                const newTheme = detectAndApplyTheme();
                document.body.offsetHeight; // Force reflow
                window.dispatchEvent(new CustomEvent('editUserThemeChanged', { 
                    detail: { theme: newTheme } 
                }));
            }
        };
        
        const observer = new MutationObserver(callback);
        
        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['data-bs-theme', 'data-theme', 'class']
        });
        
        observer.observe(document.body, {
            attributes: true,
            attributeFilter: ['data-bs-theme', 'data-theme', 'class']
        });
        
        return observer;
    };
    
    // Initialize theme system
    const observer = createThemeObserver();
    const initialTheme = detectAndApplyTheme();
    console.log('🎨 Initial theme set to:', initialTheme);
    
    // Enhanced form interactions
    const inputs = document.querySelectorAll('.premium-input, .premium-select');
    
    inputs.forEach(input => {
        // Enhanced focus effects
        input.addEventListener('focus', function() {
            this.style.borderColor = 'var(--primary)';
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.15), 0 8px 25px rgba(16, 185, 129, 0.2)';
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.style.borderColor = '';
                this.style.transform = '';
                this.style.boxShadow = '';
            }
        });
        
        // Real-time validation styling
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.style.borderColor = 'var(--success)';
            } else if (this.value) {
                this.style.borderColor = 'var(--danger)';
            }
        });
    });
    
    // Enhanced password confirmation
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    if (password && passwordConfirmation) {
        const validatePassword = () => {
            if (passwordConfirmation.value) {
                if (password.value === passwordConfirmation.value) {
                    passwordConfirmation.style.borderColor = 'var(--success)';
                    passwordConfirmation.style.boxShadow = '0 0 0 3px rgba(34, 197, 94, 0.15)';
                } else {
                    passwordConfirmation.style.borderColor = 'var(--danger)';
                    passwordConfirmation.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.15)';
                }
            }
        };
        
        password.addEventListener('input', validatePassword);
        passwordConfirmation.addEventListener('input', validatePassword);
    }
    
    // Enhanced form submission with validation
    const form = document.getElementById('editUserForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            
            // Get form fields
            const nameField = document.getElementById('name');
            const emailField = document.getElementById('email');
            const roleField = document.getElementById('role');
            
            // Debug: Log form values
            console.log('Form submission debug:');
            console.log('Name:', nameField ? nameField.value : 'Field not found');
            console.log('Email:', emailField ? emailField.value : 'Field not found');
            console.log('Role:', roleField ? roleField.value : 'Field not found');
            
            // Client-side validation
            let hasErrors = false;
            
            if (!nameField || !nameField.value.trim()) {
                console.error('Name field is empty or missing');
                if (nameField) {
                    nameField.style.borderColor = 'var(--danger)';
                    nameField.focus();
                }
                hasErrors = true;
            }
            
            if (!emailField || !emailField.value.trim()) {
                console.error('Email field is empty or missing');
                if (emailField) {
                    emailField.style.borderColor = 'var(--danger)';
                    if (!hasErrors) emailField.focus();
                }
                hasErrors = true;
            }
            
            if (!roleField || !roleField.value) {
                console.error('Role field is empty or missing');
                if (roleField) {
                    roleField.style.borderColor = 'var(--danger)';
                    if (!hasErrors) roleField.focus();
                }
                hasErrors = true;
            }
            
            // Validate email format
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    console.error('Invalid email format');
                    emailField.style.borderColor = 'var(--danger)';
                    if (!hasErrors) emailField.focus();
                    hasErrors = true;
                }
            }
            
            // Validate passwords match if new password is provided
            if (password && password.value && passwordConfirmation) {
                if (password.value !== passwordConfirmation.value) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok!');
                    passwordConfirmation.focus();
                    return;
                }
                
                // Validate password length
                if (password.value.length < 8) {
                    e.preventDefault();
                    alert('Password harus minimal 8 karakter!');
                    password.focus();
                    return;
                }
            }
            
            // If there are validation errors, prevent submission
            if (hasErrors) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi!');
                return;
            }
            
            // Enhanced loading state
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise"></i>Memperbarui Data...';
                submitBtn.disabled = true;
                submitBtn.style.background = 'linear-gradient(135deg, #64748b 0%, #475569 100%)';
                
                // Add loading animation
                submitBtn.classList.add('loading');
            }
            
            // Don't disable form inputs to ensure data is sent
            console.log('Form validation passed, submitting...');
        });
    }
    
    // Enhanced hover effects for premium cards
    const premiumCards = document.querySelectorAll('.premium-card, .quick-info-card');
    premiumCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.005)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Enhanced button interactions with ripple effect
    const premiumButtons = document.querySelectorAll('.premium-btn');
    premiumButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add ripple animation CSS
    if (!document.querySelector('#ripple-styles')) {
        const style = document.createElement('style');
        style.id = 'ripple-styles';
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    // Enhanced keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + S to submit form
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            form.dispatchEvent(new Event('submit'));
        }
        
        // Ctrl/Cmd + Backspace to go back
        if ((e.ctrlKey || e.metaKey) && e.key === 'Backspace') {
            e.preventDefault();
            window.history.back();
        }
        
        // Tab navigation enhancement
        if (e.key === 'Tab') {
            const focusedElement = document.activeElement;
            if (focusedElement.classList.contains('premium-input') || 
                focusedElement.classList.contains('premium-select')) {
                // Add visual indicator for tabbed focus
                focusedElement.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.3), 0 8px 25px rgba(16, 185, 129, 0.2)';
            }
        }
    });
    
    // Enhanced role selection with visual feedback
    const roleSelect = document.getElementById('role');
    if (roleSelect) {
        roleSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const emoji = selectedOption.textContent.split(' ')[0];
            
            // Update visual feedback based on role
            if (this.value === 'admin') {
                this.style.borderColor = 'var(--danger)';
                this.style.background = 'rgba(239, 68, 68, 0.05)';
            } else if (this.value === 'doctor') {
                this.style.borderColor = 'var(--info)';
                this.style.background = 'rgba(59, 130, 246, 0.05)';
            } else if (this.value === 'user') {
                this.style.borderColor = 'var(--success)';
                this.style.background = 'rgba(34, 197, 94, 0.05)';
            }
        });
        
        // Trigger initial styling
        if (roleSelect.value) {
            roleSelect.dispatchEvent(new Event('change'));
        }
    }
    
    // Auto-save draft functionality (optional)
    const enableAutoSave = false; // Set to true to enable
    if (enableAutoSave) {
        let autoSaveTimeout;
        
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(() => {
                    // Save draft to localStorage
                    const formData = new FormData(form);
                    const draftData = {};
                    
                    for (let [key, value] of formData.entries()) {
                        if (key !== 'password' && key !== 'password_confirmation') {
                            draftData[key] = value;
                        }
                    }
                    
                    localStorage.setItem(`edit_user_draft_${window.location.pathname}`, JSON.stringify(draftData));
                    console.log('Draft saved automatically');
                }, 2000);
            });
        });
        
        // Load draft on page load
        const draftKey = `edit_user_draft_${window.location.pathname}`;
        const savedDraft = localStorage.getItem(draftKey);
        
        if (savedDraft) {
            const draftData = JSON.parse(savedDraft);
            
            // Ask user if they want to restore draft
            if (confirm('Ditemukan draft yang tersimpan. Apakah Anda ingin memulihkannya?')) {
                Object.keys(draftData).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input && input.value === '') {
                        input.value = draftData[key];
                    }
                });
            } else {
                localStorage.removeItem(draftKey);
            }
        }
        
        // Clear draft on successful submission
        form.addEventListener('submit', function() {
            localStorage.removeItem(draftKey);
        });
    }
    
    // Add visual loading indicators
    const addLoadingIndicators = () => {
        const indicators = document.querySelectorAll('.quick-info-card');
        indicators.forEach((indicator, index) => {
            indicator.style.opacity = '0';
            indicator.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                indicator.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                indicator.style.opacity = '1';
                indicator.style.transform = 'translateY(0)';
            }, index * 150);
        });
    };
    
    // Initialize loading animations
    addLoadingIndicators();
    
    // Performance monitoring
    if (window.performance?.mark) {
        window.performance.mark('edit-user-enhanced-loaded');
        
        setTimeout(() => {
            const perfData = performance.getEntriesByName('edit-user-enhanced-loaded');
            if (perfData.length > 0) {
                console.log('Edit user page loaded in:', perfData[0].startTime, 'ms');
            }
        }, 100);
    }
    
    console.log('✅ Premium Edit User page with enhanced features loaded successfully');
});
</script>
@endsection