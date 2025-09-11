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
            <a href="{{ route('admin.reports.inspeksi.export') }}" class="btn btn-success">
                <i class="fas fa-file-excel me-2"></i> Unduh Laporan Excel
            </a>
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
                            @foreach ($inspeksis as $inspeksi)
                            <tr>
                                <td>{{ $inspeksi->apar->nomor_seri }}</td>
                                <td>{{ $inspeksi->apar->gedung }} - Lantai {{ $inspeksi->apar->lantai }}</td>
                                <td>{{ $inspeksi->user->name }}</td>
                                <td>{{ $inspeksi->created_at->format('d-m-Y H:i') }}</td>
                                <td>{{ $inspeksi->kondisi_tekanan }}</td>
                                <td>{{ $inspeksi->kondisi_selang }}</td>
                                <td>{{ $inspeksi->kondisi_segel }}</td>
                                <td>{{ $inspeksi->catatan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
