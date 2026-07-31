@extends('layouts.app')

@section('title', 'Manajemen Users')

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

    /* Kartu Utama dengan Efek Mewah */
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
        background: #ffffff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.01);
        transition: all 0.2s ease;
    }

    .table-modern tbody tr td {
        padding: 16px 20px;
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

    /* Avatar Minimalis Berkelas */
    .user-avatar {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        color: white;
        font-weight: 700;
        font-size: 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
    }

    /* Badge Role Mewah */
    .badge-role {
        background: var(--primary-light);
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 0.3px;
        padding: 7px 14px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid rgba(5, 150, 105, 0.15);
    }

    .badge-role::before {
        content: '';
        width: 6px;
        height: 6px;
        background-color: var(--primary-color);
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
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fef3c7;
    }

    .btn-edit:hover {
        background: #f59e0b;
        color: white;
        border-color: #f59e0b;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
        border-color: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
    }

    /* Pagination Kustom Berkelas */
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

    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="page-title mb-1">Manajemen Users</h1>
            <p class="page-subtitle mb-0">Kelola hak akses dan akun pengguna aplikasi POS dengan mudah dan aman.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-modern">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah User Baru
        </a>
    </div>

    <!-- Main Card -->
    <div class="page-card">

        <!-- Search Form -->
        <form action="{{ route('admin.users') }}" method="GET" class="mb-4">
            <div class="input-group search-box">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari berdasarkan nama atau email pengguna...">
                <button class="btn px-4" style="background: var(--primary-color); color: white; border:none; font-weight: 600;">
                    🔍 Cari Data
                </button>
            </div>
        </form>

        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th width="5%">#</th>
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
                                        <div class="fw-bold text-dark" style="font-size: 14.5px;">{{ $user->name }}</div>
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
                                    <h5 class="fw-bold text-dark mb-1">Belum ada data user ditemukan</h5>
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