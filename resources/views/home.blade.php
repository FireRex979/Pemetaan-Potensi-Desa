@extends('layouts.admin')
@push('css')
    <style>
        #mapid { height: 700px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
@endpush
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Desa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $desa }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-globe-europe fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sekolah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sekolah }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tempat Ibadah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tempat_ibadah }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gopuram fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Sumber Air</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sumber_air }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-water fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Preview Map</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        '<p style="margin-top : -10px;"><small> <i class="fas fa-list"></i> <span>Jenis Sekolah : '+potensi['jenis']+'</span></small></p>'+
                        '<p style="margin-top : -15px;"><small> <i class="fas fa-sort-amount-up-alt"></i> <span>Tingkat : '+potensi['tingkat']+'</span></small></p>'+
                        '<p style="margin-top : -15px;"><small> <i class="fas fa-map-marker-alt"></i> <span>Alamat : '+potensi['alamat']+'</span></small></p>';

            var marker = L.marker([potensi['lat'], potensi['lng']], {
                icon: iconSekolah,
                id : potensi['id']
            }).addTo(mymap).bindPopup(pop_up);
        }

        function createMarkerTempatIbadah(potensi) {
            let pop_up = '<p><strong>'+potensi['nama_tempat_ibadah']+'</strong><p>'+
                        '<hr style="margin-top : -15px;">'+
                        '<p style="margin-top : -10px;"><small> <i class="fas fa-faucet"></i> <span>Agama : '+potensi['agama']+'</span></small></p>'+
                        '<p style="margin-top : -15px;"><small> <i class="fas fa-map-marker-alt"></i> <span>Alamat : '+potensi['alamat']+'</span></small></p>';

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
        $(document).ready(function () {
            $('#dashboard').addClass('active');
            getAllDesa();
            getAllPotensi();
        });
    </script>
@endpush
