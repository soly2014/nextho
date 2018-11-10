$(function () {
    
    var warn_btn = '.warn-first';
    
    $('.warn-first').on('click', function (e) {
        e.preventDefault();

        var delete_action = confirm("Are you sure you want to Deactivate the selected User ?");

        if (delete_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });
    $('.warn-activate').on('click', function (e) {
        e.preventDefault();

        var delete_action = confirm("Are you sure you want to Reactivate the selected User ?");

        if (delete_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });

});