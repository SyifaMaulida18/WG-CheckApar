<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inspeksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 text-dark">Laporan Inspeksi</h1>
            <a href="{{ route('admin.reports.inspeksi.export', request()->query()) }}" class="btn btn-success">
                <i class="fas fa-file-excel me-2"></i> Unduh Laporan Excel
            </a>
        </div>
        
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.reports.inspeksi.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="gedung" class="form-label">Gedung</label>
                        <select id="gedung" name="gedung" class="form-select">
                            <option value="">Semua Gedung</option>
                            @foreach ($gedungs as $gedung)
                                <option value="{{ $gedung }}" {{ request('gedung') == $gedung ? 'selected' : '' }}>
                                    {{ $gedung }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="kondisi" class="form-label">Kondisi APAR</label>
                        <select id="kondisi" name="kondisi" class="form-select">
                            <option value="">Semua Kondisi</option>
                            <option value="Normal" {{ request('kondisi') == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Perbaikan" {{ request('kondisi') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-2"></i> Terapkan Filter
                        </button>
                        <a href="{{ route('admin.reports.inspeksi.index') }}" class="btn btn-outline-secondary">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>APAR</th>
                                <th>Gedung & Lantai</th>
                                <th>Petugas</th>
                                <th>Tanggal Inspeksi</th>
                                <th>Kondisi Tekanan</th>
                                <th>Kondisi Selang</th>
                                <th>Kondisi Segel</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inspeksis as $inspeksi)
                            <tr>
                                <td>{{ $inspeksi->apar->nomor_seri }}</td>
                                <td>{{ $inspeksi->apar->gedung }} - Lantai {{ $inspeksi->apar->lantai }}</td>
                                <td>{{ $inspeksi->user->name }}</td>
                                <td>{{ $inspeksi->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <span class="badge {{ $inspeksi->kondisi_tekanan == 'Normal' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $inspeksi->kondisi_tekanan }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $inspeksi->kondisi_selang == 'Normal' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $inspeksi->kondisi_selang }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $inspeksi->kondisi_segel == 'Utuh' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $inspeksi->kondisi_segel }}
                                    </span>
                                </td>
                                <td>{{ $inspeksi->catatan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Tidak ada data inspeksi yang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>