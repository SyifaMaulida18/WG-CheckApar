@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 text-dark">Dashboard Admin</h1>
        </div>
    </div>
    
    {{-- Ringkasan Statistik --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card card-body shadow-sm h-100 border-start border-primary border-5">
                <p class="text-muted fw-bold text-uppercase mb-1">Total APAR</p>
                <h3 class="fw-bold text-dark">{{ $totalApar }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-body shadow-sm h-100 border-start border-success border-5">
                <p class="text-muted fw-bold text-uppercase mb-1">APAR Aktif</p>
                <h3 class="fw-bold text-dark">{{ $aparAktif }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-body shadow-sm h-100 border-start border-danger border-5">
                <p class="text-muted fw-bold text-uppercase mb-1">APAR Non-Aktif</p>
                <h3 class="fw-bold text-dark">{{ $aparNonAktif }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-body shadow-sm h-100 border-start border-info border-5">
                <p class="text-muted fw-bold text-uppercase mb-1">Total Inspeksi</p>
                <h3 class="fw-bold text-dark">{{ $totalInspeksi }}</h3>
            </div>
        </div>
    </div>

    {{-- Menu Utama Admin --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body p-4 text-center">
                    <i class="fas fa-fire-extinguisher fa-4x text-primary mb-3"></i>
                    <h5 class="card-title fw-bold">Manajemen APAR</h5>
                    <p class="card-text text-muted">Kelola data APAR, lokasi, dan QR Code.</p>
                    <a href="{{ route('admin.apars.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-right me-2"></i> Akses
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body p-4 text-center">
                    <i class="fas fa-users-cog fa-4x text-success mb-3"></i>
                    <h5 class="card-title fw-bold">Manajemen Pengguna</h5>
                    <p class="card-text text-muted">Kelola akun admin dan Safety Officer.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-3">
    <i class="fas fa-arrow-right me-2"></i> Akses
</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body p-4 text-center">
                    <i class="fas fa-file-excel fa-4x text-info mb-3"></i>
                    <h5 class="card-title fw-bold">Laporan Inspeksi</h5>
                    <p class="card-text text-muted">Lihat Unduh data inspeksi ke format Excel.</p>
                    <a href="{{ route('admin.reports.inspeksi.index') }}" class="btn btn-info text-white mt-3">
                        <i class="fas fa-download me-2"></i> Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection