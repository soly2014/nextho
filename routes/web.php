<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Event::listen('illuminate.query', function($sql, $bindings){

    /*var_dump($sql);
    var_dump($bindings);*/

});


    /*
     * Sign In (GET)
     */
    Route::post('login', array(
        'as' => 'account-sign-in-post',
        'uses' => 'AccountController@postSignIn'
    ));
    
    
    /*
     * Sign In (GET)
     */
    Route::get('login', array(
        'as' => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));



/*
 * Authenticated Group
 */
Route::group(array('middleware' => 'NewAuth'), function() {
    
        /*
         * Create lead (POST)
         */
        Route::post('/leads/create', array(
            'as' => 'leads-create-post',
            'uses' => 'ClientController@postCreate'
        ));
        Route::post('/leads/search', array(
			'as' => 'leads-search-post',
            'uses' => 'ClientController@postSearch'
        ));
        Route::post('/leads/validate/create', array(
            'as' => 'leads-pre-create-post',
            'uses' => 'ClientController@postPreCreate'
        ));
        Route::post('/leads/{id}/activity', array(
            'as' => 'leads-activity-post',
            'uses' => 'ClientController@postAddActivity'
        ));
        Route::post('/note/post/{id}', array(
            'as' => 'notes-create-post',
            'uses' => 'NoteController@postNote'
        ));
        Route::post('/attachment/post', array(
            'as' => 'attachment-create-post',
            'uses' => 'AttachmentController@postAttachment'
        ));
        Route::post('/activity/post', array(
            'as' => 'activity-create-post',
            'uses' => 'ActivityController@postActivity'
        ));
        Route::PUT('/activity/{id}/modify', array(
            'as' => 'activity-modify-single-post',
            'uses' => 'ActivityController@postModify'
        ));
        Route::post('/activities/{id}/close', array(
            'as' => 'activity-bulk-close-post',
            'uses' => 'ActivityController@postActivities'
        ));

        Route::PUT('/leads/{id}/modify', array(
            'as' => 'leads-modify-single-post',
            'uses' => 'ClientController@postModify'
        ));
        
        Route::post('/leads/{id}/send-email', array(
            'as' => 'leads-send-email-post',
            'uses' => 'ClientController@postSendEmail'
        ));
        
        Route::post('/campaigns/create', array(
            'as' => 'campaigns-create-post',
            'uses' => 'CampaignController@postCreate'
        ));
        Route::PUT('/campaigns/{id}/modify', array(
            'as' => 'campaigns-modify-single-post',
            'uses' => 'CampaignController@postModify'
        ));
        Route::post('/campaigns/lead/{id}/link', array(
            'as' => 'campaign-lead-link-post',
            'uses' => 'CampaignClientController@postCampaignClient'
        ));
        Route::group(array('middleware' => 'leads.reassign'), function() {
            Route::post('/leads/re-assign/filter', array(
                'as'    => 'leads-assign-filter-post',
                'uses'  => 'ReAssignController@postFilter'
            ));
            Route::post('/leads/re-assign/selection', array(
                'as'    => 'leads-assign-selection-post',
                'uses'  => 'ReAssignController@postLeads'
            ));
            Route::post('/leads/re-assign/selection/search', array(
                'as'    => 'search-reassign-selection',
                'uses'  => 'ReAssignController@searchLeads'
            ));
        });
        Route::post('/leads/{id}/validate/convert', array(
            'as' => 'leads-pre-convert-post',
            'uses' => 'ClientController@postPreConvert'
        ));
        Route::post('/leads/{id}/convert', array(
            'as' => 'leads-convert-post',
            'uses' => 'ClientController@postConvert'
        ));
        Route::post('/leads/{id}/convert/{project}/next', array(
            'as' => 'leads-convert-step-post',
            'uses' => 'ClientController@postConvertStep'
        ));
        Route::post('leads/convert/confirm', array(
            'as'    => 'leads-confirm-post',
            'uses'  => 'ClientController@postConfirmList'
        ));
        Route::post('/leads/convert/cancel/{id}/comment', array(
            'as'    => 'leads-convert-comment-post',
            'uses'  => 'ClientController@postRejectComment'
        ));
        
        Route::post('/emails/create', array(
            'as' => 'emails-create-post',
            'uses' => 'EmailController@postCreate'
        ));
        Route::PUT('/emails/{id}/modify', array(
            'as' => 'emails-modify-single-post',
            'uses' => 'EmailController@postModify'
        ));
        
       Route::group(array('middleware' => 'projects.view'), function() {
            Route::group(array('middleware' => 'projects.add'), function() {
                Route::post('/projects/create', array(
                    'as' => 'projects-create-post',
                    'uses' => 'ProjectController@postCreate'
                ));
                Route::post('/projects/{id}/unit/create', array(
                    'as' => 'unit-create-post',
                    'uses' => 'ProjectController@postCreateUnit'
                ));
            });
           Route::group(array('middleware' => 'projects.modify'), function() {
                Route::PUT('/projects/{id}/modify', array(
                    'as' => 'projects-modify-single-post',
                    'uses' => 'ProjectController@postModify'
                ));
                Route::PUT('/projects/{id}/unit/{unit_id}/modify', array(
                    'as' => 'unit-modify-post',
                    'uses' => 'ProjectController@postModifyUnit'
                ));
           });
                        
            Route::post('/projects/search', array(
                'as' => 'projects-search-post',
                'uses' => 'ProjectController@postSearch'
            ));
       });
    
       Route::group(array('middleware' => 'units.view'), function() {
           Route::group(array('middleware' => 'units.add'), function() {
                Route::post('/units/create', array(
                    'as' => 'units-create-post',
                    'uses' => 'UnitController@postCreate'
                ));
           });
           Route::group(array('middleware' => 'units.modify'), function() {
                Route::PUT('/units/{id}/modify', array(
                    'as'    => 'units-modify-single-post',
                    'uses'  => 'UnitController@postModify'
                ));
           });
       });
       
        Route::group(array('middleware' => 'sales.view'), function() {
			Route::PUT('/sale/{id}/modify', array(
				'as'    => 'sales-modify-single-post',
				'uses'  => 'ClientController@postSaleModify'
			));

		});
        
       Route::group(array('middleware' => 'reports.view'), function() {
            
            Route::post('/reports/generate/client-acquisition', array(
                'as' => 'report-client-acquisition',
                'uses' => 'ReportController@postClientAcquisition'
            ));
            Route::post('/reports/generate/client-acquisition/projects', array(
                'as' => 'report-client-acquisition-projects',
                'uses' => 'ReportController@postClientAcquisitionProjects'
            ));
            Route::post('/reports/generate/client-acquisition/units', array(
                'as' => 'report-client-acquisition-units',
                'uses' => 'ReportController@postClientAcquisitionUnits'
            ));
            Route::post('/reports/generate/sales/project', array(
                'as' => 'report-sales-projects',
                'uses' => 'ReportController@postSalesProjects'
            ));
            Route::post('/reports/generate/sales/units', array(
                'as' => 'report-sales-units',
                'uses' => 'ReportController@postSalesUnits'
            ));
            Route::post('/reports/generate/sales', array(
                'as' => 'report-sales',
                'uses' => 'ReportController@postSales'
            ));
            Route::post('/reports/generate/sources', array(
                'as' => 'report-sources',
                'uses' => 'ReportController@postClientSoures'
            ));
            Route::post('/reports/generate/sources/leads', array(
                'as' => 'report-sources-leads',
				'uses' => 'ReportController@postLeadsSoures'
            ));
            
            Route::post('/reports/view/client-acquisition', array(
                'as' => 'report-client-acquisition-view',
                'uses' => 'ReportController@postClientAcquisitionView'
            ));
            Route::post('/reports/view/client-acquisition/projects', array(
                'as' => 'report-client-acquisition-projects-view',
                'uses' => 'ReportController@postClientAcquisitionProjectsView'
            ));
            Route::post('/reports/view/client-acquisition/units', array(
                'as' => 'report-client-acquisition-units-view',
                'uses' => 'ReportController@postClientAcquisitionUnitsView'
            ));
            Route::post('/reports/view/sales/project', array(
                'as' => 'report-sales-projects-view',
                'uses' => 'ReportController@postSalesProjectsView'
            ));
            Route::post('/reports/view/sales/units', array(
                'as' => 'report-sales-units-view',
                'uses' => 'ReportController@postSalesUnitsView'
            ));
            Route::post('/reports/view/sales', array(
                'as' => 'report-sales-view',
                'uses' => 'ReportController@postSalesView'
            ));
            Route::post('/reports/view/sources', array(
                'as' => 'report-sources-view',
                'uses' => 'ReportController@postClientSouresView'
            ));
            Route::post('/reports/view/sources/leads', array(
                'as' => 'report-sources-view',
				'uses' => 'ReportController@postLeadsSouresView'
            ));
            Route::post('/reports/daily-report', array(
		'as' => 'report-daily-repot-post',
		'uses' => 'ReportController@postUserActions'
	    ));
	    Route::post('/reports/clients-attr', array(
				'as' => 'report-clients-attr-post',
				'uses' => 'ReportController@postClientAttr'
			));
       });
        
       Route::group(array('middleware' => 'users.manage'), function() {
            Route::post('/users/create', array(
                'as' => 'users-create-post',
                'uses' => 'UserController@postCreate'
            ));
            Route::PUT('/users/{id}/modify', array(
                'as' => 'users-modify-single-post',
                'uses' => 'UserController@postModify'
            ));
            Route::post('/users/{id}/password/reset', array(
                'as' => 'users-password-reset-post',
                'uses' => 'UserController@postPasswordReset'
            ));
            Route::post('/users/{id}/password/change', array(
                'as' => 'users-password-change-post',
                'uses' => 'UserController@postPasswordChange'
            ));
       });
       Route::group(array('middleware' => 'roles.manage'), function() {
            Route::post('/roles/create', array(
                'as' => 'roles-create-post',
                'uses' => 'RoleController@postCreate'
            ));
       });
        
       Route::group(array('middleware' => 'forecast.view'), function() {
            Route::post('/forecast/create', array(
                'as' => 'forecast-create-post',
                'uses' => 'ForecastController@postCreate'
            ));
            Route::PUT('/forecast/{id}/modify', array(
                'as' => 'forecast-modify-post',
                'uses' => 'ForecastController@postModify'
            ));
       });
        
        Route::post('/email_template/send', array(
            'as'    => 'send-email-post',
            'uses'  => 'EmailController@postSendEmail'
        ));
        
       Route::group(array('middleware' => 'parameters.view'), function() {
            Route::post('/parameters/client-source/create', array(
                'as' => 'parameters-client-source-create-post',
                'uses' => 'ParametersController@postClientSourceCreate'
            ));
            Route::PUT('/parameters/client-source/{id}/modify', array(
                'as' => 'parameters-client-source-modify-post',
                'uses' => 'ParametersController@postClientSourceModify'
            ));
            
            Route::post('/parameters/client-status/create', array(
                'as' => 'parameters-client-status-create-post',
                'uses' => 'ParametersController@postClientStatusCreate'
            ));
            Route::PUT('/parameters/client-status/{id}/modify', array(
                'as' => 'parameters-client-status-modify-post',
                'uses' => 'ParametersController@postClientStatusModify'
            ));
            
            Route::post('/parameters/campaign-status/create', array(
                'as' => 'parameters-campaign-status-create-post',
                'uses' => 'ParametersController@postCampaignStatusCreate'
            ));
            Route::PUT('/parameters/campaign-status/{id}/modify', array(
                'as' => 'parameters-campaign-status-modify-post',
                'uses' => 'ParametersController@postCampaignStatusModify'
            ));
            
            Route::post('/parameters/campaign-type/create', array(
                'as' => 'parameters-campaign-type-create-post',
                'uses' => 'ParametersController@postCampaignTypeCreate'
            ));
            Route::PUT('/parameters/campaign-type/{id}/modify', array(
                'as' => 'parameters-campaign-type-modify-post',
                'uses' => 'ParametersController@postCampaignTypeModify'
            ));
            
            Route::post('/parameters/campaign-member-status/create', array(
                'as' => 'parameters-campaign-member-status-create-post',
                'uses' => 'ParametersController@postCampaignMemberStatusCreate'
            ));
            Route::PUT('/parameters/campaign-member-status/{id}/modify', array(
                'as' => 'parameters-campaign-member-status-modify-post',
                'uses' => 'ParametersController@postCampaignMemberStatusModify'
            ));
            
            Route::post('/parameters/district/create', array(
                'as' => 'parameters-district-create-post',
                'uses' => 'ParametersController@postProjectDistrictCreate'
            ));
            Route::PUT('/parameters/district/{id}/modify', array(
                'as' => 'parameters-district-modify-post',
                'uses' => 'ParametersController@postProjectDistrictModify'
            ));
            
            Route::post('/parameters/unit-type/create', array(
                'as' => 'parameters-unit-type-create-post',
                'uses' => 'ParametersController@postUnitTypeCreate'
            ));
            Route::PUT('/parameters/unit-type/{id}/modify', array(
                'as' => 'parameters-unit-type-modify-post',
                'uses' => 'ParametersController@postUnitTypeModify'
            ));
            
            Route::post('/parameters/unit-finish/create', array(
                'as' => 'parameters-unit-finish-create-post',
                'uses' => 'ParametersController@postUnitFinishCreate'
            ));
            Route::PUT('/parameters/unit-finish/{id}/modify', array(
                'as' => 'parameters-unit-finish-modify-post',
                'uses' => 'ParametersController@postUnitFinishModify'
            ));
            
            Route::post('/parameters/activity-type/create', array(
                'as' => 'parameters-activity-type-create-post',
                'uses' => 'ParametersController@postActivityTypeCreate'
            ));
            Route::PUT('/parameters/activity-type/{id}/modify', array(
                'as' => 'parameters-activity-type-modify-post',
                'uses' => 'ParametersController@postActivityTypeModify'
            ));
            
            Route::post('/parameters/activity-status/create', array(
                'as' => 'parameters-activity-status-create-post',
                'uses' => 'ParametersController@postActivityStatusCreate'
            ));
            Route::PUT('/parameters/activity-status/{id}/modify', array(
                'as' => 'parameters-activity-status-modify-post',
                'uses' => 'ParametersController@postActivityStatusModify'
            ));
       });
                
   

    
    Route::get('account/sign-out', array(
        'as'    => 'account-sign-out',
        'uses'  => 'AccountController@getSignOut'
    ));
    
    Route::get('/', array(
    'as'    => 'home',
    'uses'  => 'HomeController@getDashboard'
    ));
   
    Route::group(array('middleware' => 'leads.view'), function() {
        Route::get('/leads/view', array(
            'as' => 'leads-view',
            'uses' => 'ClientController@getAll'
        ));
        
        Route::get('/leads/validate/create', array(
            'as'    => 'leads-create',
            'uses'  => 'ClientController@getPreCreate'
        ));
        Route::get('/leads/create', array(
            'as'    => 'leads-create-get',
            'uses'  => 'ClientController@getCreate'
        ));
        Route::get('/leads/{id}/activity', array(
            'as'    => 'leads-activity-get',
            'uses'  => 'ClientController@getExist'
        ));
        
        Route::group(array('middleware' => 'leads.reassign'), function() {
            Route::get('/leads/re-assign/filter', array(
                'as'    => 'leads-assign-filter',
                'uses'  => 'ReAssignController@getFilter'
            ));
            Route::get('/leads/re-assign/selection', array(
                'as'    => 'leads-assign-selection',
                'uses'  => 'ReAssignController@getLeads'
            ));
        });
        
        
        Route::get('/leads/{id}', array(
            'as'    => 'leads-view-single',
            'uses'  => 'ClientController@getSingle'
        ));
        
        
    });

    Route::get('/leads/{id}/send-email', array(
        'as'    => 'leads-send-email',
        'uses'  => 'ClientController@getSendEmail'
    ));
    
    Route::get('/leads/{id}/validate/convert', array(
        'as'    => 'leads-pre-convert',
        'uses'  => 'ClientController@getPreConvert'
    ));
    Route::get('/leads/{id}/convert', array(
        'as'    => 'leads-convert',
        'uses'  => 'ClientController@getConvert'
    ));
    Route::get('/leads/{id}/convert/{process}/next', array(
        'as'    => 'leads-convert-step',
        'uses'  => 'ClientController@getConvertStep'
    ));
    Route::get('/leads/{id}/modify', array(
        'as'    => 'leads-modify-single',
        'uses'  => 'ClientController@getModify'
    ));
    Route::get('/client/{id}/delete', array(
        'as'    => 'client-delete',
        'uses'  => 'ClientController@postDelete'
    ));
    Route::get('/client/{id}/restore', array(
        'as'    => 'client-restore',
        'uses'  => 'ClientController@postRestore'
    ));
        
   Route::group(array('middleware' => 'customers.view'), function() {
        Route::get('/customers', array(
            'as' => 'customers-view',
            'uses' => 'ClientController@getAllCustomers'
        ));

        Route::get('/customers/{id}', array(
            'as' => 'customers-view-single',
            'uses' => 'ClientController@getSingleCustomer'
        ));

        Route::get('/customers/modify', array(
            'as' => 'customers-modify-single',
            'uses' => 'ClientController@getModifyCustomer'
        ));
   });
    
   Route::group(array('middleware' => 'sales.view'), function() {
       Route::group(array('middleware' => 'sales.view.pending'), function() {
            Route::get('/sale/confirm', array(
                'as'    => 'leads-confirm',
                'uses'  => 'ClientController@getConfirmList'
            ));
       });
       Route::group(array('middleware' => 'sales.approve'), function() {
            Route::get('/sale/confirm/{id}', array(
                'as'    => 'leads-convert-single',
                'uses'  => 'ClientController@postConfirmSingle'
            ));
            Route::get('/sale/cancel/{id}', array(
                'as'    => 'leads-convert-reject-single',
                'uses'  => 'ClientController@postRejectSingle'
            ));
            Route::get('/sale/cancel/{id}/comment', array(
                'as'    => 'leads-convert-comment',
                'uses'  => 'ClientController@getRejectComment'
            ));
       });
        Route::get('/sale/view', array(
            'as'    => 'sales-view',
            'uses'  => 'ClientController@getSalesList'
        ));
        Route::get('/sale/{id}/modify', array(
            'as'    => 'sales-modify-single',
            'uses'  => 'ClientController@getSaleModify'
        ));
   });
    Route::get('/note/{id}/delete', array(
        'as' => 'note-delete',
        'uses' => 'NoteController@getDelete'
    ));
    Route::get('/note/{id}/restore', array(
        'as' => 'note-restore',
        'uses' => 'NoteController@getRestore'
    ));
    Route::get('/attachment/{id}/download', array(
        'as' => 'attachment-download-post',
        'uses' => 'AttachmentController@getDownload'
    ));
    Route::get('/attachment/{id}/delete', array(
        'as' => 'attachment-delete',
        'uses' => 'AttachmentController@getDelete'
    ));
    Route::get('/attachment/{id}/restore', array(
        'as' => 'attachment-restore',
        'uses' => 'AttachmentController@getRestore'
    ));
    Route::get('/activity/{id}/view', array(
        'as' => 'activity-view-single',
        'uses' => 'ActivityController@getSingle'
    ));
    Route::get('/activity/{id}/modify', array(
        'as' => 'activity-modify-single',
        'uses' => 'ActivityController@getModify'
    ));
    Route::get('/activity/{id}/close', array(
        'as' => 'activity-close-post',
        'uses' => 'ActivityController@postClose'
    ));
    Route::get('/activity/{id}/delete', array(
        'as' => 'activity-delete-post',
        'uses' => 'ActivityController@postDelete'
    ));
    Route::get('/activity/{id}/restore', array(
        'as' => 'activity-restore-post',
        'uses' => 'ActivityController@postRestore'
    ));
    Route::get('/campaigns/lead/{id}/unlink', array(
        'as' => 'campaign-lead-unlink-post',
        'uses' => 'CampaignClientController@postCampaignClientDelete'
    ));
    Route::get('/campaigns/lead/{id}/relink', array(
        'as' => 'campaign-lead-relink-post',
        'uses' => 'CampaignClientController@postCampaignClientRestore'
    ));

    

   Route::group(array('middleware' => 'projects.view'), function() {
        Route::get('/projects/view', array(
            'as' => 'projects-view',
            'uses' => 'ProjectController@getAll'
        ));
       Route::group(array('middleware' => 'projects.add'), function() {
            Route::get('/projects/create', array(
                'as' => 'projects-create',
                'uses' => 'ProjectController@getCreate'
            ));
            Route::get('/projects/{id}/unit/create', array(
                'as' => 'unit-create',
                'uses' => 'ProjectController@getCreateUnit'
            ));
       });
       Route::group(array('middleware' => 'projects.modify'), function() {
            Route::get('/projects/{id}/unit/{unit_id}/modify', array(
                'as' => 'unit-modify',
                'uses' => 'ProjectController@getModifyUnit'
            ));
            Route::get('/projects/{id}/modify', array(
                'as' => 'projects-modify-single',
                'uses' => 'ProjectController@getModify'
            ));
       });
        
       Route::group(array('middleware' => 'projects.delete'), function() {
            Route::get('/projects/{id}/delete', array(
                'as' => 'projects-delete',
                'uses' => 'ProjectController@postDelete'
            ));
            Route::get('/projects/{id}/restore', array(
                'as' => 'projects-restore',
                'uses' => 'ProjectController@postRestore'
            ));
       });

       Route::group(array('middleware' => 'projects.unit.delete'), function() {
            Route::get('/projects/unit/{id}/delete', array(
                'as' => 'project-unit-delete',
                'uses' => 'ProjectController@postDeleteUnit'
            ));
            Route::get('/projects/unit/{id}/restore', array(
                'as' => 'project-unit-restore',
                'uses' => 'ProjectController@postRestoreUnit'
            ));
       });
        Route::get('/projects/{id}', array(
            'as' => 'projects-view-single',
            'uses' => 'ProjectController@getSingle'
        ));
   });
   Route::group(array('middleware' => 'units.view'), function() {
        Route::get('/units/view', array(
            'as'    => 'units-view',
            'uses'  => 'UnitController@getAll'
        ));
       Route::group(array('middleware' => 'units.add'), function() {
            Route::get('/units/create', array(
                'as'    => 'units-create',
                'uses'  => 'UnitController@getCreate'
            ));
       });
       Route::group(array('middleware' => 'units.modify'), function() {
            Route::get('/units/{id}/modify', array(
                'as'    => 'units-modify-single',
                'uses'  => 'UnitController@getModify'
            ));
       });
       Route::group(array('middleware' => 'units.delete'), function() {
            Route::get('/units/{id}/delete', array(
                'as' => 'units-delete',
                'uses' => 'UnitController@postDelete'
            ));
            Route::get('/units/{id}/restore', array(
                'as' => 'units-restore',
                'uses' => 'UnitController@postRestore'
            ));
       });

        Route::get('/units/{id}', array(
            'as'    => 'units-view-single',
            'uses'  => 'UnitController@getSingle'
        ));
   });
    

    
   Route::group(array('middleware' => 'campaigns.view'), function() {
        Route::get('/campaigns/view', array(
            'as'    => 'campaigns-view',
            'uses'  => 'CampaignController@getAll'
        ));

       Route::group(array('middleware' => 'campaigns.add'), function() {
            Route::get('/campaigns/create', array(
                'as'    => 'campaigns-create',
                'uses'  => 'CampaignController@getCreate'
            ));
       });

       Route::group(array('middleware' => 'campaigns.modify'), function() {
            Route::get('/campaigns/{id}/modify', array(
                'as' => 'campaigns-modify-single',
                'uses' => 'CampaignController@getModify'
            ));
       });

       Route::group(array('middleware' => 'campaigns.delete'), function() {
            Route::get('/campaigns/{id}/delete', array(
                'as' => 'campaigns-delete',
                'uses' => 'CampaignController@postDelete'
            ));
            Route::get('/campaigns/{id}/restore', array(
                'as' => 'campaigns-restore',
                'uses' => 'CampaignController@postRestore'
            ));
       });

        Route::get('/campaigns/{id}', array(
            'as' => 'campaigns-view-single',
            'uses' => 'CampaignController@getSingle'
        ));
   });
    
   Route::group(array('middleware' => 'email_templates.view'), function() {
        Route::get('/emails/view', array(
            'as' => 'emails-view',
            'uses' => 'EmailController@getAll'
        ));

       Route::group(array('middleware' => 'email_templates.add'), function() {
            Route::get('/emails/create', array(
                'as' => 'emails-create',
                'uses' => 'EmailController@getCreate'
            ));
       });
       Route::group(array('middleware' => 'email_templates.modify'), function() {
            Route::get('/emails/{id}/modify', array(
                'as' => 'emails-modify-single',
                'uses' => 'EmailController@getModify'
            ));
       });
       Route::group(array('middleware' => 'email_templates.delete'), function() {
            Route::get('/emails/{id}/delete', array(
                'as' => 'emails-delete',
                'uses' => 'EmailController@postDelete'
            ));
            Route::get('/emails/{id}/restore', array(
                'as' => 'emails-restore',
                'uses' => 'EmailController@postRestore'
            ));
       });

        Route::get('/emails/{id}', array(
            'as' => 'emails-view-single',
            'uses' => 'EmailController@getSingle'
        ));
   });
    

   //
   //
   //  START REPORTS
   //
   //
   // Route::group(array('middleware' => 'reports.view'), function() {

        Route::get('/reports/view', array(
            'as' => 'reports-view',
            'uses' => 'ReportController@getAll'
        ));// new-report-generate

        Route::get('/reports/create', array(
            'as' => 'new-report-generate',
            'uses' => 'ReportController@startGenerate'
        ));

        Route::get('/reports/singleview', array(
            'as' => 'reports-view-single',
            'uses' => 'ReportController@getSingle'
        ));
        
        Route::get('/reports/generate/{id}', array(
            'as' => 'reports-generate-single',
            'uses' => 'ReportController@getReport'
        ));
        Route::get('/db/exports/', array(
            'as' => 'db-export-single',
            'uses' => 'ReportController@getExports'
        ));
        
        Route::get('/reports/view/client-acquisition', array(
            'as' => 'report-client-acquisition-view-get',
            'uses' => 'ReportController@getClientAcquisitionView'
        ));
        Route::get('/reports/view/client-acquisition/projects', array(
            'as' => 'report-client-acquisition-projects-view-get',
            'uses' => 'ReportController@getClientAcquisitionProjectsView'
        ));
        Route::get('/reports/view/client-acquisition/units', array(
            'as' => 'report-client-acquisition-units-view-get',
            'uses' => 'ReportController@getClientAcquisitionUnitsView'
        ));
        Route::get('/reports/view/sales/project', array(
            'as' => 'report-sales-projects-view-get',
            'uses' => 'ReportController@getSalesProjectsView'
        ));
        Route::get('/reports/view/sales/units', array(
            'as' => 'report-sales-units-view-get',
            'uses' => 'ReportController@getSalesUnitsView'
        ));
        Route::get('/reports/view/sales', array(
            'as' => 'report-sales-view-get',
            'uses' => 'ReportController@getSalesView'
        ));
        Route::get('/reports/view/sources', array(
            'as' => 'report-sources-view-get',
            'uses' => 'ReportController@getClientSouresView'
        ));
        Route::get('/reports/view/sources/leads', array(
		'as' => 'report-sources-leads-view-get',
            'uses' => 'ReportController@getLeadsSouresView'
        ));
        Route::get('/reports/daily-report', array(
            'as' => 'report-daily-repot-get',
			'uses' => 'ReportController@getUserActions'
        ));
        Route::get('/reports/clients-attr', array(
			'as' => 'report-clients-attr-get',
			'uses' => 'ReportController@getClientAttr'
        ));
        
   // });
   //
   //  END REPORTS
   //

   Route::group(array('middleware' => 'forecast.view'), function() {
        Route::get('/forecast/view', array(
            'as' => 'forecast-view',
            'uses' => 'ForecastController@getAll'
        ));

        Route::get('/forecast/create', array(
            'as' => 'forecast-create',
            'uses' => 'ForecastController@getCreate'
        ));

        Route::get('/forecast/{id}', array(
            'as' => 'forecast-view-single',
            'uses' => 'ForecastController@getSingle'
        ));
        
        Route::get('/forecast/{id}/modify', array(
            'as' => 'forecast-modify',
            'uses' => 'ForecastController@getModify'
        ));
   });
    
   Route::group(array('middleware' => 'users.manage'), function() {
        Route::get('/users', array(
            'as' => 'users-view',
            'uses' => 'UserController@getAll'
        ));
        Route::get('/users/create', array(
            'as' => 'users-create',
            'uses' => 'UserController@getCreate'
        ));
       Route::group(array('middleware' => 'users.view'), function() {
            Route::get('/users/{id}', array(
                'as' => 'users-view-single',
                'uses' => 'UserController@getUser'
            ));
            Route::get('/users/{id}/modify', array(
                'as' => 'users-modify-single',
                'uses' => 'UserController@getModify'
            ));
            Route::get('/users/{id}/password/reset', array(
                'as' => 'users-password-reset',
                'uses' => 'UserController@getPasswordReset'
            ));
            Route::get('/users/{id}/password/change', array(
                'as' => 'users-password-change',
                'uses' => 'UserController@getPasswordChange'
            ));
            Route::get('/users/{id}/deactivate', array(
                'as' => 'users-deactivate',
                'uses' => 'UserController@postUserDeactivate'
            ));
            Route::get('/users/{id}/reactivate', array(
                'as' => 'users-reactivate',
                'uses' => 'UserController@postUserReactivate'
            ));
       });
   });
    
    Route::get('/email_template/{id}/send', array(
        'as'    => 'send-selected-email-post',
        'uses'  => 'EmailController@postSendSelectedEmail'
    ));
    
   Route::group(array('middleware' => 'roles.manage'), function() {
        Route::get('/roles', array(
            'as' => 'roles-view',
            'uses' => 'RoleController@getAll'
        ));
        Route::get('/roles/create', array(
            'as' => 'roles-create',
            'uses' => 'RoleController@getCreate'
        ));
   });
    
   Route::group(array('middleware' => 'parameters.view'), function() {
        Route::get('/parameters', array(
            'as' => 'parameters-view',
            'uses' => 'ParametersController@getAll'
        ));
        
        Route::get('/parameters/client-source', array(
            'as' => 'parameters-client-source-view',
            'uses' => 'ParametersController@getClientSource'
        ));
        Route::get('/parameters/client-source/create', array(
            'as' => 'parameters-client-source-create',
            'uses' => 'ParametersController@getClientSourceCreate'
        ));
        Route::get('/parameters/client-source/{id}/modify', array(
            'as' => 'parameters-client-source-modify',
            'uses' => 'ParametersController@getClientSourceModify'
        ));
        Route::get('/parameters/client-source/{id}/unpublish', array(
            'as' => 'parameters-client-source-unpublish',
            'uses' => 'ParametersController@getClientSourceUnPublish'
        ));
        Route::get('/parameters/client-source/{id}/publish', array(
            'as' => 'parameters-client-source-publish',
            'uses' => 'ParametersController@getClientSourcePublish'
        ));
        
        Route::get('/parameters/client-status', array(
            'as' => 'parameters-client-status-view',
            'uses' => 'ParametersController@getClientStatus'
        ));
        Route::get('/parameters/client-status/create', array(
            'as' => 'parameters-client-status-create',
            'uses' => 'ParametersController@getClientStatusCreate'
        ));
        Route::get('/parameters/client-status/{id}/modify', array(
            'as' => 'parameters-client-status-modify',
            'uses' => 'ParametersController@getClientStatusModify'
        ));
        Route::get('/parameters/client-status/{id}/unpublish', array(
            'as' => 'parameters-client-status-unpublish',
            'uses' => 'ParametersController@getClientStatusUnPublish'
        ));
        Route::get('/parameters/client-status/{id}/publish', array(
            'as' => 'parameters-client-status-publish',
            'uses' => 'ParametersController@getClientStatusPublish'
        ));
        
        Route::get('/parameters/campaign-status', array(
            'as' => 'parameters-campaign-status-view',
            'uses' => 'ParametersController@getCampaignStatus'
        ));
        Route::get('/parameters/campaign-status/create', array(
            'as' => 'parameters-campaign-status-create',
            'uses' => 'ParametersController@getCampaignStatusCreate'
        ));
        Route::get('/parameters/campaign-status/{id}/modify', array(
            'as' => 'parameters-campaign-status-modify',
            'uses' => 'ParametersController@getCampaignStatusModify'
        ));
        Route::get('/parameters/campaign-status/{id}/unpublish', array(
            'as' => 'parameters-campaign-status-unpublish',
            'uses' => 'ParametersController@getCampaignStatusUnPublish'
        ));
        Route::get('/parameters/campaign-status/{id}/publish', array(
            'as' => 'parameters-campaign-status-publish',
            'uses' => 'ParametersController@getCampaignStatusPublish'
        ));
        
        Route::get('/parameters/campaign-type', array(
            'as' => 'parameters-campaign-type-view',
            'uses' => 'ParametersController@getCampaignType'
        ));
        Route::get('/parameters/campaign-type/create', array(
            'as' => 'parameters-campaign-type-create',
            'uses' => 'ParametersController@getCampaignTypeCreate'
        ));
        Route::get('/parameters/campaign-type/{id}/modify', array(
            'as' => 'parameters-campaign-type-modify',
            'uses' => 'ParametersController@getCampaignTypeModify'
        ));
        Route::get('/parameters/campaign-type/{id}/unpublish', array(
            'as' => 'parameters-campaign-type-unpublish',
            'uses' => 'ParametersController@getCampaignTypeUnPublish'
        ));
        Route::get('/parameters/campaign-type/{id}/publish', array(
            'as' => 'parameters-campaign-type-publish',
            'uses' => 'ParametersController@getCampaignTypePublish'
        ));
        
        Route::get('/parameters/campaign-member-status', array(
            'as' => 'parameters-campaign-member-status-view',
            'uses' => 'ParametersController@getCampaignMemberStatus'
        ));
        Route::get('/parameters/campaign-member-status/create', array(
            'as' => 'parameters-campaign-member-status-create',
            'uses' => 'ParametersController@getCampaignMemberStatusCreate'
        ));
        Route::get('/parameters/campaign-member-status/{id}/modify', array(
            'as' => 'parameters-campaign-member-status-modify',
            'uses' => 'ParametersController@getCampaignMemberStatusModify'
        ));
        Route::get('/parameters/campaign-member-status/{id}/unpublish', array(
            'as' => 'parameters-campaign-member-status-unpublish',
            'uses' => 'ParametersController@getCampaignMemberStatusUnPublish'
        ));
        Route::get('/parameters/campaign-member-status/{id}/publish', array(
            'as' => 'parameters-campaign-member-status-publish',
            'uses' => 'ParametersController@getCampaignMemberStatusPublish'
        ));
        
        Route::get('/parameters/district', array(
            'as' => 'parameters-district-view',
            'uses' => 'ParametersController@getProjectDistrict'
        ));
        Route::get('/parameters/district/create', array(
            'as' => 'parameters-district-create',
            'uses' => 'ParametersController@getProjectDistrictCreate'
        ));
        Route::get('/parameters/district/{id}/modify', array(
            'as' => 'parameters-district-modify',
            'uses' => 'ParametersController@getProjectDistrictModify'
        ));
        Route::get('/parameters/district/{id}/unpublish', array(
            'as' => 'parameters-district-unpublish',
            'uses' => 'ParametersController@getProjectDistrictUnPublish'
        ));
        Route::get('/parameters/district/{id}/publish', array(
            'as' => 'parameters-district-publish',
            'uses' => 'ParametersController@getProjectDistrictPublish'
        ));
        
        Route::get('/parameters/unit-type', array(
            'as' => 'parameters-unit-type-view',
            'uses' => 'ParametersController@getUnitType'
        ));
        Route::get('/parameters/unit-type/create', array(
            'as' => 'parameters-unit-type-create',
            'uses' => 'ParametersController@getUnitTypeCreate'
        ));
        Route::get('/parameters/unit-type/{id}/modify', array(
            'as' => 'parameters-unit-type-modify',
            'uses' => 'ParametersController@getUnitTypeModify'
        ));
        Route::get('/parameters/unit-type/{id}/unpublish', array(
            'as' => 'parameters-unit-type-unpublish',
            'uses' => 'ParametersController@getUnitTypeUnPublish'
        ));
        Route::get('/parameters/unit-type/{id}/publish', array(
            'as' => 'parameters-unit-type-publish',
            'uses' => 'ParametersController@getUnitTypePublish'
        ));
        
        Route::get('/parameters/unit-finish', array(
            'as' => 'parameters-unit-finish-view',
            'uses' => 'ParametersController@getUnitFinish'
        ));
        Route::get('/parameters/unit-finish/create', array(
            'as' => 'parameters-unit-finish-create',
            'uses' => 'ParametersController@getUnitFinishCreate'
        ));
        Route::get('/parameters/unit-finish/{id}/modify', array(
            'as' => 'parameters-unit-finish-modify',
            'uses' => 'ParametersController@getUnitFinishModify'
        ));
        Route::get('/parameters/unit-finish/{id}/unpublish', array(
            'as' => 'parameters-unit-finish-unpublish',
            'uses' => 'ParametersController@getUnitFinishUnPublish'
        ));
        Route::get('/parameters/unit-finish/{id}/publish', array(
            'as' => 'parameters-unit-finish-publish',
            'uses' => 'ParametersController@getUnitFinishPublish'
        ));
        
        Route::get('/parameters/activity-type', array(
            'as' => 'parameters-activity-type-view',
            'uses' => 'ParametersController@getActivityType'
        ));
        Route::get('/parameters/activity-type/create', array(
            'as' => 'parameters-activity-type-create',
            'uses' => 'ParametersController@getActivityTypeCreate'
        ));
        Route::get('/parameters/activity-type/{id}/modify', array(
            'as' => 'parameters-activity-type-modify',
            'uses' => 'ParametersController@getActivityTypeModify'
        ));
        Route::get('/parameters/activity-type/{id}/unpublish', array(
            'as' => 'parameters-activity-type-unpublish',
            'uses' => 'ParametersController@getActivityTypeUnPublish'
        ));
        Route::get('/parameters/activity-type/{id}/publish', array(
            'as' => 'parameters-activity-type-publish',
            'uses' => 'ParametersController@getActivityTypePublish'
        ));
        
        Route::get('/parameters/activity-status', array(
            'as' => 'parameters-activity-status-view',
            'uses' => 'ParametersController@getActivityStatus'
        ));
        Route::get('/parameters/activity-status/create', array(
            'as' => 'parameters-activity-status-create',
            'uses' => 'ParametersController@getActivityStatusCreate'
        ));
        Route::get('/parameters/activity-status/{id}/modify', array(
            'as' => 'parameters-activity-status-modify',
            'uses' => 'ParametersController@getActivityStatusModify'
        ));
        Route::get('/parameters/activity-status/{id}/unpublish', array(
            'as' => 'parameters-activity-status-unpublish',
            'uses' => 'ParametersController@getActivityStatusUnPublish'
        ));
        Route::get('/parameters/activity-status/{id}/publish', array(
            'as' => 'parameters-activity-status-publish',
            'uses' => 'ParametersController@getActivityStatusPublish'
        ));
    
});








Route::get('developers/publish/{id}/{status}','\App\Http\Controllers\parameters\DeveloperController@publish')->name('developer.publish');
Route::resource('developers','\App\Http\Controllers\parameters\DeveloperController');

Route::get('unitplaces/publish/{id}/{status}','\App\Http\Controllers\parameters\UnitPlaceController@publish')->name('unitplaces.publish');
Route::resource('unitplaces','\App\Http\Controllers\parameters\UnitPlaceController');


Route::get('newprojects/publish/{id}/{status}','\App\Http\Controllers\parameters\ProjectController@publish')->name('project.publish');
Route::resource('newprojects','\App\Http\Controllers\parameters\ProjectController');


Route::get('new-convert-lead/{id}','ConvertClientController@show')->name('new.convert');

Route::post('developer-projects','ConvertClientController@getDeveloperProjects')->name('developer.projects');

Route::post('new-convert-to-client/{id}','ConvertClientController@postConvert')->name('post.convertto.client');


Route::get('resales/approve/{id}/{status}','ResaleController@approve')->name('resales.approve');
Route::get('resales/search','ResaleController@search')->name('resales.search');
Route::resource('resales','ResaleController');


Route::get('add-action/{id}','NewClientController@addAction')->name('add.action');


Route::post('mark-reject-seen','NewClientController@markRejectSeen')->name('mark.reject.seen');


Route::get('reasign-datatable/{leads}', ['uses'=>'ReAssignController@datatable'])->name('leads.datatables');


Route::post('filter-activity-dashboard','FilterController@filterActivity')->name('filter.activity.dashboard');//



Route::get('change-password','UserController@changePassword')->name('change.password');//
Route::post('change-password','UserController@postChangePassword')->name('post.change.password');//


Route::get('count-new-leads','NewClientController@]')->name('count_new_leads');

});