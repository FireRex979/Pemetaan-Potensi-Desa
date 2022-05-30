@extends('layouts.admin')
@section('title', 'Detail Desa')
@push('css')
    <style>
        #mapid { height: 500px; }
        .btn-float {
            position: fixed;
            bottom: -4px;
            right: 10px;
            margin-bottom: 40px;
            margin-right: 20px;
        }
        .btn-cricle {
            border-radius: 50%;
            color: #fff;
            display: inline-block;
            text-align: center;
            padding: 0.375rem;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endpush
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Edit Desa</h1>
    @if($message = Session::get('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Map</h6>
                </div>
                <div class="card-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Desa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('desa.update', $desa->id) }}" method="POST" id="form-submit">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Desa</label>
                            <input type="text" class="form-control" name="nama_desa" value="{{ old('nama_desa') ?? $desa->nama_desa }}" placeholder="Masukkan nama desa">
                        </div>
                        <div class="form-group">
                            <label for="">Koordinat Desa</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" readonly class="form-control" name="marker_desa" value="{{ $desa->marker_desa }}" id="marker-desa" placeholder="Koordinat Desa">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <a href="javascript:void(0)" id="set-koordinat"><i class="fas fa-map-marker-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Zoom</label>
                            <input type="number" readonly class="form-control" name="zoom" value="{{ $desa->zoom }}" min="1" id="zoom">
                        </div>
                        <div class="form-group">
                            <label for="">Warna Batas</label>
                            <input type="color" class="form-control" name="warna_batas" value="{{ $desa->warna_batas_desa ?? '#4e73df' }}" id="color-picker">
                        </div>
                        <div class="form-group">
                            <label for="">Batas Desa</label>
                            <textarea name="batas_desa" id="batas-desa" cols="30" rows="4" readonly class="form-control">{{ $desa->batas_desa }}</textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-float">
        <button class="btn rounded-pill btn-warning btn-lg" id="btn-submit"><i class="fas fa-edit"></i> Update</button>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script>
        var mymap = L.map('mapid').setView({{ $desa->marker_desa }}, {{ $desa->zoom }});
        L.Map.include({
            //include function in mymap for get Marker by id
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
            },
            //include function in mymap for get Polygon by id
            getPolyGonById: function (id) {
                var polygon = null;
                this.eachLayer(function (layer) {
                    if (layer instanceof L.Polygon) {
                        if (layer.options.id === id) {
                            polygon = layer;
                        }
                    }
                });
                return polygon;
            },
            //include function in mymap for disable edit mode in no polygon selected
            disableEditMode: function (id) {
                this.eachLayer(function (layer) {
                    if (layer instanceof L.Polygon) {
                        if (layer.options.id !== id) {
                            layer.pm.disable();
                        }
                    }
                });
            }
        });

        //when map zoom in or zoom out
        mymap.on('zoomend', function() {
            let zoom = mymap.getZoom();
            $('#zoom').val(zoom);
        });

        //setup geoman
        mymap.pm.addControls({
            position: 'topleft',
            drawMarker: false,
            drawCircleMarker: false,
            drawPolyline: false,
            drawRectangle: false,
            drawCircle: false,
            cutPolygon: false,
            removalMode: false,
            pinningOption: false,
        });

        //when marker drag
        $('#set-koordinat').on('click', function(){
            mymap.pm.enableGlobalDragMode();
        });

        //when color is change
        $('#color-picker').on('change', function(){
            var color = $(this).val();
            polygon = mymap.getPolyGonById({{ $desa->id }});
            polygon.setStyle({
                color: color,
                fillColor: color,
                fillOpacity: 0.4,
            });
            mymap.pm.setPathOptions({
                color: color,
                fillColor: color,
                fillOpacity: 0.4,
            });
        });

        //when start drawing
        var line = [];
        mymap.on('pm:drawstart', ({ workingLayer }) => {
            workingLayer.on('pm:vertexadded', e => {
                var koordinat = {};
                koordinat['lat'] = e.latlng.lat;
                koordinat['lng'] = e.latlng.lng;
                line.push(
                    koordinat
                );
            });
        });

        mymap.on('pm:create', e => {
            let shape = e.shape;
            if (shape == 'Marker') {
                let koordinat_desa = "["+e.marker._latlng.lat+", "+e.marker._latlng.lng+"]";
                $('#marker-desa').val(koordinat_desa);
                mymap.pm.disableDraw('Marker', {
                    snappable: true,
                    snapDistance: 20,
                });
            } else if(shape == 'Polygon'){
                $('#batas-desa').val(JSON.stringify(line));
            }
        });

        //when edit mode on
        mymap.on('pm:globaleditmodetoggled', e => {
            polygon = mymap.disableEditMode({{ $desa->id }});
        });

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);

        //if page is totally loaded
        $(document).ready(function(){
            $('#desa').addClass('active');
            let color = $('#color-picker').val();
            mymap.pm.setPathOptions({
                color: color,
                fillColor: color,
                fillOpacity: 0.4,
            });
            readLine('{{ $desa->id }}');
            getAllDesa();

        });

        //read koordinate desa selected
        function readLine(id) {
            let url = '/admin/desa/get-batas-desa/'+id;
            $.ajax({
                url : url,
                method : 'GET',
                success : function(response) {
                    var koor = jQuery.parseJSON(response.desa['batas_desa']);
                    var pathCoords = connectTheDots(koor);
                    var pathLine = L.polygon(pathCoords, {
                        id: response.desa['id'],
                        color: response.desa['warna_batas_desa'],
                        fillColor: response.desa['warna_batas_desa'],
                        fillOpacity: 0.4,
                        nonedit: false
                    }).addTo(mymap);
                    var marker = L.marker({{ $desa->marker_desa }}).addTo(mymap)
                        .bindPopup(response.desa['nama_desa']);
                    marker.on('click', function() {
                        marker.openPopup();
                    });
                    onUpdatePM(pathLine);
                    onDragMarker(marker);
                    return pathLine;
                }
            });
        }

        //get all desa's data fron db
        function getAllDesa() {
            let url = '{{ route("map.get_all_desa") }}';
            $.ajax({
                url : url,
                method : 'GET',
                success : function(response) {
                    for (let i = 0; i < response.desa.length; i++) {
                        if (response.desa[i]['id'] != '{{ $desa->id }}') {
                            createPolygon(response.desa[i]);
                        }
                    }
                }
            });
        }

        //build polygon
        function createPolygon(desa) {
            var koor = jQuery.parseJSON(desa['batas_desa']);
            var pathCoords = connectTheDots(koor);
            var pathLine = L.polygon(pathCoords, {
                id: desa['id'],
                nonedit:true,
            }).addTo(mymap);
            pathLine.bindPopup(desa['nama_desa']);
        }

        //on marker drag
        function onDragMarker(marker) {
            marker.on('pm:dragend', e => {
                let koordinat_desa = "["+e.target._latlng.lat+", "+e.target._latlng.lng+"]";
                $('#marker-desa').val(koordinat_desa);
            });
        }

        //on polygon in edit mode end
        function onUpdatePM(line) {
            line.on('pm:update', e => {
                var id = e.layer.options.id;
                var koordinats = e.layer._latlngs;
                let koordinat = {};
                line = []
                koordinats[0].forEach(function(latlng){
                    koordinat['lat'] = latlng.lat;
                    koordinat['lng'] = latlng.lng;
                    line.push({
                        lat: latlng.lat,
                        lng: latlng.lng
                    });
                });
                $('#batas-desa').val(JSON.stringify(line));
            });
        }

        //connect koordinate into array
        function connectTheDots(data){
            var c = [];
            for(i in data) {
                var x = data[i]['lat'];
                var y = data[i]['lng'];
                c.push([x, y]);
            }
            return c;
        }

        //button submit on click
        $('#btn-submit').on('click', function(){
            $('#form-submit').submit();
        });
    </script>
@endpush