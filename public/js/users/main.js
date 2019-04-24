
function resetPassword(id) {
    debugger;
    swal({
        title: "Are you sure?",
        text: "password Will Be Set to User123!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Reset",
    }).then(function(){
        debugger;
        $.ajax({
            type: "GET",
            url:  '/users/resetPassword/'+id,
            success: function(data) {
                debugger;
                alert('password reset to user123!');
            }
        });
    });
}
$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
$(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});