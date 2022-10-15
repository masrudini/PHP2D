<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sungai Kakap | Page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('admin_template/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin_template/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ url('admin_template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('admin_template/assets/css/custom.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('images/sungai_kakap.ico') }}" />
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <style>
        html,
        body {
            /* height: 100%; */
            margin: 0;
        }

        .leaflet-container {
            margin: 0 auto;
            height: 100vh;
            width: 100%;
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
            box-shadow: 0px 4px 10px -8px #000000;
        }

        @media only screen and (max-width:992px) {
            .leaflet-container {
                margin: 0 0 30px 0;
                width: 100vh;
                max-width: 100%;
                max-height: 100%;
                border-radius: 10px;
                box-shadow: 0px 4px 10px -8px #000000;
            }
        }

        div.leaflet-top.leaflet-right {
            display: none !important;
            width: 0px !important;
            height: 0px !important;
        }

        #map {
            height: 100vh;
            width: 100vw;
        }

        .leaflet-control-mouseposition {
            background-color: rgba(255, 255, 255, 0.7);
            box-shadow: 0 0 5px #bbb;
            padding: 1px 5px;
            margin: 0;
            color: #333;
            font: 11px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif;
        }

        .leaflet-popup {
            margin-bottom: -20px;
        }

        .leaflet-popup-content-wrapper {
            text-align: center;
            width: 300px;
            height: 30%;
        }
    </style>

</head>

<body>
    <div class="container position-fixed fixed-top">
        <nav
            class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between px-5 align-items-center">
            <a href="{{ url('/') }}" class="navbar-brand"><img width="50px"
                    src="{{ url('images/sungai_kakap.png') }}" class="me-3" alt="">Fasilitas Umum Sungai
                Kakap</a>
            <div class="ms-2" style="width: 400px">
                <select class="form-select" onchange="cari(this.value)">
                    <option selected>---Pilih---</option>
                    @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->latitude }},{{ $lokasi->longitude }}">{{ $lokasi->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Search by
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/aktif" style="color: black;">Fasilitas Aktif</a>
                        <a class="dropdown-item" href="/non-aktif" style="color: black;">Fasilitas Non-Aktif</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/" style="color: black;">Semua Fasilitas</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="/login" class="nav-link">Login</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container-scroller">
        <div class="leaflet-container">
            <div id="map"></div>
        </div>

    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="{{ url('js/L.Control.MousePosition.js') }}"></script>
<!-- Script Leaflet -->
<script>
    var currentLat = "";
    var currentLng = "";
    var map = L.map('map', {
        zoomControl: true
    }).setView([-0.05652732759345948, 109.17823055147235], 13);
    var routingControl = L.Routing.control({}).addTo(map);

    var tiles = L.tileLayer(
        'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 30,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

    function showPosition(pos) {
        currentLat = pos.coords.latitude;
        currentLng = pos.coords.longitude;
    }

    if (!navigator.geolocation) {
        console.log("Location denied");
    } else {
        navigator.geolocation.getCurrentPosition(showPosition);
    }

    $(document).ready(function() {
        $.getJSON('lokasi-aktif/json', function(data) {
            $.each(data, function(index) {

                var Icon = L.icon({
                    iconUrl: 'images/lainnya.png',
                    iconSize: [20, 26],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });


                marker = L.marker([data[index].latitude, data[index].longitude], {
                    icon: Icon
                }).addTo(map).bindPopup();

                marker.on('mouseover', function(ev) {
                    const popupLocation = '<p>' + data[index].name;
                    ev.target.bindPopup(popupLocation).openPopup();
                });

                marker.on('click', function(ev) {
                    const popupContent =
                        '<h4>' + data[index].name + '</h4>' +
                        '<img height="150px" width="100%"  src="storage/' + data[
                            index].image + '">' + '</div>' +
                        '<div class="d-flex justify-content-between">' +
                        '<button class="btn btn-info mt-3 me-1" onclick="routing(' +
                        data[
                            index].latitude + ',' + data[index].longitude +
                        ')">Rute</button>' +
                        '<a href="/detail/' + data[index].id +
                        '" class="btn btn-info mt-3 text-decoration-none text-light">Detail</a>';
                    ev.target.bindPopup(popupContent).openPopup();
                });
            });
        });
    });

    function cari(latlng) {
        var coordinat = latlng.split(",");
        map.flyTo([coordinat[0], coordinat[1]], 16);
    }

    function routing(lat, lng) {
        if (routingControl.getPlan() != null) {
            routingControl.getPlan().setWaypoints([
                L.latLng(currentLat, currentLng),
                L.latLng(lat, lng)
            ]).addTo(map);;
        } else {
            routingControl.setWaypoints({
                waypoints: [
                    L.latLng(currentLat, currentLng),
                    L.latLng(lat, lng)
                ],
            }).addTo(map);
        }
        map.panTo([currentLat, currentLng]);
        map.flyTo([currentLat, currentLng], 15).closePopup();
    }

    L.control.mousePosition().addTo(map);
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</html>
