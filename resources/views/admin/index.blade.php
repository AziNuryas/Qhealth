@extends('layouts.admin')

@section('title', 'Dashboard - Qhealth')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
    
    :root {
        --primary-gradient: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        --premium-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        --success-glow: 0 0 40px rgba(16, 185, 129, 0.4);
        --premium-glow: 0 0 40px rgba(139, 92, 246, 0.4);
        --neon-green: #10b981;
        --neon-purple: #8b5cf6;
        
        /* Light Theme */
        --bg-primary: #f8fafc;
        --bg-secondary: #e2e8f0;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --border-color: rgba(255, 255, 255, 0.2);
        --card-bg: rgba(255, 255, 255, 0.9);
        
        --bg-body: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        --bg-hero: linear-gradient(135deg, 
            rgba(16, 185, 129, 0.95) 0%, 
            rgba(5, 150, 105, 0.9) 30%,
            rgba(4, 120, 87, 0.85) 70%,
            rgba(6, 78, 59, 0.9) 100%
        );
        --bg-card: linear-gradient(145deg, 
            rgba(255, 255, 255, 0.9) 0%,
            rgba(255, 255, 255, 0.7) 100%
        );
        --glass-bg: rgba(255, 255, 255, 0.08);
        --glass-border: rgba(255, 255, 255, 0.2);
        --dark-glass-bg: rgba(0, 0, 0, 0.1);
        --border-light: rgba(255, 255, 255, 0.4);
        --shadow-light: 0 20px 40px rgba(0, 0, 0, 0.08);
        --shadow-medium: 0 8px 16px rgba(0, 0, 0, 0.04);
        --status-success-bg: rgba(16, 185, 129, 0.15);
        --status-success-text: #047857;
        --status-success-border: rgba(16, 185, 129, 0.3);
        --status-info-bg: rgba(59, 130, 246, 0.15);
        --status-info-text: #1d4ed8;
        --status-info-border: rgba(59, 130, 246, 0.3);
        --status-warning-bg: rgba(245, 158, 11, 0.15);
        --status-warning-text: #b45309;
        --status-warning-border: rgba(245, 158, 11, 0.3);
        --chart-bg: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
        --chart-bar: linear-gradient(180deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.4) 100%);
        --inset-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
    }
    
    /* Dark Theme - Multiple selectors for compatibility */
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
        
        --bg-body: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --bg-hero: linear-gradient(135deg, 
            rgba(16, 185, 129, 0.9) 0%, 
            rgba(5, 150, 105, 0.85) 30%,
            rgba(4, 120, 87, 0.8) 70%,
            rgba(6, 78, 59, 0.85) 100%
        );
        --bg-card: linear-gradient(145deg, 
            rgba(30, 41, 59, 0.9) 0%,
            rgba(15, 23, 42, 0.8) 100%
        );
        --glass-bg: rgba(30, 41, 59, 0.3);
        --glass-border: rgba(148, 163, 184, 0.3);
        --dark-glass-bg: rgba(0, 0, 0, 0.4);
        --border-light: rgba(148, 163, 184, 0.3);
        --shadow-light: 0 20px 40px rgba(0, 0, 0, 0.4);
        --shadow-medium: 0 8px 16px rgba(0, 0, 0, 0.3);
        --status-success-bg: rgba(16, 185, 129, 0.2);
        --status-success-text: #34d399;
        --status-success-border: rgba(16, 185, 129, 0.4);
        --status-info-bg: rgba(59, 130, 246, 0.2);
        --status-info-text: #60a5fa;
        --status-info-border: rgba(59, 130, 246, 0.4);
        --status-warning-bg: rgba(245, 158, 11, 0.2);
        --status-warning-text: #fbbf24;
        --status-warning-border: rgba(245, 158, 11, 0.4);
        --chart-bg: linear-gradient(135deg, rgba(148, 163, 184, 0.15) 0%, rgba(148, 163, 184, 0.05) 100%);
        --chart-bar: linear-gradient(180deg, rgba(148, 163, 184, 0.8) 0%, rgba(148, 163, 184, 0.4) 100%);
        --inset-shadow: inset 0 1px 0 rgba(148, 163, 184, 0.3);
    }
    
    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }
    
    body {
        background: var(--bg-body);
        min-height: 100vh;
        color: var(--text-primary);
    }
    
    .hero-section {
        background: var(--bg-hero);
        backdrop-filter: blur(40px) saturate(200%);
        -webkit-backdrop-filter: blur(40px) saturate(200%);
        border-radius: 24px;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        padding: 3rem 2rem !important;
        border: 1px solid var(--glass-border);
        box-shadow: 
            0 32px 64px rgba(16, 185, 129, 0.15),
            0 16px 32px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        z-index: 1;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
            linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.05) 50%, transparent 70%);
        animation: aurora 15s ease-in-out infinite;
        pointer-events: none;
        z-index: -1;
    }
    
    .hero-section::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        animation: rotate 20s linear infinite;
        opacity: 0.5;
        pointer-events: none;
        z-index: -1;
    }
    
    @keyframes aurora {
        0%, 100% { opacity: 1; transform: translateY(0px) scale(1); }
        50% { opacity: 0.8; transform: translateY(-10px) scale(1.02); }
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .premium-card {
        background: var(--bg-card);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid var(--border-light);
        border-radius: 20px;
        padding: 2rem 1.5rem !important;
        position: relative;
        transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        overflow: hidden;
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.08),
            0 8px 16px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        z-index: 2;
    }
    
    .premium-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-gradient));
        transform: scaleX(0);
        transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        pointer-events: none;
        z-index: -1;
    }
    
    .premium-card::after {
        content: '';
        position: absolute;
        top: -100%;
        left: -100%;
        width: 300%;
        height: 300%;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
        transition: all 0.6s ease;
        opacity: 0;
        pointer-events: none;
        z-index: -1;
    }
    
    .premium-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 
            0 32px 64px rgba(16, 185, 129, 0.15),
            0 16px 32px rgba(0, 0, 0, 0.1),
            var(--success-glow);
        border-color: rgba(16, 185, 129, 0.3);
    }
    
    .premium-card:hover::before {
        transform: scaleX(1);
    }
    
    .premium-card:hover::after {
        opacity: 1;
        top: -50%;
        left: -50%;
    }
    
    .stat-icon-container {
        position: relative;
        margin: 0 auto 1.5rem;
        width: 80px;
        height: 80px;
        z-index: 3;
    }
    
    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        border: 2px solid rgba(255, 255, 255, 0.3);
        z-index: 3;
    }
    
    .stat-icon.users {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        box-shadow: 0 16px 32px rgba(16, 185, 129, 0.3);
    }
    
    .stat-icon.questions {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
        box-shadow: 0 16px 32px rgba(245, 158, 11, 0.3);
    }
    
    .stat-icon.answers {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
        box-shadow: 0 16px 32px rgba(59, 130, 246, 0.3);
    }
    
    .stat-icon::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        pointer-events: none;
        z-index: -1;
    }
    
    .premium-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
        border-radius: 50%;
    }
    
    .premium-card:hover .stat-icon::before {
        width: 120px;
        height: 120px;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        animation: countUp 2.5s cubic-bezier(0.23, 1, 0.32, 1);
        line-height: 1;
        letter-spacing: -0.02em;
        position: relative;
        z-index: 3;
    }
    
    @keyframes countUp {
        0% {
            opacity: 0;
            transform: translateY(30px) scale(0.8);
        }
        60% {
            opacity: 0.8;
            transform: translateY(-5px) scale(1.1);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .stat-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        letter-spacing: -0.01em;
        position: relative;
        z-index: 3;
    }
    
    .stat-description {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-bottom: 1rem;
        line-height: 1.4;
        position: relative;
        z-index: 3;
    }
    
    .premium-btn {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
        overflow: hidden;
        font-size: 0.9rem;
        letter-spacing: -0.01em;
        box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
        z-index: 10;
        cursor: pointer;
    }
    
    .premium-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 255, 255, 0.4), 
            transparent
        );
        transition: left 0.6s ease;
        pointer-events: none;
        z-index: -1;
    }
    
    .premium-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 
            0 16px 32px rgba(16, 185, 129, 0.4),
            var(--success-glow);
        color: white;
        text-decoration: none;
    }
    
    .premium-btn:hover::before {
        left: 100%;
    }
    
    .quick-actions-container {
        background: var(--bg-card);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid var(--border-light);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.08),
            0 8px 16px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        position: relative;
        overflow: hidden;
        z-index: 2;
    }
    
    .section-title {
        font-weight: 800;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.4rem;
        letter-spacing: -0.02em;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 3;
    }
    
    .section-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-bottom: 2rem;
        font-weight: 500;
        position: relative;
        z-index: 3;
    }
    
    .action-btn {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        border-radius: 16px;
        padding: 16px 24px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        min-width: 180px;
        justify-content: center;
        font-size: 0.95rem;
        letter-spacing: -0.01em;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 24px rgba(16, 185, 129, 0.25);
        z-index: 10;
        cursor: pointer;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: -1;
    }
    
    .action-btn:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 
            0 20px 40px rgba(16, 185, 129, 0.4),
            var(--success-glow);
        color: white;
        text-decoration: none;
    }
    
    .action-btn:hover::before {
        opacity: 1;
    }
    
    .fade-in {
        animation: fadeInUp 1s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        opacity: 0;
    }
    
    .fade-in:nth-child(1) { animation-delay: 0.1s; }
    .fade-in:nth-child(2) { animation-delay: 0.3s; }
    .fade-in:nth-child(3) { animation-delay: 0.5s; }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .pulse-premium {
        animation: pulsePremium 3s infinite;
    }
    
    @keyframes pulsePremium {
        0% { transform: scale(1); }
        50% { transform: scale(1.08); }
        100% { transform: scale(1); }
    }
    
    .welcome-text {
        background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.5rem;
        font-weight: 900;
        letter-spacing: -0.02em;
        line-height: 1.1;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 3;
    }
    
    .subtitle {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.1rem;
        font-weight: 500;
        letter-spacing: -0.01em;
        position: relative;
        z-index: 3;
    }
    
    .time-badge {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 3;
    }
    
    .chart-container {
        height: 50px;
        background: var(--chart-bg);
        border-radius: 12px;
        margin-top: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        z-index: 3;
    }
    
    .chart-bar {
        width: 4px;
        background: var(--chart-bar);
        margin: 0 2px;
        border-radius: 2px;
        animation: chartDance 3s infinite ease-in-out;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 3;
    }
    
    .chart-bar:nth-child(1) { height: 18px; animation-delay: 0s; }
    .chart-bar:nth-child(2) { height: 28px; animation-delay: 0.3s; }
    .chart-bar:nth-child(3) { height: 35px; animation-delay: 0.6s; }
    .chart-bar:nth-child(4) { height: 25px; animation-delay: 0.9s; }
    .chart-bar:nth-child(5) { height: 40px; animation-delay: 1.2s; }
    .chart-bar:nth-child(6) { height: 20px; animation-delay: 1.5s; }
    
    @keyframes chartDance {
        0%, 100% { 
            opacity: 0.6; 
            transform: scaleY(1);
        }
        50% { 
            opacity: 1; 
            transform: scaleY(1.2);
        }
    }
    
    .status-container {
        background: var(--bg-card);
        backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid var(--border-light);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        position: relative;
        z-index: 2;
    }
    
    .status-title {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        letter-spacing: -0.01em;
        position: relative;
        z-index: 3;
    }
    
    .status-badge {
        background: var(--status-success-bg);
        color: var(--status-success-text);
        border: 1px solid var(--status-success-border);
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: -0.01em;
        transition: all 0.3s ease;
        position: relative;
        z-index: 3;
    }
    
    .status-badge.info {
        background: var(--status-info-bg);
        color: var(--status-info-text);
        border-color: var(--status-info-border);
    }
    
    .status-badge.warning {
        background: var(--status-warning-bg);
        color: var(--status-warning-text);
        border-color: var(--status-warning-border);
    }
    
    @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 1.5rem !important;
            margin-bottom: 1.5rem;
        }
        
        .welcome-text {
            font-size: 2rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .premium-card {
            padding: 1.5rem 1.2rem !important;
        }
        
        .action-btn {
            min-width: 100%;
            margin-bottom: 1rem;
        }
    }
    
    /* Loading Animation */
    .loading-shimmer {
        background: linear-gradient(90deg, 
            rgba(255, 255, 255, 0) 0%, 
            rgba(255, 255, 255, 0.3) 50%, 
            rgba(255, 255, 255, 0) 100%
        );
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
</style>

<div class="container-fluid py-4">
    {{-- Premium Hero Section --}}
    <div class="hero-section text-center text-white position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="welcome-text mb-3">
                    <i class="bi bi-heart-pulse me-3" style="color: rgba(255,255,255,0.9);"></i>
                    Selamat Datang di Qhealth Admin
                </h1>
                <p class="subtitle mb-4">Dashboard kontrol premium untuk mengelola aplikasi kesehatan terdepan</p>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="time-badge">
                        <i class="bi bi-clock me-2"></i>{{ now()->format('d M Y, H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Premium Stats Cards --}}
    <div class="row g-4 mb-5">
        <!-- Users Card -->
        <div class="col-lg-4 col-md-6 fade-in">
            <div class="premium-card h-100 text-center">
                <div class="stat-icon-container">
                    <div class="stat-icon users">
                        <i class="bi bi-people-fill text-white" style="font-size: 1.8rem;"></i>
                    </div>
                </div>
                <div class="stat-number pulse-premium">{{ $userCount }}</div>
                <h5 class="stat-title">Total Pengguna</h5>
                <p class="stat-description">Pengguna aktif yang terdaftar dalam sistem kesehatan</p>
                
                <div class="chart-container">
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                </div>
                
                <a href="{{ route('admin.users.index') }}" class="premium-btn mt-3">
                    <i class="bi bi-arrow-right-circle me-2"></i>Kelola Pengguna
                </a>
            </div>
        </div>
        
        <!-- Questions Card -->
        <div class="col-lg-4 col-md-6 fade-in">
            <div class="premium-card h-100 text-center">
                <div class="stat-icon-container">
                    <div class="stat-icon questions">
                        <i class="bi bi-question-circle-fill text-white" style="font-size: 1.8rem;"></i>
                    </div>
                </div>
                <div class="stat-number pulse-premium">{{ $questionCount }}</div>
                <h5 class="stat-title">Total Pertanyaan</h5>
                <p class="stat-description">Pertanyaan kesehatan dari pengguna yang membutuhkan jawaban</p>
                
                <div class="chart-container">
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                </div>
                
                <a href="{{ route('admin.questions.index') }}" class="premium-btn mt-3">
                    <i class="bi bi-arrow-right-circle me-2"></i>Kelola Pertanyaan
                </a>
            </div>
        </div>
        
        <!-- Answers Card -->
        <div class="col-lg-4 col-md-6 fade-in">
            <div class="premium-card h-100 text-center">
                <div class="stat-icon-container">
                    <div class="stat-icon answers">
                        <i class="bi bi-chat-left-text-fill text-white" style="font-size: 1.8rem;"></i>
                    </div>
                </div>
                <div class="stat-number pulse-premium">{{ $answerCount }}</div>
                <h5 class="stat-title">Total Jawaban</h5>
                <p class="stat-description">Jawaban berkualitas dari tenaga kesehatan profesional</p>
                
                <div class="chart-container">
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                    <div class="chart-bar"></div>
                </div>
                
                <a href="{{ route('admin.answers.index') }}" class="premium-btn mt-3">
                    <i class="bi bi-arrow-right-circle me-2"></i>Kelola Jawaban
                </a>
            </div>
        </div>
    </div>

    {{-- Premium Quick Actions --}}
    <div class="row justify-content-center mb-5">
        <div class="col-lg-11">
            <div class="quick-actions-container text-center">
                <h3 class="section-title">
                    <i class="bi bi-lightning-fill text-warning me-2"></i>
                    Aksi Cepat Premium
                </h3>
                <p class="section-subtitle">Akses instan ke fitur-fitur administrasi dengan performa tinggi</p>
                
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('admin.users.index') }}" class="action-btn w-100">
                            <i class="bi bi-people-fill"></i>
                            <span>Pengguna</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('admin.questions.index') }}" class="action-btn w-100">
                            <i class="bi bi-question-circle-fill"></i>
                            <span>Pertanyaan</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="#" class="action-btn w-100">
                            <i class="bi bi-graph-up"></i>
                            <span>Statistik</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="#" class="action-btn w-100">
                            <i class="bi bi-gear-fill"></i>
                            <span>Pengaturan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Premium System Status --}}
    <div class="row">
        <div class="col text-center">
            <div class="status-container">
                <h5 class="status-title">
                    <i class="bi bi-shield-check text-success me-2"></i>
                    Sistem Premium Berjalan Optimal
                </h5>
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="status-badge">
                            <i class="bi bi-server me-2"></i>Server: Online
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="status-badge info">
                            <i class="bi bi-database me-2"></i>Database: Aktif
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="status-badge warning">
                            <i class="bi bi-cpu me-2"></i>CPU: 45%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to detect theme changes
    function detectThemeChange() {
        const html = document.documentElement;
        const body = document.body;
        
        // Check various theme indicators
        const isDark = 
            html.getAttribute('data-theme') === 'dark' ||
            html.getAttribute('data-bs-theme') === 'dark' ||
            body.getAttribute('data-theme') === 'dark' ||
            body.getAttribute('data-bs-theme') === 'dark' ||
            html.classList.contains('dark-mode') ||
            body.classList.contains('dark-mode') ||
            localStorage.getItem('theme') === 'dark' ||
            localStorage.getItem('bs-theme') === 'dark';
            
        console.log('Theme detected:', isDark ? 'dark' : 'light');
        return isDark;
    }
    
    // Observer to watch for theme changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes') {
                const attributeName = mutation.attributeName;
                if (attributeName === 'data-theme' || 
                    attributeName === 'data-bs-theme' || 
                    attributeName === 'class') {
                    console.log('Theme change detected via:', attributeName);
                    detectThemeChange();
                }
            }
        });
    });
    
    // Start observing
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['data-theme', 'data-bs-theme', 'class']
    });
    
    observer.observe(document.body, {
        attributes: true,
        attributeFilter: ['data-theme', 'data-bs-theme', 'class']
    });
    
    // Listen for storage changes (if navbar uses localStorage)
    window.addEventListener('storage', function(e) {
        if (e.key === 'theme' || e.key === 'bs-theme') {
            console.log('Theme change detected via localStorage');
            detectThemeChange();
        }
    });
    
    // Listen for custom events (if navbar dispatches them)
    window.addEventListener('themeChanged', function(e) {
        console.log('Theme change detected via custom event');
        detectThemeChange();
    });
    
    // Initial theme detection
    detectThemeChange();
    
    console.log('Qhealth Dashboard loaded with enhanced theme support');
});
</script>
@endsection