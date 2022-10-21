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
            height: 520px;
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
                                        <h6 class="card-title">Form Isian Toponimi Bangunan</h6>
                                    </div>
                                    <div class="overflow-auto">
                                        <div class="d-flex justify-content-between">
                                            <form action="/tambah-lokasi" method="POST" style="width: 50%"
                                                class="me-4" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-floating mb-2">
                                                    <select class="form-select" id="category" name="category">
                                                        <option selected>-</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="category">Jenis Toponimi</label>
                                                </div>
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('name') is-invalid @enderror"
                                                        id="name" name="name" value="{{ old('name') }}">
                                                    <label for="name">Nama Fasilitas Umum</label>
                                                    @error('name')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('nama_lain') is-invalid @enderror"
                                                        id="nama_lain" name="nama_lain">
                                                    <label for="nama_lain">Nama Lain/Sebutan Lokal</label>
                                                    @error('nama_lain')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="d-flex justify-content-between ">
                                                    <div class="form-floating" style="width: 49%">
                                                        <input type="text" class="form-control mb-2" id="latitude"
                                                            name="latitude" value="">
                                                        <label for="latitude">Latitude</label>
                                                    </div>
                                                    <div class="form-floating" style="width: 49%">
                                                        <input type="text" class="form-control mb-2" id="longitude"
                                                            name="longitude" value="">
                                                        <label for="longitude">Longitude</label>
                                                    </div>
                                                </div>
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('address') is-invalid @enderror"
                                                        id="address" name="address">
                                                    <label for="address">Alamat</label>
                                                    @error('address')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('desa') is-invalid @enderror"
                                                        id="desa" name="desa">
                                                    <label for="desa">Desa</label>
                                                    @error('desa')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-floating" style="width: 49%">
                                                        <select class="form-select" id="bentuk" name="bentuk">
                                                            <option selected>-</option>
                                                            <option value="Persegi">Persegi</option>
                                                            <option value="Lingkaran">Lingkaran</option>
                                                            <option value="Tidak Beraturan">Tidak Beraturan</option>
                                                        </select>
                                                        <label for="bentuk">Bentuk</label>
                                                    </div>
                                                    <div class="form-floating" style="width: 49%">
                                                        <select class="form-select" id="ukuran" name="ukuran">
                                                            <option selected>-</option>
                                                            <option value="Besar">Besar</option>
                                                            <option value="Sedang">Sedang</option>
                                                            <option value="Kecil">Kecil</option>
                                                        </select>
                                                        <label for="ukuran">Ukuran</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between my-2">
                                                    <div class="form-floating" style="width: 49%">
                                                        <input type="text"
                                                            class="form-control mb-2 @error('luasan') is-invalid @enderror"
                                                            id="luasan" name="luasan">
                                                        <label for="luasan">Luasan (M<sup>2</sup>)</label>
                                                        @error('luasan')
                                                            <div class="invalid-feedback mb-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-floating" style="width: 49%">
                                                        <select class="form-select" id="strata" name="strata">
                                                            <option selected>-</option>
                                                            <option value="Tidak Bertingkat">Tidak Bertingkat</option>
                                                            <option value="Bertingkat">Bertingkat</option>
                                                        </select>
                                                        <label for="strata">Strata</label>
                                                    </div>
                                                </div>
                                                <div class="form-floating" style="width: 49%">
                                                    <select class="form-select" id="kualitas_unsur"
                                                        name="kualitas_unsur">
                                                        <option selected>-</option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak - Digunakan">Rusak - Digunakan</option>
                                                        <option value="Tidak Digunakan">Tidak Digunakan</option>
                                                    </select>
                                                    <label for="kualitas_unsur">Kualitas/Kondisi Unsur</label>
                                                </div>
                                                <div class="form-floating my-2">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('pemanfaatan_lain') is-invalid @enderror"
                                                        id="pemanfaatan_lain" name="pemanfaatan_lain">
                                                    <label for="pemanfaatan_lain">Pemanfaatan Lain <i
                                                            class="text-muted">*Jika ada</i></label>
                                                    @error('pemanfaatan_lain')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="sertifikat" class="text-muted">Bukti
                                                        Kepemilikan/Sertifikat atas Hak
                                                        Tanah</label>
                                                    <input
                                                        class="form-control mb-2 @error('sertifikat') is-invalid @enderror"
                                                        type="file" id="sertifikat" name="sertifikat">
                                                    @error('sertifikat')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="image" class="text-muted">Foto Unsur</label>
                                                    <input
                                                        class="form-control mb-2 @error('image') is-invalid @enderror"
                                                        type="file" id="images" name="image">
                                                    @error('image')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('keterangan_tambahan') is-invalid @enderror"
                                                        id="keterangan_tambahan" name="keterangan_tambahan">
                                                    <label for="keterangan_tambahan">Keterangan Tambahan <i
                                                            class="text-muted">*Optional</i></label>
                                                    @error('keterangan_tambahan')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <button class="btn btn-info mt-2" type="submit">Tambah</button>
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
    var currentLat = document.getElementById('latitude').value;
    var currentLng = document.getElementById('longitude').value;

    var map = L.map('map', {
        zoomControl: true
    }).setView([-0.05652732759345948, 109.17823055147235], 13);

    var tiles = L.tileLayer(
        'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 30,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);


    getLocation();

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
    }

    function showPosition(position) {
        if (currentLat == "" && currentLng == "") {
            currentLat = position.coords.latitude;
            currentLng = position.coords.longitude;
        }
        marker = L.marker([latitude, longitude]);
        map.panTo([currentLat, currentLng]);
        map.flyTo([currentLat, currentLng], 18);
    }

    function onMapClick(e) {
        var latitude = e.latlng['lat'];
        var longitude = e.latlng['lng'];
        document.getElementById('latitude').value = e.latlng['lat'];
        document.getElementById('longitude').value = e.latlng['lng'];
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
