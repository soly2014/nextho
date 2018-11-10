<!DOCTYPE html>

<html class="backend">
    <!-- START Head -->
    <head>
        <!-- START META SECTION -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ PageTitle::get() }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!--/ END META SECTION -->

        <!-- START STYLESHEETS -->
        <!-- Plugins stylesheet : optional -->

        @yield('styles')

        <!--/ Plugins stylesheet -->
        
        <!-- Application stylesheet : mandatory -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/library/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheet/layout.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheet/uielement.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheet/custom.css') }}">
        <!--/ Application stylesheet -->
        <!-- END STYLESHEETS -->
        
        

        <!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
        <script type="text/javascript" href="{{ asset('library/modernizr/js/modernizr.min.js') }}"></script>

        <!--/ END JAVASCRIPT SECTION -->
    </head>
    <!--/ END Head -->

    <!-- START Body -->
    <body>
        <!-- START Template Header -->
        <header id="header" class="navbar navbar-fixed-top">
            <!-- START navbar header -->
            <div class="navbar-header">
                <!-- Brand -->
                <a class="navbar-brand" href="javascript:void(0);">
                    <span class="logo-figure"></span>
                </a>
                <!--/ Brand -->
            </div>
            <!--/ END navbar header -->

            <!-- START Toolbar -->
            <div class="navbar-toolbar clearfix">
                <!-- START Left nav -->
                <ul class="nav navbar-nav navbar-left">
                    <!-- Sidebar shrink -->
                    <li class="hidden-xs hidden-sm">
                        <a href="javascript:void(0);" class="sidebar-minimize" data-toggle="minimize" title="Minimize sidebar">
                            <span class="meta">
                                <span class="icon"></span>
                            </span>
                        </a>
                    </li>
                    <!--/ Sidebar shrink -->

                    <!-- Offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
                    <li class="navbar-main hidden-lg hidden-md hidden-sm">
                        <a href="javascript:void(0);" data-toggle="sidebar" data-direction="ltr" rel="tooltip" title="Menu sidebar">
                            <span class="meta">
                                <span class="icon"><i class="ico-paragraph-justify3"></i></span>
                            </span>
                        </a>
                    </li>
                    <!--/ Offcanvas left -->

                    <!-- Search form toggler  -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="dropdown" data-target="#dropdown-form">
                            <span class="meta">
                                <span class="icon"><i class="ico-search"></i></span>
                            </span>
                        </a>
                    </li>
                    <!--/ Search form toggler -->
                </ul>
                <!--/ END Left nav -->

                <!-- START navbar form -->
                <div class="navbar-form navbar-left dropdown" id="dropdown-form">
                    <form action="#" role="search">
                        <div class="has-icon">
                            <input type="text" class="form-control" placeholder="Search application...">
                            <i class="ico-search form-control-icon"></i>
                        </div>
                    </form>
                </div>
                <!-- START navbar form -->

                @if(Auth::check())
                <!-- START Right nav -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Profile dropdown -->
                    <li class="dropdown profile">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <span class="text hidden-xs hidden-sm pl5">{{ Auth::user()->username }}</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('change.password') }}"><span class="icon"><i class="ico-cog4"></i></span> Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('account-sign-out') }}"><span class="icon"><i class="ico-exit"></i></span> Sign Out</a></li>
                        </ul>
                    </li>
                    <!-- Profile dropdown -->

                </ul>
                <!--/ END Right nav -->
                @endif
            </div>
            <!--/ END Toolbar -->
        </header>
        <!--/ END Template Header -->

        <!-- START Template Sidebar (Left) -->
        <aside class="sidebar sidebar-left sidebar-menu">
            <!-- START Sidebar Content -->
            @include('common.sidemenu')
            <!--/ END Sidebar Container -->
        </aside>
        <!--/ END Template Sidebar (Left) -->

        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">{{ PageTitle::get('alone') }}</h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            @yield('breadcrumbs')
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->
                
                <!-- Page Content -->
                <div class="row">
                    @include('common.notifications')
                    @yield('content')

                </div>
                <!-- Page Content -->

            </div>
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->

        </section>
        <!--/ END Main -->
        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- Library script : mandatory -->
        <script type="text/javascript" src="{{ asset('public/library/jquery/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/library/jquery/js/jquery-migrate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/library/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/library/core/js/core.min.js') }}"></script>
        <!--/ Library script -->

        <!-- App and page level script -->
        <script type="text/javascript" src="{{ asset('public/plugins/sparkline/js/jquery.sparkline.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('public/javascript/app.min.js') }}"></script>

        @yield('scripts')
        <script type="text/javascript">
            $('.full-date-picker').datepicker({ dateFormat: 'dd-mm-yy' });
        </script>
        <!--/ App and page level script -->
        <!--/ END JAVASCRIPT SECTION -->
    </body>
    <!--/ END Body -->

</html>