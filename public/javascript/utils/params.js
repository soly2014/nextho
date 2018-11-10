$(function () {

    var confirm_btn = '.confirm-first';
    
    $('.table').on('click', confirm_btn, function (e) {
        e.preventDefault();

        var confirm_action = confirm("Are you sure you want to Publish the selected Item?");

        if (confirm_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });
    
    var warn_btn = '.warn-first';
    
    $('.table').on('click', warn_btn, function (e) {
        e.preventDefault();

        var delete_action = confirm("Are you sure you want to UnPublish the selected Item?");

        if (delete_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });

});