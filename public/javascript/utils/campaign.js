$(function () {
    
    $('.warn-first').on('click', function (e) {
        e.preventDefault();

        var delete_action = confirm("Are you sure you want to delete the selected Campaign ?");

        if (delete_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });
        
    $('.confirm-first').on('click', function (e) {
        e.preventDefault();

        var restore_action = confirm("Are you sure you want to restore the selected Campaign ?");

        if (restore_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });

});