@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-dark">Daftar APAR</h1>
        <a href="{{ route('admin.apars.create') }}" class="btn btn-primary">Tambah APAR</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body p-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No. Seri</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Kepemilikan</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apars as $apar)
                            <tr>
                                <td>{{ $apar->nomor_seri }}</td>
                                <td>{{ $apar->jenis_apar }}</td>
                                <td>{{ $apar->kapasitas }}</td>
                                <td>{{ $apar->kepemilikan }}</td>
                                <td>{{ $apar->gedung }} - Lantai {{ $apar->lantai }}</td>
                                <td>
                                    <span class="badge {{ $apar->status_inspeksi == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($apar->status_inspeksi) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.apars.show', $apar) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="{{ route('admin.apars.edit', $apar) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                    <form action="{{ route('admin.apars.destroy', $apar) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus APAR ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
