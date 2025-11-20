@extends('layouts.app')

@section('title', 'Dashboard - Qhealth')

@section('content')
<style>
    /* ===== VARIABLES ===== */
    :root {
        /* Light Mode - Hijau Blur */
        --primary: #10b981;
        --primary-glow: rgba(16, 185, 129, 0.15);
        --primary-light: #a7f3d0;
        --primary-dark: #059669;
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --bg-blur: rgba(255, 255, 255, 0.8);
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-tertiary: #9ca3af;
        --card-bg: rgba(255, 255, 255, 0.9);
        --card-border: rgba(16, 185, 129, 0.1);
        --shadow-sm: 0 2px 8px rgba(16, 185, 129, 0.08);
        --shadow-md: 0 4px 16px rgba(16, 185, 129, 0.12);
        --shadow-lg: 0 8px 32px rgba(16, 185, 129, 0.15);
        
        /* Animations */
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    /* ===== BASE STYLES ===== */
    body {
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition);
    }

    .dashboard-container {
        padding: 80px 0 20px 0;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* ===== GLASS MORPHISM EFFECT ===== */
    .glass-card {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .glass-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    /* ===== HERO SECTION ===== */
    .hero-wellness {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 20px;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        margin-bottom: 16px;
        box-shadow: var(--shadow-lg);
    }

    .hero-wellness::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        33% { transform: translate(20px, -15px) rotate(120deg); }
        66% { transform: translate(-15px, 10px) rotate(240deg); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .hero-subtitle {
        font-size: 13px;
        opacity: 0.9;
        margin: 0;
    }

    .hero-decoration {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 48px;
        opacity: 0.2;
        z-index: 1;
    }

    /* ===== STATS GRID ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }

    .stat-card {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        transform: scaleX(0);
        transition: transform 0.3s var(--bounce);
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-glow);
        color: var(--primary);
        font-size: 18px;
        transition: var(--transition);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
        background: var(--primary);
        color: white;
    }

    .stat-info {
        flex: 1;
    }

    .stat-number {
        font-size: 22px;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 2px;
    }

    .stat-label {
        font-size: 11px;
        color: var(--text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* ===== SEARCH BAR ===== */
    .search-container {
        position: relative;
        margin-bottom: 16px;
    }

    .search-input {
        width: 100%;
        padding: 14px 50px 14px 42px;
        border: none;
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        border-radius: 14px;
        border: 1px solid var(--card-border);
        color: var(--text-primary);
        font-size: 13px;
        outline: none;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }

    .search-input:focus {
        box-shadow: var(--shadow-md);
        border-color: var(--primary);
    }

    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: 16px;
    }

    .search-btn {
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 12px;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .search-btn:hover {
        transform: translateY(-50%) scale(1.05);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    /* ===== MAIN LAYOUT ===== */
    .main-layout {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 16px;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .main-layout {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .form-section {
            position: static !important;
        }
    }

    /* ===== FORM SECTION - COMPACT ===== */
    .form-section {
        position: sticky;
        top: 90px;
    }

    .form-card {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        padding: 20px;
    }

    .form-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .form-icon {
        width: 36px;
        height: 36px;
        background: var(--primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .form-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 6px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--card-border);
        border-radius: 10px;
        background: var(--bg-blur);
        color: var(--text-primary);
        font-size: 13px;
        transition: var(--transition);
        outline: none;
    }

    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-glow);
        transform: translateY(-1px);
    }

    textarea.form-input {
        resize: vertical;
        min-height: 80px;
        font-family: inherit;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        background: var(--primary);
        color: white;
        border: none;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    /* ===== QUESTIONS FEED ===== */
    .feed-section {
        min-height: 400px;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        gap: 12px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    .filters-container {
        display: flex;
        gap: 6px;
    }

    .filter-btn {
        padding: 6px 12px;
        border-radius: 16px;
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        color: var(--text-secondary);
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }

    .filter-btn:hover {
        transform: translateY(-1px);
        border-color: var(--primary);
    }

    .filter-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    /* ===== QUESTION CARDS - COMPACT ===== */
    .questions-feed {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .question-card {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        overflow: hidden;
        cursor: pointer;
    }

    .question-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    /* iOS-like tap animation */
    .question-card:active {
        transform: scale(0.98);
        transition: transform 0.1s;
    }

    .card-header {
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1px solid var(--card-border);
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .user-info {
        flex: 1;
        min-width: 0;
    }

    .user-name {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.2;
        margin-bottom: 2px;
    }

    .post-time {
        font-size: 10px;
        color: var(--text-tertiary);
        font-weight: 500;
    }

    .status-badge {
        padding: 4px 10px;
        border-radius: 16px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        flex-shrink: 0;
    }

    .status-answered {
        background: var(--primary);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .status-waiting {
        background: #f59e0b;
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    .card-content {
        padding: 16px;
    }

    .question-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .question-text {
        font-size: 12px;
        color: var(--text-secondary);
        line-height: 1.5;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-actions {
        display: flex;
        padding: 10px 16px;
        border-top: 1px solid var(--card-border);
        gap: 4px;
    }

    .action-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 8px;
        background: transparent;
        border: none;
        border-radius: 8px;
        color: var(--text-tertiary);
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }

    .action-btn i {
        font-size: 14px;
        transition: var(--transition);
    }

    .action-btn:hover {
        background: var(--primary-glow);
        color: var(--primary);
        transform: translateY(-1px);
    }

    .action-btn:hover i {
        transform: scale(1.1);
    }

    .action-btn.active {
        color: var(--primary);
    }

    /* ===== EXPANDABLE ANSWERS - COMPACT ===== */
    .answers-toggle {
        padding: 12px 16px;
        background: linear-gradient(transparent, var(--primary-glow));
        border-top: 1px solid var(--card-border);
    }

    .toggle-btn {
        width: 100%;
        padding: 10px;
        background: transparent;
        border: 1px dashed var(--primary);
        border-radius: 10px;
        color: var(--primary);
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .toggle-btn:hover {
        background: var(--primary-glow);
        border-style: solid;
        transform: translateY(-1px);
    }

    .toggle-btn i {
        transition: transform 0.3s var(--bounce);
    }

    .toggle-btn.expanded i {
        transform: rotate(180deg);
    }

    .answers-container {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .answers-container.expanded {
        max-height: 500px;
    }

    .answer-item {
        padding: 16px;
        background: var(--primary-glow);
        border-top: 1px solid var(--card-border);
        animation: slideDown 0.3s var(--bounce);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .answer-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }

    .answer-avatar {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 11px;
        font-weight: 700;
    }

    .answer-author {
        font-size: 12px;
        font-weight: 700;
        color: var(--primary);
    }

    .answer-time {
        font-size: 10px;
        color: var(--text-tertiary);
        margin-left: auto;
    }

    .answer-text {
        font-size: 12px;
        color: var(--text-secondary);
        line-height: 1.5;
        margin: 0;
    }

    /* ===== ALERTS ===== */
    .alert {
        padding: 14px 16px;
        border-radius: 14px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        font-weight: 600;
        animation: slideIn 0.3s var(--bounce);
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-15px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: var(--primary);
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background: var(--card-bg);
        border-radius: 16px;
        border: 2px dashed var(--card-border);
    }

    .empty-icon {
        font-size: 48px;
        color: var(--primary);
        opacity: 0.3;
        margin-bottom: 12px;
    }

    .empty-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
    }

    .empty-subtitle {
        font-size: 13px;
        color: var(--text-secondary);
    }

    /* ===== CHATBOT - FIXED & COMPACT ===== */
    .chatbot-floating {
        position: fixed;
        bottom: 80px;
        right: 20px;
        z-index: 9998;
    }

    .chatbot-fab {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        box-shadow: var(--shadow-lg);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        z-index: 9999;
    }

    .chatbot-fab::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, transparent, rgba(255,255,255,0.2), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }

    .chatbot-fab:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 32px rgba(16, 185, 129, 0.4);
    }

    .chatbot-fab:hover::before {
        transform: translateX(100%);
    }

    .chatbot-panel {
        position: fixed;
        bottom: 140px;
        right: 20px;
        width: 320px;
        max-width: calc(100vw - 40px);
        height: 400px;
        max-height: calc(100vh - 200px);
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        border: 1px solid var(--card-border);
        box-shadow: var(--shadow-lg);
        display: none;
        flex-direction: column;
        overflow: hidden;
        animation: panelPop 0.3s var(--bounce);
        z-index: 9997;
    }

    @keyframes panelPop {
        from {
            opacity: 0;
            transform: scale(0.8) translateY(20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .chatbot-panel.active {
        display: flex;
    }

    .chatbot-header {
        padding: 16px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .chatbot-title {
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chatbot-close {
        width: 28px;
        height: 28px;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chatbot-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .chatbot-messages {
        flex: 1;
        padding: 16px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .chat-message {
        max-width: 85%;
        padding: 10px 12px;
        border-radius: 14px;
        font-size: 12px;
        line-height: 1.4;
        animation: messageSlide 0.3s var(--bounce);
    }

    @keyframes messageSlide {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chat-message-user {
        align-self: flex-end;
        background: var(--primary);
        color: white;
        border-bottom-right-radius: 4px;
    }

    .chat-message-bot {
        align-self: flex-start;
        background: var(--primary-glow);
        color: var(--text-primary);
        border-bottom-left-radius: 4px;
    }

    .suggestion-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .suggestion-pill {
        padding: 6px 10px;
        background: var(--primary-glow);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        font-size: 10px;
        font-weight: 600;
        color: var(--text-primary);
        cursor: pointer;
        transition: var(--transition);
    }

    .suggestion-pill:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-1px);
    }

    .chatbot-input-area {
        padding: 12px;
        border-top: 1px solid var(--card-border);
        display: flex;
        gap: 8px;
    }

    .chatbot-input {
        flex: 1;
        padding: 10px 12px;
        border: 1px solid var(--card-border);
        border-radius: 16px;
        background: var(--bg-blur);
        color: var(--text-primary);
        font-size: 12px;
        outline: none;
        transition: var(--transition);
    }

    .chatbot-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-glow);
    }

    .chatbot-send {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .chatbot-send:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 80px 12px 20px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .section-header {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        
        .filters-container {
            justify-content: center;
        }
        
        .chatbot-panel {
            right: 12px;
            bottom: 120px;
            width: calc(100vw - 24px);
            height: 350px;
        }
        
        .chatbot-floating {
            right: 12px;
            bottom: 70px;
        }
        
        .main-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 18px;
        }
        
        .hero-subtitle {
            font-size: 12px;
        }
        
        .form-card {
            padding: 16px;
        }
        
        .card-header {
            padding: 12px;
        }
        
        .card-content {
            padding: 12px;
        }
    }
</style>

<div class="dashboard-container">
    {{-- Hero Section --}}
    <div class="hero-wellness">
        <div class="hero-content">
            <div class="hero-title">Selamat Datang di QHealth</div>
            <div class="hero-subtitle">Konsultasi kesehatan Anda dimulai dari sini</div>
        </div>
        <div class="hero-decoration">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>
    </div>

    {{-- Alerts --}}
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

    {{-- Stats Grid --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-question-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-number">{{ $questions->count() }}</div>
                <div class="stat-label">Total Pertanyaan</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-chat-left-text"></i>
            </div>
            <div class="stat-info">
                <?php
                    $answeredCount = 0;
                    foreach ($questions as $q) {
                        if ($q->answers && $q->answers->count() > 0) {
                            $answeredCount++;
                        }
                    }
                ?>
                <div class="stat-number">{{ $answeredCount }}</div>
                <div class="stat-label">Pertanyaan Terjawab</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-info">
                <?php
                    $uniqueUsers = $questions->pluck('user_id')->unique()->count();
                ?>
                <div class="stat-number">{{ $uniqueUsers }}</div>
                <div class="stat-label">Pengguna Aktif</div>
            </div>
        </div>
    </div>

    {{-- Search --}}
    <div class="search-container">
        <i class="bi bi-search search-icon"></i>
        <input type="text" class="search-input" placeholder="Cari pertanyaan kesehatan..." id="searchInput">
        <button class="search-btn">Cari</button>
    </div>

    {{-- Main Layout --}}
    <div class="main-layout">
        {{-- Sidebar Form --}}
        <div class="form-section">
            <div class="form-card">
                <div class="form-header">
                    <div class="form-icon">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <h3 class="form-title">Ajukan Pertanyaan</h3>
                </div>
                
                <form action="{{ route('questions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Judul Pertanyaan</label>
                        <input type="text" name="title" class="form-input" 
                               placeholder="Masukkan judul pertanyaan" value="{{ old('title') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Isi Pertanyaan</label>
                        <textarea name="question" class="form-input" 
                                  placeholder="Jelaskan pertanyaan Anda secara detail..." required>{{ old('question') }}</textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <i class="bi bi-send"></i>
                        Kirim Pertanyaan
                    </button>
                </form>
            </div>
        </div>

        {{-- Questions Feed --}}
        <div class="feed-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="bi bi-list-ul"></i>
                    Diskusi Terbaru
                </h3>
                <div class="filters-container">
                    <button class="filter-btn active" data-filter="all">Semua</button>
                    <button class="filter-btn" data-filter="answered">Terjawab</button>
                    <button class="filter-btn" data-filter="unanswered">Belum Dijawab</button>
                </div>
            </div>

            <div class="questions-feed">
                @forelse($questions as $q)
                    <?php
                        $isAnswered = $q->answers && $q->answers->count() > 0;
                        $questionClass = $isAnswered ? 'answered-question' : 'unanswered-question';
                    ?>
                    <div class="question-card {{ $questionClass }}">
                        {{-- Header --}}
                        <div class="card-header">
                            <div class="user-avatar">
                                {{ strtoupper(substr($q->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="user-info">
                                <div class="user-name">{{ $q->user->name ?? 'Anonim' }}</div>
                                <div class="post-time">
                                    {{ $q->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <span class="status-badge {{ $isAnswered ? 'status-answered' : 'status-waiting' }}">
                                {{ $isAnswered ? 'Terjawab' : 'Menunggu' }}
                            </span>
                        </div>

                        {{-- Content --}}
                        <div class="card-content">
                            <div class="question-title">{{ $q->title }}</div>
                            <p class="question-text">{{ Str::limit($q->question, 120) }}</p>
                        </div>

                        {{-- Actions --}}
                        <div class="card-actions">
                            <button class="action-btn like-btn" data-id="{{ $q->id }}">
                                <i class="bi bi-heart"></i>
                                <span>Suka</span>
                            </button>
                            <button class="action-btn comment-btn" data-id="{{ $q->id }}">
                                <i class="bi bi-chat"></i>
                                <span>Komentar</span>
                            </button>
                            <button class="action-btn save-btn" data-id="{{ $q->id }}">
                                <i class="bi bi-bookmark"></i>
                                <span>Simpan</span>
                            </button>
                        </div>

                        {{-- Answers Toggle --}}
                        @if($isAnswered)
                            <div class="answers-toggle">
                                <button class="toggle-btn" data-card-id="{{ $q->id }}">
                                    <i class="bi bi-chevron-down"></i>
                                    <span>Lihat {{ $q->answers->count() }} Jawaban</span>
                                </button>
                            </div>

                            <div class="answers-container" id="answers-{{ $q->id }}">
                                @foreach($q->answers as $answer)
                                    <div class="answer-item">
                                        <div class="answer-header">
                                            <div class="answer-avatar">
                                                {{ strtoupper(substr($answer->user->name ?? 'D', 0, 1)) }}
                                            </div>
                                            <span class="answer-author">{{ $answer->user->name ?? 'Dokter' }}</span>
                                            <span class="answer-time">{{ $answer->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="answer-text">{{ $answer->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <div class="empty-title">Belum ada pertanyaan</div>
                        <div class="empty-subtitle">Jadilah yang pertama mengajukan pertanyaan!</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Chatbot --}}
<div class="chatbot-floating">
    <div class="chatbot-panel" id="chatbotPanel">
        <div class="chatbot-header">
            <div class="chatbot-title">
                <i class="bi bi-robot"></i>
                QHealth Assistant
            </div>
            <button class="chatbot-close" id="chatbotClose">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <div class="chatbot-messages" id="chatbotMessages">
            <div class="chat-message chat-message-bot">
                👋 Halo! Saya QHealth Assistant. Saya di sini untuk membantu menjawab pertanyaan seputar kesehatan. Apa yang bisa saya bantu?
            </div>
            
            <div class="suggestion-pills">
                <div class="suggestion-pill" data-question="Apa gejala umum flu?">Gejala flu</div>
                <div class="suggestion-pill" data-question="Bagaimana cara menjaga kesehatan jantung?">Kesehatan jantung</div>
                <div class="suggestion-pill" data-question="Tips pola makan sehat">Pola makan</div>
            </div>
        </div>
        
        <div class="chatbot-input-area">
            <input type="text" class="chatbot-input" id="chatbotInput" placeholder="Ketik pertanyaan...">
            <button class="chatbot-send" id="chatbotSend">
                <i class="bi bi-send"></i>
            </button>
        </div>
    </div>
    
    <button class="chatbot-fab" id="chatbotFab">
        <i class="bi bi-robot"></i>
    </button>
</div>

<script>
    // Filter functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            document.querySelectorAll('.question-card').forEach(card => {
                if (filter === 'all') {
                    card.style.display = 'block';
                } else if (filter === 'answered' && card.classList.contains('answered-question')) {
                    card.style.display = 'block';
                } else if (filter === 'unanswered' && card.classList.contains('unanswered-question')) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.question-card').forEach(card => {
            const title = card.querySelector('.question-title').innerText.toLowerCase();
            const content = card.querySelector('.question-text').innerText.toLowerCase();
            card.style.display = (title.includes(searchTerm) || content.includes(searchTerm)) ? 'block' : 'none';
        });
    });

    // Toggle answers with smooth animation
    document.querySelectorAll('.toggle-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const cardId = this.getAttribute('data-card-id');
            const answersContainer = document.getElementById('answers-' + cardId);
            
            answersContainer.classList.toggle('expanded');
            this.classList.toggle('expanded');
            
            const span = this.querySelector('span');
            if (answersContainer.classList.contains('expanded')) {
                span.textContent = 'Sembunyikan Jawaban';
            } else {
                const count = answersContainer.querySelectorAll('.answer-item').length;
                span.textContent = 'Lihat ' + count + ' Jawaban';
            }
        });
    });

    // Interactive buttons with iOS-like feedback
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Add ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(16, 185, 129, 0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
            
            // Toggle active state
            if (this.classList.contains('like-btn') || this.classList.contains('save-btn')) {
                this.classList.toggle('active');
                const icon = this.querySelector('i');
                if (this.classList.contains('active')) {
                    if (this.classList.contains('like-btn')) {
                        icon.className = 'bi bi-heart-fill';
                    } else {
                        icon.className = 'bi bi-bookmark-fill';
                    }
                } else {
                    if (this.classList.contains('like-btn')) {
                        icon.className = 'bi bi-heart';
                    } else {
                        icon.className = 'bi bi-bookmark';
                    }
                }
            }
        });
    });

    // Chatbot functionality
    document.addEventListener('DOMContentLoaded', function() {
        const chatbotFab = document.getElementById('chatbotFab');
        const chatbotPanel = document.getElementById('chatbotPanel');
        const chatbotClose = document.getElementById('chatbotClose');
        const chatbotMessages = document.getElementById('chatbotMessages');
        const chatbotInput = document.getElementById('chatbotInput');
        const chatbotSend = document.getElementById('chatbotSend');

        // Toggle chatbot
        chatbotFab.addEventListener('click', function() {
            chatbotPanel.classList.toggle('active');
            if (chatbotPanel.classList.contains('active')) {
                chatbotInput.focus();
            }
        });

        // Close chatbot
        chatbotClose.addEventListener('click', function() {
            chatbotPanel.classList.remove('active');
        });

        // Send message
        function sendMessage() {
            const message = chatbotInput.value.trim();
            if (message === '') return;

            addMessage(message, 'user');
            chatbotInput.value = '';
            
            // Simulate bot response
            setTimeout(() => {
                addMessage('Terima kasih atas pertanyaannya. Tim dokter kami akan segera merespons melalui platform ini.', 'bot');
            }, 1000);
        }

        // Add message
        function addMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `chat-message chat-message-${sender}`;
            messageDiv.textContent = text;
            chatbotMessages.appendChild(messageDiv);
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }

        // Send on click
        chatbotSend.addEventListener('click', sendMessage);

        // Send on Enter
        chatbotInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Suggestion pills
        document.querySelectorAll('.suggestion-pill').forEach(pill => {
            pill.addEventListener('click', function() {
                const question = this.getAttribute('data-question');
                chatbotInput.value = question;
                sendMessage();
            });
        });
    });

    // Add ripple effect animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection