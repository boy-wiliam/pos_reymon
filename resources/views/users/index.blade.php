@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --primary-color: #6366f1;
        --primary-dark: #4f46e5;
        --primary-light: rgba(99, 102, 241, 0.1);
        --accent-glow: rgba(99, 102, 241, 0.25);
        --text-main: #f8fafc;
        --text-muted: #94a3b8;
        --radius-card: 24px;
        --radius-element: 14px;
    }

    body {
        /* Background Gelap Elegan dengan Multi-Glow Mesh Khas Manajemen User */
        background-color: #0f172a;
        background-image: 
            radial-gradient(at 15% 15%, rgba(79, 70, 229, 0.22) 0px, transparent 50%),
            radial-gradient(at 85% 15%, rgba(147, 51, 234, 0.18) 0px, transparent 50%),
            radial-gradient(at 50% 85%, rgba(15, 23, 42, 0.9) 0px, transparent 50%);
        background-attachment: fixed;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        color: var(--text-main);
    }

    .page-title {
        color: #ffffff;
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -0.75px;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 500;
    }

    /* Kartu Statistik Mini Khusus User */
    .stat-card {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 20px 24px;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: rgba(99, 102, 241, 0.4);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        background: rgba(99, 102, 241, 0.15);
        color: #818cf8;
    }

    /* Kartu Utama */
    .page-card {
        background: rgba(30, 41, 59, 0.75);
        backdrop-filter: blur(16px);
        border-radius: var(--radius-card);
        padding: 35px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.08);
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
        background: linear-gradient(90deg, #6366f1, #a855f7, #4f46e5);
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

    .btn-indigo.btn-modern {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        border: none;
        color: white;
        box-shadow: 0 8px 20px -4px rgba(99, 102, 241, 0.4);
    }

    .btn-indigo.btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -4px rgba(99, 102, 241, 0.6);
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
    }

    /* Kotak Pencarian Elegan */
    .search-box {
        background: rgba(15, 23, 42, 0.6);
        border: 1.5px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-element);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .search-box:focus-within {
        border-color: var(--primary-color);
        background: rgba(15, 23, 42, 0.9);
        box-shadow: 0 0 0 4px var(--accent-glow);
    }

    .search-box .form-control {
        border: none;
        padding: 14px 20px;
        background: transparent;
        font-size: 14px;
        color: #ffffff;
    }

    .search-box .form-control::placeholder {
        color: #64748b;
    }

    .search-box .form-control:focus {
        box-shadow: none;
        color: #ffffff;
    }

    /* Tabel Estetik */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 8px;
        width: 100%;
    }

    .table-modern thead th {
        background: rgba(15, 23, 42, 0.5);
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        padding: 14px 20px;
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
        background: rgba(15, 23, 42, 0.4);
        transition: all 0.2s ease;
    }

    .table-modern tbody tr td {
        padding: 16px 20px;
        color: #e2e8f0;
        font-size: 14px;
        border-top: 1px solid rgba(255, 255, 255, 0.04);
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        vertical-align: middle;
    }

    .table-modern tbody tr td:first-child {
        border-left: 1px solid rgba(255, 255, 255, 0.04);
        border-top-left-radius: var(--radius-element);
        border-bottom-left-radius: var(--radius-element);
    }

    .table-modern tbody tr td:last-child {
        border-right: 1px solid rgba(255, 255, 255, 0.04);
        border-top-right-radius: var(--radius-element);
        border-bottom-right-radius: var(--radius-element);
    }

    .table-modern tbody tr:hover {
        transform: translateY(-2px);
        background-color: rgba(30, 41, 59, 0.9);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Avatar Minimalis Berkelas */
    .user-avatar {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white;
        font-weight: 700;
        font-size: 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
    }

    /* Badge Role Mewah */
    .badge-role {
        background: rgba(99, 102, 241, 0.15);
        color: #818cf8;
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 0.3px;
        padding: 7px 14px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid rgba(99, 102, 241, 0.3);
    }

    .badge-role::before {
        content: '';
        width: 6px;
        height: 6px;
        background-color: #818cf8;
        border-radius: 50%;
    }

    /* Tombol Aksi */
    .btn-action {
        padding: 8px 14px;
        font-size: 13px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-edit {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }
    .btn-edit:hover {
        background: #f59e0b;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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
        color: #cbd5e1;
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 13px;
        font-weight: 600;
        padding: 10px 16px;
        background: rgba(15, 23, 42, 0.6);
        transition: all 0.2s ease;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        border-color: transparent;
        color: white;
        box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4);
    }

    .page-item .page-link:hover:not(.active) {
        background-color: rgba(30, 41, 59, 0.9);
        color: #818cf8;
        border-color: rgba(99, 102, 241, 0.3);
    }
</style>

<div class="container-fluid py-4 px-4">

    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="page-title mb-1">👥 Manajemen Users</h1>
            <p class="page-subtitle mb-0">Kelola hak akses dan akun pengguna aplikasi POS dengan mudah dan aman.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn btn-indigo btn-modern">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah User Baru
        </a>
    </div>

    <!-- Statistik Ringkasan User -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div>
                    <span class="text-muted d-block" style="font-size: 12px; font-weight: 600;">TOTAL PENGGUNA</span>
                    <h4 class="fw-bold mb-0 text-white">{{ method_exists($users, 'total') ? $users->total() : count($users) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(16, 185, 129, 0.15); color: #34d399;">🛡️</div>
                <div>
                    <span class="text-muted d-block" style="font-size: 12px; font-weight: 600;">STATUS OTORITAS</span>
                    <h4 class="fw-bold mb-0 text-white">Terproteksi</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24;">⚡</div>
                <div>
                    <span class="text-muted d-block" style="font-size: 12px; font-weight: 600;">ROLE AKTIF</span>
                    <h4 class="fw-bold mb-0 text-white">Multi-Level</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="page-card">

        <!-- Search Form -->
        <form action="{{ route('admin.users') }}" method="GET" class="mb-4">
            <div class="input-group search-box">
                <span class="input-group-text bg-transparent border-0 ps-3 text-muted">
                    🔍
                </span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari berdasarkan nama atau email pengguna...">
                <button class="btn px-4" style="background: var(--primary-color); color: white; border:none; font-weight: 600;">
                    Cari Data
                </button>
            </div>
        </form>

        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="30%">Nama Lengkap</th>
                        <th width="25%">Email</th>
                        <th width="20%">Role Akses</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-muted fw-semibold text-center">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white" style="font-size: 14.5px;">{{ $user->name }}</div>
                                        <div class="text-muted" style="font-size: 12px;">Terdaftar ID: #{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary fw-medium">{{ $user->email }}</span>
                            </td>
                            <td>
                                <span class="badge-role">
                                    {{ $user->role->name ?? 'Tanpa Role' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-edit btn-action" title="Edit Pengguna">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-delete btn-action" title="Hapus Pengguna" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted py-4">
                                    <div style="font-size: 48px;" class="mb-3">📂</div>
                                    <h5 class="fw-bold text-white mb-1">Belum ada data user ditemukan</h5>
                                    <p class="text-muted mb-0">Silakan tambahkan pengguna baru melalui tombol di pojok kanan atas.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-4">
            {{ $users->withQueryString()->links() }}
        </div>

    </div>
</div>

@endsection