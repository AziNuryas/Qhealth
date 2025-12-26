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
    * { margin: 0; padding: 0; box-sizing: border-box; }

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
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    /* ============= BACKGROUND PREMIUM + BLUR ============= */
    .bg-premium {
      position: fixed;
      inset: 0;
      z-index: -2;
      background: linear-gradient(135deg,
        rgba(16, 185, 129, 0.16) 0%,
        rgba(59, 130, 246, 0.09) 45%,
        rgba(168, 85, 247, 0.06) 100%);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }
    .orb-premium {
      position: absolute;
      border-radius: 50%;
      filter: blur(110px);
      opacity: 0.26;
      animation: float 26s ease-in-out infinite;
    }
    .orb-premium:nth-child(1) { width: 520px; height: 520px; background: #10b981; top: -220px; left: -220px; }
    .orb-premium:nth-child(2) { width: 460px; height: 460px; background: #3b82f6; bottom: -200px; right: -200px; animation-delay: 8s; }
    .orb-premium:nth-child(3) { width: 400px; height: 400px; background: #8b5cf6; top: 30%; left: 65%; animation-delay: 15s; opacity: 0.2; }

    @keyframes float {
      0%, 100% { transform: translate(0, 0) scale(1); }
      50% { transform: translate(50px, -50px) scale(1.06); }
    }
    /* ==================================================== */

    /* Logo jantung berdenyut halus */
    .navbar-brand i {
      animation: heartbeat 3.2s ease-in-out infinite;
      filter: drop-shadow(0 0 10px rgba(16, 185, 129, 0.5));
    }
    @keyframes heartbeat {
      0%, 100% { transform: scale(1); }
      14% { transform: scale(1.2); }
      28% { transform: scale(1); }
      42% { transform: scale(1.15); }
      70% { transform: scale(1); }
    }

    /* Background lama */
    .orb-container { position: fixed; inset: 0; z-index: -1; overflow: hidden; }
    .orb { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.15; animation: float 20s ease-in-out infinite; }
    .orb-1 { width: 400px; height: 400px; background: linear-gradient(135deg, #10b981, #059669); top: -200px; left: -200px; }
    .orb-2 { width: 300px; height: 300px; background: linear-gradient(135deg, #3b82f6, #2563eb); bottom: -150px; right: -150px; animation-delay: 5s; }

    /* PREVIEW CHATBOT (Hanya Visual) */
    .chatbot-preview {
      position: relative;
      width: 100%;
      height: 300px;
      background: var(--card-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--card-border);
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      overflow: hidden;
      margin-top: 20px;
    }
    .chatbot-preview-header {
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
      color: white;
      padding: 15px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .chatbot-preview-body {
      padding: 20px;
      height: calc(100% - 60px);
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .chatbot-message-preview {
      max-width: 80%;
      padding: 10px 14px;
      border-radius: 14px;
      font-size: 13px;
      line-height: 1.4;
    }
    .chatbot-bot-preview {
      background: var(--card-border);
      color: var(--text-primary);
      align-self: flex-start;
      border-bottom-left-radius: 4px;
    }
    .chatbot-user-preview {
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
      color: white;
      align-self: flex-end;
      border-bottom-right-radius: 4px;
    }
    .chatbot-input-preview {
      position: absolute;
      bottom: 15px;
      left: 15px;
      right: 15px;
      display: flex;
      gap: 10px;
    }
    .chatbot-input-field {
      flex: 1;
      padding: 10px 15px;
      border-radius: 20px;
      border: 1px solid var(--card-border);
      background: var(--card-bg);
      color: var(--text-primary);
      font-size: 13px;
    }
    .chatbot-send-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
      border: none;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: default;
    }

    /* ANONIM USER BADGE */
    .user-anonym {
      display: inline-block;
      padding: 4px 10px;
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(30, 64, 175, 0.1));
      border: 1px solid rgba(59, 130, 246, 0.2);
      border-radius: 12px;
      font-size: 11px;
      font-weight: 600;
      color: #3b82f6;
      margin-left: 8px;
    }
    .privacy-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
      border: 1px solid rgba(16, 185, 129, 0.2);
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      color: var(--accent-primary);
      margin-bottom: 15px;
    }

    /* SEMUA STYLE ASLI TIDAK BERUBAH */
    .navbar { backdrop-filter: blur(20px); background: var(--card-bg) !important; border-bottom: 1px solid var(--card-border); box-shadow: var(--shadow-md); padding: 12px 0; }
    .navbar-brand { font-weight: 700; font-size: 20px; color: var(--accent-primary) !important; }
    .nav-link { color: var(--text-primary) !important; font-weight: 500; font-size: 13px; padding: 8px 16px !important; border-radius: 8px; transition: all 0.2s ease; }
    .nav-link:hover { background: var(--card-border); color: var(--accent-primary) !important; }
    .hero-section { padding: 80px 0 60px; text-align: center; }
    .hero-badge { display: inline-block; padding: 8px 16px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 20px; font-size: 12px; font-weight: 600; color: var(--accent-primary); margin-bottom: 20px; }
    .hero-title { font-size: 48px; font-weight: 800; color: var(--text-primary); margin-bottom: 16px; line-height: 1.2; letter-spacing: -1px; }
    .hero-gradient { background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .hero-subtitle { font-size: 18px; color: var(--text-secondary); margin-bottom: 32px; max-width: 600px; margin-left: auto; margin-right: auto; }
    .btn-hero { padding: 14px 32px; border-radius: 12px; font-size: 14px; font-weight: 700; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 8px; }
    .btn-primary-hero { background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); color: white; border: none; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3); }
    .btn-primary-hero:hover { transform: translateY(-3px); box-shadow: 0 14px 32px rgba(16, 185, 129, 0.45); }
    .btn-secondary-hero { background: var(--card-bg); color: var(--text-primary); border: 1px solid var(--card-border); }
    .btn-secondary-hero:hover { background: var(--card-border); border-color: var(--accent-primary); }
    .feature-card { backdrop-filter: blur(20px); background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 16px; padding: 28px; box-shadow: var(--shadow-md); transition: all 0.3s ease; height: 100%; }
    .feature-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .feature-icon { width: 56px; height: 56px; background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25); }
    .feature-icon i { font-size: 28px; color: white; }
    .feature-title { font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 12px; }
    .feature-text { font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px; }
    .feature-link { color: var(--accent-primary); font-size: 13px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: all 0.2s ease; }
    .feature-link:hover { gap: 10px; }
    .section-title { font-size: 32px; font-weight: 700; color: var(--text-primary); text-align: center; margin-bottom: 48px; position: relative; }
    .section-title::after { content: ''; position: absolute; bottom: -12px; left: 50%; transform: translateX(-50%); width: 60px; height: 4px; background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border-radius: 2px; }
    .testimonial-card { backdrop-filter: blur(20px); background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 14px; padding: 24px; box-shadow: var(--shadow-md); height: 100%; }
    .testimonial-text { font-size: 14px; color: var(--text-secondary); font-style: italic; line-height: 1.6; margin-bottom: 16px; }
    .testimonial-author { font-size: 13px; font-weight: 600; color: var(--accent-primary); }
    footer { background: var(--card-bg); backdrop-filter: blur(20px); border-top: 1px solid var(--card-border); padding: 40px 0 20px; margin-top: 80px; }
    .footer-logo { font-size: 20px; font-weight: 700; color: var(--accent-primary); margin-bottom: 16px; }
    .social-icon { width: 36px; height: 36px; border-radius: 50%; background: var(--card-border); display: inline-flex; align-items: center; justify-content: center; margin: 0 4px; color: var(--text-primary); transition: all 0.3s ease; text-decoration: none; }
    .social-icon:hover { background: var(--accent-primary); color: white; transform: translateY(-4px) rotate(8deg); }
    .theme-toggle-btn { width: 36px; height: 36px; border-radius: 50%; background: var(--card-border); border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease; color: var(--text-primary); }
    .theme-toggle-btn:hover { background: var(--accent-primary); color: white; transform: rotate(180deg) scale(1.1); }
    @media (max-width: 768px) { 
      .hero-title { font-size: 36px; } 
      .hero-subtitle { font-size: 16px; } 
    }
  </style>
</head>
<body>

  <!-- BACKGROUND PREMIUM BARU -->
  <div class="bg-premium"></div>
  <div class="orb-premium"></div>
  <div class="orb-premium"></div>
  <div class="orb-premium"></div>

  <!-- Background lama -->
  <div class="orb-container">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
  </div>

  <!-- NAVBAR -->
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
          <li class="nav-item"><a href="#chatbot" class="nav-link">AI Assistant</a></li>
          <li class="nav-item"><a href="#privacy" class="nav-link">Privasi</a></li>
          <li class="nav-item"><a href="#testimoni" class="nav-link">Testimoni</a></li>
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

  <!-- HERO SECTION -->
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
        Platform terpadu untuk konsultasi kesehatan, kalkulator BMI, dan komunitas sharing pengalaman kesehatan. 
        <strong>Dilengkapi AI Assistant</strong> dan <strong>sistem privasi nama terjamin</strong> di forum diskusi.
      </p>
      <div class="privacy-badge">
        <i class="bi bi-shield-check"></i> Nama Anda aman di forum kami
      </div>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('register') }}" class="btn btn-primary-hero">
          <i class="bi bi-rocket-takeoff-fill"></i>
          Daftar Gratis
        </a>
        <a href="#fitur" class="btn btn-secondary-hero">
          <i class="bi bi-play-circle-fill"></i>
          Lihat Fitur
        </a>
      </div>
    </div>
  </section>

  <!-- FITUR -->
  <section id="fitur" class="py-5">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">Fitur Unggulan</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="feature-card">
            <div class="feature-icon"><i class="bi bi-chat-dots-fill"></i></div>
            <h3 class="feature-title">Forum Tanya Jawab</h3>
            <p class="feature-text">
              Ajukan pertanyaan seputar kesehatan dan dapatkan jawaban dari komunitas dan ahli kesehatan terpercaya.
            </p>
            <div class="mb-3">
              <small class="text-success">
                <i class="bi bi-shield-check"></i> <strong>Privasi Terjaga:</strong> Nama asli tidak ditampilkan
              </small>
            </div>
            <a href="/dashboard" class="feature-link">Mulai Bertanya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="feature-card">
            <div class="feature-icon"><i class="bi bi-robot"></i></div>
            <h3 class="feature-title">AI Health Assistant</h3>
            <p class="feature-text">
              Konsultasi 24/7 dengan asisten kesehatan AI kami. Dapatkan informasi kesehatan dasar, tips, dan rekomendasi instan.
            </p>
            <div class="mb-3">
              <small class="text-success">
                <i class="bi bi-lightning-charge"></i> <strong>Tersedia di Dashboard:</strong> Setelah login
              </small>
            </div>
            <a href="{{ route('register') }}" class="feature-link">Coba Sekarang <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="feature-card">
            <div class="feature-icon"><i class="bi bi-calculator-fill"></i></div>
            <h3 class="feature-title">Kalkulator BMI</h3>
            <p class="feature-text">
              Hitung indeks massa tubuh dengan akurat dan dapatkan rekomendasi berat badan ideal untuk Anda.
            </p>
            <a href="/bmi" class="feature-link">Hitung BMI <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PREVIEW CHATBOT -->
  <section id="chatbot" class="py-5 bg-transparent">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">
        AI Health Assistant
        <span class="fs-6 text-success d-block mt-2">(Preview Dashboard)</span>
      </h2>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="chatbot-preview" data-aos="zoom-in">
            <div class="chatbot-preview-header">
              <i class="bi bi-robot"></i> QHealth AI Assistant
              <span class="ms-auto badge bg-light text-dark">Beta</span>
            </div>
            <div class="chatbot-preview-body">
              <div class="chatbot-message-preview chatbot-bot-preview">
                👋 Halo! Saya AI Health Assistant dari QHealth. Saya di sini untuk membantu Anda dengan pertanyaan seputar kesehatan. Apa yang bisa saya bantu hari ini?
              </div>
              <div class="chatbot-message-preview chatbot-user-preview">
                Bagaimana cara menjaga pola makan sehat sehari-hari?
              </div>
              <div class="chatbot-message-preview chatbot-bot-preview">
                Untuk pola makan sehat: konsumsi buah & sayur setiap hari, protein rendah lemak, batasi gula dan garam, minum air putih cukup. Sarapan penting untuk energi!
              </div>
              <div class="chatbot-message-preview chatbot-user-preview">
                Berapa berat ideal untuk tinggi 170 cm?
              </div>
              <div class="chatbot-message-preview chatbot-bot-preview">
                Untuk tinggi 170cm, berat ideal sekitar 58-72kg (BMI 20-25). Gunakan kalkulator BMI di dashboard untuk hasil personal!
              </div>
            </div>
            <div class="chatbot-input-preview">
              <input type="text" class="chatbot-input-field" placeholder="Tanyakan tentang kesehatan..." readonly value="Fitur lengkap tersedia setelah login">
              <button class="chatbot-send-btn">
                <i class="bi bi-send-fill"></i>
              </button>
            </div>
          </div>
          <div class="text-center mt-4">
            <p class="text-secondary">
              <i class="bi bi-info-circle"></i> <strong>AI Assistant lengkap</strong> tersedia di dashboard setelah Anda login. 
              Bisa tanya tentang gejala, nutrisi, olahraga, dan lebih banyak lagi!
            </p>
            <a href="{{ route('register') }}" class="btn btn-success">
              <i class="bi bi-robot"></i> Coba AI Assistant Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SISTEM PRIVASI -->
  <section id="privacy" class="py-5">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">
        Sistem Privasi Nama di Forum
        <span class="fs-6 text-primary d-block mt-2">Diskusi Aman & Nyaman</span>
      </h2>
      <div class="row g-4">
        <div class="col-md-6" data-aos="fade-right">
          <div class="feature-card h-100">
            <div class="feature-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
              <i class="bi bi-incognito"></i>
            </div>
            <h3 class="feature-title">Identitas Anonim</h3>
            <p class="feature-text">
              Di forum QHealth, nama asli Anda <strong>tidak pernah ditampilkan</strong>. Sistem kami memberikan ID unik untuk setiap pengguna.
            </p>
            <div class="mt-4">
              <h5 class="fw-bold mb-3">Contoh nama di forum:</h5>
              <div class="d-flex flex-wrap gap-2">
                <span class="user-anonym"><i class="bi bi-person"></i> Pengguna#A1B2C3</span>
                <span class="user-anonym"><i class="bi bi-person"></i> Pengguna#X7Y8Z9</span>
                <span class="user-anonym"><i class="bi bi-person"></i> Pengguna#M4N5O6</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6" data-aos="fade-left">
          <div class="feature-card h-100">
            <div class="feature-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
              <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h3 class="feature-title">Keuntungan Privasi</h3>
            <ul class="feature-text" style="list-style-type: none; padding-left: 0;">
              <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Bebas bertanya tanpa malu</li>
              <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Diskusi kesehatan sensitif aman</li>
              <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Tidak ada risiko identitas terbuka</li>
              <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Fokus pada masalah kesehatan</li>
              <li><i class="bi bi-check-circle-fill text-success me-2"></i> Komunitas lebih supportif</li>
            </ul>
            <div class="alert alert-success mt-4" style="background: rgba(16, 185, 129, 0.1);">
              <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Meski nama anonim, konten tidak pantas tetap akan dimoderasi.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONI -->
  <section id="testimoni" class="py-5">
    <div class="container">
      <h2 class="section-title" data-aos="fade-down">Kata Pengguna QHealth</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-card">
            <p class="testimonial-text">"Saya bisa bertanya tentang masalah sensitif tanpa takut diketahui orang lain. Sistem anonimnya benar-benar membantu!"</p>
            <p class="testimonial-author">
              <span class="user-anonym"><i class="bi bi-incognito"></i> Pengguna#A1B2C3</span>
            </p>
            <small class="text-secondary">Pengguna Forum Tanya Jawab</small>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-card">
            <p class="testimonial-text">"AI Assistant-nya sangat membantu untuk pertanyaan dasar. Tidak perlu menunggu jawaban dari dokter untuk hal-hal sederhana."</p>
            <p class="testimonial-author">
              <span class="user-anonym"><i class="bi bi-robot"></i> Pengguna#X7Y8Z9</span>
            </p>
            <small class="text-secondary">Pengguna AI Assistant</small>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-card">
            <p class="testimonial-text">"Komunitasnya sangat supportif. Meski semua anonim, jawaban yang diberikan sangat informatif dan membantu."</p>
            <p class="testimonial-author">
              <span class="user-anonym"><i class="bi bi-people-fill"></i> Pengguna#M4N5O6</span>
            </p>
            <small class="text-secondary">Anggota Komunitas</small>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="py-5">
    <div class="container">
      <div class="text-center" data-aos="zoom-in">
        <div class="hero-badge mb-4">
          <i class="bi bi-lightning-charge"></i> Siap Bergabung?
        </div>
        <h2 class="mb-4">Mulai Perjalanan Kesehatan Anda</h2>
        <p class="text-secondary mb-4">Daftar sekarang dan nikmati semua fitur QHealth termasuk AI Assistant dan forum dengan privasi terjamin.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <a href="{{ route('register') }}" class="btn btn-primary-hero btn-lg">
            <i class="bi bi-person-plus-fill"></i> Daftar Gratis
          </a>
          <a href="{{ route('login') }}" class="btn btn-secondary-hero btn-lg">
            <i class="bi bi-box-arrow-in-right"></i> Masuk Sekarang
          </a>
        </div>
        <p class="text-secondary mt-4 small">
          <i class="bi bi-shield-check"></i> Data Anda aman · Tidak ada biaya pendaftaran · Akses penuh ke semua fitur
        </p>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container text-center">
      <div class="footer-logo">
        <i class="bi bi-heart-pulse-fill"></i> QHealth
      </div>
      <p class="mb-3" style="color: var(--text-secondary); font-size: 13px; max-width: 600px; margin: 0 auto 20px;">
        Platform kesehatan modern dengan AI Assistant dan perlindungan privasi nama pengguna di forum diskusi.
      </p>
      <div class="mb-4">
        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
      </div>
      <p style="color: var(--text-secondary); font-size: 12px; margin: 0;">
        © 2025 QHealth. All rights reserved. | 
        <a href="/privacy" style="color: var(--accent-primary); text-decoration: none;">Kebijakan Privasi</a> | 
        <a href="/terms" style="color: var(--accent-primary); text-decoration: none;">Syarat Layanan</a>
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

    // Animasi untuk preview chatbot (hanya visual)
    let previewMessages = document.querySelectorAll('.chatbot-message-preview');
    previewMessages.forEach((msg, index) => {
      msg.style.opacity = '0';
      msg.style.transform = 'translateY(10px)';
      
      setTimeout(() => {
        msg.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        msg.style.opacity = '1';
        msg.style.transform = 'translateY(0)';
      }, index * 300);
    });
  </script>
</body>
</html>