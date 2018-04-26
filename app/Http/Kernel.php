<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        //\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
           // \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'NewAuth' => \App\Http\Middleware\NewAuth::class,//SalesView
        'sales.view' => \App\Http\Middleware\SalesView::class,//LeadsView
        'leads.view' => \App\Http\Middleware\LeadsView::class,//LeadsReassign
        'leads.reassign' => \App\Http\Middleware\LeadsReassign::class,//CustomersView
        'customers.view' => \App\Http\Middleware\CustomersView::class,//SalesViewPending
        'sales.view.pending' => \App\Http\Middleware\SalesViewPending::class,//SalesApprove
        'sales.approve' => \App\Http\Middleware\SalesApprove::class,//ForcastView
        'forecast.view' => \App\Http\Middleware\ForcastView::class,//UserManage
        'users.manage' => \App\Http\Middleware\UserManage::class,//UserView
        'users.view' => \App\Http\Middleware\UserView::class,//UserAdd
        'users.add' => \App\Http\Middleware\UserAdd::class,//UserDelete
        'users.delete' => \App\Http\Middleware\UserDelete::class,//UserDeactivate
        'users.deactivate' => \App\Http\Middleware\UserDeactivate::class,//RolesManage
        'roles.manage' => \App\Http\Middleware\RolesManage::class,//RolesAdd
        'roles.add' => \App\Http\Middleware\RolesAdd::class,//RoleDiactivate
        'roles.deactivate' => \App\Http\Middleware\RoleDiactivate::class,//ParametersView
        'parameters.view' => \App\Http\Middleware\ParametersView::class,//
    ];
}
