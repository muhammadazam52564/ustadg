@extends('layouts.admin.app')
@section('content')
<div class="container">

    <div class="row">
    <div class="col-md-12 py-2 pb-3 d-flex justify-content-between">
        <h3> Orders </h3>
        <button onclick="serviceModal_operType(0)" class="btn btn-success fa fa-plus"></button>
    </div>
        <div class="col-md-12 overflow-auto">
            <table class="table" style="min-width: 700px">
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
                            <a onclick="serviceModal_operType(1)" class="btn btn-sm btn-primary fa fa-edit"></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

