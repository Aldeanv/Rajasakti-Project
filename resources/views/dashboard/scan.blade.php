<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code - Absensi</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/instascan.min.js"></script>
</head>
<body>
    <h2>Scan QR Code untuk Absensi</h2>
    <video id="preview" width="100%" style="border:1px solid black;"></video>

    <form id="attendance-form" action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="data" id="qr-data">
    </form>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        scanner.addListener('scan', function(content) {
            document.getElementById('qr-data').value = content;
            document.getElementById('attendance-form').submit();
        });

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert("Tidak ada kamera ditemukan.");
            }
        }).catch(function(e) {
            console.error(e);
        });
    </script>
</body>
</html>
