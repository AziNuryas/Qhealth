{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QHealth Admin - @yield('title', 'Dashboard Administratif')</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  
  <!-- Optimized Admin Styles -->
  <style>
    /* 🎨 Essential Variables Only */
    :root {
      --admin-primary: #10b981;
      --admin-primary-hover: #059669;
      --admin-primary-light: rgba(16, 185, 129, 0.1);
      --admin-bg: #fafbfc;
      --admin-card-bg: #ffffff;
      --admin-text: #1a1d29;
      --admin-text-muted: #6b7280;
      --admin-border: rgba(0, 0, 0, 0.06);
      --admin-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    [data-bs-theme="dark"] {
      --admin-bg: #0f172a;
      --admin-card-bg: #1e293b;
      --admin-text: #f1f5f9;
      --admin-text-muted: #cbd5e1;
      --admin-border: rgba(255, 255, 255, 0.06);
      --admin-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
      --admin-primary: #34d399;
      --admin-primary-hover: #10b981;
    }

    /* 🌟 Base Styles - Simplified */
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--admin-bg);
      color: var(--admin-text);
    }

    /* 🎯 Navbar - Lightweight */
    .admin-navbar {
      background: var(--admin-card-bg) !important;
      border-bottom: 1px solid var(--admin-border);
      box-shadow: var(--admin-shadow);
    }

    .admin-brand {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
      font-weight: 600;
      color: var(--admin-text) !important;
    }

    .admin-brand:hover {
      color: var(--admin-primary) !important;
    }

    .brand-logo {
      width: 32px;
      height: 32px;
      background: var(--admin-primary);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .brand-logo i {
      color: white;
      font-size: 1rem;
    }

    /* 🔗 Navigation - Clean */
    .admin-nav-link {
      color: var(--admin-text-muted) !important;
      font-weight: 500;
      padding: 0.5rem 1rem !important;
      border-radius: 6px;
      text-decoration: none;
    }

    .admin-nav-link:hover {
      color: var(--admin-primary) !important;
      background: var(--admin-primary-light);
    }

    /* 🎛️ Dropdown - Minimal */
    .admin-dropdown-menu {
      background: var(--admin-card-bg);
      border: 1px solid var(--admin-border);
      border-radius: 8px;
      box-shadow: var(--admin-shadow);
      min-width: 180px;
    }

    .admin-dropdown-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 1rem;
      color: var(--admin-text) !important;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .admin-dropdown-item:hover {
      background: var(--admin-primary-light);
      color: var(--admin-primary) !important;
    }

    .admin-dropdown-item i {
      width: 16px;
      color: var(--admin-text-muted);
    }

    .admin-dropdown-item:hover i {
      color: var(--admin-primary);
    }

    /* 🔘 Theme Toggle */
    .theme-toggle {
      width: 32px;
      height: 32px;
      background: var(--admin-card-bg);
      border: 1px solid var(--admin-border);
      border-radius: 6px;
      color: var(--admin-text-muted);
      cursor: pointer;
    }

    .theme-toggle:hover {
      color: var(--admin-primary);
      border-color: var(--admin-primary);
    }

    /* 👤 User Menu */
    .user-avatar {
      width: 32px;
      height: 32px;
      border-radius: 6px;
      border: 1px solid var(--admin-border);
    }

    .user-info {
      color: var(--admin-text);
      text-decoration: none;
      font-size: 0.9rem;
    }

    .user-info:hover {
      color: var(--admin-primary);
    }

    /* 🎨 Buttons - Essential Only */
    .admin-btn {
      padding: 0.5rem 1rem;
      border-radius: 6px;
      font-weight: 500;
      font-size: 0.9rem;
      border: none;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .admin-btn-primary {
      background: var(--admin-primary);
      color: white;
    }

    .admin-btn-primary:hover {
      background: var(--admin-primary-hover);
      color: white;
    }

    .admin-btn-outline {
      background: transparent;
      color: var(--admin-text);
      border: 1px solid var(--admin-border);
    }

    .admin-btn-outline:hover {
      background: var(--admin-primary-light);
      border-color: var(--admin-primary);
      color: var(--admin-primary);
    }

    /* 📱 Cards - Simplified */
    .admin-card {
      background: var(--admin-card-bg);
      border: 1px solid var(--admin-border);
      border-radius: 8px;
      box-shadow: var(--admin-shadow);
    }

    /* 📊 Minimal Section Titles */
    .admin-section-title {
      font-weight: 600;
      font-size: 1.5rem;
      color: var(--admin-text);
      margin-bottom: 1rem;
    }

    /* 🦶 Footer */
    .admin-footer {
      background: var(--admin-card-bg);
      border-top: 1px solid var(--admin-border);
      padding: 2rem 0;
      margin-top: 2rem;
      text-align: center;
    }

    /* 📝 Form Controls - Don't Override Bootstrap */
    .admin-form-control {
      background: var(--admin-card-bg);
      border: 1px solid var(--admin-border);
      color: var(--admin-text);
    }

    .admin-form-control:focus {
      border-color: var(--admin-primary);
      box-shadow: 0 0 0 0.2rem var(--admin-primary-light);
    }

    /* 📱 Responsive */
    @media (max-width: 768px) {
      .admin-brand {
        font-size: 0.9rem;
      }
      
      .brand-logo {
        width: 28px;
        height: 28px;
      }
      
      .theme-toggle, .user-avatar {
        width: 28px;
        height: 28px;
      }
    }

    /* 🚫 Prevent Conflicts with Management Pages */
    .admin-layout-content {
      /* Isolate admin styles */
      --bs-body-bg: var(--admin-bg);
      --bs-body-color: var(--admin-text);
    }

    /* Don't override table styles */
    .admin-layout-content table {
      background: var(--admin-card-bg);
      color: var(--admin-text);
    }

    .admin-layout-content .table th,
    .admin-layout-content .table td {
      border-color: var(--admin-border);
    }

    /* Don't override form styles in content area */
    .admin-layout-content .form-control,
    .admin-layout-content .form-select {
      background: var(--admin-card-bg);
      border-color: var(--admin-border);
      color: var(--admin-text);
    }
  </style>
</head>

<body>
  <!-- 🎯 Lightweight Navbar -->
  <nav class="navbar navbar-expand-lg admin-navbar sticky-top">
    <div class="container-fluid">
      
      {{-- 🔙 Back Button --}}
      @if(!request()->is('admin') && !request()->is('admin/dashboard'))
        <a href="{{ route('admin.index') }}" class="admin-btn admin-btn-outline me-3">
          <i class="bi bi-arrow-left"></i>
          <span class="d-none d-md-inline">Dashboard</span>
        </a>
      @endif

      {{-- 📂 Admin Menu --}}
      @if (request()->is('admin*'))
        <div class="dropdown me-3">
          <a class="admin-nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-grid-3x3-gap me-1"></i>
            <span class="d-none d-lg-inline">Menu</span>
          </a>
          <ul class="dropdown-menu admin-dropdown-menu">
            <li>
              <a class="admin-dropdown-item" href="{{ route('admin.index') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a class="admin-dropdown-item" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i>
                <span>Kelola Pengguna</span>
              </a>
            </li>
            <li>
              <a class="admin-dropdown-item" href="#">
                <i class="bi bi-chat-dots"></i>
                <span>Pertanyaan</span>
              </a>
            </li>
            <li>
              <a class="admin-dropdown-item" href="#">
                <i class="bi bi-bar-chart"></i>
                <span>Statistik</span>
              </a>
            </li>
            <li>
              <a class="admin-dropdown-item" href="#">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
              </a>
            </li>
          </ul>
        </div>
      @endif

      {{-- 🏷️ Simple Logo --}}
      <a class="admin-brand me-auto" href="{{ route('admin.index') }}">
        <div class="brand-logo">
          <i class="bi bi-shield-check"></i>
        </div>
        <div>QHealth Admin</div>
      </a>

      {{-- ☰ Mobile Toggle --}}
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" style="border: none;">
        <i class="bi bi-list"></i>
      </button>
      
      <div class="collapse navbar-collapse justify-content-end" id="adminNavbar">
        <ul class="navbar-nav align-items-center">
          
          <!-- 🌗 Theme Toggle -->
          <li class="nav-item me-3">
            <button id="themeToggle" class="theme-toggle">
              <i class="bi bi-moon-fill" id="themeIcon"></i>
            </button>
          </li>
          
          <!-- 👤 User Profile -->
          <li class="nav-item">
            @auth
              <div class="dropdown">
                <a href="#" class="user-info d-flex align-items-center gap-2 dropdown-toggle" data-bs-toggle="dropdown">
                  <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=10b981&color=fff" 
                       class="user-avatar" alt="Admin">
                  <div class="d-none d-md-block">
                    <div style="font-weight: 500;">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div style="font-size: 0.75rem; color: var(--admin-text-muted);">Administrator</div>
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end admin-dropdown-menu">
                  <li>
                    <a class="admin-dropdown-item" href="{{ route('profile.show') }}">
                      <i class="bi bi-person-gear"></i>
                      <span>Profil Admin</span>
                    </a>
                  </li>
                  <li>
                    <a class="admin-dropdown-item" href="{{ route('dashboard') }}">
                      <i class="bi bi-house"></i>
                      <span>User Dashboard</span>
                    </a>
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <a href="{{ route('logout') }}" class="admin-dropdown-item text-danger"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="bi bi-box-arrow-right text-danger"></i>
                      <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </li>
                </ul>
              </div>
            @else
              <a href="{{ route('login') }}" class="admin-btn admin-btn-primary">
                <i class="bi bi-shield-lock"></i>
                Login Admin
              </a>
            @endauth
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🧩 Main Content - Isolated Styles -->
  <main class="py-3 admin-layout-content">
    @yield('content')
  </main>

  <!-- 🦶 Simple Footer -->
  <footer class="admin-footer">
    <div class="container">
      <div style="font-weight: 600; color: var(--admin-primary); margin-bottom: 0.5rem;">
        <i class="bi bi-shield-check me-2"></i>QHealth Admin Panel
      </div>
      <p class="mb-0 small text-muted">
        &copy; 2025 QHealth Administrative System. Semua hak dilindungi.
      </p>
    </div>
  </footer>

  <!-- 🔧 Minimal Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Simple Theme Toggle
    document.addEventListener('DOMContentLoaded', function() {
      const themeToggle = document.getElementById('themeToggle');
      const themeIcon = document.getElementById('themeIcon');
      const savedTheme = localStorage.getItem('admin-theme') || 'light';

      // Apply saved theme
      if (savedTheme === 'dark') {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
      }

      // Toggle functionality
      themeToggle.addEventListener('click', function() {
        const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        
        if (isDark) {
          document.documentElement.setAttribute('data-bs-theme', 'light');
          themeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
          localStorage.setItem('admin-theme', 'light');
        } else {
          document.documentElement.setAttribute('data-bs-theme', 'dark');
          themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
          localStorage.setItem('admin-theme', 'dark');
        }
      });
    });
  </script>

  @stack('scripts')
</body>
</html>