$(function () {

    var $form = $("form.form-horizontal");
    var $current_form;
    $form.parsley({
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest(".form-group");
        }
    });
    

    $.listen('parsley:form:validated', function(e){
        if (e.validationResult == true) {            
            $('button[type=submit]').attr('disabled', 'disabled');
        }
    });
    
});