@extends('layouts.app')

@section('title', 'Remon Thrift House - Katalog Produk')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --bg-main: #090d16;
        --card-bg: rgba(17, 24, 39, 0.75);
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

    /* Header Container */
    .header-box {
        background: radial-gradient(circle at top left, rgba(16, 185, 129, 0.15), transparent 60%),
                    #111827;
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 28px 32px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .brand-pill {
        background: rgba(16, 185, 129, 0.12);
        color: var(--accent-emerald);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.5px;
        padding: 5px 14px;
        border-radius: 30px;
        border: 1px solid rgba(16, 185, 129, 0.3);
        display: inline-block;
    }

    .btn-create {
        background: linear-gradient(135deg, #10b981, #059669) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        padding: 12px 24px;
        transition: all 0.25s ease;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
        text-decoration: none !important;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(16, 185, 129, 0.35);
    }

    /* Form Pencarian UI */
    .search-container {
        background: #111827;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 6px 10px 6px 16px;
        transition: all 0.2s ease;
    }

    .search-container:focus-within {
        border-color: rgba(16, 185, 129, 0.5);
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.15);
    }

    .search-input {
        background: transparent !important;
        border: none !important;
        color: #ffffff !important;
        font-size: 14px;
        box-shadow: none !important;
    }

    .search-input::placeholder {
        color: var(--text-muted);
    }

    /* Responsive Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
    }

    /* Product Card Glassmorphism */
    .product-card {
        background: var(--card-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-6px);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 18px 36px -10px rgba(0, 0, 0, 0.6), 0 0 20px rgba(16, 185, 129, 0.12);
    }

    /* Box Gambar & Aspect Ratio */
    .card-img-box {
        width: 100%;
        height: 250px;
        background: #0b1120;
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
        transition: transform 0.4s ease;
    }

    .product-card:hover .card-img-box img {
        transform: scale(1.05);
    }

    /* Badges */
    .badge-float {
        position: absolute;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        font-weight: 700;
        font-size: 11px;
        padding: 5px 12px;
        border-radius: 30px;
    }

    .stock-badge-normal {
        top: 12px;
        right: 12px;
        background: rgba(15, 23, 42, 0.8);
        color: #38bdf8;
        border: 1px solid rgba(56, 189, 248, 0.3);
    }

    .stock-badge-low {
        top: 12px;
        right: 12px;
        background: rgba(245, 158, 11, 0.2);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.4);
    }

    .stock-badge-empty {
        top: 12px;
        right: 12px;
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.4);
    }

    .uploader-badge {
        bottom: 12px;
        left: 12px;
        background: rgba(0, 0, 0, 0.65);
        color: #cbd5e1;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Card Content */
    .card-body-custom {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-title {
        font-size: 15px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 14px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 42px;
    }

    /* Box Pricing */
    .price-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 14px;
        padding: 10px 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .price-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--text-muted);
        font-weight: 700;
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

    /* Buttons Action Group */
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
        padding: 9px 4px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
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
</style>

<div class="container-fluid py-4 px-md-4">

    <div class="header-box d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="brand-pill mb-2">👕 REMON THRIFT HOUSE</span>
            <h2 class="fw-bold text-white mb-1" style="font-size: 24px;">Katalog Produk</h2>
            <p class="text-muted mb-0" style="font-size: 13px;">Kelola stok dan daftar harga koleksi thrift secara real-time.</p>
        </div>

        <div>
            <a href="{{ route('produk.create') }}" class="btn btn-create d-inline-flex align-items-center gap-2">
                <span class="fs-5">+</span> Tambah Produk Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 fade show mb-4 d-flex align-items-center gap-2" style="background: rgba(16, 185, 129, 0.15); color: #34d399; border-radius: 14px;" role="alert">
            <span>✓</span>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="mb-4">
        <form action="{{ route('produk.index') }}" method="GET" class="d-flex max-w-md">
            <div class="search-container d-flex align-items-center w-100" style="max-width: 420px;">
                <span class="text-muted me-2">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Cari nama produk thrift...">
                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3" style="background: var(--accent-emerald); border: none; font-weight: 700;">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <div class="product-grid">
        @forelse($produk as $item)
            @php 
                $stok = $item->stok ?? $item->stock ?? 0;
            @endphp
            
            <div class="product-card">
                <div class="card-img-box">
                    @if($item->foto)
                        <img 
                            src="{{ asset('storage/' . $item->foto) }}" 
                            alt="{{ $item->nama_produk ?? 'Produk Thrift' }}"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='https://via.placeholder.com/400x300/0f172a/94a3b8?text=No+Image';">
                    @else
                        <div class="text-center text-muted">
                            <div style="font-size: 36px;">👕</div>
                            <span style="font-size: 11px;" class="fw-semibold">Tanpa Foto</span>
                        </div>
                    @endif

                    @if($stok == 0)
                        <span class="badge-float stock-badge-empty">Habis Total</span>
                    @elseif($stok <= 3)
                        <span class="badge-float stock-badge-low">Sisa {{ $stok }}</span>
                    @else
                        <span class="badge-float stock-badge-normal">Stok: {{ $stok }}</span>
                    @endif

                    <span class="badge-float uploader-badge">
                        👤 {{ optional($item->user)->name ?? 'Admin' }}
                    </span>
                </div>

                <div class="card-body-custom">
                    <h3 class="product-title" title="{{ $item->nama_produk ?? $item->nama }}">
                        {{ $item->nama_produk ?? $item->nama ?? 'NAMA PRODUK' }}
                    </h3>

                    <div class="price-container">
                        <div>
                            <span class="price-label">Modal</span>
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
                        <a href="{{ route('produk.show', $item) }}" class="btn-act btn-act-view" title="Lihat Detail">
                            👁️ Detail
                        </a>

                        <a href="{{ route('produk.edit', $item) }}" class="btn-act btn-act-edit" title="Edit Data">
                            ✏️ Edit
                        </a>

                        <form action="{{ route('produk.destroy', $item) }}" method="POST" class="d-inline m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-act btn-act-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')" title="Hapus Produk">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5" style="grid-column: 1 / -1; background: var(--card-bg); border-radius: 20px; border: 1px dashed var(--border-color);">
                <div class="py-4">
                    <div style="font-size: 52px;" class="mb-2">🛍️</div>
                    <h5 class="text-white fw-bold mb-1">Belum Ada Koleksi Produk</h5>
                    <p class="text-muted small mb-0">Klik "+ Tambah Produk Baru" untuk menambahkan koleksi baju/barang thrift baru.</p>
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