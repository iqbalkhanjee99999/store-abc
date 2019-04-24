
function exportToExcel(){
    var category = $('#category').val();
    var search = $('#search').val();

    $.ajax({
        type: "GET",
        url: '../../reports/exportToExcel/',
        data:{category:category,search:search},
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

function exportToolsToExcel(){

    var category = $('#category').val();
    var search = $('#search').val();

    $.ajax({
        type: "GET",
        url: '../../reports/exportToolsToExcel/',
        data:{category:category,search:search},
        success: function (response) {
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

function exportProjectMaterialsToExcel() {

    var category = $('#category').val();
    var search = $('#search').val();

    $.ajax({
        type: "GET",
        url: '../../reports/exportProjectMaterialsToExcel/',
        data:{category:category,search:search},
        success: function (response) {
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

function returnItem(id) {
    var basepath   =   window.location.origin;
    swal({
        title: 'Item Will Be Returned To Main Store!',
        text: "Are You Sure You Want to Return This Item",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            url: basepath+'/projects/returnItemToMainStore/'+id,
            success: function(data) {
                if(data != ''){
                    swal({
                        title: 'Error !',
                        text: data,
                        type: "error",
                        confirmButtonText: "Ok",
                    }).then(function () {

                    });
                }else{
                    location.reload();
                }
            }
        });
    });
}

function markAsIdle(id) {
    var basepath   =   window.location.origin;
    swal({
        title: 'Item Will Be Marked As Idle Item !',
        text: "Are You Sure You Want to Idle This Item",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            url: basepath+'/projects/markStoreItemAsIdle/'+id,
            success: function(data) {
                if(data != ''){
                    swal({
                        title: 'Error !',
                        text: data,
                        type: "error",
                        confirmButtonText: "Ok",
                    }).then(function () {

                    });
                }else{
                    location.reload();
                }

            }
        });
    });
}
function markAsFunctional(id) {
    var basepath   =   window.location.origin;
    swal({
        title: 'Make Item Functional in Project!',
        text: "Are You Sure You Want to Make  This Item Functional",
        type: "warning",
        confirmButtonText: "Yes Sure",
        showCancelButton: true,
    }).then(function () {
        $.ajax({
            type:"GET",
            url: basepath+'/projects/markStoreItemAsFunctional/'+id,
            success: function(data) {
                debugger;
                location.reload();
            }
        });
    });
}