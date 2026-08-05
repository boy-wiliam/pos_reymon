<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remon Thrift House - Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --bg-dark: #070c12;
            --card-bg: #101720;
            --accent-green: #10b981;
            --accent-green-hover: #059669;
            --input-bg: #182230;
            --text-muted: #94a3b8;
        }

        body {
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(circle at 50% 30%, rgba(16, 185, 129, 0.15) 0%, transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(5, 150, 105, 0.1) 0%, transparent 50%);
            background-attachment: fixed;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            padding: 40px 32px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        .card-top-pill {
            width: 40px;
            height: 5px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            margin: 0 auto 28px auto;
        }

        .brand-logo-wrapper {
            width: 72px;
            height: 72px;
            background: var(--accent-green);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px auto;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.35);
        }

        .brand-logo-wrapper i {
            font-size: 32px;
            color: #ffffff;
        }

        .login-title {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
            text-align: center;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .login-subtitle {
            font-size: 13.5px;
            color: var(--text-muted);
            text-align: center;
            line-height: 1.5;
            margin-bottom: 32px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 18px;
        }

        .input-group-custom i.input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 18px;
            z-index: 5;
            transition: color 0.2s;
        }

        .form-control-custom {
            background-color: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 14px 18px 14px 48px;
            color: #ffffff;
            font-size: 14px;
            width: 100%;
            transition: all 0.2s ease;
        }

        .form-control-custom::placeholder {
            color: #475569;
        }

        .form-control-custom:focus {
            background-color: var(--input-bg);
            border-color: var(--accent-green);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
            color: #ffffff;
            outline: none;
        }

        .toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            cursor: pointer;
            font-size: 18px;
            z-index: 5;
        }

        .form-check-input {
            background-color: var(--input-bg);
            border-color: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--accent-green);
            border-color: var(--accent-green);
        }

        .form-check-label {
            font-size: 13px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 13px;
            color: var(--accent-green);
            text-decoration: none;
            font-weight: 600;
        }

        .btn-submit {
            background-color: var(--accent-green);
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 14px;
            font-size: 15px;
            font-weight: 700;
            width: 100%;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
        }

        .btn-submit:hover {
            background-color: var(--accent-green-hover);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="card-top-pill"></div>

    <div class="brand-logo-wrapper">
        <i class="bi bi-cart-fill"></i>
    </div>

    <h1 class="login-title">Remon Thrift House</h1>
    <p class="login-subtitle">Masuk untuk mengelola transaksi toko secara real-time</p>

    @if(session('error'))
        <div class="alert alert-danger py-2 px-3 mb-3 border-0 rounded-3" style="background: rgba(239, 68, 68, 0.15); color: #f87171; font-size: 13px;">
            <i class="bi bi-exclamation-circle-fill me-1"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <div class="input-group-custom">
            <input 
                type="email" 
                name="email" 
                class="form-control-custom @error('email') is-invalid @enderror" 
                placeholder="Alamat Email Perusahaan"
                value="{{ old('email') }}"
                required 
                autofocus>
            <i class="bi bi-envelope input-icon"></i>
            @error('email')
                <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group-custom">
            <input 
                type="password" 
                name="password" 
                id="passwordInput"
                class="form-control-custom @error('password') is-invalid @enderror" 
                placeholder="Kata Sandi Rahasia"
                required>
            <i class="bi bi-lock input-icon"></i>
            <i class="bi bi-eye toggle-password" id="toggleIcon" onclick="togglePassword()"></i>
            @error('password')
                <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                <label class="form-check-label" for="rememberMe">
                    Ingat saya
                </label>
            </div>
            <a href="#" class="forgot-link">Lupa sandi?</a>
        </div>

        <button type="submit" class="btn-submit">
            Masuk ke Dashboard <i class="bi bi-arrow-right ms-1"></i>
        </button>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>

</body>
</html>