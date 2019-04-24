function getProjectCategoryItems(category) {
    var avalible_items  = new Array();
    var numItems = $('.model_no').length;
    var selectedItems = $('.items');
    selectedItems.each(function (index) {
        if(index != numItems -1) {
            avalible_items[index] = $(this).val();
        }
    })

    debugger;

    $('.ajaxProgress').show();
    basepath    =   window.location.origin;
    var id      =   parseInt(category.value);
    var url     =  basepath+'/projects/getRequestedProjectCategoryItems/'+id;
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
            var obj = JSON.parse(data);
            debugger;
            if(obj.length > 0)
            {
                $.each(obj, function(key, value) {
                    item.append($("<option></option>")
                        .attr("value",value.item_id)
                        .text(value.description+' / '+value.brand_name));
                    item.prop("disabled", false);
                });
            }
            $('.ajaxProgress').hide();
        }
    });
}

function getProjectItemDetails(item) {
    basepath = window.location.origin;
    debugger;
    var id = parseInt(item.value);

    var url = basepath + '/projects/getItemDetails/' + id;

    var row = item.closest('tr');

    model_no = $(row).find('.model_no');
    brand_name = $(row).find('.brand_name');
    avalible_qty = $(row).find('.avalible_qty');
    requested_qty = $(row).find('.requested_qty');
    requested_qty.prop("disabled", false);

    debugger;

    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
            debugger;
            var obj = JSON.parse(data);
            debugger;

            if (obj != null) {
                if (obj.model_no != null) {
                    model_no.text(obj.model_no);
                } else {
                    model_no.text('-');
                }
                if (obj.brand_name != '')
                    brand_name.text(obj.brand_name);
                avalible_qty.text(obj.total_qty);
            }
            else {
                model_no.text('Model No');
                brand_name.text('Zone No');
                avalible_qty.text('Avalible Qty');
            }

        }
    });
}

function validateProjectMaterialsRequest() {

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
    })

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
    })

    $('.items').each(function (index) {
        if(index != numItems - 1){
            if($(this).val() == 0){
                error = 1;
                title = 'Item is not selected';
            }
        }
    })

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
