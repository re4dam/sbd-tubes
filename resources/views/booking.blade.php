<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Style CSS */
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
@if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Form Booking Lapangan Badminton</h2>
    <form action="{{ route('book-store') }}" method="POST">
        @csrf
        <!-- Jika sudah login, Anda bisa menyertakan input hidden untuk mengirimkan informasi login -->
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="{{ Auth::id() }}">
        <label for="tanggal">Tanggal Booking</label>
        <input type="date" name="tanggal" id="tanggal" required>
        <label for="time_slot">Pilih waktu:</label>
        <!-- <select id="time_slot" name="time_slot">
            <option value="08:00">08:00</option>
            <option value="10:00">10:00</option>
            <option value="12:00">12:00</option>
            <option value="14:00">14:00</option>
            <option value="16:00">16:00</option>
            <option value="18:00">18:00</option>
            <option value="20:00">20:00</option>
        </select> -->
        <select name="waktu_masuk" id="waktu_masuk">
            @for ($data = 7; $data != 23; $data++)
                @if ($data < 10)
                <option value="0{{$data}}:00">0{{$data}}:00</option>
                @else
                <option value="{{$data}}:00">{{$data}}:00</option>
                @endif
            @endfor
        </select>
        <label for="durasi">Lama Permainan</label>
        <input type="text" id="durasi" name="durasi" placeholder="Enter Duration" required>
        <input type="submit" value="Submit Booking">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>