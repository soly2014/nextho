<?php

namespace App\Http\Middleware;

use Closure;

class LeadsReassign
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


            if (!auth()->user()->userRole->reassign_leads)
            {
                    session()->flash('error', '<strong>Error!</strong> You don\'t have the sufficient privileges to Access the intended URL!');
                return redirect()->route('home');
            }


        return $next($request);
    }
}
