@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --primary-indigo: #6366f1;
        --primary-indigo-dark: #4f46e5;
        --primary-indigo-light: rgba(99, 102, 241, 0.15);
        --radius-card: 16px;
        --radius-element: 10px;
    }

    body {
        background-color: #0d1117 !important;
        background-image: 
            radial-gradient(circle at 20% 10%, rgba(99, 102, 241, 0.1) 0%, transparent 40%),
            radial-gradient(circle at 80% 90%, rgba(79, 70, 229, 0.08) 0%, transparent 40%) !important;
        background-attachment: fixed !important;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        color: #f8fafc !important;
    }

    .page-title {
        color: #ffffff !important;
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        color: #94a3b8 !important;
        font-size: 13.5px;
    }

    /* Stat Card */
    .stat-card {
        background: #161b26 !important;
        border-radius: var(--radius-card);
        padding: 18px 22px;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: rgba(99, 102, 241, 0.15);
        color: #818cf8;
    }

    .stat-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.8px;
        color: #64748b !important;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    /* Main Card */
    .page-card {
        background: #111622 !important;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-top: 2px solid var(--primary-indigo) !important;
    }

    /* Primary Button Indigo */
    .btn-indigo {
        background: var(--primary-indigo) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: var(--radius-element);
        font-weight: 600;
        padding: 10px 20px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-indigo:hover {
        background: var(--primary-indigo-dark) !important;
        transform: translateY(-1px);
    }

    /* Search Box */
    .search-box {
        background: #0b0f19 !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: var(--radius-element);
        overflow: hidden;
    }

    .search-box .form-control {
        border: none !important;
        padding: 10px 16px;
        background: transparent !important;
        font-size: 14px;
        color: #ffffff !important;
    }

    .search-box .form-control::placeholder {
        color: #475569 !important;
    }

    /* Table Matching Users Style */
    .table-modern {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
        width: 100%;
        background: transparent !important;
    }

    .table-modern thead th {
        background: transparent !important;
        color: #94a3b8 !important;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.8px;
        padding: 0 16px 8px 16px;
        border: none !important;
    }

    /* White Card Rows */
    .table-modern tbody tr {
        background-color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        transition: all 0.2s ease;
    }

    .table-modern tbody tr td,
    .table-modern tbody tr td * {
        color: #0f172a !important;
    }

    .table-modern tbody tr td {
        background-color: transparent !important;
        padding: 14px 18px !important;
        font-size: 13.5px;
        border: none !important;
        vertical-align: middle;
    }

    .table-modern tbody tr td:first-child {
        border-top-left-radius: 12px !important;
        border-bottom-left-radius: 12px !important;
    }

    .table-modern tbody tr td:last-child {
        border-top-right-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }

    /* ==========================================
       HD IMAGE OPTIMIZATION (Bikin Foto Tajam)
       ========================================== */
    .product-img-wrapper {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        overflow: hidden;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.06);
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        /* Force rendering tajam/HD di browser webkit & modern */
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }

    /* Badge Stock Soft Violet */
    .badge-soft-indigo {
        background: rgba(99, 102, 241, 0.12) !important;
        color: #4f46e5 !important;
        font-weight: 700;
        font-size: 12px;
        padding: 5px 14px;
        border-radius: 20px;
        display: inline-block;
    }

    /* Action Buttons Soft */
    .btn-action-view {
        background: #e0e7ff !important;
        color: #3730a3 !important;
        border: none !important;
        font-weight: 600;
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 8px;
    }

    .btn-action-edit {
        background: #fef3c7 !important;
        color: #d97706 !important;
        border: none !important;
        font-weight: 600;
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 8px;
    }

    .btn-action-delete {
        background: #fce7f3 !important;
        color: #db2777 !important;
        border: none !important;
        font-weight: 600;
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 8px;
    }
</style>

<div class="container-fluid py-4 px-4">

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="page-title mb-1">📦 Daftar Produk</h1>
            <p class="page-subtitle mb-0">Kelola data inventaris dan produk barang aplikasi POS dengan mudah.</p>
        </div>

        <a href="{{ route('produk.create') }}" class="btn btn-indigo d-inline-flex align-items-center gap-2">
            <span style="font-size: 16px;">+</span> Tambah Produk Baru
        </a>
    </div>

    <!-- Statistik Singkat -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div>
                    <span class="stat-label">TOTAL PRODUK</span>
                    <h4 class="fw-bold mb-0 text-white">{{ method_exists($products, 'total') ? $products->total() : count($products) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(59, 130, 246, 0.15); color: #60a5fa;">💼</div>
                <div>
                    <span class="stat-label">STATUS INVENTARIS</span>
                    <h4 class="fw-bold mb-0 text-white">Terkontrol</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24;">⚡</div>
                <div>
                    <span class="stat-label">SISTEM GUDANG</span>
                    <h4 class="fw-bold mb-0 text-white">Aktif & Sinkron</h4>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success fade show mb-4" style="background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 10px;" role="alert">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Card Utama -->
    <div class="page-card">

        <!-- Search Form -->
        <form action="{{ route('produk.index') }}" method="GET" class="mb-4">
            <div class="input-group search-box">
                <span class="input-group-text bg-transparent border-0 ps-3 text-muted">🔍</span>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Cari berdasarkan nama produk...">
                <button class="btn btn-indigo px-4">
                    Cari Produk
                </button>
            </div>
        </form>

        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th width="4%" class="text-center">#</th>
                        <th width="14%">PENGINPUT</th>
                        <th width="8%">FOTO</th>
                        <th width="22%">NAMA PRODUK</th>
                        <th width="15%">HARGA BELI</th>
                        <th width="15%">HARGA JUAL</th>
                        <th width="8%" class="text-center">STOK</th>
                        <th width="14%" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="text-center fw-bold" style="color: #64748b !important;">
                            {{ method_exists($products, 'firstItem') ? $products->firstItem() + $loop->index : $loop->iteration }}
                        </td>
                        <td>
                            <div class="fw-bold" style="color: #0f172a !important;">{{ optional($product->user)->name ?? 'Admin POS' }}</div>
                        </td>
                        <td>
                            <div class="product-img-wrapper">
                                @if($product->foto)
                                    <img src="{{ asset('storage/' . $product->foto) }}" alt="foto" class="product-img">
                                @else
                                    <span style="font-size: 20px;">🖼️</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-uppercase" style="color: #0f172a !important; font-size: 14px;">
                                {{ $product->nama_produk ?? $product->nama ?? $product->product_name ?? $product->name ?? 'NAMA KOSONG' }}
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold" style="color: #334155 !important;">
                                Rp {{ number_format($product->harga_beli ?? $product->harga_modal ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-bold" style="color: #16a34a !important; font-size: 14px;">
                                Rp {{ number_format($product->harga_jual ?? $product->harga ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge-soft-indigo" style="color: #4f46e5 !important;">
                                {{ $product->stok ?? $product->stock ?? 0 }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('produk.show', $product) }}" class="btn btn-action-view" title="Detail" style="color: #3730a3 !important;">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('produk.edit', $product) }}" class="btn btn-action-edit" title="Edit" style="color: #d97706 !important;">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action-delete" title="Hapus" style="color: #db2777 !important;" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="text-muted py-3">
                                <div style="font-size: 40px;" class="mb-2">📦</div>
                                <h6 class="fw-bold mb-0" style="color: #64748b !important;">Data Produk Kosong</h6>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($products, 'links'))
        <div class="d-flex justify-content-end mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>
        @endif

    </div>

</div>

@endsection