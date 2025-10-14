@extends('layouts.app')

@section('content')
<style>
/* Tambahkan atau perbarui CSS ini di file CSS Anda, atau di tag <style> halaman ini. */
/* Tambahkan efek hover pada kartu untuk interaksi yang lebih baik */
.card-body {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-body:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
}

/* Kustomisasi gaya untuk alert info */
.alert-info {
    background-color: #e0f7fa; /* Warna latar belakang biru muda yang lebih halus */
    border-left: 5px solid #00acc1; /* Garis samping yang lebih jelas */
}

/* Tambahkan Animate.css untuk animasi */
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

/* Style for the icons */
.card-icon {
    font-size: 2.5rem;
    position: absolute;
    right: 15px;
    top: 15px;
    opacity: 0.2;
}
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2 text-dark fw-bold">Dashboard Admin</h1>
</div>
    
{{-- Ringkasan Statistik --}}
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card card-body shadow-sm h-100 border-start border-primary border-5 rounded-3 animate__animated animate__fadeInUp">
            <i class="fas fa-fire-extinguisher card-icon text-primary"></i>
            <p class="text-muted fw-semibold text-uppercase mb-1">Total APAR</p>
            <h3 class="fw-bold text-dark">{{ $totalApar }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body shadow-sm h-100 border-start border-success border-5 rounded-3 animate__animated animate__fadeInUp animate__delay-1s">
            <i class="fas fa-check-circle card-icon text-success"></i>
            <p class="text-muted fw-semibold text-uppercase mb-1">APAR Aktif</p>
            <h3 class="fw-bold text-dark">{{ $aparAktif }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body shadow-sm h-100 border-start border-danger border-5 rounded-3 animate__animated animate__fadeInUp animate__delay-2s">
            <i class="fas fa-times-circle card-icon text-danger"></i>
            <p class="text-muted fw-semibold text-uppercase mb-1">APAR Non-Aktif</p>
            <h3 class="fw-bold text-dark">{{ $aparNonAktif }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body shadow-sm h-100 border-start border-info border-5 rounded-3 animate__animated animate__fadeInUp animate__delay-3s">
            <i class="fas fa-search-plus card-icon text-info"></i>
            <p class="text-muted fw-semibold text-uppercase mb-1">Total Inspeksi</p>
            <h3 class="fw-bold text-dark">{{ $totalInspeksi }}</h3>
        </div>
    </div>
</div>

<div class="alert alert-info border-0 shadow-sm rounded-3 p-4 animate__animated animate__fadeInDown">
    <p class="mb-0 text-dark fw-semibold">
        <i class="fas fa-info-circle me-2"></i> Gunakan menu di sidebar untuk menavigasi ke halaman manajemen APAR, pengguna, atau laporan.
    </p>
</div>

@endsection