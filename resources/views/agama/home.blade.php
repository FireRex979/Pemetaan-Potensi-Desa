@extends('layouts.admin')
@section('title', 'Agama')
@push('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary">Agama</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Agama
                <span><button class="btn btn-primary float-right" data-toggle="modal" data-target="#add-modal"><i class="fas fa-plus"></i> Tambah</button></span>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Agama</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Agama</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($agama as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->agama }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" onclick="edit('{{ $item->id }}')"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" onclick="destroy('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-modal-label">Tambah Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agama.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Agama</label>
                            <input type="text" class="form-control" required name="agama" placeholder="Masukkan nama agama">
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
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modal-label">Edit Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="form-edit" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Agama</label>
                            <input type="text" class="form-control" id="nama-agama" required name="agama" placeholder="Masukkan nama agama">
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
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agama.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id-delete">
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
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#agama').addClass('active');
        });
        function edit(id) {
            let url = '/admin/agama/edit/'+id;
            let link = '/admin/agama/update/'+id;
            $.ajax({
                url : url,
                method : 'GET',
                success : function(response) {
                    $('#form-edit').prop('action', link);
                    $('#nama-agama').val(response.data['agama']);
                    $('#edit-modal').modal('show');
                }
            });
        }
        function destroy(id) {
            $('#id-delete').val(id);
            $('#delete-modal').modal('show');
        }
    </script>
@endpush