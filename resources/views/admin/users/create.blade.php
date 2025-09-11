@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-dark">Tambah Pengguna Baru</h1>
        <a href="{{ route('admin.users.store') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="col-md-6">
                        <label for="role" class="form-label">Peran</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="so" {{ old('role') == 'so' ? 'selected' : '' }}>Safety Officer (SO)</option>
                        </select>
                        @error('role')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6" id="subkon-group" style="display: {{ old('role') == 'so' ? 'block' : 'none' }};">
                        <label for="subkon_nama" class="form-label">Nama Subkon</label>
                        <input type="text" class="form-control" id="subkon_nama" name="subkon_nama" value="{{ old('subkon_nama') }}">
                        @error('subkon_nama')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const subkonGroup = document.getElementById('subkon-group');
        
        roleSelect.addEventListener('change', function() {
            if (this.value === 'so') {
                subkonGroup.style.display = 'block';
            } else {
                subkonGroup.style.display = 'none';
            }
        });
    });
</script>
@endsection
