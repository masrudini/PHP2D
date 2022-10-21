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
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <style>
        .leaflet-routing-container {
            display: none;
        }

        #latlng-text {
            font-weight: 600;
        }

        .leaflet-container {
            min-height: 50vh;
            width: 50vw;
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        #detail {
            white-space: nowrap;
            width: 100px;
            overflow: hidden;
            transition: 0.5s;
            text-overflow: ellipsis;
        }

        #btn-view-detail {
            cursor: pointer;
            color: rgb(118, 118, 240);
        }

        #hide-detail {
            cursor: pointer;
            color: rgb(118, 118, 240);
        }

        .latlng-container {
            /* width: 250px; */
            padding: 14px 18px;
            border-radius: 8px;
            background-color: rgb(211, 209, 209);
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center"
        style="height: 100vh; background-color:rgb(236, 243, 243);">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <a class="p-2 mb-3" href="/"
                            style="color: white; font-weight: bold; background-color:#B66DFF; border-radius: 8px;"><i
                                class="mdi mdi-arrow-left align-self-center"></i></a>

                        <div class="card-title mt-3">
                            <h3 class="">Detail Lokasi</h3>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="card-text">
                                <h3>{{ $lokasi->name }}</h3>
                                <section class="d-flex">
                                    <p id="detail">
                                        {{ $lokasi->detail }} <span id="hide-detail" onclick="hideDetail()">View
                                            less</span></p>
                                    <p id="btn-view-detail" onclick="viewDetail()">View More
                                    </p>
                                </section>
                                <h3>Alamat</h3>
                                <p>{{ $lokasi->address }}</p>
                                <h3>Kategori</h3>
                                <p>{{ $lokasi->category->name }}</p>
                                <div class="d-sm-block d-lg-flex mb-3">
                                    <div>
                                        <p class="mb-1" id="latlng-text">Latitude</p>
                                        <div class="latlng-container me-3">{{ $lokasi->latitude }}</div>
                                    </div>
                                    <div>
                                        <p class="mb-1" id="latlng-text">Longitude</p>
                                        <div class="latlng-container">{{ $lokasi->longitude }}</div>
                                    </div>
                                </div>
                                <h3>Status</h3>
                                <p>{{ $lokasi->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}</p>
                                <button class="btn btn-primary" type="button" onclick="routeToLocation()">Rute</button>
                            </div>
                            <div class="leaflet-container ms-5">
                                <div id="map"></div>
                            </div>
                        </div>

                    </div>
                </div>
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

<script>
    function hideDetail() {
        var e = document.getElementById("detail");
        var eBtn = document.getElementById("btn-view-detail");
        e.style.whiteSpace = "nowrap";
        e.style.textOverflow = "ellipsis";
        e.style.overflow = "hidden";
        e.style.width = "100px";
        eBtn.style.display = "block";
    }

    function viewDetail() {
        var e = document.getElementById("detail");
        var eBtn = document.getElementById("btn-view-detail");
        e.style.whiteSpace = "initial";
        e.style.textOverflow = "intial";
        e.style.overflow = "auto";
        e.style.width = "auto";
        eBtn.style.display = "none";
        console.log(e.innerHTML);
    }
</script>

<script></script>

<!-- Script Leaflet -->
<script>
    // var userLat, userLng;
    var currentLat = "<?php echo $lokasi->latitude; ?>";
    var currentLng = "<?php echo $lokasi->longitude; ?>";


    var map = L.map('map', {
        zoomControl: true
    }).setView([-0.05652732759345948, 109.17823055147235], 13);

    function showPosition(pos) {
        userLat = pos.coords.latitude;
        userLng = pos.coords.longitude;
    }

    if (!navigator.geolocation) {
        console.log("Location denied");
    } else {
        navigator.geolocation.getCurrentPosition(showPosition);
    }

    function routeToLocation() {
        L.Routing.control({
            waypoints: [
                L.latLng(userLat, userLng),
                L.latLng(currentLat, currentLng)
            ],
        }).addTo(map);
        map.flyTo([userLat, userLng]);
    }

    var tiles = L.tileLayer(
        'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 30,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

    marker = L.marker([currentLat, currentLng]).addTo(map);
    map.panTo([currentLat, currentLng]);
    map.flyTo([currentLat, currentLng], 18);
</script>

</html>
