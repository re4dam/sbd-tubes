<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .registration-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-custom {
            color: white;
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 20px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            color: white;
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-text {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4 registration-form">
    <form method="post" action="{{ route('register-store') }}">
    @csrf
            <div class="form-group mb-3">
                <label for="nama_pelanggan">Nama</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Enter name" required>
            </div>
            <div class="form-group mb-3">
                <label for="no_telefon_pelanggan">Kontak</label>
                <input type="text" class="form-control" id="no_telefon_pelanggan" name="no_telefon_pelanggan" placeholder="Enter kontak" required>
            </div>
            <div class="form-group mb-3">
                <label for="email_pelanggan">Alamat Email</label>
                <input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group mb-3">
                <label for="password_pelanggan">Password</label>
                <input type="password" class="form-control" id="password_pelanggan" name="password_pelanggan" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-custom btn-block">Register</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>