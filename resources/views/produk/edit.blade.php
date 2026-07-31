@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --primary-color: #059669;
        --primary-dark: #047857;
        --primary-light: #ecfdf5;
        --accent-glow: rgba(5, 150, 105, 0.08);
        --text-main: #0f172a;
        --text-muted: #64748b;
        --radius-card: 24px;
        --radius-element: 14px;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Poppins', sans-serif;
    }

    /* Header & Title Styling */
    .page-header-wrapper {
        max-width: 900px;
        margin: 0 auto 24px auto;
        position: relative;
    }

    .btn-back-modern {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 10px;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .btn-back-modern:hover {
        background: var(--primary-light);
        color: var(--primary-dark);
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    .page-title {
        color: var(--text-main);
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -0.7px;
        background: linear-gradient(135deg, #0f172a 30%, #334155 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 500;
    }

    /* Luxurious Glassmorphic Card */
    .page-card-luxury {
        background: #ffffff;
        border-radius: var(--radius-card);
        padding: 40px;
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.05), 0 0 0 1px rgba(226, 232, 240, 0.8);
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
    }

    .page-card-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #059669, #34d399, #059669);
    }
</style>

<div class="container-fluid py-4 px-4">

    <!-- Header Section -->
    <div class="page-header-wrapper">
        <div class="mb-3">
            <a href="{{ route('produk.index') ?? url()->previous() }}" class="btn-back-modern">
                ← Kembali ke Daftar Produk
            </a>
        </div>
        <h1 class="page-title mb-1">✏️ Edit Data Produk</h1>
        <p class="page-subtitle mb-0">Perbarui spesifikasi, harga, dan manajemen inventaris produk dengan presisi</p>
    </div>

    <!-- Main Luxury Card Form -->
    <div class="page-card-luxury">
        <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @include('Produk._form')
        </form>
    </div>

</div>

@endsection