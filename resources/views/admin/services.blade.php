@extends('layouts.admin.app')
@section('title')
    Services
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 py-2 pb-3 d-flex justify-content-between">
            <h3> Services </h3>
            <button onclick="serviceModal_operType(0)" class="btn btn-success fa fa-plus"></button>
        </div>
    </div>
    <div class="row p-md-5">
        <div class="col-md-12 overflow-auto shadow p-5 mb-5 bg-white rounded">
            <table class="table" id="services_table" style="min-width: 850px">
                <thead class="thead-light">
                    <tr>
                    <th scope="col"> #</th>
                    <th scope="col"> ID</th>
                    <th scope="col"> Nmae</th>
                    <th scope="col"> Image Preview</th>
                    <th scope="col"> Price</th>
                    <th scope="col"> Price type</th>
                    <th scope="col"> Short Description</th>
                    <th scope="col"> Trending</th>
                    <th style="min-width: 120px">Action</th>
                    </tr>
                </thead>
                <tbody id="service_list">
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        async function get_services() {
            let url = '/admin/get-services/';
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    let element = document.querySelector("#service_list");
                    element.innerHTML = "";
                    let inc = 0;
                    for (const i of res.data) {
                        if(i.trending === 0){
                            btn =   '<div class="custom-control custom-switch">' +
                                        '<img src="/images/loading.gif" width="20px" height="20px" id="loading_image_'+i.id+'" class="d-none">' +
                                        '<input type="checkbox" class="custom-control-input" id="trending_'+ i.id +'" onchange="trending('+i.id+', 1)">' +
                                        '<label class="custom-control-label" for="trending_'+i.id+'" id="trending_label_'+i.id+'"></label>' +
                                    '</div>'

                        }else{
                            btn =   '<div class="custom-control custom-switch">' +
                                        '<img src="/images/loading.gif" width="20px" height="20px" id="loading_image_'+i.id+'" class="d-none" >' +
                                        '<input type="checkbox" class="custom-control-input" checked="true" id="trending_'+i.id+'" onchange="trending('+i.id+', 0)" >' +
                                        '<label class="custom-control-label" for="trending_'+i.id+'"  id="trending_label_'+i.id+'"></label>' +
                                    '</div>'
                        }

                        // if(i.enable === 0){
                        //     enable  =   '<div class="custom-control custom-switch">' +
                        //                 '<img src="/images/loading.gif" width="20px" height="20px" id="ebnable_image_'+i.id+'" class="d-none" >' +
                        //                 '<input type="checkbox" class="custom-control-input" id="ebnable_'+ i.id +'" onchange="enable('+i.id+', 1)">' +
                        //                 '<label class="custom-control-label" for="ebnable_'+i.id+'" id="ebnable_label_'+i.id+'"></label>' +
                        //             '</div>'

                        // }else{
                        //     enable  =   '<div class="custom-control custom-switch">' +
                        //                 '<img src="/images/loading.gif" width="20px" height="20px" id="ebnable_image_'+i.id+'" class="d-none" >' +
                        //                 '<input type="checkbox" class="custom-control-input" checked="true" id="trending_'+i.id+'" onchange="enable('+i.id+', 0)" >' +
                        //                 '<label class="custom-control-label" for="trending_'+i.id+'"  id="ebnable_label_'+i.id+'"></label>' +
                        //             '</div>'
                        // }

                        element.innerHTML +=
                            '<tr>' +
                            '<td> ' + inc + 1 + ' </td>' +
                            '<td>' + i.id + '</td>' +
                            '<td>' + i.name + '</td>' +
                            '<td>' +
                            '<img src="../../../' + i.image +
                            '" class="" style="max-width:140px; max-height:60px"/>' +
                            '</td>' +
                            '<td> '+ i.price +' </td>' + 
                            '<td> '+ i.price_type +' </td>' + 
                            '<td> '+ i.description +' </td>' + 
                            '<td> '+ 
                                btn + 
                            ' </td>' + 
                            '<td>' +
                                '<button onclick="serviceModal_operType(1, '+ i.id +')" class="btn btn-sm btn-primary fa fa-edit mr-2"></button>' + 
                                '<a href="#" onclick="delete_service(' + i.id + ')" class="btn btn-sm btn-danger fa fa-trash mb-0"></a> ' + 
                            '</td>' +
                        '</tr>'
                    }
                }
            });
        }get_services();

        function delete_service(id) {
            let url = '/admin/delete-service/'+ id;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    get_services();
                }
            });
        }

        $(function() {
            $('#add_edit_service_form').on('submit', function(event) {
                event.preventDefault();
                let data = new FormData(this);
                data.append('sub_category_id', {{ $sub_category->id }});
                let url = '/admin/add-edit-service';
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
                        console.log(res);
                        get_services()
                        $('#serviceModal').modal('hide');
                    }
                });
            });
        });

        function trending(id, status) 
        {
            let image = '#loading_image_' + id;
            let label = '#trending_label_' + id;
            $(image).removeClass('d-none')
            $(label).addClass('d-none')
            
            let url = '/admin/update-status-trnding';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id,
                    status
                },
                success: function(res) 
                {
                    get_services();
                    $(label).removeClass('d-none')
                    $(image).addClass('d-none')
                }
            });
        }

        function enable(id, status) 
        {
            let url = '/admin/update-status-trnding';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id,
                    status
                },
                success: function(res) 
                {
                    console.log(res);
                }
            });
        }

    </script>
@endpush

