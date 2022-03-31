@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 p-4 d-flex justify-content-between">
            <div class="card w-100">
                <div class="card-header">
                    <h3>Add New Category</h3>
                </div>
                <div class=" card-body">
                    <div class="form-group">
                        <label for="title">Category Name</label>
                        <input type="text" class="form-control"/>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
    <div class="col-md-12 py-2 pb-3">
        <h3>Categories</h3>
    </div>
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nmae</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary By Admin</td>
                    <td>
                        <a href="{{ route('admin.images') }}" class="btn btn-primary">Add Image</a>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary By Admin</td>
                    <td>
                        <a href="{{ route('admin.images') }}" class="btn btn-primary">Add Image</a>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary By Admin</td>
                    <td>
                        <a href="{{ route('admin.images') }}" class="btn btn-primary">Add Image</a>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary By Admin</td>
                    <td>
                        <a href="{{ route('admin.images') }}" class="btn btn-primary">Add Image</a>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary By Admin</td>
                    <td>
                        <a href="{{ route('admin.images') }}" class="btn btn-primary">Add Image</a>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary By Admin</td>
                    <td>
                        <a href="{{ route('admin.images') }}" class="btn btn-primary">Add Image</a>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary By Admin</td>
                    <td>
                        <a href="{{ route('admin.images') }}" class="btn btn-primary">Add Image</a>
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

