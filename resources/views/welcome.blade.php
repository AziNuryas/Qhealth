<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QHealth - Platform Kesehatan</title>
  
  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- AOS -->
  <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">

  <style>
    /* Tema dan Variabel */
    :root {
      /* Light mode variables */
      --card-bg-light: rgba(255, 255, 255, 0.75);
      --text-color-light: #333333;
      --border-color-light: rgba(255, 255, 255, 0.3);
      --shadow-light: 0 8px 32px rgba(31, 38, 135, 0.1);
      --highlight-shadow-light: 0 12px 28px rgba(34, 197, 94, 0.15);
      --input-bg-light: rgba(255, 255, 255, 0.8);
      --bubble-opacity: 0.2;
      
      /* Dark mode variables */
      --card-bg-dark: rgba(42, 42, 61, 0.8);
      --text-color-dark: #e2e8f0;
      --border-color-dark: rgba(255, 255, 255, 0.1);
      --shadow-dark: 0 8px 32px rgba(0, 0, 0, 0.2);
      --highlight-shadow-dark: 0 12px 28px rgba(34, 197, 94, 0.2);
      --input-bg-dark: rgba(30, 32, 48, 0.7);
      --bubble-opacity-dark: 0.05;
    }
    
    /* Apply theme based on system preference */
    @media (prefers-color-scheme: dark) {
      :root {
        --card-bg: var(--card-bg-dark);
        --text-color: var(--text-color-dark);
        --border-color: var(--border-color-dark);
        --shadow: var(--shadow-dark);
        --highlight-shadow: var(--highlight-shadow-dark);
        --input-bg: var(--input-bg-dark);
        --bubble-opacity: var(--bubble-opacity-dark);
      }
    }
    
    @media (prefers-color-scheme: light) {
      :root {
        --card-bg: var(--card-bg-light);
        --text-color: var(--text-color-light);
        --border-color: var(--border-color-light);
        --shadow: var(--shadow-light);
        --highlight-shadow: var(--highlight-shadow-light);
        --input-bg: var(--input-bg-light);
      }
    }
    
    body {
      background: linear-gradient(120deg, #a8d5ba, #b0d6e8, #e6b9d2);
      background-size: 400% 400%;
      animation: bgFlow 20s ease infinite;
      position: relative;
      overflow-x: hidden;
      color: var(--text-color);
    }
    
    body.dark-mode {
      background: linear-gradient(120deg, #2a3d2c, #2c3e4f, #3d2a3a);
      background-size: 400% 400%;
      --card-bg: var(--card-bg-dark);
      --text-color: var(--text-color-dark);
      --border-color: var(--border-color-dark);
      --shadow: var(--shadow-dark);
      --highlight-shadow: var(--highlight-shadow-dark);
      --bubble-opacity: var(--bubble-opacity-dark);
    }

    @keyframes bgFlow {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Bubbles Background */
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

    /* Navbar Styling */
    .navbar {
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      background-color: var(--card-bg) !important;
      font-size: 0.9rem;
      border-bottom: 1px solid var(--border-color);
    }
    
    .navbar-brand {
      font-weight: 700;
      color: #22c55e !important;
    }
    
    .navbar .nav-link {
      color: var(--text-color) !important;
      transition: all 0.3s ease;
    }
    
    .navbar .nav-link:hover {
      color: #22c55e !important;
      transform: translateY(-2px);
    }
    
    .theme-toggle-btn {
      background: transparent;
      color: var(--text-color);
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
      color: #22c55e;
      transform: rotate(20deg);
    }

    /* Card Styling */
    .feature-card {
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      background-color: var(--card-bg);
      border-radius: 16px;
      border: 1px solid var(--border-color);
      box-shadow: var(--shadow);
      transition: all 0.3s ease;
      opacity: 0;
      transform: translateY(10px);
      animation: fadeIn 0.8s forwards;
    }
    
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--highlight-shadow);
      border-color: rgba(34, 197, 94, 0.3);
    }
    
    /* Decorative elements */
    .feature-card::before {
      content: '';
      position: absolute;
      top: -8px;
      right: -8px;
      width: 25px;
      height: 25px;
      background-color: rgba(34, 197, 94, 0.3);
      border-radius: 50%;
      z-index: -1;
    }

    .feature-card::after {
      content: '';
      position: absolute;
      bottom: -12px;
      left: -12px;
      width: 40px;
      height: 40px;
      background-color: rgba(34, 197, 94, 0.2);
      border-radius: 50%;
      z-index: -1;
    }

    /* Hero Section */
    .hero-section {
      padding: 5rem 0 3rem;
      text-align: center;
    }
    
    .hero-title {
      font-size: 2.8rem;
      font-weight: 700;
      color: #22c55e;
      margin-bottom: 1rem;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .hero-subtitle {
      font-size: 1.2rem;
      margin-bottom: 2rem;
      opacity: 0.9;
    }
    
    .hero-btn {
      padding: 0.8rem 2rem;
      border-radius: 50px;
      background-color: #22c55e;
      color: white;
      border: none;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(34, 197, 94, 0.2);
    }
    
    .hero-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(34, 197, 94, 0.3);
      background-color: #16a34a;
    }

    /* Features Section */
    .section-title {
      text-align: center;
      font-size: 1.8rem;
      font-weight: 700;
      color: #22c55e;
      margin-bottom: 2.5rem;
      position: relative;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background: linear-gradient(to right, #86efac, #22c55e);
      border-radius: 2px;
    }
    
    .feature-icon {
      font-size: 2.5rem;
      color: #22c55e;
      margin-bottom: 1rem;
    }
    
    .feature-title {
      font-weight: 600;
      font-size: 1.2rem;
      margin-bottom: 0.8rem;
      color: var(--text-color);
    }
    
    .feature-text {
      font-size: 0.9rem;
      opacity: 0.9;
      margin-bottom: 1.5rem;
    }
    
    .feature-btn {
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
      background-color: transparent;
      color: #22c55e;
      border: 1px solid #22c55e;
      transition: all 0.3s ease;
    }
    
    .feature-btn:hover {
      background-color: #22c55e;
      color: white;
      transform: translateY(-2px);
    }

    /* Testimonial Section */
    .testimonial-card {
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      background-color: var(--card-bg);
      border-radius: 16px;
      border: 1px solid var(--border-color);
      box-shadow: var(--shadow);
      transition: all 0.3s ease;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      position: relative;
    }
    
    .testimonial-text {
      font-size: 1rem;
      font-style: italic;
      margin-bottom: 1rem;
    }
    
    .testimonial-author {
      font-weight: 600;
      font-size: 0.9rem;
      color: #22c55e;
    }
    
    .testimonial-quote {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 1.5rem;
      color: rgba(34, 197, 94, 0.2);
    }

    /* Contact Section */
    .contact-item {
      display: flex;
      align-items: center;
      margin-bottom: 1.2rem;
    }
    
    .contact-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: rgba(34, 197, 94, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      color: #22c55e;
      flex-shrink: 0;
    }
    
    .contact-text {
      font-size: 0.95rem;
    }

    /* Footer */
    footer {
      background-color: var(--card-bg) !important;
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      color: var(--text-color) !important;
      border-top: 1px solid var(--border-color);
      padding: 2rem 0;
      text-align: center;
      font-size: 0.9rem;
    }
    
    .footer-logo {
      font-size: 1.5rem;
      font-weight: 700;
      color: #22c55e;
      margin-bottom: 1rem;
    }
    
    .social-icons {
      display: flex;
      justify-content: center;
      margin-bottom: 1.5rem;
    }
    
    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: rgba(34, 197, 94, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 0.5rem;
      color: #22c55e;
      transition: all 0.3s ease;
    }
    
    .social-icon:hover {
      transform: translateY(-3px);
      background-color: #22c55e;
      color: white;
    }
    
    .copyright {
      opacity: 0.8;
    }
    
    /* Animation effect */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    /* Dark mode specific */
    body.dark-mode .navbar .nav-link {
      color: var(--text-color-dark) !important;
    }
    
    body.dark-mode .navbar .nav-link:hover {
      color: #86efac !important;
    }
  </style>
</head>
<body>
  <!-- Bubble Background -->
  <div class="bg-bubble bubble1"></div>
  <div class="bg-bubble bubble2"></div>
  <div class="bg-bubble bubble3"></div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">QHealth</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a href="#fitur" class="nav-link"><i class="bi bi-stars me-1"></i>Fitur</a></li>
          <li class="nav-item"><a href="#testimoni" class="nav-link"><i class="bi bi-chat-left-quote me-1"></i>Testimoni</a></li>
          <li class="nav-item"><a href="#kontak" class="nav-link"><i class="bi bi-envelope me-1"></i>Kontak</a></li>
          <li class="nav-item ms-2">
            <a href="{{ route('login') }}" class="btn btn-sm btn-success">
              <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
            </a>
          </li>
          <li class="nav-item ms-3">
            <button id="themeToggle" class="theme-toggle-btn">
              <i class="bi bi-moon-fill" id="themeIcon"></i>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section" data-aos="fade-up">
    <div class="container">
      <h1 class="hero-title">Selamat Datang di QHealth</h1>
      <p class="hero-subtitle">Platform kesehatan modern untuk tanya jawab dan kalkulasi BMI</p>
      <a href="{{ route('register') }}" class="btn hero-btn">
        <i class="bi bi-play-circle me-2"></i>Mulai Sekarang
      </a>
    </div>
  </section>

  <!-- Fitur -->
  <section id="fitur" class="py-5">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">Fitur Utama</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="feature-card h-100 position-relative p-4">
            <div class="text-center">
              <i class="bi bi-chat-dots-fill feature-icon"></i>
              <h3 class="feature-title">Tanya Jawab</h3>
              <p class="feature-text">Tanyakan apapun tentang kesehatan dan dapatkan jawaban terpercaya dari pakar kesehatan kami.</p>
              <a href="/dashboard" class="btn feature-btn">
                <i class="bi bi-arrow-right me-1"></i>Mulai Bertanya
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="feature-card h-100 position-relative p-4">
            <div class="text-center">
              <i class="bi bi-calculator-fill feature-icon"></i>
              <h3 class="feature-title">BMI Kalkulator</h3>
              <p class="feature-text">Cek berat badan ideal dan Indeks Massa Tubuh Anda dengan kalkulator BMI yang akurat dan mudah digunakan.</p>
              <a href="/bmi" class="btn feature-btn">
                <i class="bi bi-arrow-right me-1"></i>Hitung BMI
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="feature-card h-100 position-relative p-4">
            <div class="text-center">
              <i class="bi bi-person-circle feature-icon"></i>
              <h3 class="feature-title">Profil Pengguna</h3>
              <p class="feature-text">Kelola data pribadi, lihat riwayat pertanyaan dan jawaban, serta pantau BMI Anda dari waktu ke waktu.</p>
              <a href="/profile" class="btn feature-btn">
                <i class="bi bi-arrow-right me-1"></i>Lihat Profil
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Parallax Divider -->
  <div class="py-5 my-3 parallax"></div>

  <!-- Testimoni -->
  <section id="testimoni" class="py-5">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">Testimoni Pengguna</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-card">
            <i class="bi bi-quote testimonial-quote"></i>
            <p class="testimonial-text">"QHealth sangat membantu saya memahami masalah kesehatan dengan mudah. Fitur tanya jawabnya sangat praktis dan cepat!"</p>
            <p class="testimonial-author">- Andi Pratama</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-card">
            <i class="bi bi-quote testimonial-quote"></i>
            <p class="testimonial-text">"Kalkulator BMI yang disediakan sangat akurat dan memberikan saran yang jelas tentang berat badan ideal. Tampilan aplikasinya juga sangat intuitif."</p>
            <p class="testimonial-author">- Sinta Dewi</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-card">
            <i class="bi bi-quote testimonial-quote"></i>
            <p class="testimonial-text">"Saya bisa mendapatkan jawaban langsung dari pakar kesehatan. Sangat membantu untuk konsultasi cepat sebelum pergi ke dokter."</p>
            <p class="testimonial-author">- Dedi Kurniawan</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak -->
  <section id="kontak" class="py-5">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">Hubungi Kami</h2>
      <div class="row justify-content-center">
        <div class="col-md-8" data-aos="fade-up">
          <div class="feature-card p-4">
            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-envelope-fill"></i>
              </div>
              <div class="contact-text">support@qhealth.com</div>
            </div>
            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-telephone-fill"></i>
              </div>
              <div class="contact-text">+62 812 3456 7890</div>
            </div>
            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-geo-alt-fill"></i>
              </div>
              <div class="contact-text">Jl. Kesehatan No.10, Jakarta</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-logo">QHealth</div>
      <div class="social-icons">
        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
      </div>
      <p class="copyright">&copy; 2025 QHealth. All rights reserved.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({ 
      duration: 800, 
      easing: 'ease-in-out', 
      once: true 
    });
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
  
  <!-- Theme Toggle Script -->
  <script>
    const toggleBtn = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    // Load saved theme
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