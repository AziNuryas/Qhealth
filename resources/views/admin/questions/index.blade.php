@extends('layouts.admin')

@section('title', 'Daftar Pertanyaan - Qhealth')

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
        
        /* Light Mode Colors */
        --bg-primary: #f8fafc;
        --bg-secondary: #e2e8f0;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --border-color: rgba(255, 255, 255, 0.2);
        --card-bg: rgba(255, 255, 255, 0.9);
        --table-row-hover: rgba(16, 185, 129, 0.08);
        --table-border: rgba(255, 255, 255, 0.1);
        --search-bg: rgba(255, 255, 255, 0.8);
        --search-focus-bg: rgba(255, 255, 255, 0.95);
    }
    
    /* Dark Mode Colors - Multiple selectors for compatibility */
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
        --table-row-hover: rgba(16, 185, 129, 0.15);
        --table-border: rgba(148, 163, 184, 0.1);
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
    
    /* Optimized Hero Section */
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
    
    /* Advanced Statistics */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .stat-card {
        background: var(--gradient-card);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s var(--timing-smooth);
        position: relative;
        overflow: hidden;
        will-change: transform;
        transform: translateZ(0);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.05) 50%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s var(--timing-smooth);
        pointer-events: none;
    }
    
    .stat-card:hover {
        transform: translateY(-12px) rotateX(5deg);
        box-shadow: var(--shadow-hard);
    }
    
    .stat-card:hover::before {
        opacity: 1;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.8rem;
        color: white;
        position: relative;
        transition: all 0.4s var(--timing-bounce);
        will-change: transform;
    }
    
    .stat-icon.questions {
        background: linear-gradient(135deg, var(--info) 0%, #1d4ed8 100%);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
    }
    
    .stat-icon.answered {
        background: linear-gradient(135deg, var(--success) 0%, #16a34a 100%);
        box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
    }
    
    .stat-icon.pending {
        background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
    }
    
    .stat-icon.total {
        background: linear-gradient(135deg, var(--purple) 0%, #7c3aed 100%);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.15) rotateY(15deg);
    }
    
    .stat-number {
        font-size: 2.8rem;
        font-weight: 900;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        line-height: 1;
        animation: countUp 1.5s var(--timing-bounce);
    }
    
    .stat-label {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    
    /* Premium Table */
    .premium-table-container {
        background: var(--gradient-card);
        backdrop-filter: blur(25px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        position: relative;
    }
    
    .premium-table {
        width: 100%;
        border-collapse: collapse;
        background: transparent;
    }
    
    .premium-table thead {
        background: var(--gradient-primary);
        position: relative;
    }
    
    .premium-table thead::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.1) 50%, transparent 100%);
        animation: shimmer 3s infinite;
        pointer-events: none;
    }
    
    .premium-table thead th {
        padding: 1.75rem 2rem;
        color: white;
        font-weight: 800;
        text-align: left;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        position: relative;
    }
    
    .premium-table tbody tr {
        transition: all 0.3s var(--timing-smooth);
        border-bottom: 1px solid var(--table-border);
        will-change: transform, background;
    }
    
    .premium-table tbody tr:hover {
        background: var(--table-row-hover);
        transform: translateX(8px) scale(1.005);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.15);
    }
    
    .premium-table tbody td {
        padding: 1.75rem 2rem;
        color: var(--text-primary);
        font-weight: 500;
        border: none;
        vertical-align: middle;
    }
    
    /* User Interface Elements */
    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-weight: 800;
        font-size: 1.1rem;
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        transition: all 0.3s var(--timing-bounce);
        will-change: transform;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        transition: all 0.3s var(--timing-smooth);
    }
    
    .premium-table tbody tr:hover .user-avatar {
        transform: scale(1.1) rotateZ(5deg);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5);
    }
    
    .user-details h6 {
        margin: 0;
        font-weight: 700;
        color: var(--text-primary);
        font-size: 1.1rem;
        letter-spacing: -0.01em;
    }
    
    .user-email {
        margin: 0;
        font-size: 0.9rem;
        color: var(--text-secondary);
        font-weight: 500;
    }
    
    /* Question Content */
    .question-preview {
        max-width: 400px;
        line-height: 1.4;
        font-weight: 500;
        color: var(--text-secondary);
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s var(--timing-smooth);
        position: relative;
        overflow: hidden;
    }
    
    .status-badge::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.3) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s var(--timing-smooth);
        pointer-events: none;
    }
    
    .status-badge:hover::before {
        transform: translateX(100%);
    }
    
    .status-answered {
        background: rgba(34, 197, 94, 0.15);
        color: #16a34a;
        border: 2px solid rgba(34, 197, 94, 0.3);
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.2);
    }
    
    .status-pending {
        background: rgba(245, 158, 11, 0.15);
        color: #d97706;
        border: 2px solid rgba(245, 158, 11, 0.3);
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
    }
    
    /* Dark mode status badge colors */
    [data-theme="dark"] .status-answered,
    [data-bs-theme="dark"] .status-answered,
    .dark-mode .status-answered {
        background: rgba(34, 197, 94, 0.2);
        color: #34d399;
        border-color: rgba(34, 197, 94, 0.4);
    }
    
    [data-theme="dark"] .status-pending,
    [data-bs-theme="dark"] .status-pending,
    .dark-mode .status-pending {
        background: rgba(245, 158, 11, 0.2);
        color: #fbbf24;
        border-color: rgba(245, 158, 11, 0.4);
    }
    
    .status-badge:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }
    
    .btn-action {
        background: var(--gradient-card);
        backdrop-filter: blur(15px);
        border: 2px solid var(--glass-border);
        border-radius: 12px;
        padding: 12px 16px;
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.3s var(--timing-bounce);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        will-change: transform;
    }
    
    .btn-action::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s var(--timing-smooth);
        pointer-events: none;
    }
    
    .btn-action:hover::before {
        opacity: 1;
    }
    
    .btn-action.view {
        color: var(--info);
        border-color: rgba(59, 130, 246, 0.4);
    }
    
    .btn-action.edit {
        color: var(--warning);
        border-color: rgba(245, 158, 11, 0.4);
    }
    
    .btn-action.delete {
        color: var(--danger);
        border-color: rgba(239, 68, 68, 0.4);
    }
    
    .btn-action:hover {
        transform: translateY(-4px) scale(1.1);
        text-decoration: none;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }
    
    .btn-action.view:hover {
        background: rgba(59, 130, 246, 0.15);
        color: var(--info);
        box-shadow: 0 12px 30px rgba(59, 130, 246, 0.3);
    }
    
    .btn-action.edit:hover {
        background: rgba(245, 158, 11, 0.15);
        color: var(--warning);
        box-shadow: 0 12px 30px rgba(245, 158, 11, 0.3);
    }
    
    .btn-action.delete:hover {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
        box-shadow: 0 12px 30px rgba(239, 68, 68, 0.3);
    }
    
    /* Date Display */
    .date-display {
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .date-relative {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: 0.2rem;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        color: var(--text-secondary);
    }
    
    .empty-state i {
        font-size: 6rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
        opacity: 0.6;
        animation: float 3s ease-in-out infinite;
    }
    
    .empty-state h3 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .empty-state p {
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }
    
    /* Alerts */
    .alert {
        padding: 1.25rem 2rem;
        border-radius: 18px;
        margin-bottom: 2rem;
        border: none;
        font-weight: 600;
        backdrop-filter: blur(15px);
        animation: slideInDown 0.6s var(--timing-bounce);
        position: relative;
        overflow: hidden;
    }
    
    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: 18px 18px 0 0;
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
    .dark-mode .alert-success {
        background: rgba(34, 197, 94, 0.2);
        color: #34d399;
        border-color: rgba(34, 197, 94, 0.4);
    }
    
    [data-theme="dark"] .alert-danger,
    [data-bs-theme="dark"] .alert-danger,
    .dark-mode .alert-danger {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.4);
    }
    
    /* Search Filter */
    .search-filter-section {
        background: var(--gradient-card);
        backdrop-filter: blur(25px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-soft);
    }
    
    .search-input {
        width: 100%;
        padding: 14px 20px 14px 50px;
        border-radius: 16px;
        border: 2px solid var(--glass-border);
        background: var(--search-bg);
        backdrop-filter: blur(10px);
        color: var(--text-primary);
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s var(--timing-smooth);
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        background: var(--search-focus-bg);
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.2);
    }
    
    .search-input::placeholder {
        color: var(--text-muted);
    }
    
    .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary);
        font-size: 1.2rem;
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
    
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.8);
        }
        60% {
            opacity: 0.8;
            transform: translateY(-8px) scale(1.1);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(2deg); }
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
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        .premium-table-container {
            border-radius: 16px;
            overflow-x: auto;
        }
        
        .premium-table thead th,
        .premium-table tbody td {
            padding: 1rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .btn-action {
            font-size: 0.8rem;
            padding: 10px 14px;
        }
        
        .user-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .user-avatar {
            margin-right: 0;
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }
        
        .question-preview {
            max-width: 200px;
        }
    }
    
    /* Performance Optimizations */
    .premium-card,
    .stat-card,
    .btn-action,
    .premium-btn,
    .user-avatar {
        contain: layout style paint;
    }
    
    .hero-section::before,
    .hero-section::after,
    .premium-card::after {
        will-change: auto;
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
                    <i class="bi bi-chat-square-text-fill me-3" style="color: rgba(255,255,255,0.95);"></i>
                    Kelola Pertanyaan Premium
                </h1>
                <p class="subtitle">Dashboard administratif untuk mengelola pertanyaan kesehatan dengan performa tinggi dan fitur lengkap</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('admin.index') }}" class="premium-btn">
                        <i class="bi bi-arrow-left"></i>Kembali ke Dashboard
                    </a>
                    <a href="{{ route('admin.questions.create') }}" class="premium-btn">
                        <i class="bi bi-plus-circle-fill"></i>Tambah Pertanyaan Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Premium Alerts --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        </div>
    @endif

    {{-- Advanced Statistics --}}
    @if($questions && $questions->count() > 0)
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-icon questions">
                    <i class="bi bi-chat-square-text"></i>
                </div>
                <div class="stat-number">{{ $questions->count() }}</div>
                <div class="stat-label">Total Pertanyaan</div>
            </div>
            
            <div class="stat-card fade-in">
                <div class="stat-icon answered">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-number">
                    @php
                        $answeredCount = 0;
                        foreach($questions as $question) {
                            if (
                                (isset($question->answers) && count($question->answers) > 0) || 
                                (isset($question->answer) && $question->answer) || 
                                (isset($question->answered) && $question->answered) ||
                                (isset($question->status) && $question->status === 'answered') ||
                                (isset($question->answer_count) && $question->answer_count > 0)
                            ) {
                                $answeredCount++;
                            }
                        }
                        echo $answeredCount;
                    @endphp
                </div>
                <div class="stat-label">Terjawab</div>
            </div>
            
            <div class="stat-card fade-in">
                <div class="stat-icon pending">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-number">{{ $questions->count() - $answeredCount }}</div>
                <div class="stat-label">Menunggu</div>
            </div>
            
            <div class="stat-card fade-in">
                <div class="stat-icon total">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="stat-number">
                    @php
                        $totalViews = 0;
                        foreach($questions as $question) {
                            $totalViews += $question->views_count ?? 0;
                        }
                        echo $totalViews;
                    @endphp
                </div>
                <div class="stat-label">Total Views</div>
            </div>
        </div>
    @endif

    {{-- Search Section --}}
    <div class="search-filter-section">
        <div class="position-relative">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Cari pertanyaan berdasarkan judul, pengirim, atau status...">
        </div>
    </div>

    {{-- Premium Questions Table --}}
    <div class="premium-card">
        @if($questions && $questions->count() > 0)
            <div class="premium-table-container">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th><i class="bi bi-person me-2"></i>Pengirim</th>
                            <th><i class="bi bi-chat-square-text me-2"></i>Pertanyaan</th>
                            <th><i class="bi bi-shield me-2"></i>Status</th>
                            <th><i class="bi bi-calendar me-2"></i>Tanggal</th>
                            <th><i class="bi bi-gear me-2"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            @php
                                // Determine question status
                                $isAnswered = false;
                                if (
                                    (isset($question->answers) && count($question->answers) > 0) || 
                                    (isset($question->answer) && $question->answer) || 
                                    (isset($question->answered) && $question->answered) ||
                                    (isset($question->status) && $question->status === 'answered') ||
                                    (isset($question->answer_count) && $question->answer_count > 0)
                                ) {
                                    $isAnswered = true;
                                }
                                
                                // Get user initial
                                $initial = 'A';
                                if (isset($question->user) && isset($question->user->name)) {
                                    $initial = strtoupper(substr($question->user->name, 0, 1));
                                }
                                
                                // Get username
                                $username = 'Anonim';
                                if (isset($question->user) && isset($question->user->name)) {
                                    $username = $question->user->name;
                                }
                                
                                // Get user email
                                $email = 'email@example.com';
                                if (isset($question->user) && isset($question->user->email)) {
                                    $email = $question->user->email;
                                }
                            @endphp
                        <tr class="question-row">
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ $initial }}
                                    </div>
                                    <div class="user-details">
                                        <h6>{{ $username }}</h6>
                                        <p class="user-email">{{ $email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="question-preview">
                                    {{ $question->question }}
                                </div>
                            </td>
                            <td>
                                <span class="status-badge {{ $isAnswered ? 'status-answered' : 'status-pending' }}">
                                    @if($isAnswered)
                                        <i class="bi bi-check-circle-fill"></i>
                                        Terjawab
                                    @else
                                        <i class="bi bi-clock-fill"></i>
                                        Menunggu
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="date-display">
                                    {{ $question->created_at->format('d M Y') }}
                                </div>
                                <div class="date-relative">
                                    {{ $question->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Form untuk menghapus pertanyaan -->
                                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Hapus Pertanyaan">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if(method_exists($questions, 'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $questions->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="bi bi-chat-square-text"></i>
                <h3>Belum Ada Pertanyaan</h3>
                <p>Belum ada pertanyaan yang diajukan dalam sistem. Tunggu sampai pengguna mulai mengajukan pertanyaan kesehatan.</p>
                <a href="{{ route('admin.questions.create') }}" class="premium-btn">
                    <i class="bi bi-plus-circle-fill"></i>Tambah Pertanyaan Pertama
                </a>
            </div>
        @endif
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
            
        console.log('Questions page theme detected:', isDark ? 'dark' : 'light');
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
                    console.log('Questions page theme change detected via:', attributeName);
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
            console.log('Questions page theme change detected via localStorage');
            detectThemeChange();
        }
    });
    
    // Listen for custom events (if navbar dispatches them)
    window.addEventListener('themeChanged', function(e) {
        console.log('Questions page theme change detected via custom event');
        detectThemeChange();
    });
    
    // Initial theme detection
    detectThemeChange();
    
    // Optimized loading performance
    const tableRows = document.querySelectorAll('.premium-table tbody tr');
    
    // Staggered animation for table rows
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            row.style.transition = 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);
    });
    
    // Enhanced search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                const searchTerm = this.value.toLowerCase().trim();
                
                tableRows.forEach((row, index) => {
                    const username = row.querySelector('.user-details h6').innerText.toLowerCase();
                    const email = row.querySelector('.user-email').innerText.toLowerCase();
                    const questionText = row.querySelector('.question-preview').innerText.toLowerCase();
                    const status = row.querySelector('.status-badge').innerText.toLowerCase();
                    
                    const matches = username.includes(searchTerm) || 
                                  email.includes(searchTerm) || 
                                  questionText.includes(searchTerm) || 
                                  status.includes(searchTerm);
                    
                    if (searchTerm === '' || matches) {
                        row.style.display = 'table-row';
                        setTimeout(() => {
                            row.style.opacity = '1';
                            row.style.transform = 'translateY(0)';
                        }, index * 20);
                    } else {
                        row.style.opacity = '0';
                        row.style.transform = 'translateY(-10px)';
                        setTimeout(() => {
                            row.style.display = 'none';
                        }, 200);
                    }
                });
            }, 300);
        });
    }
    
    // Enhanced hover effects for action buttons
    const actionButtons = document.querySelectorAll('.btn-action');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px) scale(1.1)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Confirmation dialog for delete buttons
    const deleteButtons = document.querySelectorAll('.btn-action.delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const form = this.closest('form');
            const questionPreview = this.closest('tr').querySelector('.question-preview').innerText;
            const truncatedQuestion = questionPreview.length > 80 ? 
                questionPreview.substring(0, 80) + '...' : questionPreview;
            
            const confirmed = confirm(`Yakin ingin menghapus pertanyaan ini?\n\n"${truncatedQuestion}"\n\nTindakan ini tidak dapat dibatalkan.`);
            
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });
    
    // Status badge hover effects
    const statusBadges = document.querySelectorAll('.status-badge');
    statusBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.05)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + F to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
        
        // Escape to clear search
        if (e.key === 'Escape' && searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
        }
    });
    
    // Performance monitoring
    if (window.performance && window.performance.mark) {
        window.performance.mark('questions-admin-loaded');
    }
    
    console.log('Admin Questions page loaded with enhanced theme support');
});
</script>
@endsection