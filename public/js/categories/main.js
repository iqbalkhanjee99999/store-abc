$(function() {
    $('#data-table-basic').DataTable( {
        "order": [[ 0, "desc" ]],
        "bDestroy": true,
    } );
});

function showToolsCategoryItems(id) {
    window.location = '/categories/toolsCategoryItems/'+id;
}
function showCategoryItems(id) {
    window.location = '/categories/categoryItems/'+id;
}
$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
$(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

function orderRecieved(requested_goods_id,description,model_no,brand) {
    var basepath   =   window.location.origin;
    swal({
        title: 'Order: '+description+' / '+ model_no +' / '+brand,
        text: "Are You Sure You Recieved This Order",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            url: basepath+'/requestedGoods/markToolAsRecieved/'+requested_goods_id,
            success: function(data) {
               location.reload();
            }
        });
    });
}

function materialOrderRecieved(requested_goods_id,description,model_no,brand) {

    debugger;
    var basepath   =   window.location.origin;
    swal({
        title: 'Order: '+description+' / '+ model_no +' / '+brand,
        text: "Are You Sure You Recieved This Order",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            url: basepath+'/requestedGoods/markMaterialAsRecieved/'+requested_goods_id,
            success: function(data) {
                debugger;
                location.reload();
            }
        });
    });
}

function itemReciveFromStore(id) {
    var basepath   =   window.location.origin;
    swal({
        title: 'Item Will Be Marked As Received !',
        text: "Are You Sure You Recieved This Order",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            url: basepath+'/projects/markItemAsRecievedFromStore/'+id,
            success: function(data) {
                debugger;
                location.reload();
            }
        });
    });
}

function returnedToStore(id,item_id,quantity) {
    var basepath   =   window.location.origin;
    var data = [];
    var error = 0;
    var title = '';

    var zone_no   = $('#zone_no'+id).val();
    var column_no = $('#column_no'+id).val();
    var shelf_no  = $('#shelf_no'+id).val();
    var carton_no = $('#carton_no'+id).val();

    debugger;

    if(zone_no == ''){
        error = 1;
        title = 'Please Provide Zone number';
    }
    if(column_no < 1){
        error = 1;
        title = 'Please Provide Correct Column number';
    }
    if(shelf_no < 1){
        error = 1;
        title = 'Please Provide Correct Shelf number';
    }
    if(carton_no == ''){
        error = 1;
        title = 'Please Provide Carton number';
    }

    if(error == 1){
        swal({
            title: title,
            text: "Please Provide Correct Data",
            type: "error",
            confirmButtonText: "Ok",
        })
    }else {
        swal({
            title: 'Item Will Be Marked As Received !',
            text: "Are You Sure You Recieved This Order",
            type: "warning",
            confirmButtonText: "Yes Sure",
            showCancelButton: true,
        }).then(function () {
            $.ajax({
                type:"GET",
                data:{
                    id:id,
                    item_id:item_id,
                    quantity:quantity,
                    zone_no:zone_no,
                    column_no:column_no,
                    shelf_no:shelf_no,
                    carton_no:carton_no
                },
                url: basepath+'/requestedGoods/returnedToStore/'+id,
                success: function(data) {
                    debugger;
                    location.reload();
                }
            });
        });
    }
}

function requestIdleItem(id,project_id) {
    var title = '';
    var basepath   =   window.location.origin;
    var avalible_quantity = parseInt($('#avalible_quantity'+id).val());
    var quantity =parseInt($('#quantity'+id).val());

    debugger;

    if(quantity < 1){
        swal({
            title: "Invalid Quantity",
            text: "Items Should Be More Than 0",
            type: "error",
            buttons: "OK",
            dangerMode: true,
        });
    }
    else if(quantity > avalible_quantity){
        swal({
            title: "Invalid Quantity",
            text:  "Quantity Not Avalible",
            type: "error",
            buttons: "OK",
            dangerMode: true,
        });
    }
    else{
        if(quantity === avalible_quantity){
            title = 'All Items Will Be Requested !';
        }else{
            title = quantity + ' Items Will Be Requested';
        }
        swal({
            title: title,
            text: "Are You Sure?",
            type: "warning",
            confirmButtonText: "Yes Sure",
            showCancelButton: true,
        }).then(function () {
            $.ajax({
                type:"GET",
                data:{quantity:quantity,project_id:project_id},
                url: basepath+'/projects/requestIdleItems/'+id,
                success: function(data) {
                    debugger;
                    location.reload();
                }
            });
        });
    }
    $('#quantity').val('');
}

function approveIdleItemsRequest(id,quantity,row_id) {
    var basepath   =   window.location.origin;
    swal({
        title: 'Are You Sure?',
        text: "Idle Items Request Will Be Approved!",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            data:{quantity:quantity,id:id,row_id:row_id},
            url: basepath+'/projects/approveRequestIdleItems',
            success: function(data) {
                debugger;
                location.reload();
            }
        });
    });
}

function idleItemsRecevied(item_id,quantity,row_id) {
    var basepath   =   window.location.origin;
    swal({
        title: 'Are You Sure?',
        text: "Selected Item Recevied?",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            data:{quantity:quantity,item_id:item_id,row_id:row_id},
            url: basepath+'/projects/idleItemsRecevied',
            success: function(data) {
                debugger;
                location.reload();
            }
        });
    });
}

function rejectIdleItemsRequest(row_id) {
    var basepath   =   window.location.origin;
    swal({
        title: 'Warning!!',
        text: "Idle Items Request Will Be Rejected!",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            data:{row_id:row_id},
            url: basepath+'/projects/rejectIdleItemsRequest',
            success: function(data) {
                debugger;
                location.reload();
            }
        });
    });
}

function storeReturnApprove(row_id,project_id,item_id) {

    var basepath    =   window.location.origin;

    swal({
        title: 'Warning!!',
        text: "Item will be returned to Main store",
        type: "warning",
        confirmButtonText: "Return",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            data:{row_id:row_id,project_id:project_id,item_id:item_id},
            url: basepath+'/projects/storeApproveReturnedItems',
            success: function(data) {
                location.reload();
            }
        });
    });
}

function storeReturnReject(row_id,project_id,item_id) {

    var basepath    =   window.location.origin;

    swal({
        title: 'Warning!!',
        text: "Return items request will be rejected",
        type: "warning",
        confirmButtonText: "Reject",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            data:{row_id:row_id,project_id:project_id,item_id:item_id},
            url: basepath+'/projects/storeRejectReturnedItems',
            success: function(data) {
                location.reload();
            }
        });
    });
}

function enable_item_location(id) {
    $('#zone_no'+id).prop('disabled',false);
    $('#column_no'+id).prop('disabled',false);
    $('#shelf_no'+id).prop('disabled',false);
    $('#carton_no'+id).prop('disabled',false);
}
