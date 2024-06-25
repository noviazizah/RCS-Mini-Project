<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pelacakan Kereta</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha384-xodZBNTC5nI8JTw1DD7R8/yI4yV72lIN5D3A5ZmF5d0b2s5b7Z3K/ha5R3t4bJHs" crossorigin=""/>
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
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            width: calc(100% - 20px); /* Kurangi 20px untuk padding */
            padding: 10px;
            margin: 0 10px; /* Tambahkan margin kiri dan kanan */
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
        #map {
            height: 400px; /* Pastikan tinggi peta diatur */
            width: 100%;
        }
    </style>
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
        <h1>Hasil Pelacakan Kereta</h1>

        @if (isset($train))
            <div>
                <h2>Informasi Kereta:</h2>
                <p>Nomor Kereta: {{ $train->TrainNumber }}</p>
                <p>Nama Kereta: {{ $train->TrainName }}</p>
                <p>Rute: 
                    @if (is_array($train->Route) && count($train->Route) > 0)
                        {{ implode(', ', $train->Route) }}
                    @else
                        Data rute tidak tersedia
                    @endif
                </p>
                <div id="map"></div>
            </div>
        @elseif (isset($error))
            <div>
                <p>{{ $error }}</p>
            </div>
        @endif

        <a href="{{ route('tracking') }}" class="btn">Kembali ke Halaman Utama</a>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha384-BpRM8OsDJUrfwvvZ/VTxpGDDbD3w6zF9Joz8KLN57qlEEvCSY87z1yzVwVg3wAE3" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([-6.912615, 107.6024], 10); // Set the initial view to Bandung

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        @if (isset($train) && is_array($train->Route))
            var stationCoords = {
                @foreach ($stations as $station)
                    "{{ $station->StationCode }}": [{{ $station->Latitude }}, {{ $station->Longitude }}],
                @endforeach
            };

            var route = @json($train->Route);
            var latlngs = [];

            route.forEach(function(stationCode) {
                if (stationCoords[stationCode]) {
                    var latlng = stationCoords[stationCode];
                    latlngs.push(latlng);
                    L.marker(latlng, {
                        icon: L.divIcon({
                            className: 'custom-div-icon',
                            html: "<div style='background-color:#000;color:#fff;padding:5px;border-radius:5px;'>" + stationCode + "</div>",
                            iconSize: [60, 42],
                            iconAnchor: [30, 42]
                        })
                    }).addTo(map)
                        .bindPopup(stationCode)
                        .openPopup();
                }
            });

            if (latlngs.length > 0) {
                var polyline = L.polyline(latlngs, {color: 'blue'}).addTo(map);
                map.fitBounds(polyline.getBounds());
            }
        @endif
    </script>
</body>
</html>
