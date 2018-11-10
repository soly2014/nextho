$(function () {

    var confirm_btn = '.confirm-first';
    
    $('.panel-body').on('click', confirm_btn, function (e) {
        e.preventDefault();

        var confirm_action = confirm("Are you sure you want to Confirm the selected Transaction ?");

        if (confirm_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });
    
    var warn_btn = '.warn-first';
    
    $('.panel-body').on('click', warn_btn, function (e) {
        e.preventDefault();

        var delete_action = confirm("Are you sure you want to delete the selected Transaction ?");

        if (delete_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });

});