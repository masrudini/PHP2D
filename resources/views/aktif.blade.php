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

        .legend {
            background: rgb(252, 248, 248);
            padding: 1.5em 3em;
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

        /* AUTOCOMPLETE */
        .autocomplete {
            /*the container must be positioned relative:*/
            position: relative;
            display: inline-block;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
        }

        .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
        }

        #legend-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .legend-items {
            width: 0;
            height: 0;
            display: none;
            transition: 1s;
        }

        .legend-items.active {
            width: auto;
            display: block;
            transition: 1s;
            height: auto;
        }

        .legend {
            transition: 1s;
        }
    </style>

</head>

<body>
    <div class="container position-fixed fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between px-5 align-items-center">
            <a href="{{ url('/') }}" class="navbar-brand" style="width: fit-content;"><img width="50px"
                    id="navbar-icon" src="{{ url('images/sungai_kakap.png') }}" class="me-3" alt="">Fasilitas
                Umum Sungai
                Kakap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width: fit-content;">
                <div class="d-flex flex-sm-column flex-lg-row ms-0 ms-sm-auto align-items-end float-start float-sm-end">
                    <form class="ms-auto mr-auto" autocomplete="off">
                        <div class="autocomplete" style="width:300px;">
                            <input class="form-control" id="lokasi_name" type="text" name="lokasi_name"
                                placeholder="Nama Lokasi">
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Search by
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/aktif" style="color: black;">Fasilitas Baik</a>
                                <a class="dropdown-item" href="/semi-aktif" style="color: black;">Fasilitas Rusak -
                                    Digunakan</a>
                                <a class="dropdown-item" href="/non-aktif" style="color: black;">Fasilitas Tidak
                                    Digunakan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/" style="color: black;">Semua Fasilitas</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
    <div class="container-scroller">
        <div class="leaflet-container">
            <div id="map">
                <input type="hidden" id="image" value="{{ $image }}">
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="{{ url('js/L.Control.MousePosition.js') }}"></script>
<script>
    var map = L.map('map', {
        zoomControl: true
    }).setView([-0.05652732759345948, 109.17823055147235], 13);
    var lokasis = <?php echo json_encode($lokasis); ?>;

    function test(name) {
        lokasis.forEach(lokasi => {
            if (lokasi['name'].toLowerCase() == name.toLowerCase()) {
                // console.log(typeof lokasi['latitude']);
                map.flyTo([lokasi['latitude'], lokasi['longitude']], 16);
            }
        });
    }

    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        test(inp.value);
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }
</script>
<script>
    var lokasi_name = <?php echo json_encode($lokasi_name); ?>;
    autocomplete(document.getElementById("lokasi_name"), lokasi_name);
</script>
<!-- Script Leaflet -->
<script>
    var currentLat = "";
    var currentLng = "";

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

    // Legend
    var legend = L.control({
        position: "bottomright"
    });
    legend.onAdd = function(map) {
        var div = L.DomUtil.create("div", "legend");
        div.innerHTML +=
            `<div id="legend-title"><h4>Legenda</h4><i id="legend-icon-down" onclick="showLegends()" class="ms-3 mdi mdi-chevron-down"></div>`;
        div.innerHTML +=
            `<div id="legend-items" class="legend-items active">
                <img src="images/icon_perkantoran.png" width="18px" class="icon py-2"></i><span class="px-2">Perkantoran</span><br>
                <img src="images/icon_pendidikan.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Pendidikan</span><br>
                <img src="images/icon_kesehatan.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Kesehatan</span><br>
                <img src="images/icon_ibadah.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Ibadah</span><br>
                <img src="images/icon_wisata.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Wisata/Hiburan</span><br>
                <img src="images/icon_olahraga.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Olahraga</span><br>
                <img src="images/icon_komunikasi.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Komunikasi</span><br>
                <img src="images/icon_transmisi.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Transmisi/Instalasi Listrik/Gas/Air Bersih</span><br>
                <img src="images/icon_transportasi.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Transportasi</span><br>
                <img src="images/icon_pabrik.png" width="18px" class="icon py-2"></i><span class="px-2">Tempat/Fasilitas Pabrik/Industri</span><br>
                <img src="images/icon_lainnya.png" width="18px" class="icon py-2"></i><span class="px-2">Landmark : Kuburan,Nama Perumahan,Komplek,dll</span><br>
                </div>`;
        return div;
    };
    legend.addTo(map);

    function showLegends() {
        var icon = document.getElementById("legend-icon-down");
        var legendItems = document.getElementById("legend-items");
        icon.classList.toggle("mdi-chevron-down");
        icon.classList.toggle("mdi-chevron-up");
        legendItems.classList.toggle("active");
    }

    var image = document.getElementById("image");
    var images = image.value.split(',');

    $(document).ready(function() {
        $.getJSON('lokasi-aktif/json', function(data) {
            $.each(data, function(index) {
                var icon_perkantoran = L.icon({
                    iconUrl: '/images/icon_perkantoran.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_pendidikan = L.icon({
                    iconUrl: '/images/icon_pendidikan.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_kesehatan = L.icon({
                    iconUrl: '/images/icon_kesehatan.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_ibadah = L.icon({
                    iconUrl: '/images/icon_ibadah.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_wisata = L.icon({
                    iconUrl: '/images/icon_wisata.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_olahraga = L.icon({
                    iconUrl: '/images/icon_olahraga.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_komunikasi = L.icon({
                    iconUrl: '/images/icon_komunikasi.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_transmisi = L.icon({
                    iconUrl: '/images/icon_transmisi.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_transportasi = L.icon({
                    iconUrl: '/images/icon_transportasi.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_pabrik = L.icon({
                    iconUrl: '/images/icon_pabrik.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var icon_lainnya = L.icon({
                    iconUrl: '/images/icon_lainnya.png',
                    iconSize: [26, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [15, 36],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                // console.log(data[index].category_id)
                marker = L.marker([data[index].latitude, data[index].longitude], {
                    icon: data[index].category_id == 1 ? icon_perkantoran : data[index]
                        .category_id == 2 ?
                        icon_pendidikan : data[index].category_id == 3 ?
                        icon_kesehatan : data[index].category_id == 4 ? icon_ibadah :
                        data[index]
                        .category_id == 5 ? icon_wisata : data[index].category_id ==
                        6 ? icon_olahraga : data[index]
                        .category_id == 7 ? icon_komunikasi : data[index].category_id ==
                        8 ?
                        icon_transmisi : data[index].category_id == 9 ?
                        icon_transportasi : data[
                            index].category_id == 10 ? icon_pabrik : data[index]
                        .category_id == 11 ? icon_lainnya : icon_lainnya
                }).addTo(map).bindPopup();

                marker.on('mouseover', function(ev) {
                    const popupLocation = '<p>' + data[index].name;
                    ev.target.bindPopup(popupLocation).openPopup();
                });

                marker.on('click', function(ev) {
                    const popupContent =
                        '<h4>' + data[index].name + '</h4>' +
                        '<img height="150px" width="100%"  src="storage/' + images[
                            index] + '">' + '</div>' +
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

    // batas desa
    $.getJSON('sui_kkp.geojson', function(json) {
        geoLayer = L.geoJson(json, {
            style: function(feature, layer) {
                return {
                    fillOpacity: 0,
                    weight: 5,
                    opacity: 1,
                    color: "brown"
                };
            },
            onEachFeature: function(feature, layer) {
                layer.addTo(map);
            }
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
            ]).addTo(map);
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
