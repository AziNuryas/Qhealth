@extends('layouts.app')
@section('title', 'Dashboard - Qhealth')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap');
    /* ===== VARIABEL WARNA ===== */
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
    /* ===== ANIMATED BACKGROUND ===== */
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
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 80px 16px 24px;
    }
    /* ===== HERO SECTION ===== */
    .hero-section {
        background: linear-gradient(140deg, rgba(16, 185, 129, 0.92), rgba(4, 120, 87, 0.88));
        border-radius: 24px;
        padding: 36px;
        margin-bottom: 28px;
        box-shadow: var(--shadow-lg);
        position: realative;
        overflow: hidden;
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }
    .hero-balls {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }
    .hero-ball {
        position: absolute;
        border-radius: 50%;
        opacity: 0.2;
        animation: floatBall 15s ease-in-out infinite;
    }
    .hero-ball-1 {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.3);
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    .hero-ball-2 {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.25);
        bottom: 25%;
        right: 15%;
        animation-delay: 3s;
    }
    @keyframes floatBall {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(20px, -20px) scale(1.1); }
    }
    .hero-badge {
        display: inline-block;
        padding: 6px 14px;
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        color: white;
        margin-bottom: 14px;
        letter-spacing: 0.5px;
        font-family: 'Space Grotesk', sans-serif;
    }
    .hero-title {
        font-size: 32px;
        font-weight: 800;
        color: white;
        margin-bottom: 10px;
        line-height: 1.2;
        letter-spacing: -0.8px;
        font-family: 'Manrope', sans-serif;
    }
    .hero-subtitle {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.92);
        margin: 0;
        max-width: 620px;
        line-height: 1.5;
    }
    /* ===== ALERTS ===== */
    .alert {
        padding: 16px 20px;
        border-radius: 14px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 14px;
        font-weight: 600;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid;
    }
    .alert-success {
        background: rgba(16, 185, 129, 0.15);
        border-color: rgba(16, 185, 129, 0.3);
        color: #10b981;
    }
    .alert-error {
        background: rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }
    /* ===== SEARCH ===== */
    .search-section {
        margin-bottom: 26px;
    }
    .search-box {
        position: relative;
        max-width: 620px;
    }
    .search-input {
        width: 100%;
        padding: 15px 22px 15px 52px;
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1.5px solid var(--card-border);
        border-radius: 56px;
        font-size: 15px;
        color: var(--text-primary);
        outline: none;
        box-shadow: var(--shadow-sm);
        font-family: 'Manrope', sans-serif;
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
    /* ===== LAYOUT ===== */
    .content-layout {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 26px;
    }
    @media (max-width: 1024px) {
        .content-layout {
            grid-template-columns: 1fr;
        }
    }
    /* ===== SIDEBAR FORM ===== */
    .sidebar-form {
        position: sticky;
        top: 80px;
    }
    .form-card {
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 22px;
        padding: 30px;
        box-shadow: var(--shadow-md);
    }
    .form-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-3px);
    }
    .form-header {
        margin-bottom: 26px;
        text-align: center;
    }
    .form-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #10b981, #047857);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        box-shadow: 0 10px 24px rgba(16, 185, 129, 0.35);
    }
    .form-icon i {
        font-size: 30px;
        color: white;
    }
    .form-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 10px 0;
        font-family: 'Manrope', sans-serif;
    }
    .form-description {
        font-size: 14px;
        color: var(--text-secondary);
        margin: 0;
        line-height: 1.6;
    }
    .input-group {
        margin-bottom: 20px;
    }
    .input-label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 10px;
        font-family: 'Manrope', sans-serif;
    }
    .input-field {
        width: 100%;
        padding: 15px 20px;
        background: var(--bg-primary);
        border: 1.8px solid var(--card-border);
        border-radius: 18px;
        font-size: 15px;
        color: var(--text-primary);
        outline: none;
        font-family: 'Manrope', sans-serif;
    }
    .input-field:focus {
        background: var(--bg-secondary);
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        transform: translateY(-2px);
    }
    textarea.input-field {
        resize: vertical;
        min-height: 120px;
    }
    .btn-submit {
        width: 100%;
        padding: 17px;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
        border: none;
        border-radius: 18px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 10px 24px rgba(16, 185, 129, 0.35);
        font-family: 'Manrope', sans-serif;
    }
    /* ===== FEED ===== */
    .feed-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
        gap: 18px;
        flex-wrap: wrap;
    }
    .feed-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0;
        font-family: 'Manrope', sans-serif;
    }
    .filter-tabs {
        display: flex;
        gap: 10px;
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        padding: 6px;
        border-radius: 14px;
        border: 1.5px solid var(--card-border);
    }
    .filter-tab {
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
    .filter-tab.active {
        background: #10b981;
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }
    /* ===== QUESTION CARD ===== */
    .questions-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }
    .question-item {
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .question-item--own {
        border: 2px solid #10b981;
        background: rgba(16, 185, 129, 0.06) !important;
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.15) !important;
    }
    .question-item--own .status-badge {
        background: rgba(16, 185, 129, 0.2) !important;
        color: #10b981 !important;
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
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    .action-btn {
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
    }
    .like-btn {
        color: #3b82f6;
        border-color: rgba(59, 130, 246, 0.25);
    }
    .like-btn.active {
        background: rgba(59, 130, 246, 0.15);
        border-color: #3b82f6;
    }
    .like-btn i::before {
        content: "👍";
        font-family: "Segoe UI Emoji", "Apple Color Emoji", sans-serif;
        font-size: 16px !important;
    }
    .bookmark-btn {
        color: #8b5cf6;
        border-color: rgba(139, 92, 246, 0.25);
    }
    .bookmark-btn.active {
        background: rgba(139, 92, 246, 0.15);
        border-color: #8b5cf6;
    }
    .bookmark-btn i {
        font-size: 16px;
    }
    .view-answers-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        background: #10b981;
        border: none;
        border-radius: 50px;
        color: white;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        font-family: 'Manrope', sans-serif;
    }
    .answers-list {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.45s ease;
    }
    .answers-list.expanded {
        max-height: 600px;
        overflow-y: auto;
        border-top: 1.5px solid var(--card-border);
    }
    .answer-item {
        padding: 20px 24px;
        border-top: 1.5px solid var(--card-border);
        background: var(--bg-primary);
    }
    .answer-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .answer-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 14px;
        font-family: 'Space Grotesk', sans-serif;
    }
    .answer-author {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 14px;
        color: var(--text-primary);
    }
    .answer-time {
        font-size: 12px;
        color: var(--text-secondary);
        margin-left: auto;
    }
    .answer-content {
        font-size: 15px;
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
        font-family: 'Manrope', sans-serif;
        padding-left: 48px;
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
    /* CHATBOT */
    .chatbot-panel {
        position: fixed;
        bottom: 90px;
        right: 26px;
        width: 380px;
        max-width: calc(100vw - 52px);
        height: 500px;
        max-height: calc(100vh - 140px);
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        border-radius: 18px;
        box-shadow: var(--shadow-lg);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 9999;
    }
    .chatbot-header {
        padding: 18px 22px;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .chatbot-title {
        font-size: 17px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: 'Manrope', sans-serif;
    }
    .chatbot-close {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .chatbot-messages {
        flex: 1;
        padding: 18px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 14px;
        background: var(--bg-primary);
    }
    .chat-message {
        max-width: 85%;
        padding: 14px 18px;
        border-radius: 18px;
        font-size: 15px;
        line-height: 1.5;
        font-family: 'Manrope', sans-serif;
    }
    .chat-message.user {
        align-self: flex-end;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
    }
    .chat-message.bot {
        align-self: flex-start;
        background: var(--card-bg);
        color: var(--text-primary);
        border: 1.5px solid var(--card-border);
    }
    .chatbot-input-area {
        padding: 18px;
        border-top: 1.5px solid var(--card-border);
        display: flex;
        gap: 10px;
        background: var(--bg-secondary);
    }
    .chatbot-input {
        flex: 1;
        padding: 12px 18px;
        background: var(--bg-primary);
        border: 1.5px solid var(--card-border);
        border-radius: 56px;
        font-size: 15px;
        color: var(--text-primary);
        outline: none;
        font-family: 'Manrope', sans-serif;
    }
    .chatbot-send {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .chatbot-toggle {
        position: fixed;
        bottom: 26px;
        right: 26px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        cursor: pointer;
        box-shadow: 0 10px 24px rgba(16, 185, 129, 0.45);
        z-index: 9999;
    }
    /* ANIMASI TITIK MENGETIK */
    .typing-dots {
        display: inline-block;
        margin-left: 4px;
    }
    .typing-dots span {
        animation: typing 1.4s infinite;
        opacity: 0;
    }
    .typing-dots span:nth-child(1) { animation-delay: 0s; }
    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typing {
        0%, 100% { opacity: 0; }
        50% { opacity: 1; }
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
        .hero-title { font-size: 26px; }
        .content-layout { grid-template-columns: 1fr; }
        .question-header { flex-direction: column; align-items: flex-start; gap: 12px; }
        .question-footer { flex-direction: column; gap: 12px; align-items: stretch; }
        .action-buttons { justify-content: center; }
        .view-answers-btn { width: 100%; justify-content: center; }
        .chatbot-panel { width: calc(100vw - 32px); right: 16px; bottom: 80px; }
        .chatbot-toggle { bottom: 16px; right: 16px; }
    }
</style>
<!-- Animated Background -->
<div class="orb-container">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
</div>
<div class="dashboard-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-balls">
            <div class="hero-ball hero-ball-1"></div>
            <div class="hero-ball hero-ball-2"></div>
        </div>
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-stars"></i> DASHBOARD ANONIM
            </div>
            <h1 class="hero-title">👋 Selamat Datang di QHealth!</h1>
            <p class="hero-subtitle">
                Ajukan pertanyaan kesehatan secara anonim dan dapatkan jawaban dari komunitas serta tenaga medis profesional.
            </p>
        </div>
    </div>
    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            Terdapat kesalahan dalam pengisian form.
        </div>
    @endif
    <!-- Search -->
    <div class="search-section">
        <div class="search-box">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Cari pertanyaan kesehatan...">
        </div>
    </div>
    <!-- Main Content -->
    <div class="content-layout">
        <!-- Sidebar Form -->
        <aside class="sidebar-form">
            <div class="form-card">
                <div class="form-header">
                    <div class="form-icon">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <h2 class="form-title">Buat Pertanyaan Anonim</h2>
                    <p class="form-description">Pertanyaan Anda akan ditampilkan dengan nama karakter acak — identitas tetap aman.</p>
                </div>
                <form action="{{ route('questions.store') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label class="input-label">Judul Pertanyaan</label>
                        <input type="text" name="title" class="input-field" 
                               placeholder="Contoh: Apakah gejala ini berbahaya?" value="{{ old('title') }}" required>
                    </div>
                    <div class="input-group">
                        <label class="input-label">Detail Pertanyaan</label>
                        <textarea name="question" class="input-field" 
                                  placeholder="Jelaskan gejala atau kondisi Anda secara detail..." required>{{ old('question') }}</textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-send-fill"></i>
                        <span>Kirim Pertanyaan</span>
                    </button>
                </form>
            </div>
        </aside>
        <!-- Feed -->
        <main class="feed-container">
            <div class="feed-header">
                <h2 class="feed-title">Diskusi Terbaru</h2>
                <div class="filter-tabs">
                    <button class="filter-tab active" data-filter="all">Semua</button>
                    <button class="filter-tab" data-filter="answered">Terjawab</button>
                    <button class="filter-tab" data-filter="unanswered">Belum Dijawab</button>
                </div>
            </div>
            <div class="questions-list">
                @php
                    $characters = [
                        ['name' => 'Naruto Uzumaki', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Sasuke Uchiha', 'avatar_class' => 'avatar-purple'],
                        ['name' => 'Sakura Haruno', 'avatar_class' => 'avatar-pink'],
                        ['name' => 'Kakashi Hatake', 'avatar_class' => 'avatar-slate'],
                        ['name' => 'Hinata Hyuga', 'avatar_class' => 'avatar-blue'],
                        ['name' => 'Jiraiya', 'avatar_class' => 'avatar-lime'],
                        ['name' => 'Tsunade', 'avatar_class' => 'avatar-amber'],
                        ['name' => 'Orochimaru', 'avatar_class' => 'avatar-slate-dark'],
                        ['name' => 'Itachi Uchiha', 'avatar_class' => 'avatar-blue-dark'],
                        ['name' => 'Madara Uchiha', 'avatar_class' => 'avatar-red-dark'],
                        ['name' => 'Boruto Uzumaki', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Sarada Uchiha', 'avatar_class' => 'avatar-pink'],
                        ['name' => 'Mitsuki', 'avatar_class' => 'avatar-green'],
                        ['name' => 'Monkey D. Luffy', 'avatar_class' => 'avatar-red'],
                        ['name' => 'Roronoa Zoro', 'avatar_class' => 'avatar-purple'],
                        ['name' => 'Nami', 'avatar_class' => 'avatar-amber'],
                        ['name' => 'Usopp', 'avatar_class' => 'avatar-green-dark'],
                        ['name' => 'Sanji', 'avatar_class' => 'avatar-red'],
                        ['name' => 'Tony Tony Chopper', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Nico Robin', 'avatar_class' => 'avatar-purple'],
                        ['name' => 'Franky', 'avatar_class' => 'avatar-blue'],
                        ['name' => 'Brook', 'avatar_class' => 'avatar-slate'],
                        ['name' => 'Jinbe', 'avatar_class' => 'avatar-green-deep'],
                        ['name' => 'Shanks', 'avatar_class' => 'avatar-red-dark'],
                        ['name' => 'Portgas D. Ace', 'avatar_class' => 'avatar-red'],
                        ['name' => 'Marshall D. Teach', 'avatar_class' => 'avatar-black'],
                        ['name' => 'Asta', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Yuno', 'avatar_class' => 'avatar-blue'],
                        ['name' => 'Noelle Silva', 'avatar_class' => 'avatar-green-deep'],
                        ['name' => 'Yami Sukehiro', 'avatar_class' => 'avatar-black'],
                        ['name' => 'Mimosa Vermillion', 'avatar_class' => 'avatar-amber'],
                        ['name' => 'Luck Voltia', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Magna Swing', 'avatar_class' => 'avatar-purple'],
                        ['name' => 'Vanessa Enoteca', 'avatar_class' => 'avatar-pink'],
                        ['name' => 'Finral Roulacase', 'avatar_class' => 'avatar-blue'],
                        ['name' => 'Julius Novachrono', 'avatar_class' => 'avatar-slate-dark'],
                        ['name' => 'Sung Jin-Woo', 'avatar_class' => 'avatar-purple-deep'],
                        ['name' => 'Cha Hae-In', 'avatar_class' => 'avatar-pink'],
                        ['name' => 'Yoo Jin-Ho', 'avatar_class' => 'avatar-slate'],
                        ['name' => 'Choi Jong-In', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Baek Yoon-Ho', 'avatar_class' => 'avatar-blue'],
                        ['name' => 'Thomas Andre', 'avatar_class' => 'avatar-green-dark'],
                        ['name' => 'Liu Zhigang', 'avatar_class' => 'avatar-amber'],
                        ['name' => 'Berada', 'avatar_class' => 'avatar-green-deep'],
                        ['name' => 'BoBoiBoy', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Yaya', 'avatar_class' => 'avatar-pink'],
                        ['name' => 'Ying', 'avatar_class' => 'avatar-blue'],
                        ['name' => 'Gopal', 'avatar_class' => 'avatar-green'],
                        ['name' => 'Fang', 'avatar_class' => 'avatar-purple'],
                        ['name' => 'Papa Zola', 'avatar_class' => 'avatar-slate-dark'],
                        ['name' => 'Tok Aba', 'avatar_class' => 'avatar-green-deep'],
                        ['name' => 'Adu Du', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Probe', 'avatar_class' => 'avatar-blue'],
                        ['name' => 'Computer', 'avatar_class' => 'avatar-slate-dark'],
                        ['name' => 'Upin', 'avatar_class' => 'avatar-amber'],
                        ['name' => 'Ipin', 'avatar_class' => 'avatar-amber'],
                        ['name' => 'Kakak Ros', 'avatar_class' => 'avatar-pink'],
                        ['name' => 'Opah', 'avatar_class' => 'avatar-slate'],
                        ['name' => 'Mail', 'avatar_class' => 'avatar-green-dark'],
                        ['name' => 'Ehsan', 'avatar_class' => 'avatar-purple'],
                        ['name' => 'Fizi', 'avatar_class' => 'avatar-pink'],
                        ['name' => 'Mei Mei', 'avatar_class' => 'avatar-amber'],
                        ['name' => 'Susanti', 'avatar_class' => 'avatar-blue'],
                        ['name' => 'Jarjit Singh', 'avatar_class' => 'avatar-orange'],
                        ['name' => 'Emon', 'avatar_class' => 'avatar-green']
                    ];
                    $profiles = session()->get('qhealth_v3_profiles', []);
                    $answers = session()->get('qhealth_v3_answers', []);
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
                    @endphp
                    <article class="question-item {{ $isAnswered ? 'answered-question' : 'unanswered-question' }} {{ $q->user_id == auth()->id() ? 'question-item--own' : '' }}" data-id="{{ $q->id }}">
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
                                <p class="question-content">{{ $q->question }}</p>
                            </div>
                        </div>
                        <div class="question-footer">
                            <div class="action-buttons">
                                <button class="action-btn like-btn" data-id="{{ $q->id }}">
                                    <i></i>
                                    <span>0</span>
                                </button>
                                <button class="action-btn bookmark-btn" data-id="{{ $q->id }}">
                                    <i class="bi bi-bookmark"></i>
                                    <span>0</span>
                                </button>
                            </div>
                            @if($isAnswered)
                                <button class="view-answers-btn" data-id="{{ $q->id }}">
                                    <span>{{ $q->answers->count() }} Jawaban</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            @endif
                        </div>
                        @if($isAnswered)
                            <div class="answers-list" id="answers-{{ $q->id }}">
                                @foreach($q->answers as $answer)
                                    @php
                                        $aid = 'a_' . $answer->id;
                                        if (!isset($answers[$aid])) {
                                            $randAns = $characters[array_rand($characters)];
                                            $answers[$aid] = $randAns;
                                            session()->put('qhealth_v3_answers', $answers);
                                        }
                                        $ansProfile = $answers[$aid];
                                    @endphp
                                    <div class="answer-item">
                                        <div class="answer-header">
                                            <div class="answer-avatar {{ $ansProfile['avatar_class'] }}">
                                                {{ $ansProfile['name'][0] }}
                                            </div>
                                            <span class="answer-author">{{ $ansProfile['name'] }}</span>
                                            <span class="answer-time">{{ $answer->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="answer-content">{{ $answer->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </article>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">🔒</div>
                        <h3 class="empty-title">Belum ada pertanyaan</h3>
                        <p class="empty-text">Jadilah yang pertama bertanya — dengan nama karakter favoritmu!</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</div>
<!-- CHATBOT -->
<div class="chatbot-panel" id="chatbotPanel">
    <div class="chatbot-header">
        <div class="chatbot-title">
            <i class="bi bi-robot"></i> QHealth AI Assistant
        </div>
        <button class="chatbot-close" id="chatbotClose">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="chatbot-messages" id="chatbotMessages">
        <div class="chat-message bot">
            Halo! Saya QHealth AI. Ada yang bisa saya bantu? 😊
        </div>
    </div>
    <div class="chatbot-input-area">
        <input type="text" class="chatbot-input" id="chatbotInput" placeholder="Ketik pesan...">
        <button class="chatbot-send" id="chatbotSend">
            <i class="bi bi-send-fill"></i>
        </button>
    </div>
</div>
<button class="chatbot-toggle" id="chatbotToggle">
    <i class="bi bi-chat-dots-fill"></i>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== CHATBOT DENGAN AI NYATA + ANIMASI =====
    const toggle = document.getElementById('chatbotToggle');
    const panel = document.getElementById('chatbotPanel');
    const close = document.getElementById('chatbotClose');
    const send = document.getElementById('chatbotSend');
    const input = document.getElementById('chatbotInput');
    const messages = document.getElementById('chatbotMessages');

    if (toggle) toggle.addEventListener('click', () => {
        panel.style.display = 'flex';
        input?.focus();
    });
    if (close) close.addEventListener('click', () => panel.style.display = 'none');

    function addMessage(text, isUser = false) {
        const div = document.createElement('div');
        div.className = `chat-message ${isUser ? 'user' : 'bot'}`;
        div.innerHTML = text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/\n/g, '<br>');
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    async function sendChatMessage() {
        const msg = input.value.trim();
        if (!msg) return;

        addMessage(msg, true);
        input.value = '';
        input.disabled = true;
        send.disabled = true;

        // Animasi titik-titik
        const typingDiv = document.createElement('div');
        typingDiv.className = 'chat-message bot';
        typingDiv.innerHTML = 'Mengetik<span class="typing-dots"><span>.</span><span>.</span><span>.</span></span>';
        messages.appendChild(typingDiv);
        messages.scrollTop = messages.scrollHeight;

        try {
            const response = await fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: msg })
            });

            const data = await response.json();
            typingDiv.remove(); // Hapus animasi

            if (data.reply) {
                addMessage(data.reply);
            } else {
                addMessage("Maaf, saya tidak bisa menjawab saat ini. Coba lagi nanti!");
            }
        } catch (error) {
            console.error('Chatbot Error:', error);
            typingDiv.remove();
            addMessage("Gagal terhubung ke AI. Periksa koneksi internetmu!");
        } finally {
            input.disabled = false;
            send.disabled = false;
            input.focus();
        }
    }

    if (send) send.addEventListener('click', sendChatMessage);
    if (input) {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendChatMessage();
            }
        });
    }

    // ===== FUNGSI LAINNYA TETAP UTUH =====
    document.querySelectorAll('.filter-tab')?.forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const f = this.dataset.filter;
            document.querySelectorAll('.question-item').forEach(item => {
                const answered = item.classList.contains('answered-question');
                item.style.display = (f === 'all' || (f === 'answered' && answered) || (f === 'unanswered' && !answered)) ? 'block' : 'none';
            });
        });
    });

    document.getElementById('searchInput')?.addEventListener('input', function() {
        const t = this.value.toLowerCase();
        document.querySelectorAll('.question-item').forEach(item => {
            const title = item.querySelector('.question-title')?.textContent.toLowerCase() || '';
            const content = item.querySelector('.question-content')?.textContent.toLowerCase() || '';
            item.style.display = (title.includes(t) || content.includes(t)) ? 'block' : 'none';
        });
    });

    document.querySelectorAll('.view-answers-btn')?.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const answers = document.getElementById('answers-' + id);
            answers.classList.toggle('expanded');
            const icon = this.querySelector('i');
            icon.className = icon.className.includes('down') ? 'bi bi-chevron-up' : 'bi bi-chevron-down';
        });
    });

    document.querySelectorAll('.like-btn')?.forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('active');
            const span = this.querySelector('span');
            const count = parseInt(span.textContent) || 0;
            span.textContent = this.classList.contains('active') ? count + 1 : Math.max(0, count - 1);
        });
    });

    document.querySelectorAll('.bookmark-btn')?.forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            icon.className = this.classList.contains('active') ? 'bi bi-bookmark-fill' : 'bi bi-bookmark';
            const span = this.querySelector('span');
            const count = parseInt(span.textContent) || 0;
            span.textContent = this.classList.contains('active') ? count + 1 : Math.max(0, count - 1);
        });
    });
});
</script>
@endsection