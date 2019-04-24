function addRow() {
    var table   =   $("#projectsTable");
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

function validateProject() {
    event.preventDefault();
    var error = 0;
    var title = '';
    var projectName = $('#projectName').val();
    var engineers = $('.engineers');
    var storeKeepers = $('.storeKeepers');
    var numItems = $('.engineers').length;
    debugger;


    storeKeepers.each(function(index) {
        if(index != numItems - 1)
        {
            if ($(this).val() === "") {
                error = 1;
                title = 'Please Select Store Keeper Name';
            }
        }
    });
    engineers.each(function(index) {
        if(index != numItems - 1) {
            if ($(this).val() === "") {
                error = 1;
                title = 'Please Select Engineer Name';
            }
        }{}
    });

    if(projectName == ""){
        error = 1;
        title = 'Provide Project Name';
    }
    if(error != 0){
        swal({
            title: title,
            text: "Please Provide Correct Data",
            icon: "warning",
            buttons: "OK",
        })
    }else{
        $('#addProject').submit();
    }
}

function showProjectUsers(id) {
    window.location = '/projects/projectUsers/'+id;
}

function enable_textareas(item) {
    var row = item.closest('tr');

    engineers         =  $(row).find('.engineers');
    storeKeepers        =  $(row).find('.storeKeepers');
    button = $(row).find('#btn_icon');

    if ( engineers.is('[disabled]') ) {
        engineers.attr('disabled',false);
        button.removeClass('notika-edit');
        button.addClass('notika-eye');
    }else{
        engineers.attr('disabled',true);
        button.removeClass('notika-eye');
        button.addClass('notika-edit');
    }

    if ( storeKeepers.is('[disabled]') ) {
        storeKeepers.attr('disabled',false);
    }else{
        storeKeepers.attr('disabled',true);
    }
}

function updateProjectUsers() {
    event.preventDefault();
    var error = 0;
    var title = '';
    var engineers = $('.engineers');
    var storeKeepers = $('.storeKeepers');
    var numItems = $('.engineers').length;
    var checkEngineer = [];
    var checkStorekeeper = [];
    debugger;

    if(engineers.length < 2){
        error = 1;
        title = 'Please Add Atleast One Engineer and StoreKeeper';
    }

    storeKeepers.each(function(index) {
        if(index != numItems - 1)
        {
            if ($(this).val() === "") {
                error = 1;
                title = 'Please Select Store Keeper Name';
            }
            checkStorekeeper.push($(this).val());
        }
    });
    engineers.each(function(index) {
        if(index != numItems - 1) {
            if ($(this).val() === "") {
                error = 1;
                title = 'Please Select Engineer Name';
            }
            checkEngineer.push($(this).val());
        }
    });
    var sorted_engineers = checkEngineer.slice().sort();
    for(var i = 0; i<sorted_engineers.length; i++){
        if(sorted_engineers[i] == sorted_engineers[i+1]){
            error = 1;
            title = 'Please Remove Duplicate Value for Engineers';
        }
    }
    debugger;

    if(error != 0){
        swal({
            title: title,
            text: "Please Provide Correct Data",
            icon: "warning",
            buttons: "OK",
        })
    }else{
        swal({
            title: "Are You Sure",
            text: "Project Users Will Be Updated!",
            type: "warning",

            showCancelButton: true,
            confirmButtonText: "Update",
        }).then(function () {
            engineers.each(function () {
                $(this).prop('disabled',false);
            });
            storeKeepers.each(function () {
                $(this).prop('disabled',false);
            })
            $('#addProject').submit();
        })
    }

}
function backToProjects() {
    event.preventDefault();
    window.location= '/projects/allProjects';
}