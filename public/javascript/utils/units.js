$(function () {
    
    var visible_Class="visible";
    var selected;
    $('#property_type').on('change', function(){
        var value = $(this).val();

        select(value);
    });
    
    $('.modify-form .cat').on('change', 'input',function(){
        var name = $(this).attr('name');
        //console.log(name);
        if($(this).attr('type', 'checkbox')){
            var checked = $(this).attr('checked');
            //console.log(checked);
            if(typeof checked == 'undefined'){
                //console.log("1");
                $('[name="'+name+'"]').attr('checked', false);
            } else {
                //console.log("2");
                $('[name="'+name+'"]').attr('checked', checked);
            }
        } else {
            var value   = $(this).val();
            $('[name="'+name+'"]').val(value);
        }
    });
    
    function select(value){
        if(value == "1" || value == "2" || value == "9" || value == "6" || value == "7" || value == "8"){
            selected = ".cat-1";
        }
        if(value == "3" || value == "4" || value == "5"){
            selected = ".cat-2";
        }
        if(value == "11"){
            selected = ".cat-3";
        }
        if(value == "12"){
            selected = ".cat-4";
        }
        if(value == "10"){
            selected = ".cat-0";
        }
        
        $('.visible').removeClass(visible_Class);
        $(selected).addClass(visible_Class);
    }
    
    $(window).ready(function () {
        select($('#property_type').val());
    });
    
        
});