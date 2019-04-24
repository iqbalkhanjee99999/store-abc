
$(function() {
    $('#data-table-basic').DataTable( {
        "order": [[ 0, "desc" ]],
        "bDestroy": true,
    } );
});
function getCategoryItems(category) {
    var avalible_items  = new Array();
    var numItems = $('.model_no').length;
    var selectedItems = $('.items');
    selectedItems.each(function (index) {
        if(index != numItems -1) {
            avalible_items[index] = $(this).val();
        }
    })

    $('.ajaxProgress').show();
    basepath    =   window.location.origin;
    var id      =   parseInt(category.value);
    var url     =  basepath+'/recivingGoods/getRecivingCategoryItems/'+id;
    var row     = category.closest('tr');

    debugger;
    item        =  $(row).find('.items');
    item.val(0);
    item.prop("disabled", true);
    item.find('option').not(':first').remove();
    debugger;
    carton        =  $(row).find('.carton');
    zone       =  $(row).find('.zone');
    shelf       =  $(row).find('.shelf');
    column   = $(row).find('.column');
    requested_qty = $(row).find('.requested_qty')
    quantity_unit = $(row).find('.quantity_unit')
    requested_qty.prop('disabled', true);
    quantity_unit.val('Unit');

    carton.val('');
    zone.val('');
    shelf.val('');
    column.val('');

    $.ajax({
        type: "GET",
        url:  url,
        data: {avalible_items:avalible_items},
        success: function(data) {
            debugger;
            var obj = JSON.parse(data);
            if(obj.length > 0)
            {
                $.each(obj, function(key, value) {
                    item.append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.description+' / '+value.brand_name));
                    item.prop("disabled", false);
                });
            }
            $('.ajaxProgress').hide();
        }
    });

}

function getItems(item) {
    basepath    =   window.location.origin;
    debugger;
    var id      =   parseInt(item.value);

    var url     =  basepath+'/recivingGoods/getItembyCat/'+id;

    var row     = item.closest('tr');

    zone            =  $(row).find('.zone');
    shelf           =  $(row).find('.shelf');
    column          =  $(row).find('.column');
    carton          =  $(row).find('.carton');
    quantity        =  $(row).find('.requested_qty');
    quantity_unit   =  $(row).find('.quantity_unit');
    quantity_unit.val('Unit');
    zone.val('');
    shelf.val('');
    column.val('');

    debugger;
    quantity.prop('disabled', false);

    $.ajax({
        type: "GET",
        url:  url,
        success: function(data) {
            var obj = JSON.parse(data);
            debugger;
            if(obj != null){
                if(obj.carton_no != '')
                    carton.val(obj.carton_no);
                if(obj.zone_no != "0")
                    zone.val(obj.zone_no);
                if(obj.shelf_no != 0)
                    shelf.val(obj.shelf_no);
                if(obj.column_no != 0)
                    column.val(obj.column_no);
                if(obj.column_no != 0)
                    quantity_unit.val(obj.quantity_unit);

            }else{
                carton.val('');
                zone.val('Zone No');
                shelf.val('Shelf No');
                column.val('Column No');
                quantity_unit.val('Unit');
            }

        }
    });

}

function enable(item) {
    var row = item.closest('tr');
    debugger;
    zone         =  $(row).find('.zone');
    shelf        =  $(row).find('.shelf');
    column       =  $(row).find('.column');
    carton       =  $(row).find('.carton');

    if ( zone.is('[readonly]') ) {
        zone.attr('readonly',false);
    }else{
        zone.attr('readonly',true);
    }

    if ( shelf.is('[readonly]') ) {
        shelf.attr('readonly',false);
    }else{
        shelf.attr('readonly',true);
    }

    if ( column.is('[readonly]') ) {
        column.attr('readonly',false);
    }else{
        column.attr('readonly',true);
    }

    if ( carton.is('[readonly]') ) {
        carton.attr('readonly',false);
    }else{
        carton.attr('readonly',true);
    }
}

function addRow() {
    var table   =   $("#recivingGoodsTable");
    var row     =   $("#main_row").clone();
    row.show();
    table.append(row);
    row.removeAttr('id');
}

function remove_row(row) {
    swal({
        title: "Are You Sure",
        text: "Row Will Be Deleted!",
        type: "warning",

        confirmButtonText: "Remove",
        showCancelButton: true,
    }).then(function () {
            row.closest('tr').remove();
    })
}

function validateGoods() {
    event.preventDefault();
    var error = 0;
    var title = '';
    var numItems = $('.rows').length;
    var categories = $('.categories');
    var location = $('.location');
    var items = $('.items');
    var requested_qty = $('.requested_qty');
    var quantity_unit = $('.quantity_unit');
    var reciving_from = $('#reciving_from').val();
    var project_name = $('#project_name').val();
    debugger;

    if(reciving_from == ''){
        error = 1;
        title = 'Please Provide Person Name Receving From';
    }
    $(location).each(function(index) {
        if(index != numItems - 1){
            if($(this).val() == ""){
                error = 1;
                title = 'Please Provide Location';
            }
      }
    });
    $(quantity_unit).each(function(index) {
        if(index != numItems - 1){
            if($(this).val() == ""){
                error = 1;
                title = 'Please Provide Quantity Unit';
            }
        }
    });
    $(requested_qty).each(function(index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Please Provide Quantity';
            }
        }
    });

    $(items).each(function(index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Please Select Item';
            }
        }
    });

    $(categories).each(function(index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Please Select Category';
            }
        }
    });

    if(error != 0){
        swal({
            title: title,
            text: "Please Provide Correct Data",
            icon: "warning",
            buttons: "OK",
            dangerMode: true,
        })
    }else{
        $('#projectRecivingForm').submit();
    }
}

// function exportToExcel(){
//
//     $.ajax({
//         type: "GET",
//         url: '../../reports/exportToExcelRecieved/',
//         success: function (response) {
//             if(response == 0){
//                 swal({
//                     title: "Empty File",
//                     text: "No Data To Export",
//                     icon: "warning",
//                     buttons: "OK",
//                     dangerMode: true,
//                 })
//             }
//             else{
//                 var a = document.createElement("a");
//                 a.href = response.file;
//                 a.download = response.name;
//                 document.body.appendChild(a);
//                 a.click();
//                 a.remove();
//             }
//         }
//     });
// }
// $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
//     $("#success-alert").slideUp(500);
// });
// $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
//     $("#success-alert").slideUp(500);
// });