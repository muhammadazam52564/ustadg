@extends('layouts.admin.app')
@section('content')
<div class="container">

    <div class="row">
    <div class="col-md-12 py-2 pb-3 d-flex justify-content-between">
        <h3>Sub Categories</h3>
        <button onclick="subcatmodal_operType(0)" class="btn btn-success fa fa-plus"></button>
    </div>
        <div class="col-md-12 overflow-auto shadow p-5 mb-5 bg-white rounded">
            <table class="table" id="sub_category_table" style="min-width: 700px">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nmae</th>
                    <th scope="col">Image Preview</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Art Galary By Admin</td>
                        <td>Image here</td>
                        <td>
                            <a href="{{ route('admin.sub-categories', 1) }}" class="btn btn-sm btn-danger fa fa-trash"></a>
                            <a onclick="subcatmodal_operType(1)" class="btn btn-sm btn-primary fa fa-edit"></a>
                            <a href="{{ route('admin.services', 1) }}" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Servicrs</a>
                            <button onclick="serviceModal_operType(0)" class="btn btn-sm btn-success fa fa-plus"> &nbsp; New Service </button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Art Galary By Admin</td>
                        <td>Image here</td>
                        <td>
                            <a href="{{ route('admin.sub-categories', 1) }}" class="btn btn-sm btn-danger fa fa-trash"></a>
                            <a onclick="subcatmodal_operType(1)" class="btn btn-sm btn-primary fa fa-edit"></a>
                            <a href="{{ route('admin.services', 1) }}" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Servicrs</a>
                            <button onclick="serviceModal_operType(0)" class="btn btn-sm btn-success fa fa-plus"> &nbsp; New Service </button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Art Galary By Admin</td>
                        <td>Image here</td>
                        <td>
                            <a href="{{ route('admin.sub-categories', 1) }}" class="btn btn-sm btn-danger fa fa-trash"></a>
                            <a onclick="subcatmodal_operType(1)" class="btn btn-sm btn-primary fa fa-edit"></a>
                            <a href="{{ route('admin.services', 1) }}" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Servicrs</a>
                            <button onclick="serviceModal_operType(0)" class="btn btn-sm btn-success fa fa-plus"> &nbsp; New Service </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

