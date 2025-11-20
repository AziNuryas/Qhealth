<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QHealth - Platform Kesehatan Modern</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --bg-primary: #f8fafc;
      --bg-secondary: #ffffff;
      --text-primary: #0f172a;
      --text-secondary: #64748b;
      --accent-primary: #10b981;
      --accent-secondary: #059669;
      --card-bg: rgba(255, 255, 255, 0.8);
      --card-border: rgba(15, 23, 42, 0.06);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
      --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    body.dark-mode {
      --bg-primary: #0f172a;
      --bg-secondary: #1e293b;
      --text-primary: #f1f5f9;
      --text-secondary: #94a3b8;
      --card-bg: rgba(30, 41, 59, 0.8);
      --card-border: rgba(241, 245, 249, 0.08);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.3);
      --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    body {
      background: var(--bg-primary);
      color: var(--text-primary);
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    /* Animated Background */
    .orb-container {
      position: fixed;
      inset: 0;
      z-index: -1;
      overflow: hidden;
    }

    .orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(60px);
      opacity: 0.15;
      animation: float 20s ease-in-out infinite;
    }

    .orb-1 {
      width: 400px;
      height: 400px;
      background: linear-gradient(135deg, #10b981, #059669);
      top: -200px;
      left: -200px;
    }

    .orb-2 {
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      bottom: -150px;
      right: -150px;
      animation-delay: 5s;
    }

    @keyframes float {
      0%, 100% { transform: translate(0, 0); }
      50% { transform: translate(30px, -30px); }
    }

    /* Navbar */
    .navbar {
      backdrop-filter: blur(20px);
      background: var(--card-bg) !important;
      border-bottom: 1px solid var(--card-border);
      box-shadow: var(--shadow-md);
      padding: 12px 0;
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 20px;
      color: var(--accent-primary) !important;
    }

    .nav-link {
      color: var(--text-primary) !important;
      font-weight: 500;
      font-size: 13px;
      padding: 8px 16px !important;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .nav-link:hover {
      background: var(--card-border);
      color: var(--accent-primary) !important;
    }

    /* Hero Section */
    .hero-section {
      padding: 80px 0 60px;
      text-align: center;
    }

    .hero-badge {
      display: inline-block;
      padding: 8px 16px;
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
      border: 1px solid rgba(16, 185, 129, 0.2);
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      color: var(--accent-primary);
      margin-bottom: 20px;
    }

    .hero-title {
      font-size: 48px;
      font-weight: 800;
      color: var(--text-primary);
      margin-bottom: 16px;
      line-height: 1.2;
      letter-spacing: -1px;
    }

    .hero-gradient {
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-subtitle {
      font-size: 18px;
      color: var(--text-secondary);
      margin-bottom: 32px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .btn-hero {
      padding: 14px 32px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 700;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-primary-hero {
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
      color: white;
      border: none;
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-primary-hero:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(16, 185, 129, 0.4);
    }

    .btn-secondary-hero {
      background: var(--card-bg);
      color: var(--text-primary);
      border: 1px solid var(--card-border);
    }

    .btn-secondary-hero:hover {
      background: var(--card-border);
      border-color: var(--accent-primary);
    }

    /* Feature Cards */
    .feature-card {
      backdrop-filter: blur(20px);
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 16px;
      padding: 28px;
      box-shadow: var(--shadow-md);
      transition: all 0.3s ease;
      height: 100%;
    }

    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
    }

    .feature-icon {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
    }

    .feature-icon i {
      font-size: 28px;
      color: white;
    }

    .feature-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 12px;
    }

    .feature-text {
      font-size: 13px;
      color: var(--text-secondary);
      line-height: 1.6;
      margin-bottom: 16px;
    }

    .feature-link {
      color: var(--accent-primary);
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      transition: all 0.2s ease;
    }

    .feature-link:hover {
      gap: 8px;
    }

    /* Section Title */
    .section-title {
      font-size: 32px;
      font-weight: 700;
      color: var(--text-primary);
      text-align: center;
      margin-bottom: 48px;
      position: relative;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -12px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
      border-radius: 2px;
    }

    /* Testimonial Card */
    .testimonial-card {
      backdrop-filter: blur(20px);
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 14px;
      padding: 24px;
      box-shadow: var(--shadow-md);
      height: 100%;
    }

    .testimonial-text {
      font-size: 14px;
      color: var(--text-secondary);
      font-style: italic;
      line-height: 1.6;
      margin-bottom: 16px;
    }

    .testimonial-author {
      font-size: 13px;
      font-weight: 600;
      color: var(--accent-primary);
    }

    /* Footer */
    footer {
      background: var(--card-bg);
      backdrop-filter: blur(20px);
      border-top: 1px solid var(--card-border);
      padding: 40px 0 20px;
      margin-top: 80px;
    }

    .footer-logo {
      font-size: 20px;
      font-weight: 700;
      color: var(--accent-primary);
      margin-bottom: 16px;
    }

    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--card-border);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin: 0 4px;
      color: var(--text-primary);
      transition: all 0.2s ease;
      text-decoration: none;
    }

    .social-icon:hover {
      background: var(--accent-primary);
      color: white;
      transform: translateY(-2px);
    }

    /* Theme Toggle */
    .theme-toggle-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--card-border);
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s ease;
      color: var(--text-primary);
    }

    .theme-toggle-btn:hover {
      background: var(--accent-primary);
      color: white;
      transform: rotate(180deg);
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 36px;
      }

      .hero-subtitle {
        font-size: 16px;
      }
    }
  </style>
</head>

<body>
  <!-- Animated Background -->
  <div class="orb-container">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <i class="bi bi-heart-pulse-fill"></i> QHealth
      </a>
      <button class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <i class="bi bi-list" style="font-size: 24px;"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center gap-2">
          <li class="nav-item"><a href="#fitur" class="nav-link">Fitur</a></li>
          <li class="nav-item"><a href="#testimoni" class="nav-link">Testimoni</a></li>
          <li class="nav-item"><a href="#kontak" class="nav-link">Kontak</a></li>
          <li class="nav-item">
            <a href="{{ route('login') }}" class="btn btn-success btn-sm">
              <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
            </a>
          </li>
          <li class="nav-item">
            <button id="themeToggle" class="theme-toggle-btn">
              <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section" data-aos="fade-up">
    <div class="container">
      <div class="hero-badge">
        <i class="bi bi-stars"></i> Platform Kesehatan Modern
      </div>
      <h1 class="hero-title">
        Kesehatan Lebih Mudah<br>
        dengan <span class="hero-gradient">QHealth</span>
      </h1>
      <p class="hero-subtitle">
        Platform terpadu untuk konsultasi kesehatan, kalkulator BMI, dan komunitas sharing pengalaman kesehatan
      </p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('register') }}" class="btn btn-primary-hero">
          <i class="bi bi-rocket-takeoff-fill"></i>
          Mulai Sekarang
        </a>
        <a href="#fitur" class="btn btn-secondary-hero">
          <i class="bi bi-play-circle-fill"></i>
          Pelajari Lebih Lanjut
        </a>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="fitur" class="py-5">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">Fitur Unggulan</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="bi bi-chat-dots-fill"></i>
            </div>
            <h3 class="feature-title">Tanya Jawab</h3>
            <p class="feature-text">
              Ajukan pertanyaan seputar kesehatan dan dapatkan jawaban dari komunitas dan ahli kesehatan terpercaya.
            </p>
            <a href="/dashboard" class="feature-link">
              Mulai Bertanya <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="bi bi-calculator-fill"></i>
            </div>
            <h3 class="feature-title">Kalkulator BMI</h3>
            <p class="feature-text">
              Hitung indeks massa tubuh dengan akurat dan dapatkan rekomendasi berat badan ideal untuk Anda.
            </p>
            <a href="/bmi" class="feature-link">
              Hitung BMI <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="bi bi-people-fill"></i>
            </div>
            <h3 class="feature-title">Komunitas Sehat</h3>
            <p class="feature-text">
              Bergabung dengan komunitas peduli kesehatan, berbagi pengalaman, dan saling memberikan dukungan.
            </p>
            <a href="/questions" class="feature-link">
              Lihat Komunitas <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimoni" class="py-5">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">Kata Mereka</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-card">
            <p class="testimonial-text">
              "QHealth sangat membantu saya memahami kondisi kesehatan dengan lebih baik. Fiturnya lengkap dan mudah digunakan!"
            </p>
            <p class="testimonial-author">- Andi Pratama</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-card">
            <p class="testimonial-text">
              "Kalkulator BMI-nya akurat dan memberikan insight yang berguna. Sekarang saya lebih aware dengan kesehatan saya."
            </p>
            <p class="testimonial-author">- Sinta Dewi</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-card">
            <p class="testimonial-text">
              "Komunitasnya supportive dan responsif. Pertanyaan saya selalu dijawab dengan cepat dan informatif."
            </p>
            <p class="testimonial-author">- Dedi Kurniawan</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container text-center">
      <div class="footer-logo">
        <i class="bi bi-heart-pulse-fill"></i> QHealth
      </div>
      <div class="mb-4">
        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
      </div>
      <p style="color: var(--text-secondary); font-size: 12px; margin: 0;">
        &copy; 2025 QHealth. All rights reserved.
      </p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 600, once: true });

    // Dark Mode Toggle
    const toggleBtn = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const savedTheme = localStorage.getItem('theme') || 'light';

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