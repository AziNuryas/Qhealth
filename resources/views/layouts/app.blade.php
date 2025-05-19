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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <!-- Custom Styles -->
  <style>
    /* 🌿 Background dan Animasi Umum */
    body {
      background: linear-gradient(120deg, #a8d5ba, #b0d6e8, #e6b9d2);
      background-size: 400% 400%;
      animation: bgFlow 20s ease infinite;
      position: relative;
      overflow-x: hidden;
      background: var(--bg-color);
      color: var(--text-color);
      font-family: 'Inter', sans-serif;
    }

    @keyframes bgFlow {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* 🌬️ Bubble Background */
    .bg-bubble {
      position: absolute;
      border-radius: 50%;
      filter: blur(20px);
      z-index: 0;
      animation: floatUp 25s linear infinite;
      opacity: var(--bubble-opacity);
    }

    .bubble1 { width: 300px; height: 300px; background: #a5f3fc; top: 50%; left: -150px; }
    .bubble2 { width: 200px; height: 200px; background: #d8b4fe; bottom: 10%; right: -100px; }
    .bubble3 { width: 150px; height: 150px; background: #fecaca; top: 10%; right: 20%; }

    @keyframes floatUp {
      0% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-40px) scale(1.05); }
      100% { transform: translateY(0) scale(1); }
    }

    /* 🌗 Dark Mode Variables - Improved Contrast */
    :root {
      /* Mode Terang */
      --bg-color: #f8fafc;
      --text-color: #1a1a1a;
      --card-bg: #ffffff;
      --bubble-opacity: 0.2;
      --border-color: rgba(0, 0, 0, 0.1);
      --card-text: #333333;
      --search-bg: rgba(255, 255, 255, 0.9);
      --search-focus-bg: rgba(255, 255, 255, 1);
      --search-shadow: rgba(34, 197, 94, 0.2);
      --primary-color: #16a34a; /* Warna primary lebih gelap untuk kontras */
      --primary-hover: #15803d;
      --dropdown-hover: rgba(22, 163, 74, 0.1);
      --muted-text: #555555; /* Warna muted text yang gelap */
      --link-hover: #15803d;
      --icon-color: #444444;
      --input-text: #333333;
      --placeholder-color: #666666;
    }

    body.dark-mode {
      /* Mode Gelap */
      --bg-color: #0f172a;
      --text-color: #f1f5f9;
      --card-bg: #1e293b;
      --bubble-opacity: 0.05;
      --border-color: rgba(255, 255, 255, 0.1);
      --card-text: #e2e8f0;
      --search-bg: rgba(30, 41, 59, 0.8);
      --search-focus-bg: rgba(30, 41, 59, 1);
      --search-shadow: rgba(34, 197, 94, 0.25);
      --muted-text: #cbd5e1; /* Warna muted text yang terang */
      --dropdown-hover: rgba(34, 197, 94, 0.15);
      --link-hover: #4ade80;
      --icon-color: #cbd5e1;
      --input-text: #f1f5f9;
      --placeholder-color: #94a3b8;
    }

    /* Pastikan teks card selalu memiliki kontras yang baik */
    .card-text, .card-title, .card-body p, .card-body h1, 
    .card-body h2, .card-body h3, .card-body h4, .card-body h5, .card-body h6 {
      color: var(--card-text) !important;
    }

    /* Perbaikan untuk teks muted */
    .text-muted {
      color: var(--muted-text) !important;
    }

    /* 🌟 Komponen UI */
    .navbar, footer {
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      background-color: var(--card-bg) !important;
      color: var(--text-color) !important;
      border-bottom: 1px solid var(--border-color);
      font-size: 0.9rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .navbar-brand {
      font-weight: 700;
      color: var(--primary-color) !important;
      font-size: 1.3rem;
      letter-spacing: -0.5px;
    }

    .nav-link {
      color: var(--text-color) !important;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .nav-link:hover {
      color: var(--primary-color) !important;
    }

    /* Dropdown item warna teks */
    .dropdown-item {
      color: var(--text-color) !important;
    }

    /* 🔍 Search Bar Stylish - Simple & Clean with Better Contrast */
    .search-wrapper {
      position: relative;
      max-width: 210px;
    }

    .search-form {
      max-width: 100%;
    }

    .search-input {
      border-radius: 30px !important;
      padding-left: 38px !important;
      padding-right: 15px !important; 
      background-color: var(--search-bg) !important;
      backdrop-filter: blur(10px);
      border: 1px solid var(--border-color) !important;
      transition: all 0.3s ease !important;
      font-size: 0.85rem !important;
      height: 36px;
      color: var(--input-text) !important;
    }

    .search-input::placeholder {
      color: var(--placeholder-color) !important;
      opacity: 1;
    }

    .search-input:focus {
      box-shadow: 0 0 0 3px var(--search-shadow) !important;
      background-color: var(--search-focus-bg) !important;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--icon-color);
      opacity: 0.7;
      pointer-events: none;
      transition: all 0.3s ease;
    }

    .search-input:focus ~ .search-icon {
      color: var(--primary-color);
      opacity: 1;
    }

    /* Theme Toggle Button Styling */
    .theme-toggle-btn {
      background: transparent;
      color: var(--icon-color);
      border: 1px solid var(--border-color);
      border-radius: 50%;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .theme-toggle-btn:hover {
      color: var(--primary-color);
      transform: rotate(20deg);
    }

    /* Dropdown styling with better contrast */
    .dropdown-item {
      transition: all 0.2s ease;
      padding: 0.5rem 1rem;
      font-size: 0.85rem;
    }

    .dropdown-menu {
      background-color: var(--card-bg);
      border: 1px solid var(--border-color);
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      border-radius: 10px;
      margin-top: 8px;
      overflow: hidden;
    }

    .dropdown-item:hover {
      background-color: var(--dropdown-hover);
      padding-left: 1.2rem;
    }

    .dropdown-item i {
      color: var(--primary-color);
      margin-right: 8px;
      font-size: 0.9rem;
    }

    /* Button styling */
    .btn {
      transition: all 0.3s ease;
      border-radius: 30px;
      font-weight: 500;
      font-size: 0.85rem;
    }

    .btn-success, .btn-primary {
      border-radius: 30px;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(34, 197, 94, 0.2);
    }

    .btn-success:hover, .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    }

    .btn-danger {
      border-radius: 30px;
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);
    }

    .btn-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-sm {
      padding: 0.25rem 0.8rem;
    }

    .btn i {
      margin-right: 4px;
    }

    .card,
    .testimonial-card,
    .accordion-body {
      background-color: var(--card-bg);
      color: var(--text-color);
      backdrop-filter: blur(12px);
      border-radius: 12px;
      border: 1px solid var(--border-color);
      box-shadow: 0 4px 16px rgba(31, 38, 135, 0.05);
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
    }

    .section-title {
      font-weight: 700;
      font-size: 1.5rem;
      text-align: center;
      color: var(--primary-color);
      position: relative;
      margin-bottom: 2rem;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 40px;
      height: 3px;
      background: linear-gradient(to right, #86efac, var(--primary-color));
      border-radius: 2px;
    }

    .testimonial-card {
      border-left: 3px solid var(--primary-color);
      padding: 0.8rem;
      font-size: 0.85rem;
    }

    footer {
      font-size: 0.8rem;
      background-color: var(--card-bg) !important;
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      color: var(--text-color) !important;
      border-top: 1px solid var(--border-color);
      padding: 2rem 0;
      text-align: center;
    }

    .form-control {
      background-color: var(--card-bg);
      color: var(--input-text);
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 0.9rem;
    }

    .form-control:focus {
      border-color: #86efac;
      box-shadow: 0 0 0 0.2rem rgba(34, 197, 94, 0.2);
      background-color: var(--card-bg);
      color: var(--input-text);
    }

    /* ✨ Fade In Animation */
    .fade-up {
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.8s ease-out;
    }

    .fade-up.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Social icons */
    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: rgba(34, 197, 94, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 0.5rem;
      color: var(--primary-color);
      transition: all 0.3s ease;
    }
    
    .social-icon:hover {
      transform: translateY(-3px);
      background-color: var(--primary-color);
      color: white;
      box-shadow: 0 4px 10px rgba(34, 197, 94, 0.3);
    }

    /* Footer logo */
    .footer-logo {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 1rem;
    }

    /* Link styling untuk footer */
    footer a.text-decoration-none {
      color: var(--muted-text) !important;
      transition: all 0.2s ease;
    }

    footer a.text-decoration-none:hover {
      color: var(--link-hover) !important;
      text-decoration: underline !important;
    }

    /* Mobile responsive */
    @media (max-width: 576px) {
      .search-wrapper {
        width: 100%;
        max-width: none;
        margin-bottom: 10px;
      }
      
      .footer-logo {
        font-size: 1.3rem;
      }
      
      .social-icon {
        width: 32px;
        height: 32px;
      }
    }

    /* Badge Notification */
    .badge-notification {
      position: absolute;
      top: -5px;
      right: -5px;
      padding: 0.15rem 0.4rem;
      border-radius: 50%;
      font-size: 0.65rem;
      background-color: #ef4444;
      color: white;
      font-weight: 700;
      box-shadow: 0 2px 6px rgba(239, 68, 68, 0.3);
    }

    /* Avatar styling */
    .avatar {
      border: 2px solid rgba(34, 197, 94, 0.3);
    }

    /* Custom Font */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
  </style>
</head>

<body>
  <!-- 🎈 Bubble Background -->
  <div class="bg-bubble bubble1"></div>
  <div class="bg-bubble bubble2"></div>
  <div class="bg-bubble bubble3"></div>

  <!-- 🌐 Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container d-flex align-items-center">
      {{-- 🔙 Tombol Kembali --}}
      @if(request()->is('bmi') || request()->is('profile') || request()->is('questions'))
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm me-3">
          <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
      @endif

      {{-- 📂 Dropdown Menu di kiri logo --}}
      @if (Request::is('dashboard'))
        <div class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle text-success fw-semibold" href="#" id="mainMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-list-nested me-1"></i>Menu
          </a>
          <ul class="dropdown-menu shadow-sm" aria-labelledby="mainMenu">
            <li><a class="dropdown-item" href="{{ route('questions.index') }}"><i class="bi bi-chat-dots"></i>Pertanyaan</a></li>
            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person-circle"></i>Profil</a></li>
            <li><a class="dropdown-item" href="{{ route('bmi') }}"><i class="bi bi-calculator"></i>Kalkulator BMI</a></li>
          </ul>
        </div>
      @endif

      {{-- 🏷️ Logo QHealth --}}
      <a class="navbar-brand fw-bold me-auto" href="#"><i class="bi bi-heart-pulse me-1"></i>QHealth</a>

      {{-- ☰ Toggler & Bagian Kanan --}}
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          
          @auth
          <!-- 🔔 Notifikasi - Hanya tampil jika user sudah login -->
          <li class="nav-item me-3 position-relative">
            <a href="#" class="nav-link">
              <i class="bi bi-bell fs-5"></i>
              <span class="badge-notification">2</span>
            </a>
          </li>
          @endauth

          <!-- 📱 Tema -->
          <li class="nav-item me-3">
            <button id="themeToggle" class="theme-toggle-btn">
              <i class="bi bi-moon-fill" id="themeIcon"></i>
            </button>
          </li>
          
          <!-- 👤 User -->
          <li class="nav-item ms-2">
            @auth
              <div class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                  <img src="https://ui-avatars.com/api/?name=User&background=22c55e&color=fff" class="rounded-circle avatar" width="30" height="30" alt="User">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person"></i>Profil</a></li>
                  <li><hr class="dropdown-divider"></li>
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
              <a href="{{ route('login') }}" class="btn btn-success btn-sm me-1">
                <i class="bi bi-box-arrow-in-right"></i>Masuk
              </a>
              <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-person-plus-fill"></i>Daftar
              </a>
            @endauth
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🧩 Konten -->
  <main class="py-5 container" data-aos="fade-in">
    @yield('content') {{-- <= Wajib untuk me-render konten --}}
  </main>

  <!-- 🦶 Footer -->
  <footer>
    <div class="container">
      <div class="footer-logo">QHealth</div>
      <div class="social-icons d-flex justify-content-center mb-3">
        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
      </div>
      <p class="mb-0 text-muted">&copy; 2025 QHealth. All rights reserved.</p>
    </div>
  </footer>

  <!-- 🔧 Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({ 
      duration: 800, 
      easing: 'ease-in-out', 
      once: true 
    });
  </script>

  <!-- 🌌 Particles Background -->
  <div id="particles-js" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script>
    particlesJS("particles-js", {
      particles: {
        number: { value: 30, density: { enable: true, value_area: 800 } },
        color: { value: "#60a5fa" },
        shape: { type: "circle", stroke: { width: 0, color: "#000" }},
        opacity: { value: 0.3, random: true },
        size: { value: 10, random: true },
        line_linked: { enable: true, distance: 150, color: "#93c5fd", opacity: 0.3, width: 1 },
        move: { enable: true, speed: 1, direction: "none", out_mode: "out" }
      },
      interactivity: {
        detect_on: "canvas",
        events: {
          onhover: { enable: true, mode: "repulse" },
          onclick: { enable: true, mode: "push" }
        },
        modes: {
          repulse: { distance: 100, duration: 0.4 },
          push: { particles_nb: 2 }
        }
      },
      retina_detect: true
    });
  </script>

  <!-- 🔽 Scroll Fade -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const elements = document.querySelectorAll(".fade-up");
      function showOnScroll() {
        elements.forEach(el => {
          const rect = el.getBoundingClientRect();
          if (rect.top < window.innerHeight - 100) {
            el.classList.add("visible");
          }
        });
      }
      window.addEventListener("scroll", showOnScroll);
      showOnScroll();
    });
  </script>

  <!-- 🌗 Dark Mode Toggle -->
  <script>
    const toggleBtn = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const savedTheme = localStorage.getItem('theme') || (prefersDark ? 'dark' : 'light');

    if (savedTheme === 'dark') {
      document.body.classList.add('dark-mode');
      themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
    }

    toggleBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      const isDark = document.body.classList.contains('dark-mode');
      themeIcon.classList.toggle('bi-moon-fill', !isDark);
      themeIcon.classList.toggle('bi-sun-fill', isDark);
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
  </script>
</body>
</html>