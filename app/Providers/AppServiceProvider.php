<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


            View::composer(['clients.create','clients.search','reports.view', 'clients.edit','convert.convert','resale.create','resale.edit','resale.partials.search'], function($view)
            {
                $users = null;
                $not_set = array('' => '-None-');
                if(Auth::user()->userRole->reassign_leads){
                    $users = $not_set + \App\Models\User::where('active', true)->pluck('username', 'id')->toArray();
                } else if(Auth::user()->userRole->initially_assign_leads){
                    $users = $not_set + \App\Models\User::where('active', true)->pluck('username', 'id')->toArray();
                }
                $view->with('types', \App\Models\UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id'))
                    ->with('users', $users)
                    ->with('districts', \App\Models\ProjectDistrict::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id'));
            });



            View::composer(['clients.leadsview', 'reports.client_param','reports.view'], function($view){
                $users = null;
                $not_set = array('' => '-None-');
                $lead_source        = $not_set + \App\Models\ClientSource::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                $lead_status        = $not_set + \App\Models\ClientStatus::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                $unit_types         = $not_set + \App\Models\UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                $project_district   = $not_set +\App\Models\ProjectDistrict::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();

                $all_users = $not_set+\App\Models\User::pluck('username', 'id')->toArray();
                
                $title = [
                    ""          => "-None-",
                    "Mr."       => "Mr.",
                    "Mrs."      => "Mrs.",
                    "Ms."       => "Ms.",
                    "Eng."      => "Eng.",
                    "Dr."       => "Dr."
                ];
                
                $view->with('types', $unit_types)
                        ->with('districts', $project_district)
                        ->with('lead_source', $lead_source)
                        ->with('lead_status', $lead_status)
                        ->with('all_users', $all_users)
                        ->with('title', $title);
            });


            View::composer(['common.activities', 'clients.leave-activity', 'activities.modify','common.notes'], function($view)
            {
                $priority = [
                    "3" => "Normal",
                    "5" => "Lowest",
                    "4" => "Low",
                    "2" => "High",
                    "1" => "Highest"
                ];
                
                $view->with('activity_type', \App\Models\ActivityType::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray())
                    ->with('activity_status', \App\Models\ActivityStatus::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray())
                    ->with('activity_priority', $priority);
            });



            View::composer('common.campaigns', function($view)
            {
                $viewdata= $view->getData();
                
                $client_id = $viewdata['object']->id;
                $not_in = \App\Models\CampaignClient::where('marked_deleted', 0)->where('client_id', $client_id)->pluck('campaign_id')->toArray();
                if(!$not_in){
                    $not_in = [0];
                }
                $all_campaigns = \App\Models\Campaign::whereNotIn('id', $not_in)->where('marked_deleted', 0)->orderBy('end_date', 'DSC')->pluck('name', 'id')->toArray();
                
                $view->with('member_status', \App\Models\CampaignMemberStatus::where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'label')->toArray())
                    ->with('all_campaigns', $all_campaigns);
            });



            View::composer(['campaigns.create', 'campaigns.modify'], function($view)
            {
                
               $view->with('campaign_status', \App\Models\CampaignStatus::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray()) 
                   ->with('campaign_type', \App\Models\CampaignType::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray());
            });



            View::composer(['projects.create', 'projects.modify'], function($view)
            {
                
                $view->with('project_districts', \App\Models\ProjectDistrict::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray());
            });



            View::composer(['projects.addunit', 'projects.modifyunit', 'clients.convert-project-units'], function($view)
            {
                $view->with('unit_types', \App\Models\UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray())
                    ->with('unit_finishs', \App\Models\Finish::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray());
            });



            View::composer(['units.create', 'units.modify','convert.convert'], function($view)
            {
                $property_status = [
                    'Rent' => 'Rent',
                    'Sale' => 'Sale'
                ];
                
                $view->with('types', \App\Models\UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray())
                    ->with('districts', \App\Models\ProjectDistrict::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray())
                    ->with('property_status', $property_status)
                    ->with('finishs', \App\Models\Finish::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray());
            });



            View::composer('common.sidemenu', function($view)
            {
                $view->with('pending_requests', \App\Models\ClientProperty::Where('marked_deleted', false)->where('pending', true)->count());
            });



            View::composer(['email_templates.create', 'email_templates.modify'], function($view)
            {
                $view->with('projects_list', \App\Models\Project::Where('marked_deleted', false)->where('available', true)->pluck('name', 'id')->toArray());
            });



            View::composer('clients.re-assign.filterleads', function($view)
            {
                $not_set = array('' => '<Not Set>');
                $users = $not_set + \App\Models\User::all()->pluck('username', 'id')->toArray();
                $unit_type = $not_set + \App\Models\UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                $unit_district = $not_set + \App\Models\ProjectDistrict::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                $lead_source = $not_set + \App\Models\ClientSource::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                $lead_status = $not_set + \App\Models\ClientStatus::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                
                $view->with('users', $users)
                    ->with('unit_types', $unit_type)
                    ->with('unit_district', $unit_district)
                    ->with('lead_source', $lead_source)
                    ->with('lead_status', $lead_status);
            });



            View::composer('projects.search','resale.create','resale.edit','resale.partials.search' , function($view){
                $not_set = array('' => '<Not Set>');
               
                $unit_district  = $not_set + \App\Models\ProjectDistrict::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                $unit_type      = $not_set + \App\Models\UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                $unit_finish    = $not_set + \App\Models\Finish::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray();
                
                $view->with('project_districts', $unit_district)
                    ->with('unit_types', $unit_type)
                    ->with('unit_finishs', $unit_finish);
            });



            View::composer(['forecasts.view', 'forecasts.create', 'forecasts.modify', 'forecasts.singleview'], function($view)
            {
                $months = array(
                    '1'     => 'January',
                    '2'     => 'February',
                    '3'     => 'March',
                    '4'     => 'April',
                    '5'     => 'May',
                    '6'     => 'June',
                    '7'     => 'July',
                    '8'     => 'August',
                    '9'     => 'September',
                    '10'    => 'October',
                    '11'    => 'November',
                    '12'    => 'December'
                );
                
                $view->with('Months', $months);
            });



            View::composer(['forecasts.create', 'forecasts.modify'], function($view)
            {
                $roles = \App\Models\Role::where('active', true)->pluck('role_name', 'id');

                $year = array(
                    '2015'  => '2015',
                    '2016'  => '2016',
                    '2017'  => '2017',
                    '2018'  => '2018',
                    '2019'  => '2019',
                    '2020'  => '2020',
                    '2021'  => '2021',
                    '2022'  => '2022',
                    '2023'  => '2023',
                    '2024'  => '2024',
                    '2025'  => '2025'
                );
                
                $view->with('years', $year)
                    ->with('roles', $roles);
            });

            /*
             * Validatiors
             */
            // Validator::extend('greater_than', function($attribute, $value, $parameters)
            // {
            //     $other = Input::get($parameters[0]);

            //     return isset($other) and intval($value) > intval($other);
            // });   

     }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
