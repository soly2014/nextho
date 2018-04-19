@extends('common.master') 

@section('breadcrumbs')

<ol class="breadcrumb breadcrumb-transparent nm">
    <li class="active" style="position: relative;"><i class="fa fa-envelope" style="font-size: 30px;color:#005da4;"></i><span class="badge" style="position: absolute;right: 0;bottom: 0;background-color: red;">
    {{ $new_leads }}</span></li>
    <li class="active">Dashboard</li>
</ol>

@stop 

@section('content')

<div class="col-sm-12">
   {{--  <div class="row">
        <div class="col-sm-6">
            <div class="table-layout">
                <div class="col-xs-2 panel bgcolor-success">
                    <div class="ico-bars fsize24 text-center"></div>
                </div>
                <div class="col-xs-10 panel">
                    <div class="panel-body text-center">
                        <table class="semibold text-muted mb0 mt5 text-left table-prod" width="100%">
                            <tr>
                                <td>{{ number_format($sales_month, 0) }} EGP</td>
                                <td>-</td>
                                <td>{{ number_format($forecast_month, 0) }} EGP</td>
                                <td>=</td>
                                <td>{{ number_format(($forecast_month - $sales_month), 0) }} EGP</td>
                                <td><span class="text-primary text-right">Monthly</span></td>
                            </tr>
                            <tr>
                                <td>{{ number_format($sales_quarter, 0) }} EGP</td>
                                <td>-</td>
                                <td>{{ number_format($forecast_quarter, 0) }} EGP</td>
                                <td>=</td>
                                <td>{{ number_format(($forecast_quarter - $sales_quarter), 0) }} EGP</td>
                                <td><span class="text-primary text-right">Quarterly</span></td>
                            </tr>
                            <tr>
                                <td>{{ number_format($sales_year, 0) }} EGP</td>
                                <td>-</td>
                                <td>{{ number_format($forecast_year, 0) }} EGP</td>
                                <td>=</td>
                                <td>{{ number_format(($forecast_year - $sales_year), 0) }} EGP</td>
                                <td><span class="text-primary text-right">Yearly</span></td>
                            </tr>
                        </table>
                        <p class="semibold text-muted mb0 mt5">Total Sales</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="table-layout">
                <div class="col-xs-2 panel bgcolor-success">
                    <div class="ico-stats-up fsize24 text-center"></div>
                </div>
                <div class="col-xs-10 panel">
                    <div class="panel-body text-center">
                        <table class="semibold text-muted mb0 mt5 text-left table-prod" width="100%">
                            <tr>
                                <td>{{ $monthly_actions }}</td>
                                <td>-</td>
                                <td>{{ $monthly_follow_ups }}</td>
                                <td>=</td>
                                <td>{{ $monthly_follow_ups - $monthly_actions }}</td>
                                <td><span class="text-primary text-right">Monthly</span></td>
                            </tr>
                            <tr>
                                <td>{{ $quarterly_actions }}</td>
                                <td>-</td>
                                <td>{{ $monthly_follow_ups*3 }}</td>
                                <td>=</td>
                                <td>{{ ($monthly_follow_ups*3) - $quarterly_actions }}</td>
                                <td><span class="text-primary text-right">Quarterly</span></td>
                            </tr>
                            <tr>
                                <td>{{ $yearly_actions }}</td>
                                <td>-</td>
                                <td>{{ $monthly_follow_ups*12 }}</td>
                                <td>=</td>
                                <td>{{ ($monthly_follow_ups*12) - $yearly_actions }}</td>
                                <td><span class="text-primary text-right">Yearly</span></td>
                            </tr>
                        </table>
                        <p class="semibold text-muted mb0 mt5">Follow Ups</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="table-layout fix-height">
                <div class="col-xs-4 panel bgcolor-teal">
                    <div class="ico-users2 fsize24 text-center"></div>
                </div>
                <div class="col-xs-8 panel">
                    <div class="panel-body text-center">
                        <h4 class="semibold nm">{{ $new_leads }}</h4>
                        <p class="semibold text-muted mb0 mt5">Reassigned Leads With No Action</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title ellipsis" >Production Chart</div>
                </div>
                <div class="panel-body">
                      <canvas id="myChart"  style="width: 100%; height: 370px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default todo-panel">
                <div class="panel-heading un-bold">
                    <h4>Meetings <!--<small class="text-gray ng-binding">5 of 5 Remaining</small>--></h4>
                </div>
                   <canvas id="Meeting"  style="width: 100%; height:70px"></canvas>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default todo-panel">
                <div class="panel-heading un-bold">
                    <h4>Calls <!--<small class="text-gray ng-binding">5 of 5 Remaining</small>--></h4>
                </div>
                   <canvas id="Call"  style="width: 100%; height:70px"></canvas>
            </div>
        </div>
        <div class="col-sm-3">
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
        <div class="col-sm-3">
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



@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.time.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.axislabels.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.orderBars.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}"></script>

<script type="text/javascript">
    
    $(function () {
 

    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December","Total"],
            datasets: [{
                label: "Achievment",
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: {{ json_encode($data) }},
            },{
                label: "Target",
                backgroundColor: 'rgb(0, 93, 164)',
                borderColor: 'rgb(0, 93, 164)',
                data:{{ json_encode($target) }},
            }]
        },

        // Configuration options go here
        options: {
            responsible: false
        }
    });



    var meeting = document.getElementById('Meeting').getContext('2d');
    var chart = new Chart(meeting, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December","Total"],
            datasets: [{
                label: "Meetings",
                backgroundColor: 'rgb(242, 210, 123)',
                borderColor: 'rgb(242, 210, 123)',
                data: {{ json_encode($meetings) }},
            }]
        },

        // Configuration options go here
        options: {
            responsible: false
        }
    });


    var call = document.getElementById('Call').getContext('2d');
    var chart = new Chart(call, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December","Total"],
            datasets: [{
                label: "Calls",
                backgroundColor: 'rgb(34, 155, 76)',
                borderColor: 'rgb(34, 155, 76)',
                data: {{ json_encode($calls) }},
            }]
        },

        // Configuration options go here
        options: {
            responsible: false
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


// $('.delete_image').on('click',function(){

//     var r = confirm("Are You Sure You Wanna Delete This!");
//     if (r == true) {
//         var id = $(this).data('id');
//        window.location.href = siteBaseURL + 'delete-stock-image/' +id;
//     } 

// });

 });
    



</script>

@stop