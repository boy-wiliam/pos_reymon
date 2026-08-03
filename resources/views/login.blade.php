@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    :root {
        --primary: #059669;
        --primary-hover: #047857;
        --primary-glow: rgba(5, 150, 105, 0.35);
        --accent-glow: rgba(16, 185, 129, 0.15);
        --glass-bg: rgba(15, 23, 42, 0.75);
        --glass-border: rgba(255, 255, 255, 0.12);
    }

    body {
        background: #090d16;
        background-image: 
            radial-gradient(at 15% 15%, rgba(5, 150, 105, 0.2) 0px, transparent 45%),
            radial-gradient(at 85% 85%, rgba(16, 185, 129, 0.12) 0px, transparent 45%),
            radial-gradient(at 50% 50%, rgba(15, 23, 42, 0.9) 0px, transparent 100%);
        background-size: cover;
        background-attachment: fixed;
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
        margin: 0;
        overflow: hidden;
    }

    /* Floating Orbs */
    .orb {
        position: fixed;
        border-radius: 50%;
        filter: blur(90px);
        z-index: 0;
        pointer-events: none;
    }
    .orb-1 {
        width: 350px;
        height: 350px;
        background: rgba(5, 150, 105, 0.3);
        top: -80px;
        left: -80px;
        animation: floatOrb 10s infinite alternate ease-in-out;
    }
    .orb-2 {
        width: 300px;
        height: 300px;
        background: rgba(16, 185, 129, 0.2);
        bottom: -60px;
        right: -60px;
        animation: floatOrb 12s infinite alternate-reverse ease-in-out;
    }

    /* Card Layout */
    .login-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        max-width: 440px;
        padding: 0 16px;
        z-index: 10;
    }

    .login-card {
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        background: var(--glass-bg);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.7),
            0 0 0 1px rgba(255, 255, 255, 0.05) inset,
            0 0 30px rgba(5, 150, 105, 0.15);
        transition: border-color 0.4s ease, box-shadow 0.4s ease;
        overflow: hidden;
    }

    .login-card:hover {
        border-color: rgba(16, 185, 129, 0.3);
        box-shadow: 
            0 30px 60px -12px rgba(0, 0, 0, 0.8),
            0 0 40px rgba(5, 150, 105, 0.25);
    }

    /* Header */
    .login-header {
        text-align: center;
        padding: 38px 32px 10px;
    }

    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 20px;
        background: rgba(5, 150, 105, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #34d399;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .badge-dot {
        width: 6px;
        height: 6px;
        background-color: #34d399;
        border-radius: 50%;
        box-shadow: 0 0 8px #34d399;
    }

    .login-icon-box {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        color: white;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.4);
        position: relative;
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .login-card:hover .login-icon-box {
        transform: scale(1.08) rotate(3deg);
    }

    .login-header h3 {
        font-weight: 800;
        letter-spacing: -0.5px;
        font-size: 24px;
        color: #ffffff;
        margin-bottom: 6px;
    }

    .login-header p {
        color: #94a3b8;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* Input Styling & Icons */
    .input-group-custom {
        position: relative;
        margin-bottom: 20px;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        transition: color 0.3s ease;
        z-index: 5;
        pointer-events: none;
    }

    .form-control-custom {
        width: 100%;
        height: 52px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        background: rgba(255, 255, 255, 0.03);
        color: #f8fafc;
        padding: 0 42px 0 46px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    .form-control-custom::placeholder {
        color: #64748b;
    }

    .form-control-custom:focus {
        background: rgba(255, 255, 255, 0.07);
        border-color: #10b981;
        box-shadow: 0 0 0 4px var(--primary-glow);
    }

    .input-group-custom:focus-within .input-icon {
        color: #34d399;
    }

    .toggle-password {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #64748b;
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.3s ease;
        z-index: 5;
    }

    .toggle-password:hover {
        color: #f8fafc;
    }

    /* Form Utilities */
    .form-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        font-size: 12px;
    }

    .custom-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #94a3b8;
        cursor: pointer;
        user-select: none;
    }

    .custom-checkbox input {
        accent-color: #10b981;
        width: 15px;
        height: 15px;
        border-radius: 4px;
        cursor: pointer;
    }

    .forgot-link {
        color: #34d399;
        text-decoration: none;
        font-weight: 500;
        transition: opacity 0.2s;
    }

    .forgot-link:hover {
        text-decoration: underline;
        opacity: 0.85;
    }

    /* Button */
    .btn-login {
        position: relative;
        width: 100%;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        border: none;
        color: white;
        font-weight: 600;
        font-size: 15px;
        letter-spacing: 0.3px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.35);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(5, 150, 105, 0.5);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    /* Shimmer animation on button hover */
    .btn-login::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(60deg, transparent, rgba(255, 255, 255, 0.25), transparent);
        transform: rotate(30deg) translateX(-100%);
        transition: transform 0.6s ease;
    }

    .btn-login:hover::after {
        transform: rotate(30deg) translateX(100%);
    }

    /* Validation Feedback */
    .invalid-feedback-custom {
        background: rgba(239, 68, 68, 0.12);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Animations */
    @keyframes floatOrb {
        from { transform: translate(0, 0); }
        to { transform: translate(60px, 40px); }
    }
</style>

<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<div class="login-container">
    <div class="card login-card">

        <div class="login-header">
            <div class="badge-status">
                
            </div>

            <div class="login-icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </div>

            <h3>Selamat Datang!</h3>
            <p>Masuk untuk mengelola transaksi toko secara real-time</p>
        </div>

        <div class="card-body px-4 pb-4 pt-2">
            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <div class="input-group-custom">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                        
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            class="form-control-custom @error('email') is-invalid @enderror" 
                            placeholder="Alamat Email Perusahaan" 
                            required 
                            autocomplete="email" 
                            autofocus
                        >
                    </div>

                    @error('email')
                        <div class="invalid-feedback-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="input-group-custom">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>

                        <input 
                            type="password" 
                            id="passwordInput"
                            name="password" 
                            class="form-control-custom @error('password') is-invalid @enderror" 
                            placeholder="Kata Sandi Rahasia" 
                            required 
                            autocomplete="current-password"
                        >

                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility()" aria-label="Toggle password">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <div class="invalid-feedback-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="forgot-link">Lupa sandi?</a>
                </div>

                <button type="submit" class="btn-login">
                    <span>Masuk ke Dashboard</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `
                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                <line x1="2" x2="22" y1="2" y2="22"/>
            `;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
            `;
        }
    }
</script>

@endsection