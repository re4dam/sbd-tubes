<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1d2d50;
            color: white;
        }
        .container {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }
        h1 {
            color: #1d2d50;
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
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .badge-warning {
            background-color: #ffc107;
        }
        .badge-success {
            background-color: #28a745;
            color: white; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Admin Dashboard</h1>
        <!-- Tabel untuk menampilkan data booking -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table align-middle mb-0 bg-white table-hover">
            <thead class="bg-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Waktu Masuk</th>
                    <th scope="col">Durasi</th>
                    <th scope="col">Waktu Keluar</th>
                    <th scope="col">Harga Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            @foreach($bookings as $item)
            <tbody>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->waktu_masuk }}</td>
                    <td>{{ $item->durasi }} hari</td>
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
                        <form action="{{ route('approve', ['id_booking' => $item->id_booking]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-success btn-sm">Setujui</button>
                        </form>
                        @endif
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        <form action="{{ route('logout') }}" method="post" style="display: inline;">
            @csrf
            <button class="btn btn-danger btn-custom">Logout</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
