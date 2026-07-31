@extends('layouts.app')

@section('title', 'Penjualan')

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

    /* Kartu Utama Mewah */
    .page-card {
        background: #ffffff;
        border-radius: var(--radius-card);
        padding: 35px;
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.05), 0 0 1px 1px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(226, 232, 240, 0.8);
        position: relative;
        overflow: hidden;
    }

    .page-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #059669, #34d399, #047857);
    }

    .btn-modern {
        border-radius: var(--radius-element);
        font-weight: 600;
        padding: 12px 22px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .btn-success.btn-modern {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border: none;
        box-shadow: 0 8px 20px -4px rgba(5, 150, 105, 0.35);
    }

    .btn-success.btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -4px rgba(5, 150, 105, 0.45);
        background: linear-gradient(135deg, #047857 0%, #065f46 100%);
    }

    /* Kotak Pencarian Elegan */
    .search-box {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: var(--radius-element);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .search-box:focus-within {
        border-color: var(--primary-color);
        background: #ffffff;
        box-shadow: 0 0 0 5px var(--accent-glow);
    }

    .search-box .form-control {
        border: none;
        padding: 14px 20px;
        background: transparent;
        font-size: 14px;
        color: var(--text-main);
    }

    .search-box .form-control:focus {
        box-shadow: none;
    }

    /* Tabel Estetik */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 8px;
        width: 100%;
    }

    .table-modern thead th {
        background: #f1f5f9;
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        padding: 14px 18px;
        border: none;
    }

    .table-modern thead th:first-child {
        border-top-left-radius: var(--radius-element);
        border-bottom-left-radius: var(--radius-element);
    }

    .table-modern thead th:last-child {
        border-top-right-radius: var(--radius-element);
        border-bottom-right-radius: var(--radius-element);
    }

    .table-modern tbody tr {
        background: #ffffff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.01);
        transition: all 0.2s ease;
    }

    .table-modern tbody tr td {
        padding: 16px 18px;
        color: #334155;
        font-size: 14px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-modern tbody tr td:first-child {
        border-left: 1px solid #f1f5f9;
        border-top-left-radius: var(--radius-element);
        border-bottom-left-radius: var(--radius-element);
    }

    .table-modern tbody tr td:last-child {
        border-right: 1px solid #f1f5f9;
        border-top-right-radius: var(--radius-element);
        border-bottom-right-radius: var(--radius-element);
    }

    .table-modern tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
        background-color: #fafdfb;
    }

    /* Badge Kustom */
    .badge-method {
        background: #eff6ff;
        color: #1d4ed8;
        font-weight: 700;
        font-size: 11.5px;
        padding: 6px 14px;
        border-radius: 30px;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .badge-status {
        background: var(--primary-light);
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 11.5px;
        padding: 6px 14px;
        border-radius: 30px;
        border: 1px solid rgba(5, 150, 105, 0.2);
    }

    /* Tombol Aksi */
    .btn-action {
        padding: 6px 12px;
        font-size: 12.5px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-view {
        background: #eff6ff;
        color: #3b82f6;
        border: 1px solid #dbeafe;
    }
    .btn-view:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-1px);
    }

    .btn-edit {
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fef3c7;
    }
    .btn-edit:hover {
        background: #f59e0b;
        color: white;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
    }
    .btn-delete:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-1px);
    }

    /* Alert Modern */
    .alert-modern {
        border-radius: var(--radius-element);
        border: none;
        padding: 16px 20px;
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.1);
        font-weight: 500;
    }

    /* Pagination Kustom */
    .pagination {
        margin-top: 30px;
        margin-bottom: 0;
        justify-content: flex-end;
    }
    
    .page-item .page-link {
        border-radius: 12px;
        margin: 0 4px;
        color: var(--text-main);
        border: 1px solid #e2e8f0;
        font-size: 13px;
        font-weight: 600;
        padding: 10px 16px;
        background: #ffffff;
        transition: all 0.2s ease;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border-color: transparent;
        color: white;
        box-shadow: 0 6px 15px rgba(5, 150, 105, 0.3);
    }

    .page-item .page-link:hover:not(.active) {
        background-color: #f8fafc;
        color: var(--primary-dark);
        border-color: #cbd5e1;
    }
</style>

<div class="container-fluid py-4 px-4">

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="page-title mb-1">💰 Daftar Penjualan</h1>
            <p class="page-subtitle mb-0">Kelola riwayat data transaksi dan pencatatan kasir aplikasi POS dengan mudah.</p>
        </div>

        <a href="{{ route('penjualan.create') }}" class="btn btn-success btn-modern">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Penjualan Baru
        </a>
    </div>

    @if(session('errors'))
        <div class="alert alert-danger alert-modern mb-4">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('errors') }}
        </div>
    @endif

    <!-- Card Utama -->
    <div class="page-card">

        <!-- Search Form -->
        <form action="{{ route('penjualan.index') }}" method="GET" class="mb-4">
            <div class="input-group search-box">
                <span class="input-group-text bg-transparent border-0 ps-3 text-muted">
                    🔍
                </span>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Cari berdasarkan kasir atau kode transaksi...">
                <button class="btn px-4" style="background: var(--primary-color); color: white; border:none; font-weight: 600;">
                    Cari Transaksi
                </button>
            </div>
        </form>

        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="20%">Tanggal Transaksi</th>
                        <th width="18%">Kasir</th>
                        <th width="18%">Total Pembayaran</th>
                        <th width="13%">Metode</th>
                        <th width="10%">Status</th>
                        <th width="16%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td class="text-center text-muted fw-semibold">
                            {{ $sales->firstItem() + $loop->index }}
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ optional($sale->user)->name ?? 'Kasir Umum' }}</div>
                        </td>
                        <td>
                            <span class="fw-bold text-success" style="font-size: 14.5px;">Rp {{ number_format($sale->total_pembayaran,0,',','.') }}</span>
                        </td>
                        <td>
                            <span class="badge-method">
                                {{ $sale->metode_pembayaran }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-status">
                                {{ $sale->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('penjualan.show',$sale) }}"
                                   class="btn btn-sm btn-view btn-action"
                                   title="Detail">
                                    👁️ Lihat
                                </a>

                                @can('view',$sale)
                                <a href="{{ route('penjualan.edit',$sale) }}"
                                   class="btn btn-sm btn-edit btn-action"
                                   title="Edit">
                                    ✏️ Edit
                                </a>
                                @endcan

                                @can('delete',$sale)
                                <form action="{{ route('penjualan.destroy',$sale) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-delete btn-action"
                                        title="Hapus"
                                        onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                        🗑️ Hapus
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted py-4">
                                <div style="font-size: 48px;" class="mb-3">🧾</div>
                                <h5 class="fw-bold text-dark mb-1">Data Penjualan Kosong</h5>
                                <p class="text-muted mb-0">Belum ada transaksi yang tersedia di sistem saat ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-4">
            {{ $sales->appends(request()->query())->links() }}
        </div>

    </div>

</div>

@endsection