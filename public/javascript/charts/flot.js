/*! ========================================================================
 * flot.js
 * Page/renders: charts-flot.html
 * Plugins used: flot
 * ======================================================================== */
$(function () {
    // flot demo main function
    // ================================
    function flotDemo (element, data) {
        this.element = element;
        this.data     = data; // change this to your server url
    }

    flotDemo.prototype = {
        // load remote data
        // ================================
        remoteData: function (option, color) {
            var self = this;

            // jquery ajax setup
            $.plot($(self.element), self.data, option);

        }
    };

    // Bar Chart - Stacked
    // ================================
    (function() {
        if($("#chart-bar-stacked").length !== 0) {
            // Chart option/setting
            var data = [{"label" : "Achieved","color" : "#096c57","data" : [["Jan", 1250000],["Feb", 1490000],["Mar", 530000],["Apr", 1380000],["May", 1940000],["Jun", 1320000],["Jul", 1110000],["Aug", 1310000],["Sep", 1570000],["Oct", 1370000],["Nov", 240000],["Dec", 1330000]]},{"label" : "Target","color" : "#91c854","data" : [["Jan", 2000000],["Feb", 2000000],["Mar", 2000000],["Apr", 2000000],["May", 2000000],["Jun", 2000000],["Jul", 2000000],["Aug", 2000000],["Sep", 2000000],["Oct", 2000000],["Nov", 2000000],["Dec", 2000000]]}];
            
            /*var data = [{
                    "label": "Facebook",
                    "color": "#3b5998",
                    "data": [["Jan", 131], ["Feb", 113], ["Mar", 78], ["Apr", 66], ["May", 70], ["Jun", 67], ["Jul", 94], ["Aug", 13], ["Sep", 103], ["Oct", 96], ["Nov", 35], ["Dec", 74]]
                }, {
                    "label": "Twitter",
                    "color": "#55acee",
                    "data": [["Jan", 71], ["Feb", 65], ["Mar", 93], ["Apr", 31], ["May", 15], ["Jun", 60], ["Jul", 24], ["Aug", 91], ["Sep", 98], ["Oct", 12], ["Nov", 21], ["Dec", 84]]
                }];*/
            
            var chart  = new flotDemo("#chart-bar-stacked", data),
                option = {
                    series: {
                        stack: true,
                        bars: {
                            align: "center",
                            lineWidth: 0,
                            show: true,
                            barWidth: 0.6,
                            fill: 0.9
                        }
                    },
                    grid: {
                        borderColor: "#eee",
                        borderWidth: 1, 
                        hoverable: true,
                        backgroundColor: "#fcfcfc"
                    },
                    tooltip: true,
                    tooltipOpts: { content: "%x : %y" },
                    xaxis: {  
                        tickColor: "#fcfcfc",
                        mode: "categories" 
                    },
                    yaxis: { tickColor: "#eee" },
                    shadowSize: 0
                };

            // Load chart data
            chart.remoteData(option);

            // Reload chart data on panel refresh
            $("html").on("fa.panelrefresh.refresh", function (event, options) {
                if(options.element.find("#chart-bar-stacked").length !== 0) {
                    chart.remoteData(option);
                }
            });
        }
    })();

});