@extends('layouts.app')

@section('title', 'Kalkulator BMI')

@section('content')
<style>
    .bmi-container {
        max-width: 700px;
        margin: 0 auto;
    }

    .bmi-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .bmi-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 16px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
    }

    .bmi-icon i {
        font-size: 36px;
        color: white;
    }

    .bmi-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
        letter-spacing: -0.5px;
    }

    .bmi-subtitle {
        font-size: 13px;
        color: var(--text-secondary);
    }

    .bmi-card {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 32px;
        box-shadow: var(--shadow-lg);
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 6px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: 16px;
        pointer-events: none;
        transition: all 0.2s ease;
    }

    .input-suffix {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: 12px;
        font-weight: 600;
        pointer-events: none;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 12px 42px 12px 42px;
        border: 1px solid var(--card-border);
        border-radius: 10px;
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-control:focus ~ .input-icon {
        color: var(--accent-primary);
    }

    .btn-calculate {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: white;
        border: none;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 8px;
    }

    .btn-calculate:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(16, 185, 129, 0.4);
    }

    .result-card {
        backdrop-filter: blur(20px);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 32px;
        box-shadow: var(--shadow-lg);
        text-align: center;
    }

    .result-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .bmi-score {
        width: 140px;
        height: 140px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        box-shadow: 0 12px 32px rgba(16, 185, 129, 0.3);
    }

    .bmi-value {
        font-size: 42px;
        font-weight: 800;
        color: white;
        line-height: 1;
    }

    .bmi-unit {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        margin-top: 4px;
    }

    .bmi-category {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
        padding: 10px 24px;
        border-radius: 24px;
        display: inline-block;
    }

    .category-underweight {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
    }

    .category-normal {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: white;
    }

    .category-overweight {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .category-obese {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .bmi-description {
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.6;
        max-width: 500px;
        margin: 0 auto 24px;
    }

    .ideal-weight-box {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 14px;
        padding: 20px;
        margin-top: 24px;
    }

    .ideal-label {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .ideal-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--accent-primary);
        line-height: 1;
    }

    .bmi-range-indicator {
        margin-top: 28px;
        padding-top: 28px;
        border-top: 1px solid var(--card-border);
    }

    .range-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .range-bar {
        height: 12px;
        background: linear-gradient(to right, #3b82f6, var(--accent-primary), #f59e0b, #ef4444);
        border-radius: 6px;
        position: relative;
        margin-bottom: 12px;
    }

    .range-marker {
        position: absolute;
        top: -8px;
        width: 28px;
        height: 28px;
        background: white;
        border: 3px solid var(--accent-primary);
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateX(-50%);
    }

    .range-labels {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: var(--text-tertiary);
        font-weight: 600;
    }

    .info-box {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(37, 99, 235, 0.08));
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 12px;
        padding: 16px;
        margin-top: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .info-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .info-text {
        font-size: 12px;
        color: var(--text-secondary);
        line-height: 1.5;
    }

    @media (max-width: 576px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .bmi-score {
            width: 120px;
            height: 120px;
        }

        .bmi-value {
            font-size: 36px;
        }
    }
</style>

<div class="container py-3">
    <div class="bmi-container">
        <div class="bmi-header" data-aos="fade-in">
            <div class="bmi-icon">
                <i class="bi bi-calculator-fill"></i>
            </div>
            <h1 class="bmi-title">Kalkulator BMI</h1>
            <p class="bmi-subtitle">Hitung Indeks Massa Tubuh Anda</p>
        </div>

        <div class="bmi-card" data-aos="fade-up">
            <form action="{{ route('bmi') }}" method="GET">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Berat Badan</label>
                        <div class="input-wrapper">
                            <i class="bi bi-person-fill input-icon"></i>
                            <input type="number" name="weight" class="form-control" 
                                   placeholder="70" value="{{ request('weight') }}" required step="0.1">
                            <span class="input-suffix">kg</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tinggi Badan</label>
                        <div class="input-wrapper">
                            <i class="bi bi-rulers input-icon"></i>
                            <input type="number" name="height" class="form-control" 
                                   placeholder="170" value="{{ request('height') }}" required step="0.1">
                            <span class="input-suffix">cm</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="input-wrapper">
                        <i class="bi bi-gender-ambiguous input-icon"></i>
                        <select name="gender" class="form-select" required>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Pria</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Wanita</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-calculate">
                    <i class="bi bi-calculator-fill"></i>
                    Hitung BMI Saya
                </button>
            </form>
        </div>

        @if(isset($bmi))
            <div class="result-card" data-aos="zoom-in">
                <div class="result-title">Hasil Perhitungan BMI</div>
                
                <div class="bmi-score">
                    <div class="bmi-value">{{ number_format($bmi, 1) }}</div>
                    <div class="bmi-unit">BMI</div>
                </div>

                <div class="bmi-category 
                    @if($bmi < 18.5) category-underweight
                    @elseif($bmi >= 18.5 && $bmi < 24.9) category-normal
                    @elseif($bmi >= 25 && $bmi < 29.9) category-overweight
                    @else category-obese @endif">
                    @if($bmi < 18.5)
                        Kurang Berat
                    @elseif($bmi >= 18.5 && $bmi < 24.9)
                        Normal
                    @elseif($bmi >= 25 && $bmi < 29.9)
                        Kelebihan Berat
                    @else
                        Obesitas
                    @endif
                </div>

                <p class="bmi-description">
                    @if($bmi < 18.5)
                        Berat badan Anda kurang dari normal. Disarankan untuk meningkatkan asupan nutrisi dan berkonsultasi dengan ahli gizi.
                    @elseif($bmi >= 18.5 && $bmi < 24.9)
                        Selamat! Berat badan Anda berada dalam kategori normal. Pertahankan pola hidup sehat Anda.
                    @elseif($bmi >= 25 && $bmi < 29.9)
                        Berat badan Anda berlebih. Disarankan untuk mengatur pola makan dan meningkatkan aktivitas fisik.
                    @else
                        Berat badan Anda dalam kategori obesitas. Sangat disarankan untuk berkonsultasi dengan dokter.
                    @endif
                </p>

                <div class="ideal-weight-box">
                    <div class="ideal-label">Berat Badan Ideal</div>
                    <div class="ideal-value">{{ number_format($idealWeight, 1) }} <span style="font-size: 18px; font-weight: 600;">kg</span></div>
                </div>

                <div class="bmi-range-indicator">
                    <div class="range-title">Indikator BMI</div>
                    <div class="range-bar">
                        <div class="range-marker" style="left: {{ min(max(($bmi - 15) / 25 * 100, 0), 100) }}%;"></div>
                    </div>
                    <div class="range-labels">
                        <span>&lt; 18.5</span>
                        <span>18.5 - 24.9</span>
                        <span>25 - 29.9</span>
                        <span>&gt; 30</span>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-icon">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-title">Catatan Penting</div>
                        <div class="info-text">
                            BMI adalah indikator umum dan mungkin tidak akurat untuk atlet, ibu hamil, atau lansia. 
                            Konsultasikan dengan dokter untuk evaluasi kesehatan yang lebih komprehensif.
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection