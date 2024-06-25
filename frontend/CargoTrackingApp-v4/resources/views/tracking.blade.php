<!DOCTYPE html>
<html>
<head>
    <title>Tracking Kereta</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            margin-top: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            width: calc(100% - 20px); /* Kurangi 20px untuk padding */
            padding: 10px;
            margin: 10 10px; /* Tambahkan margin kiri dan kanan */
            border-radius: 5px;
            border: none;
        }

        .btn {
            background-color: #f39c12;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #e67e22;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            background-color: #f39c12;
            padding: 10px;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
        }
        .navbar a:hover {
            background-color: #e67e22;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha384-xodZBNTC5nI8JTw1DD7R8/yI4yV72lIN5D3A5ZmF5d0b2s5b7Z3K/ha5R3t4bJHs" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha384-BpRM8OsDJUrfwvvZ/VTxpGDDbD3w6zF9Joz8KLN57qlEEvCSY87z1yzVwVg3wAE3" crossorigin=""></script>
    
</head>
<body>
    <div class="navbar">
        <img src="{{ asset('images/logo.png') }}" alt="KAI Logistics">
        <div>
            <a href="#">Home</a>
            <a href="#">Produk & Layanan</a>
            <a href="#">Profil</a>
            <a href="#">Informasi</a>
            <a href="#">Kemitraan</a>
            <a href="#">Tracking</a>
            <a href="#">Lelang</a>
            <a href="#">Pelanggan</a>
            <a href="#">Kontak</a>
        </div>
    </div>
    <div class="container">
        <h1>CEK KA</h1>

        <form action="{{ route('track') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="TrainNumber">Masukkan No. KA</label>
                <input type="text" class="form-control" id="TrainNumber" name="TrainNumber" required>
            </div>
            <div class="form-group">
                <label for="captcha">Masukkan Kode diatas</label>
                <input type="text" class="form-control" id="captcha" name="captcha" required>
            </div>
            <button type="submit" class="btn">Start Tracking</button>
        </form>
    </div>
</body>
</html>
