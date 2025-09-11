@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-dark">Formulir Inspeksi</h1>
        <a href="{{ route('inspeksi.scan') }}" class="btn btn-secondary">Batalkan</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="mb-4">
                <h5 class="fw-bold">APAR: {{ $apar->nomor_seri }}</h5>
                <p class="text-muted">
                    Lokasi: Gedung {{ $apar->gedung }} - Lantai {{ $apar->lantai }}
                </p>
            </div>

            <form action="{{ route('inspeksi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="apar_id" value="{{ $apar->id }}">

                <div class="row g-3">
                    <div class="col-12">
                        <label for="kondisi_tekanan" class="form-label">Kondisi Tekanan</label>
                        <select name="kondisi_tekanan" id="kondisi_tekanan" class="form-select" required>
                            <option value="">Pilih Kondisi...</option>
                            <option value="Normal">Normal</option>
                            <option value="Rendah">Rendah</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                        @error('kondisi_tekanan')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="foto_tekanan" class="form-label">Foto Kondisi Tekanan</label>
                        <input type="file" name="foto_tekanan" id="foto_tekanan" class="form-control" accept="image/*" required>
                        @error('foto_tekanan')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-12">
                        <label for="kondisi_selang" class="form-label">Kondisi Selang</label>
                        <select name="kondisi_selang" id="kondisi_selang" class="form-select" required>
                            <option value="">Pilih Kondisi...</option>
                            <option value="Normal">Normal</option>
                            <option value="Bocor">Bocor</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                        @error('kondisi_selang')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="foto_selang" class="form-label">Foto Kondisi Selang</label>
                        <input type="file" name="foto_selang" id="foto_selang" class="form-control" accept="image/*" required>
                        @error('foto_selang')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-12">
                        <label for="kondisi_segel" class="form-label">Kondisi Segel</label>
                        <select name="kondisi_segel" id="kondisi_segel" class="form-select" required>
                            <option value="">Pilih Kondisi...</option>
                            <option value="Utuh">Utuh</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                        @error('kondisi_segel')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="foto_segel" class="form-label">Foto Kondisi Segel</label>
                        <input type="file" name="foto_segel" id="foto_segel" class="form-control" accept="image/*" required>
                        @error('foto_segel')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label for="catatan" class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                        @error('catatan')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success">Simpan Inspeksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
