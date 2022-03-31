@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 p-4 d-flex justify-content-between">
            <div class="card w-100">
                <div class="card-header">
                    <h3>Add New Image</h3>
                </div>
                <div class=" card-body">
                    <div class="form-group">
                        <label for="title">Image Title</label>
                        <input type="text" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Image</label>
                        <input type="file" class="form-control"/>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-primary">Add Image</button>
                </div>
            </div>
        </div>
    </div>
    <hr/>

    <div class="row">
    <div class="col-md-12 py-2 pb-3">
        <h3>Images</h3>
    </div>
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary By Admin</td>
                    <td>
                        <img src="https://picsum.photos/150/80" alt="" class="rounded">
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary 2 By Admin</td>
                    <td>
                        <img src="https://picsum.photos/150/80" alt="" class="rounded">
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary 2 By Admin</td>
                    <td>
                        <img src="https://picsum.photos/150/80" alt="" class="rounded">
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary 2 By Admin</td>
                    <td>
                        <img src="https://picsum.photos/150/80" alt="" class="rounded">
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary 2 By Admin</td>
                    <td>
                        <img src="https://picsum.photos/150/80" alt="" class="rounded">
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Art Galary 2 By Admin</td>
                    <td>
                        <img src="https://picsum.photos/150/80" alt="" class="rounded">
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

