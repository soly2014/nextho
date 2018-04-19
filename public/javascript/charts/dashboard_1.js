    /*var a1 = [[0,500],[1,150],[2,250]];
    var a2 = [[0,500],[1,500],[2,500]];

    var data = [
        {
            label: "France",
            data: a1,
            bars : {
                fillColor:  "#AA4643"
            },
            color: "#AA4643"
        },
        {
            label: "Germany",
            data: a2,
            bars : {
                fillColor:  "#89A54E"
            },
            color: "#89A54E"
        }
    ];

    $.plot($("#chart-bar-stacked"), data, {
        xaxis: {

            mode: "time",
            timeformat: "%b",
            tickSize: [1, "month"],
            monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            tickLength: 0, // hide gridlines
            axisLabel: 'Month',
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
        },
        series: {
            bars: {
                show: true,
                barWidth: 0.13,
                order: 1
            }
        },
        valueLabels: {
            show: true
        }
    });*/
    
$(function () {
    var data = [[0, 11],[1, 15],[2, 25],[3, 24],[4, 13],[5, 25]];
    var ticks = [[0, "Jan"], [1, "Feb"], [2, "Mar"], [3, "Apr"],[4, "May"], [5, "Target"]];
    var dataset = [{ label: "Production", data: data, color: "#89A54E" }];

    var options = {
        series: {
            bars: {
                show: true
            }
        },
        bars: {
            align: "center",
            barWidth: 0.5
        },
        xaxis: {
            axisLabel: "Months",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10,
            ticks: ticks
        },
        yaxis: {
            axisLabel: "Sales",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 3,
            tickFormatter: function (v, axis) {
                return v + " EGP";
            }
        },
        legend: {
            noColumns: 0,
            labelBoxBorderColor: "#000000",
            position: "nw"
        },
        grid: {
            hoverable: true,
            borderWidth: 2,
            backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
        }
    };
    
    $(document).ready(function () {
        $.plot($("#chart-bar-stacked"), dataset, options);
        $("#chart-bar-stacked").UseTooltip();
    });

    function gd(year, month, day) {
        return new Date(year, month, day).getTime();
    }

    var previousPoint = null, previousLabel = null;

    $.fn.UseTooltip = function () {
        $(this).bind("plothover", function (event, pos, item) {
            if (item) {
                if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                    previousPoint = item.dataIndex;
                    previousLabel = item.series.label;
                    $("#tooltip").remove();

                    var x = item.datapoint[0];
                    var y = item.datapoint[1];

                    var color = item.series.color;

                    //console.log(item.series.xaxis.ticks[x].label);                

                    showTooltip(item.pageX,
                    item.pageY,
                    color,
                    "<strong>" + item.series.label + "</strong><br>" + item.series.xaxis.ticks[x].label + " : <strong>" + y + "</strong> EGP");
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    };

    function showTooltip(x, y, color, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y - 40,
            left: x - 120,
            border: '2px solid ' + color,
            padding: '3px',
            'font-size': '9px',
            'border-radius': '5px',
            'background-color': '#fff',
            'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            opacity: 0.9
        }).appendTo("body").fadeIn(200);
    }
});