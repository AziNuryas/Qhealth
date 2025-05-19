@extends('layouts.app')

@section('content')
<style>
    /* Variabel warna dan tema */
    :root {
        /* Light mode variables */
        --card-bg-light: rgba(255, 255, 255, 0.75);
        --text-color-light: #333333;
        --border-color-light: rgba(255, 255, 255, 0.3);
        --shadow-light: 0 8px 32px rgba(31, 38, 135, 0.1);
        --highlight-shadow-light: 0 12px 28px rgba(34, 197, 94, 0.15);
        --input-bg-light: rgba(255, 255, 255, 0.8);
        
        /* Dark mode variables */
        --card-bg-dark: rgba(42, 42, 61, 0.8);
        --text-color-dark: #e2e8f0;
        --border-color-dark: rgba(255, 255, 255, 0.1);
        --shadow-dark: 0 8px 32px rgba(0, 0, 0, 0.2);
        --highlight-shadow-dark: 0 12px 28px rgba(34, 197, 94, 0.2);
        --input-bg-dark: rgba(30, 32, 48, 0.7);
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
        color: var(--text-color);
    }
    
    /* Container */
    .content-container {
        max-width: 850px;
        margin: 0 auto;
        padding-bottom: 50px;
    }
    
    /* BMI Card dengan efek akrilik */
    .bmi-card {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        background-color: var(--card-bg);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        padding: 2rem;
        position: relative;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.8s forwards;
    }
    
    /* Decorative elements */
    .bmi-card::before {
        content: '';
        position: absolute;
        top: -10px;
        right: -10px;
        width: 40px;
        height: 40px;
        background-color: rgba(34, 197, 94, 0.3);
        border-radius: 50%;
        z-index: -1;
    }

    .bmi-card::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: -15px;
        width: 60px;
        height: 60px;
        background-color: rgba(34, 197, 94, 0.2);
        border-radius: 50%;
        z-index: -1;
    }
    
    .title {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        text-align: center;
        color: #22c55e;
    }
    
    /* Form styling */
    .form-group {
        margin-bottom: 1.5rem;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.6s forwards;
    }
    
    .form-group:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .form-group:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 1rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background-color: var(--input-bg);
        color: var(--text-color);
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #22c55e;
        box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.25);
    }
    
    /* Button styling */
    .btn-container {
        margin-top: 2rem;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.6s forwards;
        animation-delay: 0.6s;
    }
    
    .btn-primary {
        display: inline-block;
        width: 100%;
        padding: 0.8rem 1rem;
        border-radius: 12px;
        background-color: #22c55e;
        color: white;
        border: none;
        transition: all 0.3s ease;
        font-size: 1rem;
        font-weight: 600;
        box-shadow: 0 3px 8px rgba(34, 197, 94, 0.2);
        cursor: pointer;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(34, 197, 94, 0.3);
        background-color: #16a34a;
    }
    
    /* Animation effect */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Results styling */
    .results-section {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
        opacity: 0;
        transform: translateY(10px);
        animation: fadeIn 0.8s forwards;
        animation-delay: 0.3s;
    }
    
    .result-title {
        font-size: 1.3rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 1rem;
        color: #22c55e;
    }
    
    .result-value {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    
    .result-status {
        text-align: center;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }
    
    .status-underweight {
        color: #3b82f6;
    }
    
    .status-normal {
        color: #22c55e;
    }
    
    .status-overweight {
        color: #f59e0b;
    }
    
    .status-obese {
        color: #ef4444;
    }
    
    .ideal-weight {
        text-align: center;
        padding: 1rem;
        border-radius: 12px;
        background-color: rgba(34, 197, 94, 0.1);
        margin-top: 1.5rem;
    }
</style>

<div class="container py-4">
    <div class="content-container">
        <!-- Header -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <h4 class="mb-0 fw-bold text-success">
                <i class="bi bi-calculator me-2"></i>Kalkulator BMI
            </h4>
        </div>
        
        <!-- BMI Calculator Card -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bmi-card">
                    <h1 class="title">Hitung Indeks Massa Tubuh (IMT)</h1>
                    
                    <form action="{{ route('bmi') }}" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="weight">Berat Badan (kg)</label>
                            <input type="number" class="form-control" id="weight" name="weight" 
                                placeholder="Masukkan berat badan" 
                                value="{{ request('weight') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="height">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control" id="height" name="height" 
                                placeholder="Masukkan tinggi badan" 
                                value="{{ request('height') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Pria</option>
                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Wanita</option>
                            </select>
                        </div>
                        
                        <div class="btn-container">
                            <button type="submit" class="btn-primary">
                                <i class="bi bi-calculator me-2"></i>Hitung BMI
                            </button>
                        </div>
                    </form>
                    
                    @if(isset($bmi))
                        <div class="results-section">
                            <h3 class="result-title">Hasil BMI Anda</h3>
                            <div class="result-value">{{ number_format($bmi, 1) }}</div>
                            <div class="result-status">
                                <strong>Status: </strong>
                                <span class="
                                    @if($bmi < 18.5) status-underweight
                                    @elseif($bmi >= 18.5 && $bmi < 24.9) status-normal
                                    @elseif($bmi >= 25 && $bmi < 29.9) status-overweight
                                    @else status-obese @endif
                                ">
                                    @if($bmi < 18.5)
                                        Kurang Berat Badan
                                    @elseif($bmi >= 18.5 && $bmi < 24.9)
                                        Normal
                                    @elseif($bmi >= 25 && $bmi < 29.9)
                                        Kelebihan Berat Badan
                                    @else
                                        Obesitas
                                    @endif
                                </span>
                            </div>
                            
                            <div class="ideal-weight">
                                <h4 class="result-title">Berat Badan Ideal Anda</h4>
                                <div class="result-value">{{ number_format($idealWeight, 1) }} kg</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate form appear
        const bmiCard = document.querySelector('.bmi-card');
        setTimeout(() => {
            bmiCard.style.opacity = '1';
            bmiCard.style.transform = 'translateY(0)';
        }, 300);
    });
</script>
@endsection