{{-- SHOW USER PAGE --}}
@extends('layouts.app')

@section('title', 'Detail Pengguna - Qhealth')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
    
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --success: #22c55e;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 16px 32px rgba(0, 0, 0, 0.12);
        --glow: 0 0 20px rgba(16, 185, 129, 0.3);
    }
    
    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        box-sizing: border-box;
    }
    
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
    }
    
    .premium-container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
        margin: 2rem auto;
        max-width: 800px;
    }
    
    .premium-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
        border-radius: 24px 24px 0 0;
    }
    
    .page-title {
        font-size: 2.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-align: center;
        margin-bottom: 2rem;
        letter-spacing: -0.02em;
        animation: fadeInDown 0.8s ease-out;
    }
    
    .user-profile-section {
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .user-profile-section:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg), var(--glow);
    }
    
    .user-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 12px 24px rgba(16, 185, 129, 0.3);
        animation: pulse 2s infinite;
    }
    
    .user-info-item {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 1.2rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .user-info-item:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateX(8px);
    }
    
    .info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    
    .info-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        letter-spacing: -0.01em;
    }
    
    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: capitalize;
    }
    
    .role-admin {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    .role-doctor {
        background: rgba(16, 185, 129, 0.15);
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .role-user {
        background: rgba(59, 130, 246, 0.15);
        color: #1d4ed8;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }
    
    .premium-btn {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        font-size: 0.95rem;
        cursor: pointer;
        z-index: 10;
    }
    
    .premium-btn.warning {
        background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%);
    }
    
    .premium-btn.danger {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
    }
    
    .premium-btn.secondary {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    }
    
    .premium-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
        pointer-events: none;
    }
    
    .premium-btn:hover {
        transform: translateY(-2px) scale(1.03);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }
    
    .premium-btn:hover::before {
        left: 100%;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }
    
    .back-btn {
        position: absolute;
        top: 2rem;
        left: 2rem;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 10px 16px;
        color: #6b7280;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        z-index: 10;
    }
    
    .back-btn:hover {
        background: rgba(255, 255, 255, 0.95);
        color: var(--primary);
        transform: translateX(-4px);
        text-decoration: none;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
        letter-spacing: -0.01em;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px 12px;
        padding-right: 40px;
    }
    
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border: none;
        font-weight: 500;
    }
    
    .alert-success {
        background: rgba(34, 197, 94, 0.15);
        color: #047857;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }
    
    .alert-danger {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    @media (max-width: 768px) {
        .premium-container {
            margin: 1rem;
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .back-btn {
            position: static;
            margin-bottom: 1rem;
            align-self: flex-start;
        }
    }
</style>

<div class="container-fluid py-4">
    <a href="{{ route('admin.users.index') }}" class="back-btn">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
    
    <div class="premium-container">
        <h1 class="page-title">
            <i class="bi bi-person-circle me-3" style="color: var(--primary);"></i>
            Detail Pengguna
        </h1>

        <div class="user-profile-section">
            <div class="user-avatar">
                <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
            </div>
            
            <div class="text-center mb-4">
                <h2 style="color: #1f2937; font-weight: 800; margin-bottom: 0.5rem;">{{ $user->name }}</h2>
                <div class="role-badge role-{{ $user->role }}">
                    <i class="bi bi-shield-check"></i>
                    {{ ucfirst($user->role) }}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="user-info-item">
                        <div class="info-label">
                            <i class="bi bi-envelope me-2"></i>Email Address
                        </div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="user-info-item">
                        <div class="info-label">
                            <i class="bi bi-calendar me-2"></i>Bergabung Sejak
                        </div>
                        <div class="info-value">{{ $user->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="user-info-item">
                        <div class="info-label">
                            <i class="bi bi-clock me-2"></i>Terakhir Update
                        </div>
                        <div class="info-value">{{ $user->updated_at->format('d M Y H:i') }}</div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="user-info-item">
                        <div class="info-label">
                            <i class="bi bi-hash me-2"></i>User ID
                        </div>
                        <div class="info-value">#{{ $user->id }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="premium-btn warning">
                <i class="bi bi-pencil-fill"></i>Edit Pengguna
            </a>
            
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="premium-btn danger">
                    <i class="bi bi-trash-fill"></i>Hapus Pengguna
                </button>
            </form>
            
            <a href="{{ route('admin.users.index') }}" class="premium-btn secondary">
                <i class="bi bi-list-ul"></i>Lihat Semua Pengguna
            </a>
        </div>
    </div>
</div