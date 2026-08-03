@extends('layouts.app')

@section('title', 'Edit Pengguna - ' . $user->name)

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --accent-color: #f59e0b;
        --accent-dark: #d97706;
        --accent-light: #fffbeb;
        --text-main: #0f172a;
        --text-muted: #64748b;
        --radius-card: 24px;
        --radius-element: 14px;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', 'Inter', system-ui, -apple-system, sans-serif;
        color: var(--text-main);
    }

    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .breadcrumb-custom a {
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb-custom a:hover {
        color: var(--accent-dark);
    }

    .page-title {
        color: var(--text-main);
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 500;
    }

    /* Form Main Card */
    .form-card {
        background: #ffffff;
        border-radius: var(--radius-card);
        padding: 36px;
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.04), 0 0 1px 1px rgba(0, 0, 0, 0.02);
        border: 1px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #f59e0b, #fbbf24, #d97706);
    }

    /* Info Sidebar Card */
    .info-card {
        background: #ffffff;
        border-radius: var(--radius-card);
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.04);
    }

    .info-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-list {
        padding-left: 0;
        list-style: none;
        margin-bottom: 0;
        font-size: 13px;
        color: var(--text-muted);
    }

    .info-list li {
        margin-bottom: 10px;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .info-list li:last-child {
        margin-bottom: 0;
    }

    /* Buttons */
    .btn-modern {
        border-radius: var(--radius-element);
        font-weight: 600;
        padding: 12px 22px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .btn-update {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        color: white;
        box-shadow: 0 8px 20px -4px rgba(245, 158, 11, 0.35);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px -4px rgba(245, 158, 11, 0.45);
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        color: white;
    }

    .btn-back {
        background: #ffffff;
        color: var(--text-muted);
        border: 1px solid #cbd5e1;
    }

    .btn-back:hover {
        background: #f1f5f9;
        color: var(--text-main);
        border-color: #94a3b8;
    }
</style>

<div class="container-fluid py-4 px-4">

    <div class="row justify-content-center mb-4">
        <div class="col-xl-11">
            
            <div class="breadcrumb-custom">
                <a href="{{ route('admin.users') }}">Pengelolaan Pengguna</a>
                <span>/</span>
                <span class="text-dark fw-semibold">Edit Pengguna</span>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h1 class="page-title mb-1">Edit Pengguna</h1>
                    <p class="page-subtitle mb-0">Perbarui informasi akun dan hak akses untuk <strong class="text-dark">{{ $user->name }}</strong></p>
                </div>

                <a href="{{ route('admin.users') }}" class="btn btn-back btn-modern">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kembali
                </a>
            </div>

        </div>
    </div>

    <div class="row justify-content-center g-4">
        
        <div class="col-xl-8 col-lg-7">
            <div class="form-card">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                 

                    @include('users._form')

                    <div class="d-flex justify-content-end align-items-center gap-3 mt-5 pt-4 border-top">
                        <a href="{{ route('admin.users') }}" class="btn btn-back btn-modern px-4">Batal</a>
                        <button type="submit" class="btn btn-update btn-modern px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-3 col-lg-5">
            <div class="info-card">
                <div class="info-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    Catatan Perubahan
                </div>
                <ul class="info-list">
                    <li>
                        <span>🔑</span>
                        <span><strong>Kata Sandi:</strong> Biarkan bidang kata sandi kosong jika tidak ingin menguubahnya.</span>
                    </li>
                    <li>
                        <span>📧</span>
                        <span><strong>Perubahan Email:</strong> Pastikan email baru yang dimasukkan belum terdaftar pada akun lain.</span>
                    </li>
                    <li>
                        <span>🛡️</span>
                        <span><strong>Akses Peran:</strong> Mengubah peran (role) akan berdampak langsung pada hak akses pengguna saat login berikutnya.</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</div>

@endsection