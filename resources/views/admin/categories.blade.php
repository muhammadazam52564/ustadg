@extends('layouts.admin.app')
@section('title')
    Categories
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 pr-5 py-2 pb-3 d-flex justify-content-between">
                <h3>Categories</h3>
                <!-- <button class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#categoryModal">  </button> -->
                <button class="btn btn-success fa fa-plus" onclick="catModal_operType(0)"> </button>

            </div>
        </div>
        <div class="row p-md-5">
            <div class="col-md-12 overflow-auto shadow p-5 mb-5 bg-white rounded">
                <table class="table" id="categories__table" style="min-width: 700px">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nmae</th>
                            <th scope="col">Image Preview</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="categories_list" >
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        async function get_categories() {
            let curr_url = window.location.href;
            const id = curr_url.split("/").pop();
            let url = '/admin/get-categories/all';
            if (id !== 'categories' && id !== '') 
            {
                url = '/admin/get-categories/'+ id;
            }
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    let element = document.querySelector("#categories_list");
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
                                '<button onclick="catModal_operType(1, '+ i.id +')" class="btn btn-sm btn-primary fa fa-edit mr-2"></button>' + 
                                '<a href="#" onclick="delete_category(' + i.id + ')" class="btn btn-sm btn-danger fa fa-trash mb-0"></a> ' + 
                                '<a href="/admin/sub-categories/'+ i.id +'" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Sub Categories</a>' +
                            '</td>' +
                            '</tr>'
                    }
                }
            });
        }get_categories();

        function delete_category(id) {
            let url = '/admin/delete-category/'+ id;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    get_categories();
                }
            });
        }

        $(function() {
            $('#add_edit_category_form').on('submit', function(event) {
                event.preventDefault();
                let data = new FormData(this);
                let url = '/admin/add-edit-category';
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

                        if (res.status === true) 
                        {
                            $('#categoryModal').modal('hide');
                            get_categories();
                        }
                    }
                });
            });
        });
    </script>
@endpush



<!-- 
'<label for="delete_cat_'+i.id+'" class="btn btn-sm btn-danger fa fa-trash mb-0"></label> ' + 
                                '<form method="post" action="/admin/delete-category/'+  i.id +'" class="d-none">' +
                                    '@csrf' +
                                    '<input  type="submit" id="delete_cat_'+i.id+'">' + 
                                '</form>'+ -->