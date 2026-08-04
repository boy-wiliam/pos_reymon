@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --primary-indigo: #6366f1;
        --primary-indigo-dark: #4f46e5;
        --primary-indigo-light: rgba(99, 102, 241, 0.15);
        --text-dark: #1e293b;
        --text-muted: #64748b;
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
        color: #64748b !important;
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

    .table-modern tbody tr td {
        background-color: transparent !important;
        padding: 14px 18px !important;
        color: var(--text-dark) !important;
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

    /* Badges Soft Violet & Green */
    .badge-soft-indigo {
        background: rgba(99, 102, 241, 0.15) !important;
        color: #4f46e5 !important;
        font-weight: 700;
        font-size: 11px;
        padding: 5px 14px;
        border-radius: 20px;
        display: inline-block;
    }

    .badge-soft-success {
        background: #dcfce7 !important;
        color: #15803d !important;
        font-weight: 700;
        font-size: 11px;
        padding: 5px 14px;
        border-radius: 20px;
        display: inline-block;
    }

    .badge-soft-warning {
        background: #fef3c7 !important;
        color: #b45309 !important;
        font-weight: 700;
        font-size: 11px;
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
            <h1 class="page-title mb-1">💰 Daftar Penjualan</h1>
            <p class="page-subtitle mb-0">Kelola riwayat data transaksi dan pencatatan kasir aplikasi POS dengan mudah.</p>
        </div>

        <a href="{{ route('penjualan.create') }}" class="btn btn-indigo d-inline-flex align-items-center gap-2">
            <span style="font-size: 16px;">+</span> Tambah Penjualan Baru
        </a>
    </div>

    <!-- Statistik Singkat -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div>
                    <span class="stat-label">TOTAL TRANSAKSI</span>
                    <h4 class="fw-bold mb-0 text-white">{{ method_exists($sales, 'total') ? $sales->total() : count($sales) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(59, 130, 246, 0.15); color: #60a5fa;">💼</div>
                <div>
                    <span class="stat-label">STATUS SISTEM</span>
                    <h4 class="fw-bold mb-0 text-white">Aktif & Normal</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24;">⚡</div>
                <div>
                    <span class="stat-label">MODE OPERASIONAL</span>
                    <h4 class="fw-bold mb-0 text-white">POS Realtime</h4>
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
        <form action="{{ route('penjualan.index') }}" method="GET" class="mb-4">
            <div class="input-group search-box">
                <span class="input-group-text bg-transparent border-0 ps-3 text-muted">🔍</span>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Cari berdasarkan kasir atau metode pembayaran...">
                <button class="btn btn-indigo px-4">
                    Cari Data
                </button>
            </div>
        </form>

        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th width="4%" class="text-center">#</th>
                        <th width="20%">TANGGAL TRANSAKSI</th>
                        <th width="18%">KASIR</th>
                        <th width="18%">TOTAL PEMBAYARAN</th>
                        <th width="12%">METODE</th>
                        <th width="10%">STATUS</th>
                        <th width="18%" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td class="text-center text-muted fw-bold">
                            {{ method_exists($sales, 'firstItem') ? $sales->firstItem() + $loop->index : $loop->iteration }}
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $sale->created_at ? $sale->created_at->translatedFormat('d-m-Y H:i:s') : '-' }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ optional($sale->user)->name ?? 'Kasir Umum' }}</div>
                        </td>
                        <td>
                            <span class="fw-bold text-success" style="font-size: 14px;">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="badge-soft-indigo">
                                {{ strtoupper($sale->metode_pembayaran ?? 'CASH') }}
                            </span>
                        </td>
                        <td>
                            @if(strtoupper($sale->status ?? '') == 'OPEN')
                                <span class="badge-soft-warning">OPEN</span>
                            @else
                                <span class="badge-soft-success">COMPLETED</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-action-view" title="Detail">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-action-edit" title="Edit">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action-delete" title="Hapus" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted py-3">
                                <div style="font-size: 40px;" class="mb-2">🧾</div>
                                <h6 class="fw-bold mb-0">Data Penjualan Kosong</h6>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($sales, 'links'))
        <div class="d-flex justify-content-end mt-4">
            {{ $sales->appends(request()->query())->links() }}
        </div>
        @endif

    </div>

</div>

@endsection