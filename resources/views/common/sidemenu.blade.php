<section class="content slimscroll">
    <h5 class="heading">Main Menu</h5>
    <!-- START Template Navigation/Menu -->
    <ul class="topmenu topmenu-responsive" data-toggle="menu">
        <li class="{{ (Request::is('/') ? 'active' : '') }}">
            <a href="{{ route('home') }}">
                <span class="figure"><i class="ico-dashboard2"></i></span>
                <span class="text">Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->userRole->view_leads)
        <li class="{{ (Request::is('leads/*') ? 'active open' : '') }}">
            <a href="javascript:void(0);" data-target="#leads" data-toggle="submenu" data-parent=".topmenu">
                <span class="figure"><i class="ico-users3"></i></span>
                <span class="text">Leads</span>
                <span class="arrow"></span>
            </a>
            <ul id="leads" class="submenu collapse {{ (Request::is('leads/*') ? 'in' : '') }}">
                <li class="submenu-header ellipsis">Leads</li>
                <li class="{{ ((Route::is('leads-view') || Route::is('leads-modify-single') || Route::is('leads-view-single')) ? 'active' : '') }}">
                    <a href="{{ route('leads-view') }}">
                        <span class="text">View All</span>
                    </a>
                </li>
                <li class="{{ ((Request::is('leads/create') || Route::is('leads-create')) ? 'active' : '') }}">
                    <a href="{{ route('leads-create') }}">
                        <span class="text">Add New</span>
                    </a>
                </li>
                @if(Auth::user()->userRole->reassign_leads)
                <li class="{{ ((Request::is('leads/re-assign/*') || Route::is('leads-assign-filter')) ? 'active' : '') }}">
                    <a href="{{ route('leads-assign-filter') }}">
                        <span class="text">Re-Assign Leads</span>
                    </a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif
        
        @if(Auth::user()->userRole->view_customers)
        <li class="{{ ((Request::is('customers/*') || Request::is('customers')) ? 'active' : '') }}">
            <a href="{{ route('customers-view') }}">
                <span class="figure"><i class="ico-user22"></i></span>
                <span class="text">Customers</span>
            </a>
        </li>
        @endif
        
        @if(Auth::user()->userRole->view_sales)
        <li class="{{ ((Request::is('sale/*') || Request::is('sale')) ? 'active' : '') }}">
            <a href="javascript:void(0);" data-target="#sales" data-toggle="submenu" data-parent=".topmenu">
                <span class="figure"><i class="ico-dollar"></i></span>
                <span class="text">Sales</span>
                @if($pending_requests > 0)
                 <span class="number"><span class="label label-danger">{{$pending_requests}}</span></span>
                @endif                
                <span class="arrow"></span>
            </a>
            <ul id="sales" class="submenu collapse {{ (Request::is('sale/*') ? 'in' : '') }}" >
                <li class="submenu-header ellipsis">Sales</li>
                @if(Auth::user()->userRole->view_pending_sales)
                <li class="{{ ((Route::is('sales-view') || Route::is('sales-view-single')) ? 'active' : '') }}">
                    <a href="{{ route('sales-view') }}">
                        <span class="text">Resolved Sales Requests</span>
                    </a>
                </li>
                @endif
                <li class="{{ ((Request::is('sale/cancel/*') || Route::is('leads-confirm')) ? 'active' : '') }}">
                    <a href="{{ route('leads-confirm') }}">
                        <span class="text">Pending Sales Requests</span>
                    </a>
                </li>
            </ul>
        </li>
        @endif
{{--         @if(Auth::user()->userRole->view_projects)
            @if(Auth::user()->userRole->add_projects)
            <li class="{{ ((Request::is('projects/*') || Request::is('projects')) ? 'active' : '') }}">
                <a href="javascript:void(0);" data-target="#projects" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-home6"></i></span>
                    <span class="text">Projects</span>
                    <span class="arrow"></span>
                </a>
                <ul id="projects" class="submenu collapse {{ (Request::is('projects/*') ? 'in' : '') }}" >
                    <li class="submenu-header ellipsis">Project</li>
                    <li class="{{ ((Route::is('projects-view') || Route::is('projects-view-single') || Route::is('projects-modify-single')) ? 'active' : '') }}">
                        <a href="{{ route('projects-view') }}">
                            <span class="text">View All</span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('projects/create') ? 'active' : '') }}">
                        <a href="{{ route('projects-create') }}">
                            <span class="text">Add New</span>
                        </a>
                    </li>

                </ul>
            </li>
            @else
            <li class="{{ ((Request::is('projects/*') || Request::is('projects')) ? 'active' : '') }}">
                <a href="{{ route('projects-view') }}">
                    <span class="figure"><i class="ico-home6"></i></span>
                    <span class="text">Projects</span>
                </a>
            </li>
            @endif
        @endif
 --}}        

            <li class="{{ ((Request::is('resales/*') || Request::is('resales')) ? 'active' : '') }}" >
                <a href="javascript:void(0);" data-target="#units" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-office"></i></span>
                    <span class="text">Resale</span>
                    @if(auth()->user()->role_id == '1' && \App\Models\Resale::where('approved',false)->count() > 0)
                     <span class="number"><span class="label label-danger">{{\App\Models\Resale::where('approved',false)->count()}}</span></span>
                    @endif                

                    <span class="arrow"></span>
                </a>
                <ul id="units" class="submenu collapse {{ (Request::is('resales/*') ? 'in' : '') }}" >
                    <li class="submenu-header ellipsis">Individual Units</li>
                    <li class="{{ ((Route::is('resales') || Route::is('resales.show') || Route::is('resales.edit')) ? 'active' : '') }}">
                        <a href="{{ route('resales.index') }}">
                            <span class="text">View All</span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('resales/create') ? 'active' : '') }}">
                        <a href="{{ route('resales.create') }}">
                            <span class="text">Add New</span>
                        </a>
                    </li>

                </ul>
            </li>
        
        
{{--         @if(Auth::user()->userRole->view_campaigns)
            @if(Auth::user()->userRole->add_campaigns)
            <li class="{{ ((Request::is('campaigns/*') || Request::is('campaigns')) ? 'active' : '') }}" >
                <a href="javascript:void(0);" data-target="#campaigns" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-stack2"></i></span>
                    <span class="text">Campaigns</span>
                    <span class="arrow"></span>
                </a>
                <ul id="campaigns" class="submenu collapse {{ (Request::is('campaigns/*') ? 'in' : '') }}" >
                    <li class="submenu-header ellipsis">Campaigns</li>
                    <li class="{{ ((Route::is('campaigns-view') || Route::is('campaigns-modify-single') || Route::is('campaigns-view-single')) ? 'active' : '') }}">
                        <a href="{{ route('campaigns-view') }}">
                            <span class="text">View All</span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('campaigns/create') ? 'active' : '') }}">
                        <a href="{{ route('campaigns-create') }}">
                            <span class="text">Add New</span>
                        </a>
                    </li>

                </ul>
            </li>
            @else
            <li class="{{ ((Request::is('campaigns/*') || Request::is('campaigns')) ? 'active' : '') }}" >
                <a href="{{ route('campaigns-view') }}">
                    <span class="figure"><i class="ico-stack2"></i></span>
                    <span class="text">Campaigns</span>
                </a>
            </li>
            @endif
        @endif --}}
        
  {{--       @if(Auth::user()->userRole->view_email_templates)
            @if(Auth::user()->userRole->add_email_templates)
            <li class="{{ ((Request::is('emails/*') || Request::is('emails')) ? 'active' : '') }}">
                <a href="javascript:void(0);" data-target="#emails" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-envelop3"></i></span>
                    <span class="text">Emails</span>
                    <span class="arrow"></span>
                </a>
                <ul id="emails" class="submenu collapse {{ (Request::is('emails/*') ? 'in' : '') }}" >
                    <li class="submenu-header ellipsis">Emails</li>
                    <li class="{{ ((Route::is('emails-view') || Route::is('emails-view-single') || Route::is('emails-modify-single')) ? 'active' : '') }}">
                        <a href="{{ route('emails-view') }}">
                            <span class="text">View All</span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('emails/create') ? 'active' : '') }}">
                        <a href="{{ route('emails-create') }}">
                            <span class="text">Add New</span>
                        </a>
                    </li>

                </ul>
            </li>
            @else
            <li class="{{ ((Request::is('emails/*') || Request::is('emails')) ? 'active' : '') }}">
                <a href="{{ route('emails-view') }}">
                    <span class="figure"><i class="ico-envelop3"></i></span>
                    <span class="text">Emails</span>
                </a>
            </li>
            @endif
        @endif
         --}}

         
        @if(Auth::user()->userRole->view_reports)
        <li class="{{ ((Request::is('reports/*') || Request::is('reports')) ? 'active' : '') }}">
            <a href="{{ route('reports-view') }}">
                <span class="figure"><i class="ico-file"></i></span>
                <span class="text">Reports</span>
            </a>
        </li>
        @endif 


        
        @if(Auth::user()->userRole->view_forecast)
        <li class="{{ ((Request::is('forecast/*') || Request::is('forecast')) ? 'active' : '') }}">
            <a href="{{ route('forecast-view') }}">
                <span class="figure"><i class="ico-feed"></i></span>
                <span class="text">Forecast</span>
            </a>
        </li>
        @endif      
        
        @if(Auth::user()->userRole->view_parameters)
        <li class="{{ ((Request::is('parameters/*') || Route::is('parameters-view')) ? 'active' : '') }}">
            <a href="{{ route('parameters-view') }}">
                <span class="figure"><i class="ico-equalizer"></i></span>
                <span class="text">Parameters</span>
            </a>
        </li>
        @endif
        
        @if(Auth::user()->userRole->view_users)
        <li class="{{ ((Request::is('users/*') || Route::is('users-view') || Request::is('roles/*') || Route::is('roles-view')) ? 'active open' : '') }}">
            <a href="javascript:void(0);" data-target="#users" data-toggle="submenu" data-parent=".topmenu">
                <span class="figure"><i class="ico-users"></i></span>
                <span class="text">Users Management</span>
                <span class="arrow"></span>
            </a>
            <ul id="users" class="submenu collapse {{ ((Request::is('users/*') || Route::is('users-view') || Request::is('roles/*') || Route::is('roles-view')) ? 'in' : '') }}">
                <li class="submenu-header ellipsis">Users Management</li>
                <li class="{{ ((Route::is('users-view') || Route::is('users-modify-single') || Route::is('users-view-single')) ? 'active' : '') }}">
                    <a href="{{ route('users-view') }}">
                        <span class="text">View All</span>
                    </a>
                </li>
                <li class="{{ ((Request::is('users/create') || Route::is('users-create')) ? 'active' : '') }}">
                    <a href="{{ route('users-create') }}">
                        <span class="text">Add New</span>
                    </a>
                </li>
                @if(Auth::user()->userRole->manage_roles)
                <li class="{{ ((Request::is('roles/*') || Route::is('roles-view')) ? 'active' : '') }}">
                    <a href="{{ route('roles-view') }}">
                        <span class="text">Manage Roles</span>
                    </a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif
    </ul>
    <!--/ END Template Navigation/Menu -->
</section>
