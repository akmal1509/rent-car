@extends('layouts.admin.app')
@section('title', 'Master Data Car')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('main')
    <meta name="method-delete" content="DELETE">
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Master Data Car</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="/admin/cars/create" class="btn btn-primary">Create New</a>
                            </div>
                            <div class="card-body pt-0">
                                @include('pages.admin.car._typeDataCar')
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            data-checkbox-role="dad" class="custom-control-input"
                                                            id="checkbox-all">
                                                        <label for="checkbox-all"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th>Image</th>
                                                <th>Car Name</th>
                                                <th>Slug</th>
                                                <th>Brand</th>
                                                <th>Capacity</th>
                                                <th>Year</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $data)
                                                <tr>
                                                    <td>
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup"
                                                                class="custom-control-input akm-check-box"
                                                                id="checkbox-{{ $loop->iteration }}" name="number_check[]"
                                                                value="{{ $data->id }}" data-id="{{ $data->id }}">
                                                            <label for="checkbox-{{ $loop->iteration }}"
                                                                class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="img-tbl-preview">
                                                            <img class="img-fluid h-100"
                                                                src="{{ asset('storage/upload/images/' . $data->image) }}"
                                                                alt="">
                                                        </div>
                                                    </td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->slug }}</td>
                                                    <td>{{ $data->brand }}</td>
                                                    <td>{{ $data->capacity }}</td>
                                                    <td>{{ $data->year }}</td>
                                                    <td>
                                                        <a class="btn btn-warning btn-action mr-1" data-toggle="tooltip"
                                                            title="Duplicate"
                                                            onclick="duplicateData({{ $data->id }},'Car', '{{ $data->slug }}','cars')">
                                                            <i class="fa-regular fa-folder"></i>
                                                        </a>
                                                        <a href="/admin/cars/{{ $data->id }}/edit"
                                                            class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                            title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <a class="btn btn-danger btn-action" data-toggle="tooltip"
                                                            title="Delete"
                                                            data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                            data-confirm-yes="deleteData({{ $data->id }},'Car','cars')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
