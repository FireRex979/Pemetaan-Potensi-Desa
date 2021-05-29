<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Potensi Desa</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        #mapid { height: 700px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body id="page-top">

    <div id="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-primary">Map</h5>
                        </div>
                        <div class="card-body">
                            <div id="mapid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <script>
        var mymap = L.map('mapid').setView([-8.375319619905975, 115.18006704436591], 12);
        L.Map.include({
            getMarkerById: function (id) {
                var marker = null;
                this.eachLayer(function (layer) {
                    if (layer instanceof L.Marker) {
                        if (layer.options.id === id) {
                            marker = layer;
                        }
                    }
                });
                return marker;
            }
        });

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);

        function getAllDesa() {
            let url = '{{ route("map.get_all_desa") }}';
            $.ajax({
                url : url,
                method : 'GET',
                success : function(response) {
                    for (let i = 0; i < response.desa.length; i++) {
                        createPolygon(response.desa[i]);
                        createMarkerDesa(response.desa[i]);
                    }
                }
            });
        }

        function createMarkerDesa(desa) {
            let latlng = JSON.parse(desa['marker_desa']);
            var marker = L.marker([latlng[0], latlng[1]]).addTo(mymap).bindPopup(desa['nama_desa']);
        }

        function getAllPotensi() {
            let url = '{{ route("map.get_sumber_desa") }}';
            $.ajax({
                url : url,
                method : 'GET',
                success : function(response) {
                    for(let i = 0; i< response.sumber_air.length; i++) {
                        createMarkerSumberAir(response.sumber_air[i]);
                    }
                    for(let i = 0; i< response.sekolah.length; i++) {
                        createMarkerSekolah(response.sekolah[i]);
                    }
                    for(let i = 0; i< response.tempat_ibadah.length; i++) {
                        createMarkerTempatIbadah(response.tempat_ibadah[i]);
                    }
                }
            });
        }

        var iconSumberAir = L.icon({
            iconUrl: '/assets/img/waterfall.png',
            iconSize:     [24, 24], // size of the icon
            shadowSize:   [8, 8], // size of the shadow
            iconAnchor:   [16, 16], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [0, -12] // point from which the popup should open relative to the iconAnchor
        });

        var iconSekolah = L.icon({
            iconUrl: '/assets/img/school.png',
            iconSize:     [24, 24], // size of the icon
            shadowSize:   [8, 8], // size of the shadow
            iconAnchor:   [16, 16], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [0, -12] // point from which the popup should open relative to the iconAnchor
        });

        var iconTempatIbadah = L.icon({
            iconUrl: '/assets/img/shinto.png',
            iconSize:     [24, 24], // size of the icon
            shadowSize:   [8, 8], // size of the shadow
            iconAnchor:   [16, 16], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [0, -12] // point from which the popup should open relative to the iconAnchor
        });

        function createMarkerSumberAir(potensi) {
            let pop_up = '<p><strong>'+potensi['nama_sumber']+'</strong><p>'+
                        '<hr style="margin-top : -15px;">'+
                        '<p style="margin-top : -10px;"><small> <i class="fas fa-faucet"></i> <span>Debit Sumber Air : '+potensi['debit']+' lt/detik</span></small></p>'+
                        '<p style="margin-top : -15px;"><small> <i class="fas fa-user-tie"></i> <span>Pengelola : '+potensi['pengelola']+'</span></small></p>';

            var marker = L.marker([potensi['lat'], potensi['lng']], {
                icon: iconSumberAir,
                id : potensi['id']
            }).addTo(mymap).bindPopup(pop_up);
        }

        function createMarkerSekolah(potensi) {
            let pop_up = '<p><strong>'+potensi['nama_sekolah']+'</strong><p>'+
                        '<hr style="margin-top : -15px;">'+
                        '<p style="margin-top : -10px;"><small> <i class="fas fa-faucet"></i> <span>Jenis Sekolah : '+potensi['jenis']+'</span></small></p>'+
                        '<p style="margin-top : -15px;"><small> <i class="fas fa-user-tie"></i> <span>Tingkat : '+potensi['tingkat']+'</span></small></p>'+
                        '<p style="margin-top : -15px;"><small> <i class="fas fa-user-tie"></i> <span>Alamat : '+potensi['alamat']+'</span></small></p>';

            var marker = L.marker([potensi['lat'], potensi['lng']], {
                icon: iconSekolah,
                id : potensi['id']
            }).addTo(mymap).bindPopup(pop_up);
        }

        function createMarkerTempatIbadah(potensi) {
            let pop_up = '<p><strong>'+potensi['nama_tempat_ibadah']+'</strong><p>'+
                        '<hr style="margin-top : -15px;">'+
                        '<p style="margin-top : -10px;"><small> <i class="fas fa-faucet"></i> <span>Agama : '+potensi['agama']+'</span></small></p>'+
                        '<p style="margin-top : -15px;"><small> <i class="fas fa-user-tie"></i> <span>Alamat : '+potensi['alamat']+'</span></small></p>';

            var marker = L.marker([potensi['lat'], potensi['lng']], {
                icon: iconTempatIbadah,
                id : potensi['id']
            }).addTo(mymap).bindPopup(pop_up);
        }

        function createPolygon(desa) {
            var koor = jQuery.parseJSON(desa['batas_desa']);
            var pathCoords = connectTheDots(koor);
            var pathLine = L.polygon(pathCoords, {
                id: desa['id'],
                color: desa['warna_batas_desa'],
                fillColor: desa['warna_batas_desa'],
                fillOpacity: 0.4,
            }).addTo(mymap);

        }

        function connectTheDots(data){
            var c = [];
            for(i in data) {
                var x = data[i]['lat'];
                var y = data[i]['lng'];
                c.push([x, y]);
            }
            return c;
        }

        $(document).ready(function(){
            $('#map').addClass('active');
            getAllDesa();
            getAllPotensi();
        });
    </script>
</body>
</html>