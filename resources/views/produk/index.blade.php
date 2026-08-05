@extends('layouts.app')

@section('title', 'Remon Thrift House - Produk')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --bg-main: #090d16;
        --card-bg: #111827;
        --accent-emerald: #10b981;
        --accent-emerald-hover: #059669;
        --border-color: rgba(255, 255, 255, 0.08);
        --text-muted: #94a3b8;
    }

    body {
        background-color: var(--bg-main) !important;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        color: #f8fafc !important;
    }

    /* Header Section */
    .header-box {
        background: radial-gradient(circle at top left, rgba(16, 185, 129, 0.12), transparent 50%),
                    var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 24px 28px;
        margin-bottom: 24px;
    }

    .brand-pill {
        background: rgba(16, 185, 129, 0.15);
        color: var(--accent-emerald);
        font-size: 12px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid rgba(16, 185, 129, 0.3);
        display: inline-block;
        margin-bottom: 8px;
    }

    .btn-create {
        background: var(--accent-emerald) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 12px;
        font-weight: 700;
        padding: 12px 22px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
        text-decoration: none !important;
    }

    .btn-create:hover {
        background: var(--accent-emerald-hover) !important;
        transform: translateY(-2px);
    }

    /* Container Grid Produk */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    /* Card Produk Modern */
    .product-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-6px);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5), 0 0 15px rgba(16, 185, 129, 0.15);
    }

    /* Container Foto Produk & Ketajaman Gambar */
    .card-img-box {
        width: 100%;
        height: 240px;
        background: #0f172a;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        image-rendering: -webkit-optimize-contrast;
        transition: transform 0.3s ease;
    }

    .product-card:hover .card-img-box img {
        transform: scale(1.03);
    }

    .stock-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(8px);
        color: #38bdf8;
        border: 1px solid rgba(56, 189, 248, 0.3);
        font-weight: 700;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .uploader-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(6px);
        color: #e2e8f0;
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 8px;
    }

    /* Isi Card */
    .card-body-custom {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-title {
        font-size: 16px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 12px;
        line-height: 1.3;
        letter-spacing: -0.3px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Perbandingan Harga */
    .price-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 10px 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .price-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        margin-bottom: 2px;
        display: block;
    }

    .price-val-buy {
        font-size: 13px;
        font-weight: 600;
        color: #94a3b8;
    }

    .price-val-sell {
        font-size: 15px;
        font-weight: 800;
        color: var(--accent-emerald);
    }

    /* Tombol Aksi Sejajar Horizontal */
    .action-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 8px;
        margin-top: auto;
    }

    .btn-act {
        border: none !important;
        font-size: 12px;
        font-weight: 700;
        padding: 8px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: all 0.2s ease;
        text-decoration: none !important;
        cursor: pointer;
    }

    .btn-act-view {
        background: rgba(99, 102, 241, 0.15) !important;
        color: #818cf8 !important;
    }
    .btn-act-view:hover {
        background: #6366f1 !important;
        color: #ffffff !important;
    }

    .btn-act-edit {
        background: rgba(245, 158, 11, 0.15) !important;
        color: #fbbf24 !important;
    }
    .btn-act-edit:hover {
        background: #f59e0b !important;
        color: #ffffff !important;
    }

    .btn-act-delete {
        background: rgba(239, 68, 68, 0.15) !important;
        color: #f87171 !important;
        width: 100%;
    }
    .btn-act-delete:hover {
        background: #ef4444 !important;
        color: #ffffff !important;
    }

    /* Pencarian */
    .search-box {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 6px 14px;
        max-width: 400px;
    }

    .search-box input {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 14px;
    }

    .search-box input:focus {
        outline: none;
        box-shadow: none;
        background: transparent;
        color: #fff;
    }
</style>

<div class="container-fluid py-4 px-4">

    <div class="header-box d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <span class="brand-pill">👕 REMON THRIFT HOUSE</span>
            <h2 class="fw-extrabold text-white mb-1" style="font-weight: 800; font-size: 24px;">Katalog Produk</h2>
            <p class="text-muted mb-0" style="font-size: 13px;">Kelola stok dan harga koleksi thrift siap jual secara real-time.</p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('produk.create') }}" class="btn btn-create d-inline-flex align-items-center gap-2">
                <span>+</span> Tambah Produk Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 fade show mb-4" style="background: rgba(16, 185, 129, 0.15); color: #34d399; border-radius: 12px;" role="alert">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <form action="{{ route('produk.index') }}" method="GET">
            <div class="search-box d-flex align-items-center">
                <span class="text-muted me-2">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari produk...">
                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 ms-2" style="background: var(--accent-emerald); border: none;">Cari</button>
            </div>
        </form>
    </div>

    <div class="product-grid">
        @forelse($produk as $item)
        <div class="product-card">
            
            <div class="card-img-box">
                @if($item->foto)
                    <img 
                        src="{{ asset('storage/' . $item->foto) }}" 
                        alt="{{ $item->nama_produk ?? 'Produk' }}"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/400x300?text=No+Image';">
                @else
                    <div class="text-center text-muted">
                        <div style="font-size: 32px;">👕</div>
                        <span style="font-size: 11px;">Tanpa Foto</span>
                    </div>
                @endif

                <span class="stock-badge">
                    Stok: {{ $item->stok ?? $item->stock ?? 0 }}
                </span>

                <span class="uploader-badge">
                    👤 {{ optional($item->user)->name ?? 'Admin' }}
                </span>
            </div>

            <div class="card-body-custom">
                <h3 class="product-title">
                    {{ $item->nama_produk ?? $item->nama ?? 'NAMA PRODUK' }}
                </h3>

                <div class="price-container">
                    <div>
                        <span class="price-label">Harga Beli</span>
                        <div class="price-val-buy">
                            Rp {{ number_format($item->harga_beli ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="price-label">Harga Jual</span>
                        <div class="price-val-sell">
                            Rp {{ number_format($item->harga_jual ?? $item->harga ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="action-grid">
                    <a href="{{ route('produk.show', $item) }}" class="btn-act btn-act-view" title="Detail">
                        👁️ Lihat
                    </a>

                    <a href="{{ route('produk.edit', $item) }}" class="btn-act btn-act-edit" title="Edit">
                        ✏️ Edit
                    </a>

                    <form action="{{ route('produk.destroy', $item) }}" method="POST" class="d-inline m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-act btn-act-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" title="Hapus">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>

        </div>
        @empty
        <div class="col-12 text-center py-5" style="grid-column: 1 / -1; background: var(--card-bg); border-radius: 18px; border: 1px dashed var(--border-color);">
            <div class="py-4">
                <div style="font-size: 48px;" class="mb-2">🛍️</div>
                <h5 class="text-white font-weight-bold mb-1">Belum Ada Produk</h5>
                <p class="text-muted small">Klik "+ Tambah Produk Baru" untuk menambahkan koleksi barang thrift.</p>
            </div>
        </div>
        @endforelse
    </div>

    @if(method_exists($produk, 'links'))
    <div class="d-flex justify-content-center mt-5">
        {{ $produk->appends(request()->query())->links() }}
    </div>
    @endif

</div>

@endsection