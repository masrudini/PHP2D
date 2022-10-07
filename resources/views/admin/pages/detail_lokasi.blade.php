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
            height: 40vh;
            width: 50%;
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }

        #map {
            height: 100%;
            width: 100%;
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
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card" style="height: 70vh">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center mb-4">
                                        <h6 class="card-title">Detail Lokasi</h6>
                                    </div>
                                    <div class="overflow-auto">
                                        <div class="d-flex justify-content-between">
                                            <div class="card">
                                                <p>test</p>
                                            </div>
                                            <div class="leaflet-container">
                                                <div id="map"></div>
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

<!-- Script Leaflet -->
<script>
    var currentLat = "<?php echo $lokasi->latitude; ?>";
    var currentLng = "<?php echo $lokasi->longitude; ?>";

    var map = L.map('map', {
        zoomControl: true
    }).setView([-0.05652732759345948, 109.17823055147235], 13);

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
