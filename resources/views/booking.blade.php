<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Tc5IQbG9gS6OHsbozsFA20W/Ygi7E8LA5RQ/IIcN8yrss1FbT/JqUiU" crossorigin="anonymous">
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="{{ asset('bootstrapke2/font-awesome-4.7.0/css/font-awesome.min.css') }}">                <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bootstrapke2/css/bootstrap.min.css') }}">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrapke2/css/datepicker.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrapke2/slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrapke2/slick/slick-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('bootstrapke2/css/templatemo-style.css') }}"> 
    <style>
        /* General Style */
        body {
            font-family: 'Open Sans', sans-serif;
            /* background-color: #4e9ceb; */
            background-image: url('dokum/badmin.jpg');
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
        }
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .form-container, .info-container {
            background-color: #4aaae2;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .form-title, .info-title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 30px;
            color: #333;
            font-size: 1.5rem;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: 600;
            color: #666;
            margin-bottom: 5px;
            display: block;
        }
        .form-control {
            border: 1px solid #ddd;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.1);
        }
        .tm-select {
            appearance: none;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 40px;
        }
        .submit-container {
            text-align: center;
        }
        .submit-container button[type="submit"] {
            background: linear-gradient(to right, #3498db, #2ecc71);
            color: #fff;
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease-in-out;
        }
        .submit-container button[type="submit"]:hover {
            background: linear-gradient(to right, #2ecc71, #3498db);
        }
        .back-home-container {
            margin-top: 20px;
            text-align: center;
        }
        .back-home-container a {
            color: #fff;
            text-decoration: none;
            background-color: #e74c3c;
            padding: 10px 20px;
            border-radius: 50px;
            transition: background-color 0.3s ease-in-out;
        }
        .back-home-container a:hover {
            background-color: #c0392b;
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
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="info-container">
                    <h2 class="info-title">Informasi Voucher dan Paket Fasilitas</h2>
                    <h3 style="text-align: center">Voucher Diskon</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Voucher</th>
                                <th>Deskripsi</th>
                                <th>Batas waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->nama_voucher }}</td>
                                <td>{{ $voucher->deskripsi_voucher }}</td>
                                <td>{{ $voucher->waktu_expired }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3 style="text-align: center">Paket Fasilitas</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paketFasilitas as $paket)
                            <tr>
                                <td>{{ $paket->nama_paket_fasilitas }}</td>
                                <td>{{ $paket->deskripsi_paket_fasilitas }}</td>
                                <td>{{ $paket->harga_paket_fasilitas }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                
            </div>
            <div class="col-md-4">
                <div class="form-container">
                    <h2 class="form-title">Form Booking Lapangan Badminton</h2>
                    <form action="{{ route('book-store') }}" method="POST" class="tm-search-form tm-section-pad-2">
                        @csrf
                        <!-- Jika sudah login, Anda bisa menyertakan input hidden untuk mengirimkan informasi login -->
                        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="{{ Auth::id() }}">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Booking</label>
                            <input type="date" name="tanggal" id="tanggal" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="waktu_masuk">Pilih waktu:</label>
                            <select name="waktu_masuk" id="waktu_masuk" class="form-control tm-select">
                                @for ($data = 7; $data != 23; $data++)
                                    @if ($data < 10)
                                        <option value="0{{$data}}:00">0{{$data}}:00</option>
                                    @else
                                        <option value="{{$data}}:00">{{$data}}:00</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="durasi">Lama Permainan</label>
                            <input type="text" id="durasi" name="durasi" placeholder="Durasi" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="id_voucher_diskon">Voucher Diskon</label>
                            <select name="id_voucher_diskon" id="id_voucher_diskon" class="form-control tm-select">
                                <option value="">Pilih Voucher</option>
                                @foreach($vouchers as $voucher)
                                    <option value="{{ $voucher->id_voucher_diskon }}">{{ $voucher->nama_voucher }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_paket_fasilitas">Paket Fasilitas</label>
                            <select name="id_paket_fasilitas" id="id_paket_fasilitas" class="form-control tm-select">
                                <option value="">Pilih Paket Fasilitas</option>
                                @foreach($paketFasilitas as $paket)
                                    <option value="{{ $paket->id_paket_fasilitas }}">{{ $paket->nama_paket_fasilitas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="submit-container">
                            <button type="submit" class="btn btn-primary">Submit Booking</button>
                        </div>
                    </form>
                    
                </div>
                {{-- <div class="back-home-container">
                    <a href="{{ route('home') }}" class="btn btn-danger btn-custom">Back to home</a>
                </div> --}}
            </div>
        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary btn-custom">Back to home</a>

    <!-- load JS files -->
    <script src="{{ asset('bootstrapke2/js/jquery-1.11.3.min.js') }}"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="{{ asset('bootstrapke2/js/popper.min.js') }}"></script>                    <!-- https://popper.js.org/ -->       
    <script src="{{ asset('bootstrapke2/js/bootstrap.min.js') }}"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="{{ asset('bootstrapke2/js/datepicker.min.js') }}"></script>                <!-- https://github.com/qodesmith/datepicker -->
    <script src="{{ asset('bootstrapke2/js/jquery.singlePageNav.min.js') }}"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="{{ asset('bootstrapke2/slick/slick.min.js') }}"></script>                  <!-- http://kenwheeler.github.io/slick/ -->
    <script src="{{ asset('bootstrapke2/js/jquery.scrollTo.min.js') }}"></script>
</body>
</html>
