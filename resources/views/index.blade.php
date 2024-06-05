<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOR Badminton Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero-section {
            background: url('https://via.placeholder.com/1200x400') no-repeat center center;
            background-size: cover;
            height: 400px;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .gallery {
            margin-top: 30px;
        }
        .btn-custom {
            margin: 10px;
            border-radius: 20px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <h1>GOR Badminton Booking</h1>
        <p>Sewa lapangan badminton dengan mudah dan cepat</p>
        <div>
            <a href="{{ route('book-time') }}" class="btn btn-primary btn-custom">Book Now</a>
            @auth
            <a href="{{ route('profile') }}" class="btn btn-secondary btn-custom">Profile</a>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button class="btn btn-secondary btn-custom">Logout</button>
            </form>
            <a href="{{ route('cart') }}" class="btn btn-secondary btn-custom">My Booking</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-secondary btn-custom">Login</a>
            @endauth
        </div>
    </div>

    <div class="container">
        <h2 class="text-center mt-5">Gallery</h2>
        <div class="row gallery">
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="GOR Image 1">
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="GOR Image 2">
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="GOR Image 3">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
