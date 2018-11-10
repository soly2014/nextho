$(document).ready(function () {
    var d1_1 = [
        [1, 120],
        [2, 70],
        [3, 100],
        [4, 60],
        [5, 35]
    ];

    var d1_2 = [
        [1, 80],
        [2, 60],
        [3, 30],
        [4, 35],
        [5, 30]
    ];

    var d1_3 = [
        [1, 80],
        [2, 40],
        [3, 30],
        [4, 20],
        [5, 10]
    ];

    var d1_4 = [
        [1, 15],
        [2, 10],
        [3, 15],
        [4, 20],
        [5, 15]
    ];
    var previousPoint  = null;
    var data1 = [
        {
            label: "Product 1",
            data: d1_1,
            bars: {
                show: true,
                barWidth: 0.2,
                fill: true,
                lineWidth: 1,
                order: 1,
                fillColor:  "#AA4643"
            },
            color: "#AA4643"
        },
        {
            label: "Product 2",
            data: d1_2,
            bars: {
                show: true,
                barWidth: 0.2,
                fill: true,
                lineWidth: 1,
                order: 2,
                fillColor:  "#89A54E"
            },
            color: "#89A54E"
        }
    ];

    $.plot($("#chart-bar-stacked"), data1, {
        xaxis: {
            min: (new Date(2011, 11, 15)).getTime(),
            max: (new Date(2012, 04, 18)).getTime(),
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
        yaxis: {
            axisLabel: 'Value',
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
        },
        grid: {
            hoverable: true,
            clickable: false,
            borderWidth: 1
        },
        legend: {
            labelBoxBorderColor: "none",
            position: "right"
        },
        series: {
            shadowSize: 1
        }
    });

    function showTooltip(x, y, contents, z) {
        $('<div id="flot-tooltip">' + contents + '</div>').css({
            top: y - 20,
            left: x - 90,
            'border-color': z,
        }).appendTo("body").show();
    }

    function getMonthName(newTimestamp) {
        var d = new Date(newTimestamp);

        var numericMonth = d.getMonth();
        var monthArray = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        var alphaMonth = monthArray[numericMonth];

        return alphaMonth;
    }

    $("#chart-bar-stacked").bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.datapoint) {
                previousPoint = item.datapoint;
                $("#flot-tooltip").remove();

                var originalPoint;

                if (item.datapoint[0] == item.series.data[0][3]) {
                    originalPoint = item.series.data[0][0];
                } else if (item.datapoint[0] == item.series.data[1][3]){
                    originalPoint = item.series.data[1][0];
                } else if (item.datapoint[0] == item.series.data[2][3]){
                    originalPoint = item.series.data[2][0];
                } else if (item.datapoint[0] == item.series.data[3][3]){
                    originalPoint = item.series.data[3][0];
                } else if (item.datapoint[0] == item.series.data[4][3]){
                    originalPoint = item.series.data[4][0];
                }

                var x = getMonthName(originalPoint);
                y = item.datapoint[1];
                z = item.series.color;

                showTooltip(item.pageX, item.pageY,
                            "<b>" + item.series.label + "</b><br /> " + x + " = " + y + "&deg;C",
                            z);
            }
        } else {
            $("#flot-tooltip").remove();
            previousPoint = null;
        }
    });
});