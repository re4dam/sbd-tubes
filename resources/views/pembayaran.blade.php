<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-image: url('{{ asset('dokum/badmin.jpg') }}');
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #4aaae2;
            border-radius: 10px;
            background-color: #4aaae2;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table.custom-table {
            background-color: #4aaae2;
            border-collapse: collapse;
            width: 100%;
        }

        .table.custom-table th,
        .table.custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table.custom-table th {
            background-color: #4aaae2;
            color: white;
        }

        .table.custom-table td {
            background-color: #e0f4fb;
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
        
            <table class="table custom-table">
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
                    <th>Voucher Diskon</th>
                    <td><input type="text" class="form-control" id="voucher_diskon" name="voucher_diskon" value="{{ $voucher_diskon ? $voucher_diskon->nama_voucher : 'Tidak ada' }}" readonly></td>
                </tr>
                <tr>
                    <th>Paket Fasilitas</th>
                    <td><input type="text" class="form-control" id="deskripsi_paket_fasilitas" name="deskripsi_paket_fasilitas" value="{{ $paket_fasilitas ? $paket_fasilitas->deskripsi_paket_fasilitas : 'Tidak ada' }}" readonly></td>
                </tr>
                <tr>
                    <th>Kode Membership</th>
                    <td><input type="text" class="form-control" id="kode_membership" name="kode_membership" value="{{ $membership ? $membership->kode_membership : 'Tidak ada' }}" readonly></td>
                </tr>
                <tr>
                    <th>Harga Pembayaran</th>
                    <td><input type="text" class="form-control" id="harga_pembayaran" name="harga_pembayaran" value="{{ $harga_pembayaran }}" readonly></td>
                </tr>
                <tr>
                    <th>Harga DP</th>
                    <td><input type="number" class="form-control" id="harga_dp" name="harga_dp" value="{{ $dp }}" readonly></td>
                </tr>
                <tr>
                    <th>Harga Total</th>
                    <td><input type="number" class="form-control" id="harga_total" name="harga_total" value="{{ $harga_total }}" readonly></td>
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
                    <th>Upload Bukti Pembayaran</th>
                    <td><input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required></td>
                </tr>
            </table>
        
            <div class="text-center">
                <button type="submit">Kirim Pembayaran</button>
            </div>
        </form>        
        
    </div>
    <a href="{{ route('home') }}" class="btn btn-primary btn-custom">Back to home</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
</body>
</html>
