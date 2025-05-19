<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QHealth - Daftar</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- AOS -->
  <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(120deg, #a8d5ba, #b0d6e8, #e6b9d2);
      background-size: 400% 400%;
      animation: bgFlow 20s ease infinite;
      position: relative;
      overflow-x: hidden;
      color: var(--text-color);
    }

    @keyframes bgFlow {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .bg-bubble {
      position: absolute;
      border-radius: 50%;
      opacity: var(--bubble-opacity);
      z-index: 0;
      animation: floatUp 25s linear infinite;
      filter: blur(20px);
    }

    .bubble1 {
      width: 300px;
      height: 300px;
      background: #a5f3fc;
      top: 50%;
      left: -150px;
    }

    .bubble2 {
      width: 200px;
      height: 200px;
      background: #d8b4fe;
      bottom: 10%;
      right: -100px;
    }

    .bubble3 {
      width: 150px;
      height: 150px;
      background: #fecaca;
      top: 10%;
      right: 20%;
    }

    @keyframes floatUp {
      0% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-40px) scale(1.05); }
      100% { transform: translateY(0) scale(1); }
    }

    :root {
      --bg-color: #f0fff0;
      --text-color: #212529;
      --card-bg: #ffffff;
      --bubble-opacity: 0.2;
    }

    body.dark-mode {
      --bg-color: #1e1e2f;
      --text-color: #f1f1f1;
      --card-bg: #2a2a3d;
      --bubble-opacity: 0.05;
    }

    .card {
      background-color: var(--card-bg);
      border: none;
      border-radius: 16px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      z-index: 1;
    }

    .navbar, footer {
      background-color: var(--card-bg) !important;
    }

    .form-control, .form-label {
      color: var(--text-color);
    }

    body.dark-mode .form-control {
      background-color: #3a3a4a;
      border-color: #555;
      color: #f1f1f1;
    }

    .icon-hover:hover {
      transform: scale(1.05);
      transition: 0.3s ease;
    }
  </style>
</head>
<body>
<!-- Bubble Background -->
<div class="bg-bubble bubble1"></div>
<div class="bg-bubble bubble2"></div>
<div class="bg-bubble bubble3"></div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand text-success fw-bold" href="#">QHealth</a>
    <div>
      <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm me-2 icon-hover">
        <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
      </a>
      <button id="themeToggle" class="btn btn-outline-secondary btn-sm icon-hover">
        <i class="bi bi-moon-fill" id="themeIcon"></i>
      </button>
    </div>
  </div>
</nav>

<!-- Register Form Section -->
<section class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="col-md-6" data-aos="fade-up">
    <div class="card p-4">
      <h3 class="text-center text-success mb-4">Daftar Akun Baru</h3>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="name" name="name" required autofocus>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Alamat Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-success w-100">
          <i class="bi bi-person-plus-fill me-1"></i> Daftar
        </button>
      </form>
      <p class="text-center mt-3 small">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="text-center py-3">
  <p class="mb-0 text-muted">&copy; 2025 QHealth. All rights reserved.</p>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
</script>

<!-- Particles Background -->
<div id="particles-js" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
particlesJS("particles-js", {
  particles: {
    number: { value: 40, density: { enable: true, value_area: 800 } },
    color: { value: "#60a5fa" },
    shape: { type: "circle", stroke: { width: 0, color: "#000" }},
    opacity: { value: 0.4, random: true },
    size: { value: 12, random: true },
    line_linked: { enable: true, distance: 150, color: "#93c5fd", opacity: 0.4, width: 1 },
    move: { enable: true, speed: 1.5, direction: "none", out_mode: "out" }
  },
  interactivity: {
    detect_on: "canvas",
    events: {
      onhover: { enable: true, mode: "repulse" },
      onclick: { enable: true, mode: "push" }
    },
    modes: {
      repulse: { distance: 120, duration: 0.4 },
      push: { particles_nb: 3 }
    }
  },
  retina_detect: true
});
</script>

<!-- Dark Mode Toggle -->
<script>
  const toggleBtn = document.getElementById('themeToggle');
  const themeIcon = document.getElementById('themeIcon');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

  const savedTheme = localStorage.getItem('theme') || (prefersDark ? 'dark' : 'light');
  if (savedTheme === 'dark') {
    document.body.classList.add('dark-mode');
    themeIcon.classList.remove('bi-moon-fill');
    themeIcon.classList.add('bi-sun-fill');
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
