@extends('common.master') 

@section('breadcrumbs')

<ol class="breadcrumb breadcrumb-transparent nm">

    @if(auth()->user()->role_id == '2')
    <li class="active" style="position: relative;"><i class="fa fa-envelope" style="font-size: 30px;color:#005da4;"></i><span class="badge" style="position: absolute;right: 0;bottom: 0;background-color: red;">
    {{ $new_leads }}</span></li>
    @endif

    @if(auth()->user()->role_id == '3')
    <li class="active" style="position: relative;padding: 5px;"><i class="fa fa-thumbs-o-down" style="font-size: 30px;color:#005da4;"></i><span id="countBadge" class="badge" style="position: absolute;left: 0;bottom: 0;background-color: red;">
    {{ \App\Models\Client::where('newly_assigned',1)->count() }}</span></li>
    @endif

    <li class="active">Dashboard</li>
</ol>

@stop 

@section('content')

@if(auth()->user()->role_id != '3')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title ellipsis" >Production Chart</div>
                    </div>
                    <div class="panel-body" id="ProductionChartDIV">
                          

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default" id="MeetingsChartDIV">
                    <div class="panel-heading">
                        <div class="panel-title ellipsis" >Meetings</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading" id="CallsChartDIV">
                        <div class="panel-title ellipsis" >Calls</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default todo-panel">
                    <div class="panel-heading un-bold">
                        <h4>Personal Activities 
                          <span class="fa fa-calendar " style="float: right;margin-left: 10px;"></span>
                          <input type="text" name='datepicker' class="full-date-picker personl_activity" data-type="personal" style="width: 100px;float: right;"  value="00/00/0000"  ng-required="true" placeholder="MM/DD/YYYY" >
                        </h4>
                    </div>
                    <div class="panel-body no-padding">
                        @include('common.dash-activities')
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default todo-panel">
                    <div class="panel-heading un-bold">
                        <h4>Other Activities 
                          <span class="fa fa-calendar " style="float: right;margin-left: 10px;"></span>
                          <input type="text" name='datepicker' class="full-date-picker other_activity" data-type="other" style="width: 100px;float: right;"  value="00/00/0000" ng-required="true" placeholder="MM/DD/YYYY" >
                        </h4>
                    </div>
                    <div class="panel-body no-padding">
                        @include('common.dash-otheractivities')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}">
<style type="text/css">
#ProductionChartDIV, #MeetingsChartDIV, #CallsChartDIV {
    height: 350px;
    min-width: 200px;
    max-width: 1500px;
}
</style>
@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.time.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.axislabels.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.orderBars.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}"></script>

<script type="text/javascript">
    
    $(function () {
 

           
        // Achievment&Target Chart
        var chart = Highcharts.chart('ProductionChartDIV', {

            chart: {
                type: 'column'
            },

            title: {
                text: 'Achievment && Target'
            },

            subtitle: {
                text: ' '
            },

            legend: {
                align: 'right',
                verticalAlign: 'middle',
                layout: 'vertical'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mars','April', 'May', 'June','July', 'August', 'September','October', 'November', 'December','Total'],
                labels: {
                    x: -10
                }
            },

            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Amount'
                }
            },

            series: [{
                name: 'Achievment',
                data: {{ json_encode($data) }}
            }, {
                name: 'Target',
                data: {{ json_encode($target) }}
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            },
            color: {
                linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                stops: [
                    [0, 'red'],
                    [1, '#3366AA']
                ]
            }
        });




           
        // Achievment&Target Chart
        var chart = Highcharts.chart('MeetingsChartDIV', {

            chart: {
                type: 'column'
            },

            title: {
                text: 'Calls'
            },

            subtitle: {
                text: ''
            },

            legend: {
                align: 'right',
                verticalAlign: 'middle',
                layout: 'vertical'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mars','April', 'May', 'June','July', 'August', 'September','October', 'November', 'December','Total'],
                labels: {
                    x: -10
                }
            },

            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Amount'
                }
            },

            series: [{
                name: 'Calls',
                data: {{ json_encode($calls) }}
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });




           
        // Achievment&Target Chart
        var chart = Highcharts.chart('CallsChartDIV', {

            chart: {
                type: 'column'
            },

            title: {
                text: 'Meetings'
            },

            subtitle: {
                text: ''
            },

            legend: {
                align: 'right',
                verticalAlign: 'middle',
                layout: 'vertical'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mars','April', 'May', 'June','July', 'August', 'September','October', 'November', 'December','Total'],
                labels: {
                    x: -10
                }
            },

            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Amount'
                }
            },

            series: [{
                name: 'Meetings',
                data: {{ json_encode($meetings) }}
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });




    
        function showTooltip(x, y, contents, z) {
            $('<div id="flot-tooltip">' + contents + '</div>').css({
                top: y - 30,
                left: x - 100,
                'border-color': z,
            }).appendTo("body").show();
        }

        function getMonthName(newTimestamp) {
            //var d = new Date(newTimestamp);

            //var numericMonth = d.getMonth();
            var monthArray = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            var alphaMonth = monthArray[newTimestamp];

            return alphaMonth;
        }

        $("#chart-bar-stacked").bind("plothover", function (event, pos, item) {
            if(item) {
                if(previousPoint != item.datapoint) {
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
                    } else if (item.datapoint[0] == item.series.data[5][3]){
                        originalPoint = item.series.data[5][0];
                    } else if (item.datapoint[0] == item.series.data[6][3]){
                        originalPoint = item.series.data[6][0];
                    } else if (item.datapoint[0] == item.series.data[7][3]){
                        originalPoint = item.series.data[7][0];
                    } else if (item.datapoint[0] == item.series.data[8][3]){
                        originalPoint = item.series.data[8][0];
                    } else if (item.datapoint[0] == item.series.data[9][3]){
                        originalPoint = item.series.data[9][0];
                    } else if (item.datapoint[0] == item.series.data[10][3]){
                        originalPoint = item.series.data[10][0];
                    } else if (item.datapoint[0] == item.series.data[11][3]){
                        originalPoint = item.series.data[11][0];
                    } else if (item.datapoint[0] == item.series.data[10][3]){
                        originalPoint = item.series.data[12][0];
                    }
                    
                    console.log(originalPoint);
                    var x = getMonthName(originalPoint);
                    y = item.datapoint[1];
                    z = item.series.color;

                    showTooltip(item.pageX, item.pageY,
                                "<b>" + item.series.label + "</b><br /> " + x + " : " + parseFloat(y, 8).toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString() + " EGP",
                        z);
                }
            } else {
                $("#flot-tooltip").remove();
                previousPoint = null;
            }
        });


        $(".full-date-picker").datepicker({
            changeMonth: true,
            changeYear: true,
            onSelect: function(date) { 
                var type = $(this).data('type'); 
                $.ajax({
                    type:'POST',
                    url:'{{ route('filter.activity.dashboard') }}',
                    data:{type:type,date:date,'_token':'{{ csrf_token() }}'},
                    success:function(data){
                        if (data.type == 'personal') {
                           $('#PersonalContainer').html(data.html); 
                        } else {
                           $('#OtherContainer').html(data.html);                             
                        }
                    },
                    error:function(error){
                        alert(error)
                    }

                });

            }
        });

        (function ($) {
            $.extend({
                playSound: function () {
                    return $(
                           '<audio class="sound-player" autoplay="autoplay" style="display:none;">'
                             + '<source src="' + arguments[0] + '" />'
                             + '<embed src="' + arguments[0] + '" hidden="true" autostart="true" loop="false"/>'
                           + '</audio>'
                         ).appendTo('body');
                },
                stopSound: function () {
                    $(".sound-player").remove();
                }
            });
        })(jQuery);


        @if(auth()->user()->role_id == '2')
        setInterval(function() {
            $.ajax({
                type:'GET',
                data:{num:{{ $new_leads }} },
                url:'{{ route('count_new_leads') }}',
                success:function(data){
                    if (data.success) {
                         $('#countBadge').val(data.new_count);
                         $.playSound("http://www.noiseaddicts.com/samples_1w72b820/3724.mp3");
                    } else {

                    }
                    console.log(data);
                },
                error:function(error){
                    //alert(error);
                }
            });
        },5000);
        @endif


        // $('#ProductionChartDIV').width($('#ProductionChartDIVContainer').width()-20);//
        // $('#MeetingsChartDIV').width($('#MeetingsChartDIVContainer').width()-20);//
        // $('#CallsChartDIV').width($('#CallsChartDIVContainer').width()-20);//
        
 });
    



</script>

@stop