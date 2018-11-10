$(function () {
    
    $.fn.hasAttr = function(name) {  
       return this.attr(name) !== undefined;
    };

    $('#expiry_date').on('change', function(){
        if($("#expiry_date_never").hasAttr('checked')){
            $("#expiry_date_never").removeAttr('checked');
        }
    });
    
    $("#expiry_date_never").on('click', function(){
        $('#expiry_date').val("");  
    });
    
    

});

$('document').ready(function(){
    if($('#expiry_date').val() == ""){
        $("#expiry_date_never").attr('checked', 'checked');
    }
    
    CKEDITOR.replace( 'email_body' );

});