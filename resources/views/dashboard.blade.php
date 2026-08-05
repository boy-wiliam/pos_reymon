@extends('layouts.app')

@section('title', 'Dashboard POS')

@section('content')

@include('layouts.navbar')

<style>
    /* Background Animasi Fluid Modern */
    body {
        background: linear-gradient(-45deg, #080c14, #0f172a, #032e27, #021f1b);
        background-size: 400% 400%;
        animation: gradientMove 18s ease infinite;
        min-height: 100vh;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    @keyframes gradientMove {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .dashboard-wrapper {
        padding: 35px 30px;
    }

    .dashboard-title {
        color: #ffffff;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .dashboard-subtitle {
        color: #94a3b8;
        font-size: 14px;
    }

    /* STAT CARDS ULTRA MODERN */
    .stat-card {
        border-radius: 20px;
        color: white;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
    }

    .stat-card:hover {
        transform: translateY(-6px) scale(1.01);
        background: rgba(255, 255, 255, 0.09);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 15px 35px -10px rgba(16, 185, 129, 0.2);
    }

    .stat-title {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(255, 255, 255, 0.7);
    }

    .stat-value {
        font-size: 26px;
        font-weight: 800;
        margin-top: 6px;
        letter-spacing: -0.5px;
        color: #ffffff;
    }

    .icon-box {
        font-size: 26px;
        background: rgba(255, 255, 255, 0.08);
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* CONTAINER BOX UNTUK TABEL */
    .table-box {
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border-radius: 24px;
        padding: 26px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.12);
    }

    .section-title {
        font-weight: 800;
        color: #ffffff !important;
        font-size: 17px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* PERBAIKAN TABEL & TEKS DOKUMEN */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 8px;
        width: 100%;
        margin: 0;
    }

    /* Header Tabel */
    .table-modern thead th {
        background: rgba(255, 255, 255, 0.08) !important;
        color: #38bdf8 !important;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        padding: 14px 18px;
        border: none;
    }

    .table-modern thead th:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-modern thead th:last-child  { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }

    /* Baris Tabel */
    .table-modern tbody tr {
        background: rgba(255, 255, 255, 0.05) !important;
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: rgba(255, 255, 255, 0.1) !important;
    }

    /* Sel Tabel */
    .table-modern tbody td {
        padding: 14px 18px;
        color: #f8fafc !important;
        font-size: 14px;
        border: none;
        vertical-align: middle;
    }

    /* Khusus Teks Nama Produk */
    .product-title {
        color: #ffffff !important;
        font-weight: 700;
    }

    /* Khusus Teks Kosong Data Empty State */
    .empty-state-text {
        color: #94a3b8 !important;
        font-size: 13.5px;
    }

    .table-modern tbody tr td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .table-modern tbody tr td:last-child  { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

    /* NEON BADGES */
    .badge-custom {
        border-radius: 30px;
        font-weight: 700;
        padding: 6px 14px;
        font-size: 11px;
        letter-spacing: 0.3px;
    }

    .badge-warning-custom {
        background: rgba(245, 158, 11, 0.25);
        color: #fde047 !important;
        border: 1px solid rgba(245, 158, 11, 0.5);
    }

    .badge-danger-custom {
        background: rgba(239, 68, 68, 0.25);
        color: #fca5a5 !important;
        border: 1px solid rgba(239, 68, 68, 0.5);
    }

    .badge-success-custom {
        background: rgba(16, 185, 129, 0.25);
        color: #6ee7b7 !important;
        border: 1px solid rgba(16, 185, 129, 0.5);
    }
</style>

<div class="container-fluid dashboard-wrapper">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="dashboard-title">Dashboard POS</h1>
            <p class="dashboard-subtitle mb-0">
                Ringkasan aktivitas toko hari ini &bull; <strong class="text-light">{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</strong>
            </p>
        </div>
        <div>
            <span class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill border border-white border-opacity-25 fs-6">
                🟢 Sistem Aktif & Normal
            </span>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)

        <h3 class="text-white fw-bold mb-3" style="font-size: 18px;">📊 Penjualan Hari Ini</h3>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-title">Total Penjualan</div>
                                <div class="stat-value">Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</div>
                            </div>
                            <div class="icon-box">💰</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-title">Jumlah Transaksi</div>
                                <div class="stat-value">
                                    {{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} 
                                    <span class="fs-6 fw-normal text-white opacity-75">Struk</span>
                                </div>
                            </div>
                            <div class="icon-box">🧾</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="text-white fw-bold mb-3" style="font-size: 18px;">💳 Status Pembayaran</h3>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-title">Pembayaran Tunai (Cash)</div>
                                <div class="stat-value">Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</div>
                            </div>
                            <div class="icon-box">💵</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-title">Pembayaran Non Tunai</div>
                                <div class="stat-value">Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</div>
                            </div>
                            <div class="icon-box">💳</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcan

    <div class="row g-4 mb-4">

        <div class="col-md-6">
            <div class="table-box h-100 d-flex flex-column justify-content-between">
                <div>
                    <h3 class="section-title">⚠️ Produk Stok Rendah</h3>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th width="15%">#</th>
                                    <th>Nama Produk</th>
                                    <th width="30%">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkStokRendah as $index => $produk)
                                    <tr>
                                        <td class="fw-bold" style="color: #94a3b8;">{{ $produkStokRendah->firstItem() + $index }}</td>
                                        <td class="product-title">{{ $produk->nama }}</td>
                                        <td>
                                            <span class="badge badge-custom badge-warning-custom">
                                                ⚠️ {{ $produk->stok }} Unit
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 empty-state-text">Stok aman, tidak ada produk menipis</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $produkStokRendah->links() }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="table-box h-100 d-flex flex-column justify-content-between">
                <div>
                    <h3 class="section-title">❌ Produk Habis Stok</h3>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th width="15%">#</th>
                                    <th>Nama Produk</th>
                                    <th width="30%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkStokHabis as $index => $produk)
                                    <tr>
                                        <td class="fw-bold" style="color: #94a3b8;">{{ $produkStokHabis->firstItem() + $index }}</td>
                                        <td class="product-title">{{ $produk->nama }}</td>
                                        <td>
                                            <span class="badge badge-custom badge-danger-custom">Habis Total</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 empty-state-text">Tidak ada produk yang habis</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $produkStokHabis->links() }}
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-box">
                <h3 class="section-title">🔥 Produk Terlaris Bulan Ini</h3>
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th width="20%">Stok Tersisa</th>
                                <th width="25%">Total Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTerlaris as $produk)
                                <tr>
                                    <td class="product-title">{{ $produk->nama }}</td>
                                    <td style="color: #cbd5e1; font-weight: 600;">{{ $produk->stok }} Unit</td>
                                    <td>
                                        <span class="badge badge-custom badge-success-custom">
                                            🔥 {{ $produk->total_terjual }} Unit Terjual
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 empty-state-text">Belum ada data penjualan produk bulan ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection