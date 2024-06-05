<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking Lapangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select, input[type="text"], input[type="number"], input[type="file"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        @csrf

        <label for="waktu_masuk">Waktu Masuk</label>
        <input type="text" id="waktu_masuk" name="waktu_masuk"  readonly>

        <label for="lama_booking">Lama Booking (jam)</label>
        <input type="number" id="lama_booking" name="lama_booking"  readonly>

        <label for="waktu_keluar">Waktu Keluar</label>
        <input type="text" id="waktu_keluar" name="waktu_keluar"  readonly>

        <label for="metode_pembayaran">Metode Pembayaran</label>
        <select id="metode_pembayaran" name="metode_pembayaran" required>
            <option value="">Pilih Metode Pembayaran</option>
            <option value="transfer_bank">Transfer Bank</option>
            <option value="kartu_kredit">Kartu Kredit</option>
            <option value="dompet_digital">Dompet Digital</option>
        </select>

        <label for="harga_pembayaran">Harga Pembayaran</label>
        <input type="number" id="harga_pembayaran" name="harga_pembayaran"  readonly>

        <label for="harga_dp">Harga DP</label>
        <input type="number" id="harga_dp" name="harga_dp"  readonly>

        <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required>

        <button type="submit">Kirim Pembayaran</button>
    </form>
</body>
</html>
