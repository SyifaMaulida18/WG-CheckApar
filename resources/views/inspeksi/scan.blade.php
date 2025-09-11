@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center card shadow-sm p-4" style="max-width: 500px;">
        <h1 class="h3 mb-3">Mulai Inspeksi APAR</h1>
        <p class="lead text-muted">Arahkan kamera ke QR Code APAR untuk memulai.</p>
        
        {{-- Area untuk tampilan kamera --}}
        <div id="reader" style="width:100%; max-height: 300px; border-radius: 8px;"></div>
        
        <div class="mt-4">
            {{-- Pesan sukses atau error dari session --}}
            @if (session('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mt-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            {{-- Pesan dari JavaScript --}}
            <div id="message-box" class="mt-3"></div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script type="text/javascript">
    function showMessage(message, type = 'danger') {
        const messageBox = document.getElementById('message-box');
        messageBox.innerHTML = `
            <div class="alert alert-${type}" role="alert">
                ${message}
            </div>
        `;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const html5QrCode = new Html5Qrcode("reader");
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            // Arahkan ke rute inspeksi dengan ID APAR dari QR Code
            window.location.href = '{{ url("inspeksi") }}/' + decodedText;
        };
        const config = { fps: 10, qrbox: 250 };

        // Minta izin kamera dan mulai pemindaian
        html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback)
            .catch(err => {
                console.error("Gagal mengakses kamera: ", err);
                showMessage('Gagal mengakses kamera: ' + err, 'danger');
            });
    });
</script>
@endsection
