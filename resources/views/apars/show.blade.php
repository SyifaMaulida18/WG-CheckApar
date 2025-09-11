@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-dark">Detail APAR: {{ $apar->nomor_seri }}</h1>
        <a href="{{ route('admin.apars.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="card p-3 border-0 shadow-sm h-100">
                        <h5 class="card-title fw-bold">QR Code</h5>
                        <img src="{{ asset('qrcodes/' . $apar->qr_code_path) }}" alt="QR Code APAR" class="img-fluid my-3 mx-auto d-block" style="max-width: 200px;">
                        <a href="{{ asset('qrcodes/' . $apar->qr_code_path) }}" download class="btn btn-sm btn-outline-primary">Unduh QR Code</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card p-4 border-0 shadow-sm h-100">
                        <h5 class="card-title fw-bold">Informasi APAR</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nomor Seri:</strong> {{ $apar->nomor_seri }}</li>
                            <li class="list-group-item"><strong>Jenis:</strong> {{ $apar->jenis_apar }}</li>
                            <li class="list-group-item"><strong>Kapasitas:</strong> {{ $apar->kapasitas }}</li>
                            <li class="list-group-item"><strong>Kepemilikan:</strong> {{ $apar->kepemilikan }}</li>
                            <li class="list-group-item"><strong>Lokasi:</strong> Gedung {{ $apar->gedung }} - Lantai {{ $apar->lantai }}</li>
                            <li class="list-group-item"><strong>Status Posisi:</strong> {{ $apar->status_posisi }}</li>
                            <li class="list-group-item"><strong>Tanggal Kadaluarsa:</strong> {{ \Carbon\Carbon::parse($apar->tanggal_kadaluarsa)->format('d-m-Y') }}</li>
                            <li class="list-group-item">
                                <strong>Status Inspeksi:</strong>
                                <span class="badge {{ $apar->status_inspeksi == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($apar->status_inspeksi) }}
                                </span>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <a href="{{ route('admin.apars.edit', $apar) }}" class="btn btn-warning text-white me-2">Edit APAR</a>
                            <a href="#" class="btn btn-info text-white">Riwayat Inspeksi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Denah Lokasi APAR --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-3">Lokasi pada Denah</h5>
            <div class="card p-2 text-center position-relative">
                <img id="denah-image" src="" class="img-fluid" alt="Denah Gedung" style="display: none;">
                <div id="denah-placeholder" class="py-5 text-muted">Denah lokasi APAR akan ditampilkan di sini.</div>
                <div id="pin-location" class="position-absolute translate-middle" style="display: none;">
                    <svg id="pin-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const denahImage = document.getElementById('denah-image');
        const denahPlaceholder = document.getElementById('denah-placeholder');
        const pin = document.getElementById('pin-location');
        const pinSvg = document.getElementById('pin-svg');
        
        // Data dari Blade
        const gedung = "{{ $apar->gedung }}";
        const lantai = "{{ $apar->lantai }}";
        const statusPosisi = "{{ $apar->status_posisi }}";
        const koordinatX = parseFloat("{{ $apar->koordinat_x }}");
        const koordinatY = parseFloat("{{ $apar->koordinat_y }}");
        
        function updatePinColor() {
            if (statusPosisi === 'Permanen') {
                pinSvg.setAttribute('fill', 'red');
            } else if (statusPosisi === 'Non-permanen') {
                pinSvg.setAttribute('fill', 'green');
            } else {
                pinSvg.setAttribute('fill', 'grey');
            }
        }
        
        if (gedung && lantai) {
            const imagePath = `/denah/${gedung}/lantai_${lantai}.png`; 
            denahImage.src = imagePath;
            denahImage.onload = function() {
                denahImage.style.display = 'block';
                denahPlaceholder.style.display = 'none';
                if (!isNaN(koordinatX) && !isNaN(koordinatY)) {
                    pin.style.display = 'block';
                    pin.style.left = `${koordinatX}px`;
                    pin.style.top = `${koordinatY}px`;
                    updatePinColor();
                }
            };
        } else {
            denahImage.style.display = 'none';
            denahPlaceholder.style.display = 'block';
        }
    });
</script>
@endsection
