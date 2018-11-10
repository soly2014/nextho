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


        <!--/ Plugins stylesheet -->

        <!-- Application stylesheet : mandatory -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/library/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheet/layout.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheet/uielement.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheet/custom.css') }}">
        <!--/ Application stylesheet -->
        <!-- END STYLESHEETS -->

        <!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
        <script type="text/javascript" src="{{ asset('public/library/modernizr/js/modernizr.min.js') }}"></script>

        <!--/ END JAVASCRIPT SECTION -->
    </head>
    <!--/ END Head -->

    <!-- START Body -->
    <body>
        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <section class="container">
                <!-- START row -->
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <!-- Brand -->
                        <div class="text-center" style="margin-bottom:25px;">
                            <span class="logo-figure inverse login-screen"></span>
                            <h5 class="semibold text-muted mt-5">Next Home - eState Investment &amp; Marketing<br />Clients Relationship Management.</h5>
                        </div>
                        <!--/ Brand -->
                        @yield('content')
                        
                        <hr><!-- horizontal line -->

                        <p class="text-muted text-center">Copyright © 2015 <span class="semibold">Next Home - Real eState</span></p>
                    </div>
                </div>
                <!--/ END row -->
            </section>
            <!--/ END Template Container -->
        </section>
        <!--/ END Template Main -->

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- Library script : mandatory -->
        <script type="text/javascript" src="{{ asset('public/library/jquery/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/library/jquery/js/jquery-migrate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/library/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/library/core/js/core.min.js') }}"></script>
        <!--/ Library script -->

        <!-- App and page level script -->
        <script type="text/javascript" src="{{ asset('public/javascript/app.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
        
        @yield('scripts')

        <!--/ App and page level script -->
        <!--/ END JAVASCRIPT SECTION -->
    </body>
    <!--/ END Body -->
</html>