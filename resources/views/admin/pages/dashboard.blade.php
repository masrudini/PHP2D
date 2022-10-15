<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | Page</title>
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
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <style>
        .leaflet-container {
            margin: 0 auto;
            height: 100%;
            width: 100%;
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
            padding: 30 px;
            background-color: white;
        }

        #map {
            height: 100%;
            width: 100vw;
        }

        .leaflet-popup {
            margin-bottom: 25px;
        }

        .leaflet-control-mouseposition {
            background-color: rgba(255, 255, 255, 0.7);
            box-shadow: 0 0 5px #bbb;
            padding: 1px 5px;
            margin: 0;
            color: #333;
            font: 11px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif;
        }

        .leaflet-popup-content-wrapper {
            text-align: center;
            width: 300px;
            height: 30%;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        {{-- navbar --}}
        @include('admin/includes/navbar')
        {{-- end navbar --}}

        <div class="container-fluid page-body-wrapper">
            {{-- sidebar --}}
            @include('admin/includes/sidebar')
            {{-- end sidebar --}}
            <div class="main-panel">
                {{-- content --}}
                <div class="row">
                    <div class="container-scroller">
                        <div class="container-fluid page-body-wrapper">
                            <div class="card">
                                <div class="leaflet-container">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end content --}}
            </div>
        </div>

    </div>

</body>
<script src="{{ url('admin_template/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ url('admin_template/assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ url('admin_template/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('admin_template/assets/js/off-canvas.js') }}"></script>
<script src="{{ url('admin_template/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ url('admin_template/assets/js/misc.js') }}"></script>
<script src="{{ url('admin_template/assets/js/dashboard.js') }}"></script>
<script src="{{ url('admin_template/assets/js/todolist.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="{{ url('js/L.Control.MousePosition.js') }}"></script>
<!-- Script Leaflet -->
<script>
    var currentLat = "";
    var currentLng = "";
    // function showPosition(pos) {
    //     currentLat = pos.coords.latitude;
    //     currentLng = pos.coords.longitude;
    //     console.log(currentLat, currentLng);
    // }
    var map = L.map('map', {
        zoomControl: true
    }).setView([-0.05652732759345948, 109.17823055147235], 13);
    // map.flyTo([currentLat, currentLng], 8
    var tiles = L.tileLayer(
        'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 30,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);
    // map.flyTo([currentLat, currentLng]);
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
</script>

</html>
