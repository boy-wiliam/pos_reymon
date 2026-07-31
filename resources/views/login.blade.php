@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    :root {
        --primary-color: #059669;
        --primary-hover: #047857;
        --primary-glow: rgba(5, 150, 105, 0.4);
    }

    body {
        background: #0f172a;
        background-image: 
            radial-gradient(at 10% 20%, rgba(5, 150, 105, 0.25) 0px, transparent 50%),
            radial-gradient(at 90% 80%, rgba(15, 23, 42, 0.8) 0px, transparent 50%),
            url('/images/pos-bg.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .login-card {
        width: 430px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 28px;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(5, 150, 105, 0.1);
        animation: fadeCard 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        z-index: 10;
    }

    .login-header {
        color: white;
        text-align: center;
        padding: 40px 30px 20px;
    }

    .login-header h3 {
        font-weight: 800;
        letter-spacing: -0.5px;
        font-size: 26px;
        margin-bottom: 6px;
        background: linear-gradient(135deg, #ffffff 30%, #94a3b8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .login-header p {
        color: #94a3b8;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 0;
    }

    .login-icon-box {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        box-shadow: 0 12px 25px rgba(5, 150, 105, 0.35);
        transform: rotate(-5deg);
        transition: transform 0.3s ease;
    }

    .login-card:hover .login-icon-box {
        transform: rotate(0deg) scale(1.05);
    }

    .form-floating-custom .form-control {
        height: 54px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        background: rgba(255, 255, 255, 0.05);
        color: white;
        padding-left: 20px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-floating-custom .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-floating-custom .form-control:focus {
        background: rgba(255, 255, 255, 0.09);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px var(--primary-glow);
        color: white;
    }

    .btn-login {
        height: 54px;
        border-radius: 14px;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border: none;
        font-weight: 600;
        font-size: 15px;
        letter-spacing: 0.4px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.35);
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(5, 150, 105, 0.5);
    }

    .invalid-feedback-custom {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 12px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        backdrop-filter: blur(10px);
    }

    @keyframes fadeCard {
        from {
            opacity: 0;
            transform: translate(-50%, -42%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }
</style>

<div class="card login-card position-absolute top-50 start-50 translate-middle">

    <div class="login-header">
        <div class="login-icon-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        </div>
        <h3>Selamat Datang</h3>
        <p>Masuk ke sistem POS untuk mengelola transaksi toko</p>
    </div>

    <div class="card-body px-4 pb-4 pt-2">

        <form action="{{ route('auth') }}" method="POST">
            @csrf

            <div class="mb-3 form-floating-custom">
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Alamat Email Perusahaan"
                    required
                    autocomplete="email"
                    autofocus
                >
                @error('email')
                    <div class="invalid-feedback-custom">
                        ⚠️ {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4 form-floating-custom">
                <input 
                    type="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Kata Sandi Rahasia"
                    required
                    autocomplete="current-password"
                >
                @error('password')
                    <div class="invalid-feedback-custom">
                        ⚠️ {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login text-white w-100">
                Masuk ke Dashboard 🚀
            </button>

        </form>

    </div>

</div>

@endsection