
$(function() {
    $('#data-table-basic').DataTable( {
        "order": [[ 0, "desc" ]],
        "bDestroy": true,
    } );
});

function getCategoryItems(category) {
    var avalible_items  = [];
    var numItems = $('.model_no').length;
    var selectedItems = $('.items');
    selectedItems.each(function (index) {
        if(index != numItems -1) {
            avalible_items[index] = $(this).val();
        }
    });

    debugger;

    $('.ajaxProgress').show();
    basepath    =   window.location.origin;
    var id      =   parseInt(category.value);
    var url     =  basepath+'/recivingGoods/getRequestedCategoryItems/'+id;
    var row     = category.closest('tr');

    model_no        =  $(row).find('.model_no');
    brand_name       =  $(row).find('.brand_name');
    avalible_qty       =  $(row).find('.avalible_qty');
    requested_qty = $(row).find('.requested_qty');

    model_no.text('Model No');
    brand_name.text('Zone No');
    avalible_qty.text('Avalible Qty');
    requested_qty.prop("disabled", true);
    requested_qty.val('');

    item        =  $(row).find('.items');
    item.val(0);
    item.prop("disabled", true);
    item.find('option').not(':first').remove();
    $.ajax({
        type: "GET",
        url:  url,
        data:{avalible_items:avalible_items},
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

function getToolsCategoryItems(category) {

    var avalible_items  = [];
    var numItems = $('.model_no').length;
    var selectedItems = $('.items');
    selectedItems.each(function (index) {
        if(index != numItems -1) {
            avalible_items[index] = $(this).val();
        }
    });

    $('.ajaxProgress').show();
    basepath    =   window.location.origin;
    var id      =   parseInt(category.value);
    var url     =  basepath+'/recivingGoods/getToolsCategoryItems/'+id;
    var row     = category.closest('tr');

    item        =  $(row).find('.items');
    tools_user        =  $(row).find('.tools_user');
    project_no       =  $(row).find('.project_no');

    tools_user.val('');
    tools_user.prop("disabled", true);

    project_no.val('');
    project_no.prop("disabled", true);

    item.val(0);
    item.prop("disabled", true);
    item.find('option').not(':first').remove();
    $.ajax({
        type: "GET",
        url:  url,
        data:{avalible_items:avalible_items},
        success: function(data) {
            debugger;
            var obj = JSON.parse(data);
            if(obj.length > 0)
            {
                $.each(obj, function(key, value) {
                    item.append($("<option></option>")
                        .attr("value",value.id)
                        .text(value.description+' / '+value.model_no+' / '+value.brand_name));
                    item.prop("disabled", false);
                });
            }
            $('.ajaxProgress').hide();
        }
    });
}


function getProjectToolsCategoryItems(category) {

    $('.ajaxProgress').show();
    basepath    =   window.location.origin;
    var id      =   parseInt(category.value);
    var url     =  basepath+'/recivingGoods/getProjectToolsCategoryItems/'+id;

    var row     = category.closest('tr');

    var model        =  $(row).find('.model');
    var asset_no        =  $(row).find('.asset_no');
    var image       =  $(row).find('.image');
    var location       =  $(row).find('.location');
    var description       =  $(row).find('.description');
    var categories = [];

    $('.categories').each(function (index) {
        if(index < $('.categories').length - 1){
            categories.push($(this).val());
        }
    });

    var target = category.value;

    var numOccurences = $.grep(categories, function (elem) {
        return elem === target;
    }).length;

    $.ajax({
        type: "GET",
        url:  url,
        data:{numOccurences:numOccurences},
        success: function(data) {
            var obj = JSON.parse(data);
            asset_no.val(obj.asset_no);
            $('.ajaxProgress').hide();
            model.prop("disabled", false);
            image.prop("disabled", false);
            location.prop("disabled", false);
            description.prop("disabled", false);
        }
    });
}

function getItems(item) {

    basepath    =   window.location.origin;
    debugger;
    var id      =   parseInt(item.value);

    var url     =  basepath+'/requestedGoods/getItemDetails/'+id;

    var row     = item.closest('tr');

    unit            =  $(row).find('.unit');
    model_no        =  $(row).find('.model_no');
    brand_name      =  $(row).find('.brand_name');
    avalible_qty    =  $(row).find('.avalible_qty');
    requested_qty   = $(row).find('.requested_qty');
    requested_qty   = $(row).find('.requested_qty');
    loc             = $(row).find('.location');
    requested_qty.prop("disabled", false);
    loc.prop("disabled", false);

    debugger;

    $.ajax({
        type: "GET",
        url:  url,
        success: function(data) {
            debugger;
            var obj = JSON.parse(data);
            debugger;

            if(obj != null){
                if(obj.model_no != null){
                    model_no.text(obj.model_no);
                }else{
                    model_no.text('-');
                }
                if(obj.brand_name != '')
                    brand_name.text(obj.brand_name);

                    avalible_qty.text(obj.quantity);
                    unit.text(obj.quantity_unit);
            }
            else{
                model_no.text('Model No');
                brand_name.text('Zone No');
                model_no.text('Unit');
                avalible_qty.text('Avalible Qty');
            }

        }
    });

}

function enableTextBoxes(item) {

    var row     = item.closest('tr');
    var tools_user        =  $(row).find('.tools_user');
    var location        =  $(row).find('.location');

    if(item.value == 0){
        tools_user.prop("disabled", true);
        location.prop("disabled", true);
    }else{
        tools_user.prop("disabled", false);
        location.prop("disabled", false);
    }

}

function enable() {
    $('.mySelect').attr('readonly', false);
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

function validateRequest() {
    event.preventDefault();
    var avalible_qty = new Array('');
    var title = '';
    var error = 0;
    var numItems = $('.items').length;
    var project_name = $('#project_name').val();

    if(project_name == ''){
        error = 1;
        title = 'Please Enter Project Name';
    }

    $('.avalible_qty').each(function (index) {
        if(index != numItems - 1){
            avalible_qty[index] = parseInt($(this).text());
        }
    });

    $('.requested_qty').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == ''){
                error = 1;
                title = 'Please Provide Quantity';
            }else if($(this).val() < 1){
                error = 1;
                title = 'Quantity Should Be More Than 0 ';
            }else if(parseInt($(this).val()) > avalible_qty[index]){
                error = 1;
                title = 'Quantity Selected Not Avalible';
            }
        }
    });

    $('.items').each(function (index) {
      if(index != numItems - 1){
          if($(this).val() == 0){
              error = 1;
              title = 'Item is not selected';
          }
      }
  });

    if(error == 1){
        swal({
            title: title,
            type: "warning",
            confirmButtonText: "OK",
        })
    }else{
       $('#addRequest').submit();
    }
}

function validateToolsRequest() {

    event.preventDefault();
    var title = '';
    var error = 0;
    var numItems = $('.tools_user').length;
    debugger;


    $('.location').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == ''){
                error = 1;
                title = 'Please Provide Location';
            }
        }
    });

    $('.tools_user').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == ''){
                error = 1;
                title = 'Please Provide User Name ';
            }
        }
    });

    $('.items').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Please Select Item';
            }
        }
    });

    $('.categories').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Please Select Category';
            }
        }
    });

    if(error == 1){
        swal({
            title: title,
            type: "warning",
            confirmButtonText: "OK",
        })
    }else{
        $('#addToolsRequest').submit();
    }
}

function validateProjectToolsRequest() {

    event.preventDefault();
    var title = '';
    var error = 0;
    var numItems = $('.categories').length;
    debugger;



    if($('#file').val() == ''){
        error = 1;
        title = 'Please Attach Delivery Note';
    }

    if($('#reciving_from').val() == ''){
        error = 1;
        title = 'Please Provide Supplier Name';
    }
    $('.location').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == ''){
                error = 1;
                title = 'Please Provide Location';
            }
        }
    });

    $('.image').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == ''){
                error = 1;
                title = 'Please Provide Item Image';
            }
        }
    });

    $('.asset_no').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == ''){
                error = 1;
                title = 'Please Provide Asset No';
            }
        }
    });

    $('.model').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Please Provide Model No';
            }
        }
    });

    $('.description').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Please Provide Description';
            }
        }
    });

    $('.categories').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Please Select Category';
            }
        }
    });

    if(error == 1){
        swal({
            title: title,
            type: "warning",
            confirmButtonText: "OK",
        })
    }else{
        $('#addProjectToolsRequest').submit();
    }
}

function exportToExcel(){

    $.ajax({
        type: "GET",
        url: '../../reports/exportToExcelRequested/',
        success: function (response) {
            debugger;
            if(response == 0){
                swal({
                    title: "Empty File",
                    text: "No Data To Export",
                    icon: "warning",
                    buttons: "OK",
                    dangerMode: true,
                })
            }
            else{
                var a = document.createElement("a");
                a.href = response.file;
                a.download = response.name;
                document.body.appendChild(a);
                a.click();
                a.remove();
            }
        }
    });
}
$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

function returnTool(item_id,item_name,requested_goods_id) {

    var basepath   =   window.location.origin;

    swal({
        title: "Select Condition ("+item_name+")",
        type: "info",
        html:
        "<br>" +
        '<button type="button" role="button" id="btn_good" tabindex="0" class="btn btn-success col-md-3" style="margin-left: 25px;">' + 'Good' + '</button>' +
        '<button type="button" role="button" id="btn_repair" tabindex="0" class="btn btn-warning col-md-4 " style="margin-left: 15px;">' + 'Need Maintenance' + '</button>' +
        '<button type="button" role="button" id="btn_demaged" tabindex="0" class="btn btn-danger col-md-3" style="margin-left: 15px;">' + 'Damaged' + '</button><br>',
        showCancelButton: false,
        showConfirmButton: false
    });
    $('#btn_good').click(function () {
        swal({
            title: "Are You Sure",
            text: "The Item Will Be Marked As In Good Condition",
            type: "warning",
            confirmButtonText: "Yes",
            showCancelButton: true,
        }).then(function () {
            $.ajax({
            type:"GET",
            url: basepath+'/requestedGoods/markToolAsGood/'+item_id+'/'+requested_goods_id,
            success: function(data) {
                debugger;
                swal({
                    title: "success",
                    text: "Item Returned Back In Good Condition",
                    type: "success",
                }).then(function(){
                   location.reload();
                });
            }
        });
        })
    });
    $('#btn_repair').click(function () {
        swal({
            title: "Are You Sure",
            text: "The Item Will Be Marked As Need Maintenance",
            type: "warning",
            confirmButtonText: "Yes",
            showCancelButton: true,
        }).then(function () {
            $.ajax({
                type:"GET",
                url: basepath+'/requestedGoods/markToolAsNeedRepair/'+item_id,
                success: function(data) {
                    debugger;
                    swal({
                        title: "success",
                        text: "Item Need Maintenance ",
                        type: "success",
                    }).then(function(){
                        location.reload();
                    });
                }
            });
        })
    });
    $('#btn_demaged').click(function () {
        swal({
            title: "Are You Sure",
            text: "The Item Will Be Marked As Demaged",
            type: "warning",
            confirmButtonText: "Yes",
            showCancelButton: true,
        }).then(function () {
            $.ajax({
                type:"GET",
                url: basepath+'/requestedGoods/markToolAsDemaged/'+item_id,
                success: function(data) {
                    debugger;
                    swal({
                        title: "success",
                        text: "Item Marked As Demaged",
                        type: "success",
                    }).then(function(){
                        location.reload();
                    });
                }
            });
        })
    })
}

function toolRepaired(item_id,requested_goods_id) {
    var basepath   =   window.location.origin;
    swal({
        title: "Are You Sure",
        text: "The Item Will Be Marked As In Good Condition",
        type: "warning",
        confirmButtonText: "Yes",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            url: basepath+'/requestedGoods/markToolAsGood/'+item_id+'/'+requested_goods_id,
            success: function(data) {
                debugger;
                swal({
                    title: "success",
                    text: "Item Returned Back In Good Condition",
                    type: "success",
                }).then(function(){
                    location.reload();
                });
            }
        });
    })
}

