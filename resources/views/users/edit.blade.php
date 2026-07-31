@extends('layouts.app')

@section('title', 'Edit Pengguna - ' . $user->name)

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --primary-color: #059669;
        --primary-dark: #047857;
        --primary-light: #ecfdf5;
        --accent-glow: rgba(5, 150, 105, 0.15);
        --text-main: #0f172a;
        --text-muted: #64748b;
        --radius-card: 28px;
        --radius-element: 16px;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .page-title {
        color: var(--text-main);
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -0.75px;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 500;
    }

    /* Kartu Form Utama */
    .form-card {
        background: #ffffff;
        border-radius: var(--radius-card);
        padding: 40px;
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.05), 0 0 1px 1px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(226, 232, 240, 0.8);
        position: relative;
        overflow: hidden;
        max-width: 850px;
        margin: 0 auto;
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

    /* Tombol Kembali & Aksi */
    .btn-modern {
        border-radius: var(--radius-element);
        font-weight: 600;
        padding: 12px 24px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .btn-update {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        color: white;
        box-shadow: 0 8px 20px -4px rgba(245, 158, 11, 0.35);
    }

    .btn-update:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -4px rgba(245, 158, 11, 0.45);
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        color: white;
    }

    .btn-back {
        background: #f1f5f9;
        color: var(--text-muted);
        border: 1px solid #e2e8f0;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: var(--text-main);
    }
</style>

<div class="container-fluid py-4 px-4">

    <!-- Header Section -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-9">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h1 class="page-title mb-1">✏️ Edit Pengguna</h1>
                    <p class="page-subtitle mb-0">Perbarui informasi akun dan hak akses untuk <strong class="text-dark">{{ $user->name }}</strong></p>
                </div>

                <a href="{{ route('admin.users') }}" class="btn btn-back btn-modern">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="form-card">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Memanggil Form Partial -->
                    @include('users._form')

                    <!-- Tombol Aksi Form -->
                    <div class="d-flex justify-content-end align-items-center gap-3 mt-5 pt-3 border-top">
                        <a href="{{ route('admin.users') }}" class="btn btn-back btn-modern px-4">Batal</a>
                        <button type="submit" class="btn btn-update btn-modern px-5">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection