<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: aquamarine;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            margin-bottom: 20px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Pembayaran Booking Lapangan</h2>
        <form method="POST" enctype="multipart/form-data" action="{{ route('pembayaran.store') }}">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id_booking }}">

            <table class="table">
                <tr>
                    <th>Waktu Masuk</th>
                    <td><input type="text" class="form-control" id="waktu_masuk" name="waktu_masuk" value="{{ $booking->waktu_masuk }}" readonly></td>
                </tr>
                <tr>
                    <th>Lama Booking (jam)</th>
                    <td><input type="number" class="form-control" id="lama_booking" name="lama_booking" value="{{ $booking->durasi }}" readonly></td>
                </tr>
                <tr>
                    <th>Waktu Keluar</th>
                    <td><input type="text" class="form-control" id="waktu_keluar" name="waktu_keluar" value="{{ $booking->waktu_keluar }}" readonly></td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>
                        <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            @foreach($metodePembayaran as $metode)
                                <option value="{{ $metode->id_metode_pembayaran }}">{{ $metode->jenis_pembayaran }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Harga Pembayaran</th>
                    <td><input type="number" class="form-control" id="harga_pembayaran" name="harga_pembayaran" value="{{ $booking->durasi * 50000 }}" readonly></td>
                </tr>
                <tr>
                    <th>Harga DP</th>
                    <td><input type="number" class="form-control" id="harga_dp" name="harga_dp" value="{{ $booking->uang_dp }}" readonly></td>
                </tr>
                <tr>
                    <th>Upload Bukti Pembayaran</th>
                    <td><input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required></td>
                </tr>
            </table>

            <div class="text-center">
                <button type="submit">Kirim Pembayaran</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
