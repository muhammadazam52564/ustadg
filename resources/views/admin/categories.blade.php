@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-12 pr-5 py-2 pb-3 d-flex justify-content-between">
        <h3>Categories</h3>
        <!-- <button class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#categoryModal">  </button> -->
        <button class="btn btn-success fa fa-plus" onclick="catModal_operType(0)" >  </button>

    </div>
        <div class="col-md-12 overflow-auto shadow p-5 mb-5 bg-white rounded">
            <table class="table" id="categories__table" style="min-width: 700px">
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
                        <td>Image will Appear here</td>
                        <td>

                            <a href="{{ route('admin.delete-category', 1) }}" class="btn btn-sm btn-danger fa fa-trash"></a>
                            <button onclick= "catModal_operType(1)"  class="btn btn-sm btn-primary fa fa-edit"></button>
                            <a href="{{ route('admin.sub-categories', 1) }}" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Sub Categories</a>
                            <button class="btn btn-sm btn-success fa fa-plus" onclick= "subcatmodal_operType(0)"  >
                                &nbsp; New Sub Category
                            </button>

                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Art Galary By Admin</td>
                        <td>Image will Appear here</td>
                        <td>

                            <a href="{{ route('admin.delete-category', 1) }}" class="btn btn-sm btn-danger fa fa-trash"></a>
                            <button onclick= "operationType(1)"  class="btn btn-sm btn-primary fa fa-edit"></button>
                            <a href="{{ route('admin.sub-categories', 1) }}" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Sub Categories</a>
                            <button class="btn btn-sm btn-success fa fa-plus" data-toggle="modal" data-target="#subcategoryModal" >
                                &nbsp; New Sub Category
                            </button>

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>

</script>
@endpush

