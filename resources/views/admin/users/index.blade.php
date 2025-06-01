{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Pengguna - Qhealth')

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
        --table-row-hover: rgba(16, 185, 129, 0.08);
        --table-border: rgba(255, 255, 255, 0.1);
        --search-bg: rgba(255, 255, 255, 0.8);
        --search-focus-bg: rgba(255, 255, 255, 0.95);
    }
    
    /* Dark Mode Colors - Multiple selectors for maximum compatibility */
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
    
    /* Secondary button style */
    .premium-btn.secondary {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
    }
    
    .premium-btn.secondary:hover {
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4), 0 0 40px rgba(99, 102, 241, 0.25);
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
    
    .stat-icon.users {
        background: linear-gradient(135deg, var(--info) 0%, #1d4ed8 100%);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
    }
    
    .stat-icon.admins {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
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
    
    /* Role Badges */
    .role-badge {
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
    
    .role-badge::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.3) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s var(--timing-smooth);
        pointer-events: none;
    }
    
    .role-badge:hover::before {
        transform: translateX(100%);
    }
    
    .role-admin {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        border: 2px solid rgba(239, 68, 68, 0.3);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
    }
    
    .role-user {
        background: rgba(59, 130, 246, 0.15);
        color: #1d4ed8;
        border: 2px solid rgba(59, 130, 246, 0.3);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    }
    
    /* Dark mode role badge colors - Multiple selectors for compatibility */
    [data-theme="dark"] .role-admin,
    [data-bs-theme="dark"] .role-admin,
    .dark-mode .role-admin,
    body.dark-mode .role-admin,
    html.dark-mode .role-admin,
    html[data-theme="dark"] .role-admin,
    body[data-theme="dark"] .role-admin,
    html[data-bs-theme="dark"] .role-admin,
    body[data-bs-theme="dark"] .role-admin {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.4);
    }
    
    [data-theme="dark"] .role-user,
    [data-bs-theme="dark"] .role-user,
    .dark-mode .role-user,
    body.dark-mode .role-user,
    html.dark-mode .role-user,
    html[data-theme="dark"] .role-user,
    body[data-theme="dark"] .role-user,
    html[data-bs-theme="dark"] .role-user,
    body[data-bs-theme="dark"] .role-user {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
        border-color: rgba(59, 130, 246, 0.4);
    }
    
    .role-badge:hover {
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
    
    /* Dark mode alert colors - Multiple selectors for compatibility */
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
    
    /* Button Group */
    .button-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
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
            grid-template-columns: 1fr;
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
        
        .button-group {
            flex-direction: column;
            align-items: center;
        }
        
        .premium-btn {
            width: 100%;
            max-width: 280px;
            justify-content: center;
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
                    <i class="bi bi-people-fill me-3" style="color: rgba(255,255,255,0.95);"></i>
                    Kelola Pengguna Premium
                </h1>
                <p class="subtitle">Dashboard administratif untuk mengelola pengguna sistem kesehatan Qhealth dengan performa tinggi</p>
                <div class="button-group">
                    <a href="{{ route('admin.index') }}" class="premium-btn">
                        <i class="bi bi-arrow-left"></i>Kembali ke Dashboard
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="premium-btn secondary">
                        <i class="bi bi-person-plus-fill"></i>Tambah Pengguna Baru
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
    @if($users->count() > 0)
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-icon users">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number">{{ $users->where('role', 'user')->count() }}</div>
                <div class="stat-label">Regular Users</div>
            </div>
            
            <div class="stat-card fade-in">
                <div class="stat-icon admins">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="stat-number">{{ $users->where('role', 'admin')->count() }}</div>
                <div class="stat-label">Administrators</div>
            </div>
            
            <div class="stat-card fade-in">
                <div class="stat-icon total">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="stat-number">{{ $users->count() }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
    @endif

    {{-- Search Section --}}
    <div class="search-filter-section">
        <div class="position-relative">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Cari pengguna berdasarkan nama, email, atau role...">
        </div>
    </div>

    {{-- Premium Users Table --}}
    <div class="premium-card">
        @if($users->count() > 0)
            <div class="premium-table-container">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th><i class="bi bi-person me-2"></i>Pengguna</th>
                            <th><i class="bi bi-shield me-2"></i>Role</th>
                            <th><i class="bi bi-calendar me-2"></i>Bergabung</th>
                            <th><i class="bi bi-gear me-2"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="user-row">
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="user-details">
                                        <h6>{{ $user->name }}</h6>
                                        <p class="user-email">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="role-badge role-{{ $user->role }}">
                                    @if($user->role === 'admin')
                                        <i class="bi bi-shield-fill-check"></i>
                                        Admin
                                    @else
                                        <i class="bi bi-person-fill"></i>
                                        User
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="date-display">
                                    {{ $user->created_at->format('d M Y') }}
                                </div>
                                <div class="date-relative">
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn-action view" title="Lihat Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action edit" title="Edit Pengguna">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus pengguna {{ $user->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Hapus Pengguna">
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
            @if(method_exists($users, 'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="bi bi-people"></i>
                <h3>Belum Ada Pengguna</h3>
                <p>Mulai dengan menambahkan pengguna pertama untuk sistem Qhealth dan rasakan pengalaman manajemen yang premium dengan performa tinggi.</p>
                <a href="{{ route('admin.users.create') }}" class="premium-btn">
                    <i class="bi bi-person-plus-fill"></i>Tambah Pengguna Pertama
                </a>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Users admin page loaded - initializing theme system integration');
    
    // Enhanced theme detection that works with Bootstrap theme switcher
    function detectAndApplyTheme() {
        const html = document.documentElement;
        const body = document.body;
        
        // Log all theme-related attributes for debugging
        console.log('Theme Detection Debug:');
        console.log('- html[data-bs-theme]:', html.getAttribute('data-bs-theme'));
        console.log('- body[data-bs-theme]:', body.getAttribute('data-bs-theme'));
        console.log('- html[data-theme]:', html.getAttribute('data-theme'));
        console.log('- body[data-theme]:', body.getAttribute('data-theme'));
        console.log('- localStorage.theme:', localStorage.getItem('theme'));
        console.log('- localStorage.bs-theme:', localStorage.getItem('bs-theme'));
        console.log('- html.classList:', Array.from(html.classList));
        console.log('- body.classList:', Array.from(body.classList));
        
        // Check Bootstrap data-bs-theme attribute (most reliable for Bootstrap 5.3+)
        const bsTheme = html.getAttribute('data-bs-theme') || body.getAttribute('data-bs-theme');
        
        if (bsTheme === 'dark') {
            console.log('✅ Dark theme detected via data-bs-theme');
            // Force apply dark theme classes
            html.setAttribute('data-theme', 'dark');
            body.setAttribute('data-theme', 'dark');
            return 'dark';
        } else if (bsTheme === 'light') {
            console.log('✅ Light theme detected via data-bs-theme');
            // Force apply light theme classes
            html.setAttribute('data-theme', 'light');
            body.setAttribute('data-theme', 'light');
            return 'light';
        }
        
        // Fallback checks for other theme implementations
        const legacyChecks = [
            html.getAttribute('data-theme'),
            body.getAttribute('data-theme'),
            localStorage.getItem('theme'),
            localStorage.getItem('bs-theme')
        ];
        
        for (const check of legacyChecks) {
            if (check === 'dark') {
                console.log('✅ Dark theme detected via fallback method:', check);
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
    
    // Create a comprehensive observer for all possible theme change mechanisms
    const createThemeObserver = () => {
        const callback = (mutations) => {
            let themeChanged = false;
            
            mutations.forEach((mutation) => {
                if (mutation.type === 'attributes') {
                    const attr = mutation.attributeName;
                    const target = mutation.target;
                    const newValue = target.getAttribute(attr);
                    
                    console.log(`🔄 Attribute changed: ${attr} on ${target.tagName} to "${newValue}"`);
                    
                    if (['data-bs-theme', 'data-theme', 'class'].includes(attr)) {
                        themeChanged = true;
                        console.log(`🎨 Theme-related change detected: ${attr} = "${newValue}"`);
                    }
                }
            });
            
            if (themeChanged) {
                console.log('🔄 Processing theme change...');
                const newTheme = detectAndApplyTheme();
                console.log('🎨 Theme change completed, new theme:', newTheme);
                
                // Force CSS re-evaluation by triggering a reflow
                document.body.offsetHeight;
                
                // Dispatch custom event for other components
                window.dispatchEvent(new CustomEvent('userPageThemeChanged', { 
                    detail: { theme: newTheme } 
                }));
            }
        };
        
        const observer = new MutationObserver(callback);
        
        // Observe both html and body elements with detailed logging
        console.log('🔍 Setting up theme observers...');
        
        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['data-bs-theme', 'data-theme', 'class']
        });
        
        observer.observe(document.body, {
            attributes: true,
            attributeFilter: ['data-bs-theme', 'data-theme', 'class']
        });
        
        console.log('✅ Theme observers initialized');
        return observer;
    };
    
    // Start theme monitoring
    const observer = createThemeObserver();
    
    // Initial theme detection with comprehensive fallbacks
    console.log('🚀 Starting initial theme detection...');
    const initialTheme = detectAndApplyTheme();
    console.log('🎨 Initial theme set to:', initialTheme);
    
    // Periodic theme check as fallback (every 2 seconds)
    setInterval(() => {
        const currentTheme = detectAndApplyTheme();
        // Only log if theme actually changed to avoid spam
        if (window.lastDetectedTheme !== currentTheme) {
            console.log('🔄 Periodic theme check - theme changed to:', currentTheme);
            window.lastDetectedTheme = currentTheme;
        }
    }, 2000);
    
    // Manual theme testing functions for debugging
    window.testDarkMode = function() {
        console.log('🧪 Testing dark mode...');
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        detectAndApplyTheme();
    };
    
    window.testLightMode = function() {
        console.log('🧪 Testing light mode...');
        document.documentElement.setAttribute('data-bs-theme', 'light');
        detectAndApplyTheme();
    };
    
    // Add visual indicator for current theme
    const addThemeIndicator = () => {
        const indicator = document.createElement('div');
        indicator.id = 'theme-indicator';
        indicator.style.cssText = `
            position: fixed;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            z-index: 9999;
            pointer-events: none;
        `;
        indicator.textContent = `Theme: ${initialTheme}`;
        document.body.appendChild(indicator);
        
        // Update indicator when theme changes
        window.addEventListener('userPageThemeChanged', (e) => {
            indicator.textContent = `Theme: ${e.detail.theme}`;
            indicator.style.background = e.detail.theme === 'dark' ? 
                'rgba(255,255,255,0.8)' : 'rgba(0,0,0,0.8)';
            indicator.style.color = e.detail.theme === 'dark' ? 'black' : 'white';
        });
        
        // Remove indicator after 10 seconds
        setTimeout(() => {
            indicator?.remove();
        }, 10000);
    };
    
    // Add theme indicator for debugging
    addThemeIndicator();
    
    // Listen for storage events (for cross-tab theme sync)
    window.addEventListener('storage', function(e) {
        if (['theme', 'bs-theme'].includes(e.key)) {
            console.log('Theme change detected via localStorage');
            detectAndApplyTheme();
        }
    });
    
    // Listen for custom theme events with more comprehensive coverage
    const themeEvents = [
        'themeChanged', 
        'themeToggle', 
        'bsThemeChange',
        'darkModeToggle',
        'lightModeToggle',
        'theme-change',
        'bs:theme:change'
    ];
    
    themeEvents.forEach(eventType => {
        window.addEventListener(eventType, function(e) {
            console.log(`🎨 Theme change detected via ${eventType} event:`, e.detail);
            setTimeout(() => {
                const newTheme = detectAndApplyTheme();
                console.log(`✅ Theme applied from ${eventType}:`, newTheme);
            }, 50); // Small delay to ensure DOM is updated
        });
        
        document.addEventListener(eventType, function(e) {
            console.log(`🎨 Theme change detected via document ${eventType} event:`, e.detail);
            setTimeout(() => {
                const newTheme = detectAndApplyTheme();
                console.log(`✅ Theme applied from document ${eventType}:`, newTheme);
            }, 50);
        });
    });
    
    // Listen for Bootstrap's built-in theme events if they exist
    if (window.bootstrap) {
        console.log('📦 Bootstrap detected, listening for theme events');
        document.addEventListener('DOMContentLoaded', () => {
            // Check if Bootstrap has theme utilities
            if (window.bootstrap.Tooltip) {
                console.log('🎨 Bootstrap theme utilities available');
            }
        });
    }
    
    // Enhanced loading animations
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
                    const username = row.querySelector('.user-details h6')?.innerText.toLowerCase() || '';
                    const email = row.querySelector('.user-email')?.innerText.toLowerCase() || '';
                    const role = row.querySelector('.role-badge')?.innerText.toLowerCase() || '';
                    
                    const matches = username.includes(searchTerm) || 
                                  email.includes(searchTerm) || 
                                  role.includes(searchTerm);
                    
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
    
    // Enhanced delete confirmation
    const deleteButtons = document.querySelectorAll('.btn-action.delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const form = this.closest('form');
            const username = this.closest('tr')?.querySelector('.user-details h6')?.innerText || 'pengguna ini';
            const userEmail = this.closest('tr')?.querySelector('.user-email')?.innerText || '';
            
            const confirmed = confirm(`Yakin ingin menghapus pengguna "${username}"?\n\nEmail: ${userEmail}\n\nTindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait pengguna.`);
            
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });
    
    // Role badge hover effects
    const roleBadges = document.querySelectorAll('.role-badge');
    roleBadges.forEach(badge => {
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
        if ((e.ctrlKey || e.metaKey) && e.key === 'f' && searchInput) {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }
        
        // Escape to clear search
        if (e.key === 'Escape' && searchInput && document.activeElement === searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
        }
    });
    
    // Enhanced button interactions with ripple effect
    const premiumButtons = document.querySelectorAll('.premium-btn');
    premiumButtons.forEach(button => {
        // Add ripple effect on click
        button.addEventListener('click', function(e) {
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
    
    // User avatar interactions
    const userAvatars = document.querySelectorAll('.user-avatar');
    userAvatars.forEach(avatar => {
        avatar.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotateZ(5deg)';
        });
        
        avatar.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotateZ(0deg)';
        });
    });
    
    // Statistics animation on scroll
    const statNumbers = document.querySelectorAll('.stat-number');
    const observerOptions = {
        threshold: 0.7,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const finalNumber = parseInt(entry.target.textContent);
                animateNumber(entry.target, 0, finalNumber, 1500);
                statObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    statNumbers.forEach(stat => {
        statObserver.observe(stat);
    });
    
    function animateNumber(element, start, end, duration) {
        const startTime = performance.now();
        const range = end - start;
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function for smooth animation
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(start + (range * easeProgress));
            
            element.textContent = current;
            
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        
        requestAnimationFrame(update);
    }
    
    // Performance monitoring
    if (window.performance?.mark) {
        window.performance.mark('users-admin-enhanced-loaded');
        
        // Log loading performance
        setTimeout(() => {
            const perfData = performance.getEntriesByName('users-admin-enhanced-loaded');
            if (perfData.length > 0) {
                console.log('Users admin page loaded in:', perfData[0].startTime, 'ms');
            }
        }, 100);
    }
    
    console.log('Enhanced Users admin page with theme integration loaded successfully');
});
</script>
@endsection