@extends('layouts.admin')

@section('content')

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#dashboard').addClass('active');
        });
    </script>
@endpush
