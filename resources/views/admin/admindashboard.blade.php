<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Waktu Masuk</th>
                    <th scope="col">Durasi</th>
                    <th scope="col">Waktu Keluar</th>
                    <th scope="col">Harga DP</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            @foreach($bookings as $item)
                <tbody>
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->waktu_masuk }}</td>
                        <td>{{ $item->durasi }} jam</td>
                        <td>{{ $item->waktu_keluar }}</td>
                        <td>Rp. {{ number_format($item->uang_dp, 2, ',', '.') }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <!-- Tombol untuk menyetujui data booking -->
                            <form action="{{ route('approve', ['id_booking' => $item->id_booking]) }}" method="POST">
                                @csrf
                                <button class="btn btn-success">Setujui</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
