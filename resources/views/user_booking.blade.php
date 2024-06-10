<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet"/>
    <style>
        body {
            background-image: url('dokum/badmin.jpg');
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
        }
        .container {
            background-color: #4aaae2;
            border-radius: 10px;
            padding: 20px;
        }
        h1 {
            color: #ffffff;
            text-align: center;
            margin-bottom: 30px;
        }
        .table {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-custom {
            display: block;
            width: 100%;
            text-align: center;
            border-radius: 20px;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .badge-warning {
            background-color: #ffc107;
        }
        .badge-success {
            background-color: #28a745;
            color: white; 
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Booking saya</h1>

        <table class="table align-middle mb-0 bg-white table-hover">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Waktu Masuk</th>
                    <th>Durasi</th>
                    <th>Waktu Keluar</th>
                    <th>Harga Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->waktu_masuk }}</td>
                    <td>{{ $item->durasi }} jam</td>
                    <td>{{ $item->waktu_keluar }}</td>
                    <td>Rp. {{ number_format($item->harga_total, 2, ',', '.') }}</td>
                    <td>
                        @if($item->status == 'pending')
                            <span class="badge badge-warning rounded-pill d-inline">Pending</span>
                        @elseif($item->status == 'Approved')
                            <span class="badge badge-success rounded-pill d-inline">Approved</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 'pending')
                        <form action="{{ route('booking.delete', $item->id_booking) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Cancel booking</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Booking tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('home') }}" class="btn btn-custom">Balik ke halaman utama</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js"></script>
</body>
</html>
