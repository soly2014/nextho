@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

@include('users.partials.inactive')

<div class="col-md-12">
    <div class="form-horizontal">
        <div class="panel panel-default">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-users mr10"></i>View "{{ $user->username }}" Details</h3>
                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        <a href="{{ route('users-modify-single', array($user->id)) }}" class="btn btn-default btn-sm"><i class="ico-pencil mr5"></i>Edit</a>
                        <a href="{{ route('users-password-reset', array($user->id)) }}" class="btn btn-default btn-sm"><i class="ico-lock mr5"></i>Password Reset</a>
                        @if($user->active)
                        <a href="{{ route('users-deactivate', array($user->id)) }}" class="btn btn-danger btn-sm warn-first"><i class="ico-cancel-circle mr5"></i>Deactivate</a>
                        @else
                        <a href="{{ route('users-reactivate', array($user->id)) }}" class="btn btn-success btn-sm warn-activate"><i class="ico-checkbox-checked mr5"></i>Reactivate</a>
                        @endif
                    </div>
                </div>
            </div>
            <!--/ panel heading/header -->

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">User Name:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->username }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->email }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Created By:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->userCreated->username }}</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Created At:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->created_at }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Last Log-in:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->last_login }}</label>
                        </div>

                    </div>
                </div>
                @if($user->role_id == 2)
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
                        </div>
                    </div>

                @endif
            </div>
            <ul class="nav nav-tabs in-panel">
                <li class="active"><a href="#tab1" data-toggle="tab">Leads Assigned</a></li>
                <li class=""><a href="#tab4" data-toggle="tab">No Action Leads</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Customers</a></li>
                <li class=""><a href="#tab3" data-toggle="tab">Open Activities</a></li>
            </ul>
            <div class="tab-content in-panel">
                <div class="tab-pane active" id="tab1">
                    @include('users.partials.leads')
                </div>
                <div class="tab-pane" id="tab2">
                    @include('users.partials.customers')
                </div>
                <div class="tab-pane" id="tab3">
                    @include('users.partials.open_activities')
                </div>

                <div class="tab-pane" id="tab4">
                    @include('users.partials.no_action')
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <a href="{{ route('users-modify-single', array($user->id)) }}" class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-primary mr10">Delete</button>
                        <a href="{{ route('users-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">
<style type="text/css">
    #ProductionChartDIV, #MeetingsChartDIV, #CallsChartDIV {
        height: 350px;
        min-width: 200px;
        max-width: 1500px;
    }
</style>

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/tables/datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/users.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){


           
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





    });

</script>
@stop
