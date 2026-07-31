@extends('layouts.app')

@section('title', 'Dashboard POS')

@section('content')

@include('layouts.navbar')

<style>
    /* Background Animasi Modern */
    body {
        background: linear-gradient(-45deg, #090d16, #1e1b4b, #1e3a8a, #042f2e);
        background-size: 400% 400%;
        animation: gradientMove 18s ease infinite;
        min-height: 100vh;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
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

    /* STAT CARDS MODERN */
    .stat-card {
        border: none;
        border-radius: 20px;
        color: white;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.3);
        position: relative;
        background-blend-mode: overlay;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 100%);
        pointer-events: none;
    }

    .stat-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
    }

    .gradient-blue { background: linear-gradient(135deg, #1d4ed8 100%, #3b82f6 0%); }
    .gradient-purple { background: linear-gradient(135deg, #6d28d9 100%, #8b5cf6 0%); }
    .gradient-green { background: linear-gradient(135deg, #047857 100%, #10b981 0%); }
    .gradient-orange { background: linear-gradient(135deg, #c2410c 100%, #f97316 0%); }

    .stat-title {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(255, 255, 255, 0.8);
    }

    .stat-value {
        font-size: 24px;
        font-weight: 800;
        margin-top: 6px;
        letter-spacing: -0.5px;
    }

    .icon-box {
        font-size: 30px;
        background: rgba(255, 255, 255, 0.12);
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        backdrop-filter: blur(8px);
        box-shadow: inset 0 1px 1px rgba(255,255,255,0.3);
    }

    /* TABLES & BOXES (Glassmorphism Effect) */
    .table-box {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: transform 0.3s ease;
    }

    .table-box:hover {
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    .section-title {
        font-weight: 800;
        color: #0f172a;
        font-size: 17px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-modern {
        border-collapse: separate;
        border-spacing: 0 8px; /* Memberi jarak antar baris tabel */
        width: 100%;
    }

    .table-modern thead th {
        background: #0f172a;
        color: #f8fafc;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 10px;
        letter-spacing: 1px;
        padding: 12px 16px;
        border: none;
    }

    .table-modern thead th:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-modern thead th:last-child { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }

    .table-modern tbody tr {
        background: #f8fafc;
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f1f5f9;
        transform: scale(1.005);
    }

    .table-modern tbody td {
        padding: 12px 16px;
        color: #334155;
        font-size: 13px;
        border: none;
        vertical-align: middle;
    }

    .table-modern tbody tr td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .table-modern tbody tr td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

    .badge-custom {
        border-radius: 30px;
        font-weight: 700;
        padding: 6px 12px;
        font-size: 11px;
        letter-spacing: 0.3px;
    }
</style>

<div class="container-fluid dashboard-wrapper">

    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="dashboard-title">Dashboard POS</h1>
            <p class="dashboard-subtitle mb-0">
                Ringkasan aktivitas toko hari ini &bull; <strong class="text-light">{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</strong>
            </p>
        </div>
        <div>
            <span class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill border border-white border-opacity-2q fs-6">
                🟢 Sistem Aktif & Normal
            </span>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)

        <!-- Sales Section -->
        <h3 class="text-white fw-bold mb-3" style="font-size: 18px;">📊 Penjualan Hari Ini</h3>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card stat-card gradient-blue">
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
                <div class="card stat-card gradient-purple">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-title">Jumlah Transaksi</div>
                                <div class="stat-value">{{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} <span class="fs-6 fw-normal opacity-75">Struk</span></div>
                            </div>
                            <div class="icon-box">🧾</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status Section -->
        <h3 class="text-white fw-bold mb-3" style="font-size: 18px;">💳 Status Pembayaran</h3>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card stat-card gradient-green">
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
                <div class="card stat-card gradient-orange">
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

    <!-- Tables Grid Section -->
    <div class="row g-4 mb-4">
        
        <!-- Produk Stok Rendah -->
        <div class="col-md-6">
            <div class="table-box h-100 d-flex flex-column justify-content-between">
                <div>
                    <h3 class="section-title">⚠️ Produk Stok Rendah</h3>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th width="15%">#</th>
                                    <th>Nama Produk</th>
                                    <th width="25%">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkStokRendah as $index => $produk)
                                    <tr>
                                        <td class="text-muted fw-bold">{{ $produkStokRendah->firstItem() + $index }}</td>
                                        <td class="fw-bold text-dark">{{ $produk->nama }}</td>
                                        <td>
                                            <span class="badge badge-custom bg-warning text-dark">
                                                ⚠️ {{ $produk->stok }} Unit
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">Stok aman, tidak ada produk menipis</td>
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

        <!-- Produk Habis Stok -->
        <div class="col-md-6">
            <div class="table-box h-100 d-flex flex-column justify-content-between">
                <div>
                    <h3 class="section-title">❌ Produk Habis Stok</h3>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th width="15%">#</th>
                                    <th>Nama Produk</th>
                                    <th width="25%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkStokHabis as $index => $produk)
                                    <tr>
                                        <td class="text-muted fw-bold">{{ $produkStokHabis->firstItem() + $index }}</td>
                                        <td class="fw-bold text-dark">{{ $produk->nama }}</td>
                                        <td>
                                            <span class="badge badge-custom bg-danger text-white">Habis Total</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">Tidak ada produk yang habis</td>
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

    <!-- Produk Terlaris Section -->
    <div class="row">
        <div class="col-12">
            <div class="table-box">
                <h3 class="section-title">🔥 Produk Terlaris Bulan Ini</h3>
                <div class="table-responsive">
                    <table class="table table-modern align-middle">
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
                                    <td class="fw-bold text-dark">{{ $produk->nama }}</td>
                                    <td><span class="text-muted fw-semibold">{{ $produk->stok }} Unit</span></td>
                                    <td>
                                        <span class="badge badge-custom bg-success text-white">
                                            🔥 {{ $produk->total_terjual }} Unit Terjual
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                data penjualan produk
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection