@extends('layouts.admin')
@section('title', 'Desa')
@push('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Desa</h1>
    @if($message = Session::get('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Desa
                <span><a href="{{ route('desa.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Tambah Data</a></span>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Desa</th>
                            <th>Koordinat Desa</th>
                            <th>Warna Batas Desa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Desa</th>
                            <th>Koordinat Desa</th>
                            <th>Warna Batas Desa</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($desa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_desa }}</td>
                                <td>{{ $item->marker_desa }}</td>
                                <td>{{ $item->warna_batas_desa }}</td>
                                <td>Lihat</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#desa').addClass('active');
        });
    </script>
@endpush