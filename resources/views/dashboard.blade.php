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
        position: relative;
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
        transition: all 0.3s ease;
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
        transition: all 0.3s ease;
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
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(16, 185, 129, 0.45);
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
        transition: all 0.3s ease;
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
        transition: all 0.3s ease;
    }
    .question-item:hover {
        box-shadow: var(--shadow-md);
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
        gap: 12px;
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
        transition: all 0.3s ease;
    }
    .answer-question-btn {
        background: rgba(16, 185, 129, 0.1);
        border-color: rgba(16, 185, 129, 0.3);
        color: #10b981;
    }
    .answer-question-btn:hover {
        background: rgba(16, 185, 129, 0.2);
        border-color: #10b981;
        transform: translateY(-2px);
    }
    .view-answers-btn {
        display: inline-flex;
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
        transition: all 0.3s ease;
    }
    .view-answers-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }
    /* ===== iOS STYLE SCROLLABLE ANSWERS (CONTROL CENTER STYLE) ===== */
    .answers-section {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        background: var(--bg-primary);
    }
    .answers-section.expanded {
        max-height: 400px; /* Max height untuk iOS style */
        border-top: 1.5px solid var(--card-border);
    }
    .answers-container {
        padding: 16px 24px 20px;
    }
    .answers-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }
    .answers-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
        font-family: 'Manrope', sans-serif;
    }
    .answers-count {
        font-size: 13px;
        color: var(--text-secondary);
        font-weight: 600;
    }
    /* iOS STYLE SCROLLABLE LIST */
    .answers-scroll-container {
        max-height: 320px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 8px;
        /* iOS Style Scrollbar */
        scrollbar-width: thin;
        scrollbar-color: rgba(16, 185, 129, 0.3) transparent;
    }
    .answers-scroll-container::-webkit-scrollbar {
        width: 6px;
    }
    .answers-scroll-container::-webkit-scrollbar-track {
        background: transparent;
    }
    .answers-scroll-container::-webkit-scrollbar-thumb {
        background: rgba(16, 185, 129, 0.3);
        border-radius: 10px;
    }
    .answers-scroll-container::-webkit-scrollbar-thumb:hover {
        background: rgba(16, 185, 129, 0.5);
    }
    .answers-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    /* iOS NOTIFICATION STYLE ANSWER CARD */
    .answer-item {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1.5px solid var(--card-border);
        border-radius: 14px;
        padding: 12px 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        /* iOS Style Shadow */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    .answer-item:hover {
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .answer-item:active {
        transform: scale(0.98);
    }
    .answer-item-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 8px;
        gap: 10px;
    }
    .answer-author-info {
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 1;
        min-width: 0;
    }
    .answer-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 13px;
        font-family: 'Space Grotesk', sans-serif;
        flex-shrink: 0;
    }
    .answer-author-text {
        flex: 1;
        min-width: 0;
    }
    .answer-author {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 13px;
        color: var(--text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .answer-time {
        font-size: 11px;
        color: var(--text-secondary);
        margin-top: 1px;
    }
    .answer-actions {
        display: flex;
        gap: 6px;
        flex-shrink: 0;
    }
    .answer-like-btn,
    .answer-dislike-btn {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 5px 10px;
        border-radius: 16px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        border: 1.5px solid transparent;
        background: transparent;
        font-family: 'Manrope', sans-serif;
        transition: all 0.2s ease;
    }
    .answer-like-btn {
        color: #10b981;
        border-color: rgba(16, 185, 129, 0.2);
    }
    .answer-like-btn.active {
        background: rgba(16, 185, 129, 0.15);
        border-color: #10b981;
    }
    .answer-dislike-btn {
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.2);
    }
    .answer-dislike-btn.active {
        background: rgba(239, 68, 68, 0.15);
        border-color: #ef4444;
    }
    .answer-like-btn i,
    .answer-dislike-btn i {
        font-size: 12px;
    }
    .answer-item-content {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.5;
        font-family: 'Manrope', sans-serif;
        padding-left: 40px;
        /* Limit lines untuk iOS style */
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    /* ===== POPUP MODAL ===== */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .modal-overlay.active {
        display: flex;
        opacity: 1;
    }
    .modal-content {
        background: var(--card-bg);
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        border: 1.5px solid var(--card-border);
        border-radius: 24px;
        padding: 32px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: var(--shadow-lg);
        animation: modalSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }
    .modal-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--text-primary);
        font-family: 'Manrope', sans-serif;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .modal-close {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--bg-primary);
        border: 1.5px solid var(--card-border);
        color: var(--text-primary);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.3s ease;
    }
    .modal-close:hover {
        background: #ef4444;
        border-color: #ef4444;
        color: white;
        transform: rotate(90deg);
    }
    .modal-question-preview {
        background: var(--bg-primary);
        border: 1.5px solid var(--card-border);
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 24px;
    }
    .modal-question-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        font-family: 'Manrope', sans-serif;
    }
    .modal-question-content {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.5;
        font-family: 'Manrope', sans-serif;
    }
    .modal-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .modal-form-label {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        font-family: 'Manrope', sans-serif;
    }
    .modal-form-textarea {
        width: 100%;
        padding: 14px 18px;
        background: var(--bg-primary);
        border: 1.8px solid var(--card-border);
        border-radius: 16px;
        font-size: 15px;
        color: var(--text-primary);
        resize: vertical;
        min-height: 120px;
        outline: none;
        font-family: 'Manrope', sans-serif;
        transition: all 0.3s ease;
    }
    .modal-form-textarea:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
    }
    .modal-form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }
    .modal-btn-cancel {
        padding: 12px 24px;
        background: transparent;
        border: 1.8px solid var(--card-border);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        color: var(--text-secondary);
        cursor: pointer;
        font-family: 'Manrope', sans-serif;
        transition: all 0.3s ease;
    }
    .modal-btn-cancel:hover {
        background: var(--bg-primary);
        border-color: var(--text-secondary);
    }
    .modal-btn-submit {
        padding: 12px 24px;
        background: linear-gradient(135deg, #10b981, #047857);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        font-family: 'Manrope', sans-serif;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .modal-btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }
    .modal-btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
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
        transition: all 0.3s ease;
    }
    .chatbot-toggle:hover {
        transform: scale(1.1);
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
        .action-buttons { width: 100%; }
        .answer-question-btn, .view-answers-btn { flex: 1; justify-content: center; }
        .chatbot-panel { width: calc(100vw - 32px); right: 16px; bottom: 80px; }
        .chatbot-toggle { bottom: 16px; right: 16px; }
        .modal-content { padding: 24px; }
        .modal-form-actions { flex-direction: column; }
        .modal-btn-cancel, .modal-btn-submit { width: 100%; justify-content: center; }
        .answers-scroll-container { max-height: 280px; }
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
                        $totalAnswers = $q->answers ? $q->answers->count() : 0;
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
                                <button class="action-btn answer-question-btn" data-id="{{ $q->id }}" data-title="{{ $q->title }}" data-content="{{ $q->question }}">
                                    <i class="bi bi-reply-fill"></i>
                                    <span>Jawab</span>
                                </button>
                                @if($isAnswered)
                                    <button class="view-answers-btn" data-id="{{ $q->id }}">
                                        <span>Lihat {{ $totalAnswers }} Jawaban</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                        @if($isAnswered)
                            <div class="answers-section" id="answers-{{ $q->id }}">
                                <div class="answers-container">
                                    <div class="answers-header">
                                        <h4 class="answers-title">Jawaban</h4>
                                        <span class="answers-count">{{ $totalAnswers }} balasan</span>
                                    </div>
                                    <!-- iOS STYLE SCROLLABLE CONTAINER -->
                                    <div class="answers-scroll-container">
                                        <div class="answers-list">
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
                                                    <div class="answer-item-header">
                                                        <div class="answer-author-info">
                                                            <div class="answer-avatar {{ $ansProfile['avatar_class'] }}">
                                                                {{ $ansProfile['name'][0] }}
                                                            </div>
                                                            <div class="answer-author-text">
                                                                <div class="answer-author">{{ $ansProfile['name'] }}</div>
                                                                <div class="answer-time">{{ $answer->created_at->diffForHumans() }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="answer-actions">
                                                            <button class="answer-like-btn" data-id="{{ $answer->id }}">
                                                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                                                <span>0</span>
                                                            </button>
                                                            <button class="answer-dislike-btn" data-id="{{ $answer->id }}">
                                                                <i class="bi bi-hand-thumbs-down-fill"></i>
                                                                <span>0</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <p class="answer-item-content">{{ $answer->content }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
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

<!-- POPUP MODAL FOR ANSWER -->
<div class="modal-overlay" id="answerModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="bi bi-chat-dots-fill"></i>
                Berikan Jawaban
            </h3>
            <button class="modal-close" id="modalClose">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-question-preview">
            <div class="modal-question-title" id="modalQuestionTitle"></div>
            <div class="modal-question-content" id="modalQuestionContent"></div>
        </div>
        <form class="modal-form" id="answerModalForm">
            @csrf
            <div>
                <label class="modal-form-label">Jawaban Anda</label>
                <textarea class="modal-form-textarea" id="modalAnswerContent" placeholder="Tulis jawaban yang informatif dan membantu..." required></textarea>
            </div>
            <div class="modal-form-actions">
                <button type="button" class="modal-btn-cancel" id="modalCancelBtn">Batal</button>
                <button type="submit" class="modal-btn-submit">
                    <i class="bi bi-send-fill"></i>
                    Kirim Jawaban
                </button>
            </div>
        </form>
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
    // ===== ANSWER MODAL =====
    const answerModal = document.getElementById('answerModal');
    const modalClose = document.getElementById('modalClose');
    const modalCancelBtn = document.getElementById('modalCancelBtn');
    const answerModalForm = document.getElementById('answerModalForm');
    const modalQuestionTitle = document.getElementById('modalQuestionTitle');
    const modalQuestionContent = document.getElementById('modalQuestionContent');
    const modalAnswerContent = document.getElementById('modalAnswerContent');
    let currentQuestionId = null;

    // Open modal when click "Jawab" button
    document.querySelectorAll('.answer-question-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentQuestionId = this.dataset.id;
            modalQuestionTitle.textContent = this.dataset.title;
            modalQuestionContent.textContent = this.dataset.content;
            answerModal.classList.add('active');
            setTimeout(() => modalAnswerContent.focus(), 100);
        });
    });

    // Close modal
    function closeModal() {
        answerModal.classList.remove('active');
        modalAnswerContent.value = '';
        currentQuestionId = null;
    }

    modalClose.addEventListener('click', closeModal);
    modalCancelBtn.addEventListener('click', closeModal);
    answerModal.addEventListener('click', function(e) {
        if (e.target === answerModal) closeModal();
    });

    // Submit answer - FIXED untuk tidak redirect sampai sukses
    answerModalForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        e.stopPropagation(); // Prevent form from submitting traditionally
        
        const content = modalAnswerContent.value.trim();
        
        if (!content) {
            alert('Jawaban tidak boleh kosong!');
            return false;
        }

        const submitBtn = this.querySelector('.modal-btn-submit');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Mengirim...';
        submitBtn.disabled = true;

        try {
            const res = await fetch(`/questions/${currentQuestionId}/answer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ content: content })
            });

            if (!res.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await res.json();
            
            if (data.success) {
                closeModal();
                // Tunggu animasi close selesai baru reload
                setTimeout(() => {
                    window.location.reload();
                }, 300);
            } else {
                alert('Gagal mengirim jawaban: ' + (data.message || 'Coba lagi'));
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        } catch (err) {
            console.error('Error:', err);
            alert('Terjadi kesalahan. Pastikan koneksi internet Anda stabil.');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
        
        return false;
    });

    // ===== TOGGLE ANSWERS =====
    document.querySelectorAll('.view-answers-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const answersSection = document.getElementById('answers-' + id);
            const isExpanded = answersSection.classList.contains('expanded');
            
            answersSection.classList.toggle('expanded');
            const icon = this.querySelector('i');
            icon.className = isExpanded ? 'bi bi-chevron-down' : 'bi bi-chevron-up';
            
            const textSpan = this.querySelector('span');
            const matches = textSpan.textContent.match(/\d+/);
            const count = matches ? matches[0] : '0';
            textSpan.textContent = isExpanded ? `Lihat ${count} Jawaban` : `Sembunyikan`;
        });
    });

    // ===== LIKE/DISLIKE ANSWERS =====
    document.querySelectorAll('.answer-like-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const wasActive = this.classList.contains('active');
            this.classList.toggle('active');
            
            const span = this.querySelector('span');
            const count = parseInt(span.textContent) || 0;
            span.textContent = wasActive ? Math.max(0, count - 1) : count + 1;
            
            // Remove dislike if was active
            const dislikeBtn = this.parentElement.querySelector('.answer-dislike-btn');
            if (!wasActive && dislikeBtn.classList.contains('active')) {
                dislikeBtn.classList.remove('active');
                const dislikeSpan = dislikeBtn.querySelector('span');
                const dislikeCount = parseInt(dislikeSpan.textContent) || 0;
                dislikeSpan.textContent = Math.max(0, dislikeCount - 1);
            }
        });
    });

    document.querySelectorAll('.answer-dislike-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const wasActive = this.classList.contains('active');
            this.classList.toggle('active');
            
            const span = this.querySelector('span');
            const count = parseInt(span.textContent) || 0;
            span.textContent = wasActive ? Math.max(0, count - 1) : count + 1;
            
            // Remove like if was active
            const likeBtn = this.parentElement.querySelector('.answer-like-btn');
            if (!wasActive && likeBtn.classList.contains('active')) {
                likeBtn.classList.remove('active');
                const likeSpan = likeBtn.querySelector('span');
                const likeCount = parseInt(likeSpan.textContent) || 0;
                likeSpan.textContent = Math.max(0, likeCount - 1);
            }
        });
    });

    // ===== CHATBOT =====
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

        const typingDiv = document.createElement('div');
        typingDiv.className = 'chat-message bot';
        typingDiv.innerHTML = 'Mengetik<span class="typing-dots"><span>.</span><span>.</span><span>.</span></span>';
        messages.appendChild(typingDiv);
        messages.scrollTop = messages.scrollHeight;

        try {
            const response = await fetch('/api/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: msg })
            });

            const data = await response.json();
            typingDiv.remove();

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

    // ===== FILTER & SEARCH =====
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
});
</script>
@endsection