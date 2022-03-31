$(function () {
    $('#categories__table').DataTable();
    $('#sub_category_table').DataTable();
    $('#service_table').DataTable();




    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    var parts = window.location.pathname.split('/');
    var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash
    // alert(`#${lastSegment}`)
    $('#menu_area li').removeClass('active')
    $(`#${lastSegment}`).addClass('active')


});


//
// categories Scripts
//
function catModal_operType(param)
{
    // param = 1 >>> edit
    // param = 0 >>> Add New
    let model = document.getElementById('categoryModalLongTitle');
    param === 0? model.innerHTML = "Add New Category": model.innerHTML = "Edit Category"
    if (param !== 0) {
        // ajax call then set values then show model here
        console.log('ajjax call here');
        $('#categoryModal').modal('show');
    }

    $('#categoryModal').modal('show');
}

//
// categories Scripts
//
function subcatmodal_operType(param){
    // param = 1 >>> edit
    // param = 0 >>> Add New
    let model = document.getElementById('subcategoryModalLongTitle');
    param === 0? model.innerHTML = "Add New Sub Category": model.innerHTML = "Edit Sub Category"
    if (param !== 0) {
        // ajax call then set values then show model here
        console.log('ajjax call here');
        $('#subcategoryModal').modal('show');
    }

    $('#subcategoryModal').modal('show');
}





//
// categories Scripts
//


function serviceModal_operType(param){
    // param = 1 >>> edit
    // param = 0 >>> Add New
    let model = document.getElementById('serviceModalLongTitle');
    param === 0? model.innerHTML = "Add New Service": model.innerHTML = "Edit Service"
    if (param !== 0) {
        // ajax call then set values then show model here
        console.log('ajjax call here');
        $('#serviceModal').modal('show');
    }
    $('#serviceModal').modal('show');
}







            // $.ajax({
            //     type: "GET",
            //     url: "https://jsonplaceholder.typicode.com/posts/1",
            //     cache: false,
            //     success: function(data){
            //         console.log(data);
            //         alert("ok")
            //     }
            // });
