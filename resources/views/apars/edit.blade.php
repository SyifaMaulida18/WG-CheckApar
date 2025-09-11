@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-dark">Edit APAR: {{ $apar->nomor_seri }}</h1>
        <a href="{{ route('admin.apars.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.apars.update', $apar) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nomor_seri" class="form-label">Nomor Seri</label>
                        <input type="text" class="form-control" id="nomor_seri" name="nomor_seri" value="{{ old('nomor_seri', $apar->nomor_seri) }}" required>
                        @error('nomor_seri')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="jenis_apar" class="form-label">Jenis APAR</label>
                        <input type="text" class="form-control" id="jenis_apar" name="jenis_apar" value="{{ old('jenis_apar', $apar->jenis_apar) }}" required>
                        @error('jenis_apar')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="kapasitas" class="form-label">Kapasitas</label>
                        <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $apar->kapasitas) }}" required>
                        @error('kapasitas')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="kepemilikan" class="form-label">Kepemilikan</label>
                        <select class="form-select" id="kepemilikan" name="kepemilikan" required>
                            <option value="">Pilih Kepemilikan...</option>
                            <option value="Perusahaan" {{ old('kepemilikan', $apar->kepemilikan) == 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                            <option value="Subkon" {{ old('kepemilikan', $apar->kepemilikan) != 'Perusahaan' ? 'selected' : '' }}>Subkon</option>
                        </select>
                        @error('kepemilikan')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6" id="nama-subkon-group" style="display: {{ old('kepemilikan', $apar->kepemilikan) == 'Perusahaan' ? 'none' : 'block' }};">
                        <label for="nama_subkon" class="form-label">Nama Subkon</label>
                        <input type="text" class="form-control" id="nama_subkon" name="nama_subkon" value="{{ old('nama_subkon', $apar->kepemilikan == 'Perusahaan' ? '' : $apar->kepemilikan) }}">
                        @error('nama_subkon')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="gedung" class="form-label">Gedung</label>
                        <select class="form-select" id="gedung" name="gedung" required>
                            <option value="">Pilih Gedung...</option>
                            <option value="gedung_g" {{ old('gedung', $apar->gedung) == 'gedung_g' ? 'selected' : '' }}>Gedung G</option>
                            <option value="gedung_f" {{ old('gedung', $apar->gedung) == 'gedung_f' ? 'selected' : '' }}>Gedung F</option>
                            <option value="gedung_h" {{ old('gedung', $apar->gedung) == 'gedung_h' ? 'selected' : '' }}>Gedung H</option>
                        </select>
                        @error('gedung')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="lantai" class="form-label">Lantai</label>
                        <select class="form-select" id="lantai" name="lantai" required>
                            <option value="">Pilih Lantai...</option>
                            <option value="1" {{ old('lantai', $apar->lantai) == '1' ? 'selected' : '' }}>Lantai 1</option>
                            <option value="2" {{ old('lantai', $apar->lantai) == '2' ? 'selected' : '' }}>Lantai 2</option>
                            <option value="3" {{ old('lantai', $apar->lantai) == '3' ? 'selected' : '' }}>Lantai 3</option>
                            <option value="4" {{ old('lantai', $apar->lantai) == '4' ? 'selected' : '' }}>Lantai 4</option>
                            <option value="5" {{ old('lantai', $apar->lantai) == '5' ? 'selected' : '' }}>Lantai 5</option>
                        </select>
                        @error('lantai')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status_posisi" class="form-label">Status Posisi</label>
                        <select class="form-select" id="status_posisi" name="status_posisi" required>
                            <option value="">Pilih Status Posisi...</option>
                            <option value="Permanen" {{ old('status_posisi', $apar->status_posisi) == 'Permanen' ? 'selected' : '' }}>Permanen</option>
                            <option value="Non-permanen" {{ old('status_posisi', $apar->status_posisi) == 'Non-permanen' ? 'selected' : '' }}>Non-permanen</option>
                        </select>
                        @error('status_posisi')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa', $apar->tanggal_kadaluarsa) }}" required>
                        @error('tanggal_kadaluarsa')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-12 mt-4">
                        <label class="form-label">Pilih Titik Lokasi pada Denah</label>
                        <div class="card p-2 text-center position-relative">
                            <img id="denah-image" src="" class="img-fluid" alt="Denah Gedung" style="display: none;">
                            <div id="denah-placeholder" class="py-5 text-muted">Pilih Gedung dan Lantai untuk menampilkan denah.</div>
                            <div id="pin-location" class="position-absolute translate-middle" style="display: none;">
                                <svg id="pin-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label for="koordinat_x" class="form-label">Koordinat X</label>
                                <input type="text" class="form-control" id="koordinat_x" name="koordinat_x" value="{{ old('koordinat_x', $apar->koordinat_x) }}" readonly required>
                                @error('koordinat_x')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="koordinat_y" class="form-label">Koordinat Y</label>
                                <input type="text" class="form-control" id="koordinat_y" name="koordinat_y" value="{{ old('koordinat_y', $apar->koordinat_y) }}" readonly required>
                                @error('koordinat_y')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Perbarui APAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kepemilikanSelect = document.getElementById('kepemilikan');
        const namaSubkonGroup = document.getElementById('nama-subkon-group');
        const gedungSelect = document.getElementById('gedung');
        const lantaiSelect = document.getElementById('lantai');
        const statusPosisiSelect = document.getElementById('status_posisi');
        const denahImage = document.getElementById('denah-image');
        const denahPlaceholder = document.getElementById('denah-placeholder');
        const pin = document.getElementById('pin-location');
        const pinSvg = document.getElementById('pin-svg');
        const inputX = document.getElementById('koordinat_x');
        const inputY = document.getElementById('koordinat_y');
        
        // Fungsi untuk menampilkan/menyembunyikan input nama subkon
        function updateSubkonInput() {
            if (kepemilikanSelect.value === 'Subkon') {
                namaSubkonGroup.style.display = 'block';
            } else {
                namaSubkonGroup.style.display = 'none';
            }
        }

        // Fungsi untuk mengubah warna pin
        function updatePinColor() {
            const status = statusPosisiSelect.value;
            if (status === 'Permanen') {
                pinSvg.setAttribute('fill', 'red');
            } else if (status === 'Non-permanen') {
                pinSvg.setAttribute('fill', 'green');
            } else {
                pinSvg.setAttribute('fill', 'grey');
            }
        }

        // Fungsi untuk memperbarui gambar denah dan menempatkan pin
        function updateDenahAndPin() {
            const gedung = gedungSelect.value;
            const lantai = lantaiSelect.value;
            pin.style.display = 'none';

            if (gedung && lantai) {
                const imagePath = `/denah/${gedung}/lantai_${lantai}.png`; 
                denahImage.src = imagePath;
                denahImage.onload = function() {
                    denahImage.style.display = 'block';
                    denahPlaceholder.style.display = 'none';
                    if (inputX.value && inputY.value) {
                        pin.style.display = 'block';
                        pin.style.left = `${inputX.value}px`;
                        pin.style.top = `${inputY.value}px`;
                        updatePinColor();
                    }
                };
            } else {
                denahImage.style.display = 'none';
                denahPlaceholder.style.display = 'block';
            }
        }
        
        // Event listeners untuk perubahan formulir
        kepemilikanSelect.addEventListener('change', updateSubkonInput);
        gedungSelect.addEventListener('change', updateDenahAndPin);
        lantaiSelect.addEventListener('change', updateDenahAndPin);
        statusPosisiSelect.addEventListener('change', updatePinColor);

        // Event listener untuk klik pada denah
        denahImage.addEventListener('click', function (e) {
            const rect = denahImage.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            pin.style.display = 'block';
            pin.style.left = `${x}px`;
            pin.style.top = `${y}px`;
            
            updatePinColor();

            inputX.value = x.toFixed(2);
            inputY.value = y.toFixed(2);
        });

        // Panggil fungsi saat halaman dimuat untuk mengisi data awal
        updateSubkonInput();
        updateDenahAndPin();
    });
</script>
@endsection
