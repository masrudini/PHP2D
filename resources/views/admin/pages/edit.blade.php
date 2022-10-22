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
                                    <a href="/detail" class="btn btn-light"><i
                                            class="mdi mdi-arrow-left menu-icon"></i></a>
                                    <div class="d-flex justify-content-center mb-4">
                                        <h6 class="card-title">Form Edit Toponimi Bangunan</h6>
                                    </div>
                                    <div class="overflow-auto">
                                        <div class="d-flex justify-content-between">
                                            <form action="/edit-lokasi" method="POST" style="width: 50%" class="me-4"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-floating mb-2">
                                                    <select class="form-select" id="category" name="category">
                                                        @foreach ($categories as $category)
                                                            @if ($lokasi->category_id == $category->id)
                                                                <option selected value="{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <label for="category">Jenis Toponimi</label>
                                                </div>
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('name') is-invalid @enderror"
                                                        id="name" name="name" value="{{ $lokasi->name }}">
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
                                                        id="nama_lain" name="nama_lain"
                                                        value="{{ $lokasi->nama_lain }}">
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
                                                            name="latitude" value="{{ $lokasi->latitude }}">
                                                        <label for="latitude">Latitude</label>
                                                    </div>
                                                    <div class="form-floating" style="width: 49%">
                                                        <input type="text" class="form-control mb-2" id="longitude"
                                                            name="longitude" value="{{ $lokasi->longitude }}">
                                                        <label for="longitude">Longitude</label>
                                                    </div>
                                                </div>
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('address') is-invalid @enderror"
                                                        id="address" name="address" value="{{ $lokasi->address }}">
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
                                                        id="desa" name="desa" value="{{ $lokasi->desa }}">
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
                                                            <option value="{{ $lokasi->bentuk }}" selected>
                                                                {{ $lokasi->bentuk }}</option>
                                                            <option value="Persegi">Persegi</option>
                                                            <option value="Lingkaran">Lingkaran</option>
                                                            <option value="Tidak Beraturan">Tidak Beraturan</option>
                                                        </select>
                                                        <label for="bentuk">Bentuk</label>
                                                    </div>
                                                    <div class="form-floating" style="width: 49%">
                                                        <select class="form-select" id="ukuran" name="ukuran">
                                                            <option value="{{ $lokasi->ukuran }}" selected>
                                                                {{ $lokasi->ukuran }}</option>
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
                                                            id="luasan" name="luasan"
                                                            value="{{ $lokasi->luasan }}">
                                                        <label for="luasan">Luasan (M<sup>2</sup>)</label>
                                                        @error('luasan')
                                                            <div class="invalid-feedback mb-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-floating" style="width: 49%">
                                                        <select class="form-select" id="strata" name="strata">
                                                            <option value="{{ $lokasi->strata }}" selected>
                                                                {{ $lokasi->strata }}</option>
                                                            <option value="Tidak Bertingkat">Tidak Bertingkat</option>
                                                            <option value="Bertingkat">Bertingkat</option>
                                                        </select>
                                                        <label for="strata">Strata</label>
                                                    </div>
                                                </div>
                                                <div class="form-floating" style="width: 49%">
                                                    <select class="form-select" id="kualitas_unsur"
                                                        name="kualitas_unsur">
                                                        <option value="{{ $lokasi->kualitas_unsur }}" selected>
                                                            {{ $lokasi->kualitas_unsur }}</option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak - Digunakan">Rusak - Digunakan</option>
                                                        <option value="Tidak Digunakan">Tidak Digunakan</option>
                                                    </select>
                                                    <label for="kualitas_unsur">Kualitas/Kondisi Unsur</label>
                                                </div>
                                                <div class="form-floating my-2">
                                                    <input type="text"
                                                        class="form-control mb-2 @error('pemanfaatan_lain') is-invalid @enderror"
                                                        id="pemanfaatan_lain" name="pemanfaatan_lain"
                                                        value="{{ $lokasi->pemanfaatan_lain }}">
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
                                                        id="keterangan_tambahan" name="keterangan_tambahan"
                                                        value="{{ $lokasi->keterangan_tambahan }}">
                                                    <label for="keterangan_tambahan">Keterangan Tambahan <i
                                                            class="text-muted">*Optional</i></label>
                                                    @error('keterangan_tambahan')
                                                        <div class="invalid-feedback mb-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <input type="hidden" value="{{ $lokasi->id }}" name="id"
                                                    id="id">
                                                <input type="hidden" value="{{ $lokasi->image }}" name="image_old"
                                                    id="image_old">
                                                <input type="hidden" value="{{ $lokasi->sertifikat }}"
                                                    name="sertifikat_old" id="sertifikat_old">
                                                <button class="btn btn-info mt-2" type="submit">Save</button>
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
    var marker = L.marker([-0.05652732759345948, 109.17823055147235], {
        draggable: true
    }).addTo(map);
    var tiles = L.tileLayer(
        'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 30,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);


    getLocation();

    async function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
    }

    function showPosition(position) {
        if (currentLat == "" && currentLng == "") {
            currentLat = position.coords.latitude;
            currentLng = position.coords.longitude;
        }
        marker.setLatLng([currentLat, currentLng]).addTo(map);
        map.panTo([currentLat, currentLng]);
        map.flyTo([currentLat, currentLng], 18);
    }

    marker.on('dragend', function(e) {
        updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
    });
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
    });

    function updateLatLng(lat, lng, reverse) {
        if (reverse) {
            marker.setLatLng([lat, lng]);
            map.panTo([lat, lng]);
        } else {
            document.getElementById('latitude').value = marker.getLatLng().lat;
            document.getElementById('longitude').value = marker.getLatLng().lng;
            map.panTo([lat, lng]);
        }
    }
</script>

</html>
