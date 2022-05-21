@extends('layouts.admin.app')
@section('title')
    Customers
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 pr-5 py-2 pb-3 d-flex justify-content-between">
                <h3>Notifications</h3>
                <button class="btn btn-success fa fa-plus"></button>
            </div>
        </div>
        <div class="row p-md-4">
            <div class="col-md-12 overflow-auto shadow p-5 bg-white rounded">
                <table class="table" id="categories__table" style="min-width: 800px">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nmae</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
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
        async function get_users() {
            let curr_url = window.location.href;
            const id = curr_url.split("/").pop();
            let url = '/admin/get-users';
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    let element = document.querySelector("#categories_list");
                    element.innerHTML = "";
                    let inc = 0;
                    for (const i of res.data) {
                        inc = inc + 1
                        let btn; 
                        if (i.status === 2){
                            btn = '<button  onclick="block_unblock(' + i.id + ', 1)" class="btn btn-sm btn-success fa fa-lock-open mb-0" style="width:90px"> unblock </a> ' 
                        }else if(i.status === 0){
                            btn = '<button  onclick="block_unblock(' + i.id + ', 1)" class="btn btn-sm btn-success fa fa-check-circle mb-0" style="width:90px"> verify </a> ' 
                        }else{
                            btn = '<button  onclick="block_unblock(' + i.id + ', 2)" class="btn btn-sm btn-danger fa fa-lock mb-0" style="width:90px"> block </a> ' 
                        }
                        element.innerHTML +=
                            '<tr>' +
                            '<td>' + inc + ' </td>' +
                            '<td>' + i.id + '</td>' +
                            '<td>' + i.name + '</td>' +
                            '<td>' + i.email +'</td>' +
                            '<td>' + i.phone +'</td>' +
                            '<td>' +
                                '<button onclick="delete_user(' + i.id + ')" class="btn btn-sm btn-danger fa fa-trash mb-0"></button> ' + 
                                btn +
                            '</td>' +
                            '</tr>'
                    }
                }
            });
        }get_users();

        function delete_user(id) {
            let url = '/admin/delete-user/'+ id;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    get_users();
                    toastr.success(res.message)
                }
            });
        }
        function block_unblock(id, status) 
        {
            console.log('id', id);
            console.log('status', status);
            let url = '/admin/status-updte-user/'+ id+'/'+ status;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    get_users();
                    toastr.success(res.message)
                }
            });
        }

    </script>
@endpush