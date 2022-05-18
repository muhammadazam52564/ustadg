@extends('layouts.admin.app')
@section('title')
    Cities
@endsection
@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-12 pr-5 py-2 pb-3 d-flex justify-content-between">
        <h3>Cities</h3>
        <button class="btn btn-success fa fa-plus" onclick="cityModal(0)" >  </button>

    </div>
        <div class="col-md-12 overflow-auto shadow p-5 mb-5 bg-white rounded">
            <table class="table" id="banners__table" style="min-width: 700px">
                <thead class="thead-light">
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody id="baner_list"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        async function get_city() 
        {
            let url = '/admin/get-cities';
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    console.log('----- res', res);
                    let element = document.querySelector("#baner_list");
                    element.innerHTML = "";
                    let inc = 0;
                    for (const i of res.data) {
                        element.innerHTML +=
                            '<tr>' +
                            '<td> ' + inc + ' </td>' +
                            '<td>' + i.id + '</td>' +
                            '<td>' + i.name + '</td>' +
                            '<td>' +
                                '<button onclick="cityModal(1, '+ i.id +')" class="btn btn-sm btn-primary fa fa-edit mr-2"></button>' + 
                                '<a href="#" onclick="delete_city(' + i.id + ')" class="btn btn-sm btn-danger fa fa-trash mb-0"></a> ' + 
                            '</td>' +
                        '</tr>'
                    }
                }
            });
        }get_city();

        function delete_city(id) {
            let url = '/admin/delete-city/'+ id;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    console.log('del-res', res);
                    get_city();
                }
            });
        }
        $(function() {
            $('#add_edit_city_form').on('submit', function(event) {
                event.preventDefault();
                let data = new FormData(this);
                let url = '/admin/add-edit-city';
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
                        get_city();
                        console.log('add-res', res);
                        $('#cityModal').modal('hide');
                    }
                });
            });
        });
    </script>
@endpush

