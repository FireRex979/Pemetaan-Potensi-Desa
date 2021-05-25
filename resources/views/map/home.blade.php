@extends('layouts.admin')
@section('title', 'Map')
@push('css')
<style>
    #mapid { height: 500px; }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Manajemen Map</h1>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Map</h6>
            </div>
            <div class="card-body">
                <div id="mapid"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-modal-sumber-air" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-modal-label">Tambah Data Sumber Air</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sumber_air.store') }}" method="POST">
                    @csrf
                    <input type="hidden" value="2" name="potensi_id">
                    <div class="form-group">
                        <label for="">Nama Sumber Air</label>
                        <input type="text" class="form-control" required name="nama_sumber" placeholder="Masukkan nama sumber air">
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control lat" readonly required name="lat">
                    </div>
                    <div class="form-group">
                        <label for="">Longtitude</label>
                        <input type="text" class="form-control lng" readonly required name="lng">
                    </div>
                    <div class="form-group">
                        <label for="">Debit (lt/d)</label>
                        <input type="number" class="form-control" required name="debit" placeholder="Masukkan debit sumber air">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pengelola Sumber Air</label>
                        <input type="text" class="form-control" required name="pengelola" placeholder="Masukkan pengelola sumber air">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-modal-sumber-air" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-modal-label">Edit Data Sumber Air</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-sumber-air" method="POST">
                    @csrf
                    <input type="hidden" value="2" name="potensi_id">
                    <div class="form-group">
                        <label for="">Nama Sumber Air</label>
                        <input type="text" class="form-control" id="nama-sumber" required name="nama_sumber" placeholder="Masukkan nama sumber air">
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control lat" id="lat-sumber-air" readonly required name="lat">
                    </div>
                    <div class="form-group">
                        <label for="">Longtitude</label>
                        <input type="text" class="form-control lng" id="lng-sumber-air" readonly required name="lng">
                    </div>
                    <div class="form-group">
                        <label for="">Debit (lt/d)</label>
                        <input type="number" class="form-control" required name="debit" id="debit" placeholder="Masukkan debit sumber air">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pengelola Sumber Air</label>
                        <input type="text" class="form-control" required name="pengelola" id="pengelola" placeholder="Masukkan pengelola sumber air">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-modal-sekolah" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-modal-label">Tambah Data Sekolah</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sekolah.store') }}" method="POST">
                    @csrf
                    <input type="hidden" value="1" name="potensi_id">
                    <div class="form-group">
                        <label for="">Nama Sekolah</label>
                        <input type="text" class="form-control" required name="nama_sekolah" placeholder="Masukkan sekolah">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Sekolah</label>
                        <select name="jenis" required class="form-control">
                            <option value="swasta">Swasta</option>
                            <option value="negeri">Negeri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tingkat Sekolah</label>
                        <select name="tingkat" required class="form-control">
                            <option value="tk">TK</option>
                            <option value="sd">SD</option>
                            <option value="smp">SMP</option>
                            <option value="sma">SMA</option>
                            <option value="smk">SMK</option>
                            <option value="universitas">Universitas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control lat" readonly required name="lat">
                    </div>
                    <div class="form-group">
                        <label for="">Longtitude</label>
                        <input type="text" class="form-control lng" readonly required name="lng">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" placeholder="Masukkan alamat sekolah" required class="form-control" cols="30" rows="10"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-modal-sekolah" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-modal-label">Edit Data Sekolah</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-update-sekolah" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Sekolah</label>
                        <input type="text" class="form-control" id="nama-sekolah" required name="nama_sekolah" placeholder="Masukkan sekolah">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Sekolah</label>
                        <select name="jenis" required class="form-control" id="jenis-sekolah">
                            <option value="swasta">Swasta</option>
                            <option value="negeri">Negeri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tingkat Sekolah</label>
                        <select name="tingkat" required class="form-control" id="tingkat-sekolah">
                            <option value="TK">TK</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                            <option value="Universitas">Universitas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control lat" readonly required name="lat" id="lat-sekolah">
                    </div>
                    <div class="form-group">
                        <label for="">Longtitude</label>
                        <input type="text" class="form-control lng" readonly required name="lng" id="lng-sekolah">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" placeholder="Masukkan alamat sekolah" required class="form-control" cols="30" rows="10" id="alamat-sekolah"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-modal-sekolah" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Sekolah</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sekolah.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id-sekolah-delete">
                Data yang dihapus tidak akan bisa dikembalikan.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="submit">Hapus</a>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-modal-sumber-air" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Sumber Air</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sumber_air.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id-sumber-air-delete">
                Data yang dihapus tidak akan bisa dikembalikan.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="submit">Hapus</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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

    mymap.pm.addControls({
        position: 'topleft',
    });

    function getAllDesa() {
        let url = '{{ route("map.get_all_desa") }}';
        $.ajax({
            url : url,
            method : 'GET',
            success : function(response) {
                // console.log(response.desa);
                for (let i = 0; i < response.desa.length; i++) {
                    createPolygon(response.desa[i]);
                }
            }
        });
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

    function createMarkerSumberAir(potensi) {
        let pop_up = '<p><strong>'+potensi['nama_sumber']+'</strong><p>'+
                     '<hr style="margin-top : -15px;">'+
                     '<p style="margin-top : -10px;"><small> <i class="fas fa-faucet"></i> <span>Debit Sumber Air : '+potensi['debit']+' lt/detik</span></small></p>'+
                     '<p style="margin-top : -15px;"><small> <i class="fas fa-user-tie"></i> <span>Pengelola : '+potensi['pengelola']+'</span></small></p>'+
                     '<button class="btn btn-sm mr-1 btn-warning" onclick="editSumberAir('+"'"+potensi['id']+"'"+')" style="font-size : 8px; padding : 4px 8px;"><i class="fas fa-edit"></i></button><button onclick="deleteSumberAir('+"'"+potensi['id']+"'"+')" style="font-size : 8px; padding : 4px 8px;" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>';

        var marker = L.marker([potensi['lat'], potensi['lng']], {
            icon: iconSumberAir,
            id : potensi['id']
        }).addTo(mymap).bindPopup(pop_up);
        onDragMarkerSumberAir(marker);
    }

    function createMarkerSekolah(potensi) {
        let pop_up = '<p><strong>'+potensi['nama_sekolah']+'</strong><p>'+
                     '<hr style="margin-top : -15px;">'+
                     '<p style="margin-top : -10px;"><small> <i class="fas fa-faucet"></i> <span>Jenis Sekolah : '+potensi['jenis']+'</span></small></p>'+
                     '<p style="margin-top : -15px;"><small> <i class="fas fa-user-tie"></i> <span>Tingkat : '+potensi['tingkat']+'</span></small></p>'+
                     '<p style="margin-top : -15px;"><small> <i class="fas fa-user-tie"></i> <span>Alamat : '+potensi['alamat']+'</span></small></p>'+
                     '<button class="btn btn-sm mr-1 btn-warning" onclick="editSekolah('+"'"+potensi['id']+"'"+')" style="font-size : 8px; padding : 4px 8px;"><i class="fas fa-edit"></i></button><button onclick="deleteSekolah('+"'"+potensi['id']+"'"+')" style="font-size : 8px; padding : 4px 8px;" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>';

        var marker = L.marker([potensi['lat'], potensi['lng']], {
            icon: iconSekolah,
            id : potensi['id']
        }).addTo(mymap).bindPopup(pop_up);
        onDragMarkerSekolah(marker);
    }

    function onDragMarkerSumberAir(marker) {
        marker.on('pm:dragend', e => {
            let id = e.target.options.id;
            let lat = e.target._latlng.lat;
            let lng = e.target._latlng.lng;
            let url = '/admin/sumber-air/update-koordinat/'+id;
            $.ajax({
                url : url,
                method : 'POST',
                data : {
                    lat : lat,
                    lng : lng
                },
                success : function (response) {
                    console.log('Sukses Mengganti Koordinat Marker');
                }
            });
        });
    }

    function onDragMarkerSekolah(marker) {
        marker.on('pm:dragend', e => {
            let id = e.target.options.id;
            let lat = e.target._latlng.lat;
            let lng = e.target._latlng.lng;
            let url = '/admin/sekolah/update-koordinat/'+id;
            $.ajax({
                url : url,
                method : 'POST',
                data : {
                    lat : lat,
                    lng : lng
                },
                success : function (response) {
                    console.log('Sukses Mengganti Koordinat Marker');
                }
            });
        });
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

        let popup =
                    '<div class="text-center">'+
                        '<a href="#" class="mr-2" title="Tambah Sekolah" onclick="createSekolah()">'+
                            '<img src="/assets/img/school.png" width="32" alt="">'+
                        '</a>'+
                        '<a href="#" class="mr-2" title="Tambah Sumber Air" onclick="createSumberAir()">'+
                            '<img src="/assets/img/waterfall.png" width="32" alt="">'+
                        '</a>'+
                        '<a href="#" class="mr-2" title="Tambah Tempat Ibadah">'+
                            '<img src="/assets/img/shinto.png" width="32" alt="">'+
                        '</a>'+
                    '</div>';

        pathLine.on('click', function(e){
            this.bindPopup(popup);
            $('.lat').val(e.latlng.lat);
            $('.lng').val(e.latlng.lng);
        });

    }

    //Sekolah
    function createSekolah() {
        $('#add-modal-sekolah').modal('show');
    }

    //Sumber Air

    function createSumberAir() {
        $('#add-modal-sumber-air').modal('show');
    }

    function editSumberAir(id) {
        let url = '/admin/sumber-air/show/'+id;
        let link = '/admin/sumber-air/update/'+id;
        $.ajax({
            url : url,
            method : 'GET',
            success : function(response) {
                $('#form-edit-sumber-air').prop('action', link);
                $('#nama-sumber').val(response.data['nama_sumber']);
                $('#lat-sumber-air').val(response.data['lat']);
                $('#lng-sumber-air').val(response.data['lng']);
                $('#debit').val(response.data['debit']);
                $('#pengelola').val(response.data['pengelola']);
                $('#edit-modal-sumber-air').modal('show');
            }
        });
    }

    function editSekolah(id) {
        let url = '/admin/sekolah/show/'+id;
        let link = '/admin/sekolah/update/'+id;
        $.ajax({
            url : url,
            method : 'GET',
            success : function(response) {
                $('#nama-sekolah').val(response.data['nama_sekolah']);
                $('#jenis-sekolah option[value='+response.data['jenis']+']').prop('selected', true);
                $('#tingkat-sekolah option[value='+response.data['tingkat']+']').prop('selected', true);
                $('#lat-sekolah').val(response.data['lat']);
                $('#lng-sekolah').val(response.data['lng']);
                $('#alamat-sekolah').val(response.data['alamat']);
                $('#form-update-sekolah').prop('action', link);
                $('#edit-modal-sekolah').modal('show');
            }
        })
    }

    function deleteSekolah(id) {
        $('#id-sekolah-delete').val(id);
        $('#delete-modal-sekolah').modal('show');
    }

    function deleteSumberAir(id) {
        $('#id-sumber-air-delete').val(id);
        $('#delete-modal-sumber-air').modal('show');
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
@endpush