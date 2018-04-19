$(function () {

    var warn_btn = '.warn-first';
    
    $('.tab-content').on('click', warn_btn, function (e) {
        e.preventDefault();

        var delete_action = confirm("Are you sure you want to delete the selected item?");

        if (delete_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });
    
    var restore_btn = '.confirm-restore-first';
    
    $('.tab-content').on('click', restore_btn, function (e) {
        e.preventDefault();

        var restore_action = confirm("Are you sure you want to restore the selected Item?");

        if (restore_action) {
            var URL = $(this).attr('href');

            window.location.href = URL;
        }
    });

});