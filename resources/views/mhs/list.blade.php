@extends('layouts.main')
@section('tittle', 'List Data Mahasiswa')
@section('button_header')
    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app"
        id="kt_toolbar_primary_button">Create</a>
@endsection
@section('judul_header', 'Data Mahasiswa')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mahasiswa Zidan</title>
    <style>
        body {
            background-color: lightgray !important;
        }
    </style>
    @section('css')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endsection
</head>

<body>
    @section('content')
        <div class="container" style="margin-top: 50px">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">TABEL MAHASISWA</h4>
                    <div class="card border-0 shadow-sm rounded-md mt-4">
                        <div class="card-body">
                            <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>
                            <table id="kt_datatable_example_5" class="table table-bordered table-striped table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>No Hp</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table-mahasiswa">
                                    @foreach ($mahasiswa as $post)
                                        <tr id="index_{{ $post->id }}">
                                            <td>{{ $post->nama_mahasiswa_2255301097 }}</td>
                                            <td>{{ $post->tempat_lahir }}</td>
                                            <td>{{ $post->tanggal_lahir }}</td>
                                            <td>{{ $post->no_hp }}</td>
                                            <td>{{ $post->email }}</td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" id="btn-edit-post"data-id="{{ $post->id }}"
                                                    class="btn btn-primary btn-sm">EDIT</a>
                                                <a href="javascript:void(0)" id="btn-delete-post"
                                                    data-id="{{ $post->id }}" class="btn btn-danger btn-sm">DELETE</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('mhs.modal-create')
        @include('mhs.update')
        @include('mhs.delete')
        @endsection
        @section('js')
        <script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script>
            $("#kt_datatable_example_5").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<"
                row " +
                "<'col-sm-6 d-flex align-items-center justify-conten-start 1>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ""
            });
        </script>
    @endsection
</body>
</html>