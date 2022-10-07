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
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('images/sungai_kakap.ico') }}" />
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <style>
        html,
        body {
            height: 100%;
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
            height: 95%;
            width: 100vw;
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="card">
                <nav>
                    <a href="/login">Login</a>
                </nav>
                <div class="leaflet-container">
                    <div id="map"></div>
                </div>
            </div>
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

    var tiles = L.tileLayer(
        'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 30,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

    $(document).ready(function() {
        $.getJSON('lokasi/json', function(data) {
            $.each(data, function(index) {

                marker = L.marker([data[index].latitude, data[index].longitude]).addTo(map)
                    .bindPopup();

                marker.on('mouseover', function(ev) {
                    const popupLocation = '<p>' + data[index].name;
                    ev.target.bindPopup(popupLocation).openPopup();
                });

                marker.on('click', function(ev) {
                    const popupContent = '<h3>' + data[index].name + '</h3>' + '<p>' +
                        data[index].address + '</p>' +
                        '<img height="200px" width="100%"  src="images/numpanh/' + data[
                            index].image + '">' +
                        '<button class="btn btn-success mt-3" onclick="keSini(' + data[
                            index].latitude + ',' + data[index].longitude +
                        ')">Rute</button>' +
                        '<a href="/detail/' + data[index].id +
                        '" class="btn btn-success mt-3 mx-2 text-decoration-none text-light">Detail</a>';
                    ev.target.bindPopup(popupContent).openPopup();
                });
            });
        });
    });

    // getLocation();

    // function getLocation() {
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(showPosition);
    //     }
    // }

    // function showPosition(position) {
    //     if (currentLat == "" && currentLng == "") {
    //         currentLat = position.coords.latitude;
    //         currentLng = position.coords.longitude;
    //     }
    //     marker = L.marker([currentLat, currentLng]).addTo(map);
    //     map.panTo([currentLat, currentLng]);
    //     map.flyTo([currentLat, currentLng], 20);
    // }
</script>

</html>
