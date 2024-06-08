<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="{{asset('bootstrapke2/font-awesome-4.7.0/css/font-awesome.min.css')}}">                <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bootstrapke2/css/bootstrap.min.css')}}">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrapke2/css/datepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrapke2/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrapke2/slick/slick-theme.css')}}"/>
    <link rel="stylesheet" href="{{asset('bootstrapke2/css/templatemo-style.css')}}"> 
    <style>
        /* Style CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(112, 164, 231);
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .submit-container {
            text-align: right;
        }
        .back-home-container {
            margin-top: 20px;
            text-align: center;
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
    
    <div class="row tm-banner-row" id="tm-section-search">
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
                    <input type="submit" value="Submit Booking" class="btn btn-primary">
                </div>
            </form>        
        </div>
    </div>
    
    <div class="back-home-container">
        <a href="{{ route('home') }}" class="btn btn-danger btn-custom">Back to home</a>
    </div>

        <!-- load JS files -->
        <script src="{{asset('bootstrapke2/js/jquery-1.11.3.min.js')}}"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="{{asset('bootstrapke2/js/popper.min.js')}}"></script>                    <!-- https://popper.js.org/ -->       
        <script src="{{asset('bootstrapke2/js/bootstrap.min.js')}}"></script>                 <!-- https://getbootstrap.com/ -->
        <script src="{{asset('bootstrapke2/js/datepicker.min.js')}}"></script>                <!-- https://github.com/qodesmith/datepicker -->
        <script src="{{asset('bootstrapke2/js/jquery.singlePageNav.min.js')}}"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
        <script src="{{asset('bootstrapke2/slick/slick.min.js')}}"></script>                  <!-- http://kenwheeler.github.io/slick/ -->
        <script src="{{asset('bootstrapke2/js/jquery.scrollTo.min.js')}}"></script>
    </body>
    </html>
