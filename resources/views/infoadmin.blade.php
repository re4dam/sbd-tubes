<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: rgb(112, 164, 231);
        }
        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-header h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .profile-header p {
            font-size: 1rem;
            color: #6c757d;
        }
        .profile-info {
            margin-bottom: 15px;
        }
        .profile-info label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .profile-info p {
            margin: 0;
            font-size: 1rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach ($penjuals as $penjual)
                <div class="profile-card">
                    <div class="profile-header">
                        <h2>{{ $penjual->nama_penjual }}</h2>
                        <p>Kontak Kita</p>
                    </div>
                    <div class="profile-info">
                        <label for="name">Nama:</label>
                        <p id="name">{{ $penjual->nama_penjual }}</p>
                    </div>
                    <div class="profile-info">
                        <label for="address">Alamat:</label>
                        <p id="address">{{ $penjual->alamat_penjual }}</p>
                    </div>
                    <div class="profile-info">
                        <label for="contact">Kontak Nomor Telefon:</label>
                        <p id="contact">{{ $penjual->no_telefon_penjual }}</p>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-secondary btn-custom">Home</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
