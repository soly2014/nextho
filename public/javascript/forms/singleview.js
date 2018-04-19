
$(function () {

    // display month & year
    if($(".date-picker").length){
        $(".date-picker").datetimepicker({
            changeMonth: true,
            changeYear: true,
            minDate: 0
        });
    }
        
    if($(".full-date-picker").length){
        $(".full-date-picker").datepicker({
            changeMonth: true,
            changeYear: true
        });
    }
    
    // table tools
    // ================================
    
    if($("table#Leads_Table").length){
        var $table = $("table#Leads_Table"),
            oTable = $table.dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                responsive: true
            });

            $table.on("keyup", "input[type=search]", function () {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter(this.value, $("tfoot input").index(this));
        });
    }
    /*if($("table#Leads_Table").length){
        var $table = $("table#Leads_Table"),
            oTable = $table.dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "sDom": "<'row'<'col-sm-4'T><'col-sm-4'l><'col-sm-4'f>><'table-responsive'rt><'row'<'col-sm-6'p><'col-sm-6'i>>",
                "oTableTools": {
                    "sSwfPath": "../plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        "copy",
                        "print",
                        "pdf",
                        "csv"
                    ]
                },
                responsive: true
            });

            $table.on("keyup", "input[type=search]", function () {
            oTable.fnFilter(this.value, $("tfoot input").index(this));
        });
    }*/

});