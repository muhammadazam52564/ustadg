@extends('layouts.admin.app')
@section('title')
    Domains
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 pr-5 py-2 pb-3 d-flex justify-content-between">
                <h3>Domains</h3>
                <button class="btn btn-success fa fa-plus" onclick="DomainModal_operType(0, null)"> </button>
            </div>
            <div class="col-md-12 overflow-auto shadow p-5 mb-5 bg-white rounded">
                <table class="table" id="categories__table" style="min-width: 700px">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nmae</th>
                            <th scope="col">Urdu Name</th>
                            <th scope="col">Image View</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="domains_list">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        async function get_domains() {
            let url = '/admin/get-domains';
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    let element = document.querySelector("#domains_list");
                    element.innerHTML = "";
                    let inc = 0;
                    for (const i of res.data) {
                        element.innerHTML +=
                            '<tr>' +
                            '<td> ' + inc + 1 + ' </td>' +
                            '<td>' + i.id + '</td>' +
                            '<td>' + i.name + '</td>' +
                            '<td>' + i.urdu_name + '</td>' +
                            '<td>' +
                            '<img src="../' + i.image +
                            '" class="" style="max-width:140px; max-height:60px"/>' +
                            '</td>' +
                            '<td>' +
                            '<a onclick="DomainModal_operType(1, '+ i.id +')" class="btn btn-sm btn-primary fa fa-edit mr-2"></a>' + 
                            '<button onclick="delete_domain('+ i.id +')" class="btn btn-sm btn-danger fa fa-trash mr-2" title="Remove Domain"></button>' +
                            '<a href="/admin/categories/'+ i.id +'" class="btn btn-sm btn-warning fa fa-list mr-2"> &nbsp;Categories</a>' +
                            '<a href="/admin/banners/'+ i.id +'" class="btn btn-sm btn-warning fa fa-list"> &nbsp;Banners</a>' +

                            '</td>' +
                            '</tr>'
                    }
                }
            });
        }get_domains();

        function delete_domain(id) {
            let url = '/admin/delete-domain/'+ id;
            $.ajax({
                url: url,
                cache: false,
                success: function(res) {
                    get_domains();
                }
            });
        }

        $(function() {
            $('#add_edit_domain_form').on('submit', function(event) {
                event.preventDefault();
                let data = new FormData(this);
                let url = '/admin/add-domains';
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
                        $('#domainModal').modal('hide');
                        get_domains();
                    }
                });
            });
        });
    </script>
@endpush
