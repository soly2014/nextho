$(function () {

    $(".range-slider").each(function () {
        $(this).slider({
            range: true,
            min: $(this).data("min"),
            max: $(this).data("max"),
            values: [$(this).data("value-min"), $(this).data("value-max")],
            slide: function (event, ui) {
                $( ".min-area" ).val(ui.values[0]);
                $( ".max-area" ).val(ui.values[1]);
            }
        });
    });

});