let edit = false;
// param = 0 >>> New
// param = 1 >>> Edit

// cities Script

function cityModal(type, id) {
    let title = document.getElementById('cityModalTitle');
    if (type !== 0) {
        title.innerHTML = "Edit City";
        edit = true;
        $('#cityModal').modal('show');
    } else {
        title.innerHTML = "Add New City";
        edit = false;
        $('#cityModal').modal('show');
    }
    console.log('edit', edit);
}


// Domain Scripts
function DomainModal_operType(type, id) {
    let title = document.getElementById('domainModalLongTitle');
    if (type !== 0) {
        title.innerHTML = "Edit Domain";
        edit = true;
        $('#domainModal').modal('show');
    } else {
        title.innerHTML = "Add New Domain";
        edit = false;
        $('#domainModal').modal('show');
    }
    console.log('edit', edit);
}




// categories Scripts
function catModal_operType(type, id) {
    let model = document.getElementById('categoryModalLongTitle');
    if (type !== 0) {
        model.innerHTML = "Edit Category"
        edit = true;
        $('#categoryModal').modal('show');
    } else {
        model.innerHTML = "Add New Category"
        edit = false;
        console.log('ajjax call here');
        $('#categoryModal').modal('show');
    }

}

// Sub Categories Scripts
function subcatmodal_operType(type, id) {
    let model = document.getElementById('subcategoryModalLongTitle');
    if (type !== 0) {
        model.innerHTML = "Edit Subcategory";
        edit = true;
        $('#subcategoryModal').modal('show');
    } else {
        model.innerHTML = "Add New Subcategory"
        edit = false;
        $('#subcategoryModal').modal('show');
    }

}

// Service Scripts
function serviceModal_operType(type, id) {
    let model = document.getElementById('serviceModalLongTitle');
    if (type !== 0) {
        model.innerHTML = "Edit Service"
        edit = true;
        $('#serviceModal').modal('show');
    } else {
        model.innerHTML = "Add New  Service"
        edit = false;
        $('#serviceModal').modal('show');
    }
}

// Banner
function bannerModal_operType(type, id) {
    let model = document.getElementById('bannerModalTitle');
    if (type !== 0) {
        model.innerHTML = "Edit Banner"
        edit = true;
        $('#bannerModal').modal('show');
    } else {
        model.innerHTML = "Add New Banner"
        edit = false;
        $('#bannerModal').modal('show');
    }
}


function previewImage(event, id) {
    imgInp = event.target;
    const [file] = imgInp.files
    $(id).removeClass('d-none')
    $(id).attr("src", URL.createObjectURL(file));
}

async function get_cities() {
    let url = '/admin/get-cities';
    $.ajax({
        url: url,
        cache: false,
        success: function(res) {
            let element = document.getElementsByClassName("city_dropdown")
            for (let i = 0; i < element.length; i++) {
                element[i].innerHTML = "";
                for (const j of res.data) {
                    element[i].innerHTML += '<option value="' + j.id + '">' + j.name + '</option>'
                }

            }
        }
    });
}
get_cities();

// $(function () {
//     $('#categories__table').DataTable();
//     $('#sub_category_table').DataTable();
//     $('#services_table').DataTable();
//     $('#banners__table').DataTable();
// });

$(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });

    var parts = window.location.pathname.split('/');
    var lastSegment = parts.pop() || parts.pop(); // handle potential trailing slash
    $('#menu_area li').removeClass('active')
    $(`#${lastSegment}`).addClass('active')

});