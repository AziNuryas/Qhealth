{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QHealth - @yield('title', 'Platform Kesehatan')</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      /* Light Mode */
      --bg-primary: #f8fafc;
      --bg-secondary: #ffffff;
      --text-primary: #0f172a;
      --text-secondary: #64748b;
      --text-tertiary: #94a3b8;
      --accent-primary: #10b981;
      --accent-secondary: #059669;
      --card-bg: rgba(255, 255, 255, 0.8);
      --card-border: rgba(15, 23, 42, 0.06);
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
      --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.12);
      --blur: 20px;
    }

    body.dark-mode {
      /* Dark Mode */
      --bg-primary: #0f172a;
      --bg-secondary: #1e293b;
      --text-primary: #f1f5f9;
      --text-secondary: #94a3b8;
      --text-tertiary: #64748b;
      --accent-primary: #10b981;
      --accent-secondary: #34d399;
      --card-bg: rgba(30, 41, 59, 0.8);
      --card-border: rgba(241, 245, 249, 0.08);
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.2);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.3);
      --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    body {
      background: var(--bg-primary);
      color: var(--text-primary);
      font-family: 'Inter', -apple-system, sans-serif;
      font-size: 14px;
      line-height: 1.5;
      transition: all 0.3s ease;
      -webkit-font-smoothing: antialiased;
    }

    /* Animated Background */
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
      opacity: 0.15;
      animation: float 20s ease-in-out infinite;
    }

    .orb-1 {
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, #10b981, #059669);
      top: -150px;
      left: -150px;
    }

    .orb-2 {
      width: 250px;
      height: 250px;
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      bottom: -100px;
      right: -100px;
      animation-delay: 5s;
    }

    .orb-3 {
      width: 200px;
      height: 200px;
      background: linear-gradient(135deg, #8b5cf6, #7c3aed);
      top: 40%;
      right: 15%;
      animation-delay: 10s;
    }

    @keyframes float {
      0%, 100% { transform: translate(0, 0) scale(1); }
      33% { transform: translate(20px, -20px) scale(1.05); }
      66% { transform: translate(-15px, 15px) scale(0.95); }
    }

    /* Navbar */
    .navbar {
      height: 56px;
      backdrop-filter: saturate(180%) blur(var(--blur));
      -webkit-backdrop-filter: saturate(180%) blur(var(--blur));
      background: var(--card-bg) !important;
      border: none;
      border-bottom: 1px solid var(--card-border);
      box-shadow: var(--shadow-sm);
      position: sticky;
      top: 0;
      z-index: 1030;
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 18px;
      color: var(--accent-primary) !important;
      letter-spacing: -0.3px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .navbar-brand i {
      font-size: 20px;
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.08); }
    }

    .nav-link {
      color: var(--text-primary) !important;
      font-weight: 500;
      font-size: 13px;
      padding: 6px 12px !important;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .nav-link:hover {
      background: var(--card-border);
      color: var(--accent-primary) !important;
    }

    /* Dropdown */
    .dropdown-menu {
      background: var(--card-bg);
      backdrop-filter: blur(var(--blur));
      border: 1px solid var(--card-border);
      border-radius: 12px;
      box-shadow: var(--shadow-lg);
      padding: 6px;
      margin-top: 6px !important;
      min-width: 200px;
    }

    .dropdown-item {
      color: var(--text-primary) !important;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .dropdown-item:hover {
      background: var(--card-border);
      color: var(--accent-primary) !important;
      transform: translateX(3px);
    }

    .dropdown-item i {
      font-size: 16px;
      color: var(--accent-primary);
    }

    /* Notification */
    .notification-wrapper {
      position: relative;
    }

    .notification-icon {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: var(--card-border);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-primary);
      transition: all 0.2s ease;
      cursor: pointer;
      font-size: 16px;
    }

    .notification-icon:hover {
      background: var(--accent-primary);
      color: white;
      transform: scale(1.05);
    }

    .badge-notification {
      position: absolute;
      top: -3px;
      right: -3px;
      min-width: 16px;
      height: 16px;
      border-radius: 8px;
      background: linear-gradient(135deg, #ef4444, #dc2626);
      color: white;
      font-size: 9px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 4px;
      box-shadow: 0 2px 6px rgba(239, 68, 68, 0.4);
    }

    /* Theme Toggle */
    .theme-toggle-btn {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: var(--card-border);
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 15px;
      color: var(--text-primary);
    }

    .theme-toggle-btn:hover {
      background: var(--accent-primary);
      color: white;
      transform: rotate(180deg);
    }

    /* Avatar */
    .avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      border: 2px solid var(--accent-primary);
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .avatar:hover {
      transform: scale(1.05);
      box-shadow: 0 0 0 3px var(--card-border);
    }

    /* Buttons */
    .btn {
      font-weight: 600;
      font-size: 13px;
      padding: 8px 16px;
      border-radius: 8px;
      border: none;
      transition: all 0.2s ease;
    }

    .btn-success, .btn-primary {
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
      color: white;
      box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
    }

    .btn-success:hover, .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-outline-secondary {
      background: var(--card-bg);
      color: var(--text-primary);
      border: 1px solid var(--card-border);
    }

    .btn-outline-secondary:hover {
      background: var(--card-border);
      border-color: var(--accent-primary);
      color: var(--accent-primary);
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 12px;
    }

    /* Cards */
    .card {
      background: var(--card-bg);
      backdrop-filter: blur(var(--blur));
      border: 1px solid var(--card-border);
      border-radius: 12px;
      box-shadow: var(--shadow-md);
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-lg);
    }

    /* Footer */
    footer {
      background: var(--card-bg);
      backdrop-filter: blur(var(--blur));
      border-top: 1px solid var(--card-border);
      padding: 32px 0 16px;
      margin-top: 60px;
    }

    .footer-logo {
      font-size: 20px;
      font-weight: 700;
      color: var(--accent-primary);
      margin-bottom: 12px;
    }

    .social-icon {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: var(--card-border);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 4px;
      color: var(--text-primary);
      transition: all 0.2s ease;
      text-decoration: none;
      font-size: 14px;
    }

    .social-icon:hover {
      background: var(--accent-primary);
      color: white;
      transform: translateY(-2px);
    }

    footer a {
      color: var(--text-secondary) !important;
      text-decoration: none;
      transition: all 0.2s ease;
      font-size: 13px;
    }

    footer a:hover {
      color: var(--accent-primary) !important;
    }

    /* Form Controls */
    .form-control {
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 8px;
      color: var(--text-primary);
      padding: 10px 12px;
      font-size: 13px;
      transition: all 0.2s ease;
    }

    .form-control:focus {
      background: var(--bg-secondary);
      border-color: var(--accent-primary);
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
      outline: none;
    }

    .form-control::placeholder {
      color: var(--text-tertiary);
    }

    /* Back Button */
    .btn-back {
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      color: var(--text-primary);
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      text-decoration: none;
    }

    .btn-back:hover {
      background: var(--accent-primary);
      color: white;
      border-color: transparent;
      transform: translateX(-2px);
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }

    ::-webkit-scrollbar-track {
      background: var(--bg-primary);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--text-tertiary);
      border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--accent-primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .navbar-brand {
        font-size: 16px;
      }
      
      .btn {
        padding: 6px 12px;
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <!-- Animated Background -->
  <div class="orb-container">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container d-flex align-items-center">
      {{-- Back Button --}}
      @if(request()->is('bmi') || request()->is('profile') || request()->is('questions'))
        <a href="{{ route('dashboard') }}" class="btn-back me-3">
          <i class="bi bi-arrow-left"></i>
          <span>Kembali</span>
        </a>
      @endif

      {{-- Menu Dropdown --}}
      @if (Request::is('dashboard'))
        <div class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle" href="#" id="mainMenu" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-grid-fill"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="mainMenu">
            <li><a class="dropdown-item" href="{{ route('questions.index') }}"><i class="bi bi-chat-dots-fill"></i>Pertanyaan</a></li>
            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person-circle"></i>Profil</a></li>
            <li><a class="dropdown-item" href="{{ route('bmi') }}"><i class="bi bi-calculator-fill"></i>Kalkulator BMI</a></li>
          </ul>
        </div>
      @endif

      {{-- Logo --}}
      <a class="navbar-brand me-auto" href="#">
        <i class="bi bi-heart-pulse-fill"></i>
        QHealth
      </a>

      {{-- Toggler --}}
      <button class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <i class="bi bi-list" style="font-size: 22px;"></i>
      </button>
      
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center gap-2">
          
          @auth
          <!-- Notification -->
          <li class="nav-item">
            <div class="notification-wrapper">
              <div class="notification-icon">
                <i class="bi bi-bell-fill"></i>
              </div>
              <span class="badge-notification">2</span>
            </div>
          </li>
          @endauth

          <!-- Theme Toggle -->
          <li class="nav-item">
            <button id="themeToggle" class="theme-toggle-btn">
              <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
            </button>
          </li>
          
          <!-- User Menu -->
          <li class="nav-item">
            @auth
              <div class="dropdown">
                <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown">
                  <img src="https://ui-avatars.com/api/?name=User&background=10b981&color=fff" class="avatar" alt="User">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person-fill"></i>Profil</a></li>
                  <li><hr class="dropdown-divider" style="border-color: var(--card-border);"></li>
                  <li>
                    <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="bi bi-box-arrow-right"></i>Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </li>
                </ul>
              </div>
            @else
              <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                  <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                </a>
                <a href="{{ route('register') }}" class="btn btn-success btn-sm">
                  <i class="bi bi-person-plus-fill me-1"></i>Daftar
                </a>
              </div>
            @endauth
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <main class="py-4 container">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer>
    <div class="container text-center">
      <div class="footer-logo">QHealth</div>
      <div class="d-flex justify-content-center mb-3">
        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
      </div>
      <p class="mb-0" style="color: var(--text-tertiary); font-size: 12px;">
        &copy; 2025 QHealth. All rights reserved.
      </p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({ 
      duration: 500, 
      easing: 'ease-out',
      once: true
    });

    // Dark Mode Toggle
    const toggleBtn = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const savedTheme = localStorage.getItem('theme') || (prefersDark ? 'dark' : 'light');

    if (savedTheme === 'dark') {
      document.body.classList.add('dark-mode');
      themeIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
    }

    toggleBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      const isDark = document.body.classList.contains('dark-mode');
      themeIcon.classList.toggle('bi-moon-stars-fill', !isDark);
      themeIcon.classList.toggle('bi-sun-fill', isDark);
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
  </script>
</body>
</html>