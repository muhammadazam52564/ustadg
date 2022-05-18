@extends('layouts.admin.app')
@section('title')
    Sub Categories
@endsection
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
                    <th scope="col">ID</th>
                    <th scope="col">Nmae</th>
                    <th scope="col">Image Preview</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="sub_categories_list">   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        async function get_sub_categories() {
            let curr_url = window.location.href;
            const id = curr_url.split("/").pop();
            let url = '/admin/get-sub-categories/'+ id;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    let element = document.querySelector("#sub_categories_list");
                    element.innerHTML = "";
                    let inc = 0;
                    for (const i of res.data) {
                        element.innerHTML +=
                            '<tr>' +
                            '<td> ' + inc + 1 + ' </td>' +
                            '<td>' + i.id + '</td>' +
                            '<td>' + i.name + '</td>' +
                            '<td>' +
                            '<img src="../../' + i.image +
                            '" class="" style="max-width:140px; max-height:60px"/>' +
                            '</td>' +
                            '<td>' +
                                '<a onclick="subcatmodal_operType(1)" class="btn btn-sm btn-primary fa fa-edit"></a>' + 
                                '<a href="#" onclick="delete_sub_category(' + i.id + ')" class="btn btn-sm btn-danger fa fa-trash mb-0"></a> ' + 
                                '<a href="/admin/services/'+ i.id +'" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Service</a>' +
                                
                            '</td>' +
                            '</tr>'
                    }
                }
            });
        }get_sub_categories();

        function delete_sub_category(id) {
            let url = '/admin/delete-sub-category/'+ id;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    get_sub_categories();
                }
            });
        }
        $(function() {
            $('#add_edit_sub_category_form').on('submit', function(event) {
                event.preventDefault();
                let data = new FormData(this);
                data.append('category_id', {{ $cat->id }});
                let url = '/admin/add-edit-sub-category';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $('#subcategoryModal').modal('hide');
                        get_sub_categories();
                    }
                });
            });
        });
    </script>
@endpush

<!-- <tr>
                        <th scope="row">1</th>
                        <td>Art Galary By Admin</td>
                        <td>Image here</td>
                        <td>
                            <a href="{{ route('admin.sub-categories', 1) }}" class="btn btn-sm btn-danger fa fa-trash"></a>
                            <a onclick="subcatmodal_operType(1)" class="btn btn-sm btn-primary fa fa-edit"></a>
                            <a href="{{ route('admin.services', 1) }}" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Servicrs</a>
                            <button onclick="serviceModal_operType(0)" class="btn btn-sm btn-success fa fa-plus"> &nbsp; New Service </button>
                        </td>
                    </tr> -->