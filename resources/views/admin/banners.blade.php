@extends('layouts.admin.app')
@section('title')
    Banners
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 pr-5 py-2 pb-3 d-flex justify-content-between">
            <h3>Banners</h3>
            <!-- <button class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#categoryModal">  </button> -->
            <button class="btn btn-success fa fa-plus" onclick="bannerModal_operType(0)" >  </button>
        </div>
    </div>
    <div class="row p-md-5 pt-0">
        <div class="col-md-12 overflow-auto shadow p-5  bg-white rounded">
            <table class="table" id="banners__table" style="min-width: 700px">
                <thead class="thead-light">
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Domain Name</th>
                    <th>Image Preview</th>
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
        async function get_banners() 
        {
            let curr_url = window.location.href;
            const id = curr_url.split("/").pop();
            let url = '/admin/get-banners/all';
            if (id !== 'banners' && id !== '') 
            {
                url = '/admin/get-banners/'+ id;
            }
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    console.log('res', res);
                    let element = document.querySelector("#baner_list");
                    element.innerHTML = "";
                    let inc = 0;
                    for (const i of res.data) {
                        element.innerHTML +=
                            '<tr>' +
                            '<td> ' + inc + ' </td>' +
                            '<td>' + i.id + '</td>' +
                            '<td>' + i.domain.name + '</td>' +
                            '<td>' +
                            '<img src="../../' + i.image +
                            '" class="" style="max-width:140px; max-height:60px"/>' +
                            '</td>' +
                            '<td>' +
                                '<button onclick="bannerModal_operType(1, '+ i.id +')" class="btn btn-sm btn-primary fa fa-edit mr-2"></button>' + 
                                '<a href="#" onclick="delete_banner(' + i.id + ')" class="btn btn-sm btn-danger fa fa-trash mb-0"></a> ' + 
                            '</td>' +
                        '</tr>'
                    }
                }
            });
        }get_banners();

        function delete_banner(id) {
            let url = '/admin/delete-banner/'+ id;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    get_banners();
                }
            });
        }
        $(function() {
            $('#add_edit_banner_form').on('submit', function(event) {
                event.preventDefault();
                let data = new FormData(this);
                let url = '/admin/add-edit-banner';
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
                        console.log('res', res);
                        $('#bannerModal').modal('hide');
                        get_banners();
                    }
                });
            });
        });
    </script>
@endpush

