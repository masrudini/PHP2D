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
            width: 60%;
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
            background-color: white;
        }

        #map {
            height: 50vh;
            width: 100%;
        }

        /* #detail {
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
        } */
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
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card" style="min-height: 70vh; max-heigth: 100vh;">
                                <div class="card-body">
                                    <a href="/detail" class="btn btn-light"><i
                                            class="mdi mdi-arrow-left menu-icon"></i></a>
                                    <div class="d-flex justify-content-center mb-4">
                                        <h6 class="card-title">Detail Lokasi</h6>
                                    </div>
                                    <div class="overflow-auto">
                                        <div class="d-flex justify-content-between">
                                            <div class="card" style="width: 50%; margin-right: 20px;">
                                                <h3>{{ $lokasi->name }}</h3>
                                                <div class="overflow-auto">
                                                    <p>Category : {{ $lokasi->category->name }}</p>
                                                    <p>Nama Lain/Sebutan Lokal : {{ $lokasi->nama_lain }}</p>
                                                    <p>Alamat : {{ $lokasi->address }}</p>
                                                    <p>Desa : {{ $lokasi->desa }}</p>
                                                    <p>Bentuk : {{ $lokasi->bentuk }}</p>
                                                    <p>Ukuran : {{ $lokasi->ukuran }}</p>
                                                    <p>Luasan : {{ $lokasi->luasan }} M<sup>2</sup></p>
                                                    <p>Strata : {{ $lokasi->strata }}</p>
                                                    <p>Kualitas Unsur : {{ $lokasi->kualitas_unsur }}</p>
                                                    <p>Pemanfaatan Lain : {{ $lokasi->pemanfaatan_lain }}</p>
                                                    <p>Keterangan Tambahan : {{ $lokasi->keterangan_tambahan }}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="form-floating" style="width: 49%">
                                                            <input type="text" class="form-control mb-2"
                                                                value="{{ $lokasi->latitude }}" readonly>
                                                            <label for="latitude">Latitude</label>
                                                        </div>
                                                        <div class="form-floating" style="width: 49%">
                                                            <input type="text" class="form-control mb-2"
                                                                value="{{ $lokasi->longitude }}" readonly>
                                                            <label for="longitude">Longitude</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="leaflet-container">
                                                <div id="map"></div>
                                                <div class="d-flex justify-content-between">
                                                    @if ($lokasi->sertifikat)
                                                        <img src="{{ url('storage') }}/{{ $lokasi->sertifikat }}"
                                                            style="width:49%; height: 200px;" class="rounded mt-2"
                                                            alt="">
                                                    @endif
                                                    <img src="{{ url('storage') }}/{{ $lokasi->image }}"
                                                        style="width:49%; height: 200px;" class="rounded mt-2"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

{{-- <script>
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
</script> --}}


<!-- Script Leaflet -->
<script>
    // var userLat, userLng;
    var currentLat = "<?php echo $lokasi->latitude; ?>";
    var currentLng = "<?php echo $lokasi->longitude; ?>";


    var map = L.map('map', {
        zoomControl: true
    }).setView([-0.05652732759345948, 109.17823055147235], 13);
    // Routing & current location

    function showPosition(pos) {
        userLat = pos.coords.latitude;
        userLng = pos.coords.longitude;
        console.log(userLat, userLng);
    }

    if (!navigator.geolocation) {
        console.log("Location denied");
    } else {
        console.log("Halo");
        navigator.geolocation.getCurrentPosition(showPosition);
    }

    function routeToLocation() {
        L.Routing.control({
            waypoints: [
                L.latLng(userLat, userLng),
                L.latLng(currentLat, currentLng)
            ],
        }).addTo(map);
        map.panTo([userLat, userLng]);
        map.flyTo([userLat, userLng], 15);
    }

    var tiles = L.tileLayer(
        'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 30,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

    marker = L.marker([currentLat, currentLng]).addTo(map);
    map.panTo([currentLat, currentLng]);
    map.flyTo([currentLat, currentLng], 18);

    function onMapClick(e) {
        var latitude = e.latlng['lat'];
        var longitude = e.latlng['lng'];
        document.getElementById('latitude').setAttribute('value', e.latlng['lat']);
        document.getElementById('longitude').setAttribute('value', e.latlng['lng']);
        map.removeLayer(marker);
        marker = L.marker([latitude, longitude]).addTo(map);
        map.panTo([latitude, longitude]);
        map.flyTo([latitude, longitude], 17);
    }
    map.on('click', function(e) {
        onMapClick(e);
    });
</script>

</html>
