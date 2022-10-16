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
            height: auto;
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
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center mb-4">
                                        <h6 class="card-title">Form Edit Lokasi</h6>
                                    </div>
                                    <div class="overflow-auto">
                                        <div class="d-flex justify-content-between">
                                            <form action="/edit-lokasi" method="POST" style="width: 50%" class="me-4"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @foreach ($lokasis as $lokasi)
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            class="form-control mb-2 @error('name') is-invalid @enderror"
                                                            id="name" name="name" value="{{ $lokasi->name }}">
                                                        <label for="name">Nama Gedung</label>
                                                        @error('name')
                                                            <div class="invalid-feedback mb-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            class="form-control mb-2 @error('address') is-invalid @enderror"
                                                            id="address" name="address"
                                                            value="{{ $lokasi->address }}">
                                                        <label for="address">Alamat</label>
                                                        @error('address')
                                                            <div class="invalid-feedback mb-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            class="form-control mb-2 @error('detail') is-invalid @enderror"
                                                            id="detail" name="detail" value="{{ $lokasi->detail }}">
                                                        <label for="detail">Detail</label>
                                                        @error('detail')
                                                            <div class="invalid-feedback mb-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-floating mb-2">
                                                        <select class="form-select" id="category" name="category">
                                                            @foreach ($categories as $category)
                                                                @if ($category->id == $lokasi->category_id)
                                                                    <option value="{{ $category->id }}" selected>
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <label for="category">Kategori Gedung</label>
                                                    </div>
                                                    <div>
                                                        <input
                                                            class="form-control mb-2 @error('image') is-invalid @enderror"
                                                            type="file" id="image" name="image">
                                                        @error('image')
                                                            <div class="invalid-feedback mb-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="d-flex justify-content-between ">
                                                        <div class="form-floating" style="width: 49%">
                                                            <input type="text" class="form-control mb-2"
                                                                id="latitude" name="latitude"
                                                                value="{{ $lokasi->latitude }}" readonly>
                                                            <label for="latitude">Latitude</label>
                                                        </div>
                                                        <div class="form-floating" style="width: 49%">
                                                            <input type="text" class="form-control mb-2"
                                                                id="longitude" name="longitude"
                                                                value="{{ $lokasi->longitude }}" readonly>
                                                            <label for="longitude">Longitude</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-floating">
                                                        <select class="form-select" id="is_active" name="is_active">
                                                            @if ($lokasi->is_active == 1)
                                                                <option value="1" selected>Gedung Aktif</option>
                                                                <option value="0">Gedung Tidak Aktif</option>
                                                            @else
                                                                <option value="1">Gedung Aktif</option>
                                                                <option value="0" selected>Gedung Tidak Aktif
                                                                </option>
                                                            @endif
                                                        </select>
                                                        <label for="is_active">Status Gedung</label>
                                                    </div>
                                                @endforeach
                                                <input type="hidden" name="id" value="{{ $lokasi->id }}">
                                                <input type="hidden" name="image_old" value="{{ $lokasi->image }}">
                                                <button class="btn btn-info mt-2" type="submit">Update</button>
                                            </form>
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
    var currentLat = document.getElementById('latitude').getAttribute('value');
    var currentLng = document.getElementById('longitude').getAttribute('value');

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
    map.flyTo([currentLat, currentLng], 17);

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
