(function () {
    // Formating function for row details
    var fnFormatDetails = function (oTable, nTr) {
        var sOut = "",
            aData = oTable.fnGetData(nTr);

        sOut += '<div class="table table-condensed nm">';
        sOut += '<p><b>Description: </b>' + aData[1] + ' ' + aData[2] + '</p>';
        sOut += '</div>';

        return sOut;
    };

    var nCloneTh = document.createElement("th"),
        nCloneTd = document.createElement("td");
    nCloneTd.innerHTML = '<a href="#" class="text-primary detail-toggler" style="text-decoration:none;font-size:14px;"><i class="ico-plus-circle"></i></a>';
    nCloneTd.className = "center";

    $(".actvities_table thead tr").each(function () {
        this.insertBefore(nCloneTh, this.childNodes[0]);
    });
    $(".actvities_table tbody tr").each(function () {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
    });

    // Initialse DataTables
    var oTable = $(".actvities_table").dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
            }],
        "aaSorting": [
                [1, "asc"]
            ]
    });

    // Add event listener for opening and closing details
    $(".actvities_table tbody td .detail-toggler").on("click", function (e) {
        var nTr = $(this).parents("tr")[0];
        $(nTr).toggleClass("open");
        if (oTable.fnIsOpen(nTr)) {
            // This row is already open - close it
            $(this).children().attr("class", "ico-plus-circle");
            oTable.fnClose(nTr);
        } else {
            // Open this row
            $(this).children().attr("class", "ico-minus-circle");
            oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), "details np");
        }
        e.preventDefault();
    });
})();