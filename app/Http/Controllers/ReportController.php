<?php 

namespace App\Http\Controllers;




use Illuminate\Http\Request;


class ReportController extends Controller {


    /**
     * [getAll description]
     * @return [type] [description]
     */
    public function getAll()
    {
        $reports = Report::where('active', true)->get();
        PageTitle::add('View All Available Reports');
        return view('reports.view', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Reports',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'View All',
                    'crumb_link' => 'reports-view'
                ])
            ]),
            'reports'   => $reports
        ));
    }

    /**
     * [getCreate description]
     * @return [type] [description]
     */
    public function getCreate()
    {
        PageTitle::add('Create A New Report');
        return view('reports.create', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Reports',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'Create Report',
                    'crumb_link' => 'reports-create'
                ])
            ])
        ));
    }
    public function getSingle()
    {
        PageTitle::add('View Report');
        return view('reports.singleview', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Reports',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'View All',
                    'crumb_link' => 'reports-view-single'
                ])
            ])
        ));
    }

    public function getReport($id){

        $report = Report::where('id', $id)->where('active', true)->first();

        if($report){

            PageTitle::add('Generate Report "'.$report->report_name.'"');
            return view('reports.timerange', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Reports',
                        'crumb_link' => 'reports-view'
                    ])
                    ,array([
                        'crumb_name' => $report->report_name,
                        'crumb_link' => ''
                    ])
                ]),
                'formRoute' => $report->route
            ));

        } else {
            return route('reports-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Intended Report either no longer Active, doesn\'t exist or the provided URL is Invalid.');
        }
    }

    public function postClientAcquisition(){
        $validator = $this->validate($request, 
                                     array(
                                         'end_date'         => 'required',
                                         'start_date'       => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('reports-generate-single', array(1))
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_name = "Clients Acquisition Report - ".date("d/m/Y");

            $report     = Report::where('id', 1)->first();
            $generated  = (int)$report->number_generated;
            ++$generated;

            $report->update(array(
                'number_generated'  => $generated,
                'last_generated_at' => date("Y-m-d H:i:s")
            ));

            Excel::create($file_name, function($excel) {

                // Set the title
                $excel->setTitle('Clients Acquisition Report');

                // Chain the setters
                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Clients', function($sheet) {
                    $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));

                    $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->whereBetween('customer_date', array($start_date, $end_date))->get();

                    //dd($clients->firstProperty);
                    $sheet->loadView('reports.templates.clientaq', array(
                        'clients'       => $clients,
                        'projects_only' => false,
                        'units_only'    => false,
                        'start_date'    => Input::get('start_date'),
                        'end_date'      => Input::get('end_date')
                    ));

                });

            })->download('xlsx');
        }

    }
    public function getClientAcquisitionView(){
        $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->get();

        PageTitle::add('View Clients Acquisition Report');

        return view('reports.templates.clientaq_view', array(
            'clients'       => $clients,
            'start_date'    => '',
            'end_date'      => '',
            'projects_only' => false,
            'units_only'    => false,
            'form_route'    => 'report-client-acquisition-view'
        ));
    }    

    public function postClientAcquisitionView(){

        $end_raw = Input::get('end_date');
        if($end_raw == ""){
            $end_raw = date("Y-m-d");
        }

        $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date       = date('Y-m-d', strtotime($end_raw));

        $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->whereBetween('customer_date', array($start_date, $end_date))->get();
        //dd($clients);
        PageTitle::add('View Clients Acquisition Report');

        return view('reports.templates.clientaq_view', array(
            'clients'       => $clients,
            'start_date'    => Input::get('start_date'),
            'end_date'      => Input::get('end_date'),
            'projects_only' => false,
            'units_only'    => false,
            'form_route'    => 'report-client-acquisition-view'
        ));
    }

    public function postClientAcquisitionProjects(){
        $validator = $this->validate($request, 
                                     array(
                                         'end_date'         => 'required',
                                         'start_date'       => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('reports-generate-single', array(2))
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_name = "Clients Acquisition Report - ".date("d/m/Y");

            $report     = Report::where('id', 2)->first();
            $generated  = (int)$report->number_generated;
            ++$generated;

            $report->update(array(
                'number_generated'  => $generated,
                'last_generated_at' => date("Y-m-d H:i:s")
            ));

            Excel::create($file_name, function($excel) {

                // Set the title
                $excel->setTitle('Clients Acquisition Report');

                // Chain the setters
                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Clients', function($sheet) {
                    $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));

                    $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->whereBetween('customer_date', array($start_date, $end_date))->get();
                    //dd($clients->firstProperty);
                    $sheet->loadView('reports.templates.clientaq', array(
                        'clients'       => $clients,
                        'projects_only' => true,
                        'units_only'    => false,
                        'start_date'    => Input::get('start_date'),
                        'end_date'      => Input::get('end_date')
                    ));

                });

            })->download('xlsx');
        }
    }
    public function getClientAcquisitionProjectsView(){
        $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->get();

        PageTitle::add('View Clients Acquisition Report - Projects');

        return view('reports.templates.clientaq_view', array(
            'clients'       => $clients,
            'start_date'    => '',
            'end_date'      => '',
            'projects_only' => true,
            'units_only'    => false,
            'form_route'    => 'report-client-acquisition-projects-view'
        ));
    }    

    public function postClientAcquisitionProjectsView(){

        $end_raw = Input::get('end_date');
        if($end_raw == ""){
            $end_raw = date("Y-m-d");
        }

        $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date       = date('Y-m-d', strtotime($end_raw));

        $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->whereBetween('customer_date', array($start_date, $end_date))->get();
        //dd($clients);
        PageTitle::add('View Clients Acquisition Report - Projects');

        return view('reports.templates.clientaq_view', array(
            'clients'       => $clients,
            'start_date'    => Input::get('start_date'),
            'end_date'      => Input::get('end_date'),
            'projects_only' => true,
            'units_only'    => false,
            'form_route'    => 'report-client-acquisition-projects-view'
        ));
    }

    public function postClientAcquisitionUnits(){
        $validator = $this->validate($request, 
                                     array(
                                         'end_date'         => 'required',
                                         'start_date'       => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('reports-generate-single', array(3))
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_name = "Clients Acquisition Report - ".date("d/m/Y");

            $report     = Report::where('id', 3)->first();
            $generated  = (int)$report->number_generated;
            ++$generated;

            $report->update(array(
                'number_generated'  => $generated,
                'last_generated_at' => date("Y-m-d H:i:s")
            ));

            Excel::create($file_name, function($excel) {

                // Set the title
                $excel->setTitle('Clients Acquisition Report');

                // Chain the setters
                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Clients', function($sheet) {
                    $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));

                    $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->whereBetween('customer_date', array($start_date, $end_date))->get();
                    //dd($clients->firstProperty);
                    $sheet->loadView('reports.templates.clientaq', array(
                        'clients'       => $clients,
                        'projects_only' => false,
                        'units_only'    => true,
                        'start_date'    => Input::get('start_date'),
                        'end_date'      => Input::get('end_date')
                    ));

                });

            })->download('xlsx');
        }
    }
    public function getClientAcquisitionUnitsView(){
        $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->get();

        PageTitle::add('View Clients Acquisition Report - Units');

        return view('reports.templates.clientaq_view', array(
            'clients'       => $clients,
            'start_date'    => '',
            'end_date'      => '',
            'projects_only' => false,
            'units_only'    => true,
            'form_route'    => 'report-client-acquisition-units-view'
        ));
    }    

    public function postClientAcquisitionUnitsView(){

        $end_raw = Input::get('end_date');
        if($end_raw == ""){
            $end_raw = date("Y-m-d");
        }

        $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date       = date('Y-m-d', strtotime($end_raw));

        $clients = Client::with('source', 'firstProperty', 'firstProperty.userCreated', 'firstProperty.Unit', 'firstProperty.Project')->where('is_customer', true)->whereBetween('customer_date', array($start_date, $end_date))->get();
        //dd($clients);
        PageTitle::add('View Clients Acquisition Report - Units');

        return view('reports.templates.clientaq_view', array(
            'clients'       => $clients,
            'start_date'    => Input::get('start_date'),
            'end_date'      => Input::get('end_date'),
            'projects_only' => false,
            'units_only'    => true,
            'form_route'    => 'report-client-acquisition-units-view'
        ));
    }

    public function postSales(){
        $validator = $this->validate($request, 
                                     array(
                                         'end_date'         => 'required',
                                         'start_date'       => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('reports-generate-single', array(4))
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_name = "Sales Report - ".date("d/m/Y");

            $report     = Report::where('id', 4)->first();
            $generated  = (int)$report->number_generated;
            ++$generated;

            $report->update(array(
                'number_generated'  => $generated,
                'last_generated_at' => date("Y-m-d H:i:s")
            ));

            Excel::create($file_name, function($excel) {

                $excel->setTitle('Sales Report');

                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Sales', function($sheet) {
                    $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));

                    $sales = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Unit', 'Project')->whereBetween('status_updated_at', array($start_date, $end_date))->where('approved', true)->orderBy('status_updated_at')->get();
                    //dd($clients->firstProperty);
                    $sheet->loadView('reports.templates.sales', array(
                        'sales'       => $sales,
                        'start_date'    => Input::get('start_date'),
                        'end_date'      => Input::get('end_date')
                    ));

                });

            })->download('xlsx');
        }
    }
    public function getSalesView(){
        $clients = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Unit', 'Project')->where('approved', true)->orderBy('status_updated_at')->get();

        PageTitle::add('View Sales Report');

        return view('reports.templates.sales_view', array(
            'sales'       => $clients,
            'start_date'    => '',
            'end_date'      => '',
            'form_route'    => 'report-sales-view'
        ));
    }    
    public function postSalesView(){

        $end_raw = Input::get('end_date');
        if($end_raw == ""){
            $end_raw = date("Y-m-d");
        }

        $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date       = date('Y-m-d', strtotime($end_raw));

        $clients = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Unit', 'Project')->whereBetween('status_updated_at', array($start_date, $end_date))->where('approved', true)->orderBy('status_updated_at')->get();
        //dd($clients);
        PageTitle::add('View Sales Report');

        return view('reports.templates.sales_view', array(
            'sales'       => $clients,
            'start_date'    => Input::get('start_date'),
            'end_date'      => Input::get('end_date'),
            'form_route'    => 'report-sales-view'
        ));
    }

    public function postSalesProjects(){
        $validator = $this->validate($request, 
                                     array(
                                         'end_date'         => 'required',
                                         'start_date'       => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('reports-generate-single', array(5))
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_name = "Sales Report - ".date("d/m/Y");

            $report     = Report::where('id', 5)->first();
            $generated  = (int)$report->number_generated;
            ++$generated;

            $report->update(array(
                'number_generated'  => $generated,
                'last_generated_at' => date("Y-m-d H:i:s")
            ));

            Excel::create($file_name, function($excel) {

                $excel->setTitle('Sales Report');

                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Sales', function($sheet) {
                    $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));

                    $sales = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Project')->where('propertable_type', 'Project')->whereBetween('status_updated_at', array($start_date, $end_date))->where('approved', true)->orderBy('status_updated_at')->get();
                    //dd($clients->firstProperty);
                    $sheet->loadView('reports.templates.sales', array(
                        'sales'       => $sales,
                        'start_date'    => Input::get('start_date'),
                        'end_date'      => Input::get('end_date')
                    ));

                });

            })->download('xlsx');
        }
    }
    public function getSalesProjectsView(){
        $clients = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Project')->where('propertable_type', 'Project')->where('approved', true)->orderBy('status_updated_at')->get();

        PageTitle::add('View Sales Report - Projects');

        return view('reports.templates.sales_view', array(
            'sales'       => $clients,
            'start_date'    => '',
            'end_date'      => '',
            'form_route'    => 'report-sales-projects-view'
        ));
    }    
    public function postSalesProjectsView(){

        $end_raw = Input::get('end_date');
        if($end_raw == ""){
            $end_raw = date("Y-m-d");
        }

        $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date       = date('Y-m-d', strtotime($end_raw));

        $clients = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Project')->where('propertable_type', 'Project')->whereBetween('status_updated_at', array($start_date, $end_date))->where('approved', true)->orderBy('status_updated_at')->get();
        //dd($clients);
        PageTitle::add('View Sales Report - Projects');

        return view('reports.templates.sales_view', array(
            'sales'       => $clients,
            'start_date'    => Input::get('start_date'),
            'end_date'      => Input::get('end_date'),
            'form_route'    => 'report-sales-projects-view'
        ));
    }

    public function postSalesUnits(){
        $validator = $this->validate($request, 
                                     array(
                                         'end_date'         => 'required',
                                         'start_date'       => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('reports-generate-single', array(6))
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_name = "Sales Report - ".date("d/m/Y");

            $report     = Report::where('id', 6)->first();
            $generated  = (int)$report->number_generated;
            ++$generated;

            $report->update(array(
                'number_generated'  => $generated,
                'last_generated_at' => date("Y-m-d H:i:s")
            ));

            Excel::create($file_name, function($excel) {

                $excel->setTitle('Sales Report');

                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Sales', function($sheet) {
                    $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));

                    $sales = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Unit')->where('propertable_type', 'Unit')->whereBetween('status_updated_at', array($start_date, $end_date))->where('approved', true)->orderBy('status_updated_at')->get();
                    //dd($clients->firstProperty);
                    $sheet->loadView('reports.templates.sales', array(
                        'sales'       => $sales,
                        'start_date'    => Input::get('start_date'),
                        'end_date'      => Input::get('end_date')
                    ));

                });

            })->download('xlsx');
        }
    }
    public function getSalesUnitsView(){
        $clients = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Unit')->where('propertable_type', 'Unit')->where('approved', true)->orderBy('status_updated_at')->get();

        PageTitle::add('View Sales Report - Units');

        return view('reports.templates.sales_view', array(
            'sales'       => $clients,
            'start_date'    => '',
            'end_date'      => '',
            'form_route'    => 'report-sales-units-view'
        ));
    }    
    public function postSalesUnitsView(){

        $end_raw = Input::get('end_date');
        if($end_raw == ""){
            $end_raw = date("Y-m-d");
        }

        $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date       = date('Y-m-d', strtotime($end_raw));

        $clients = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Unit')->where('propertable_type', 'Unit')->whereBetween('status_updated_at', array($start_date, $end_date))->where('approved', true)->orderBy('status_updated_at')->get();
        //dd($clients);
        PageTitle::add('View Sales Report - Units');

        return view('reports.templates.sales_view', array(
            'sales'       => $clients,
            'start_date'    => Input::get('start_date'),
            'end_date'      => Input::get('end_date'),
            'form_route'    => 'report-sales-units-view'
        ));
    }

    public function postClientSoures(){
        $validator = $this->validate($request, 
                                     array(
                                         'end_date'         => 'required',
                                         'start_date'       => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('reports-generate-single', array(7))
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_name = "Clients Sources Report - ".date("d/m/Y");

            $report     = Report::where('id', 7)->first();
            $generated  = (int)$report->number_generated;
            ++$generated;

            $report->update(array(
                'number_generated'  => $generated,
                'last_generated_at' => date("Y-m-d H:i:s")
            ));

            Excel::create($file_name, function($excel) {

                $excel->setTitle('Clients Sources Report');

                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Clients Sources', function($sheet) {
                    $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));

                    //$sales = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Unit')->where('propertable_type', 'Unit')->whereBetween('status_updated_at', array($start_date, $end_date))->where('approved', true)->orderBy('status_updated_at')->get();

                    $clients_source = Client::with('source', 'source.customersCount')->where('is_customer', true)->where('marked_deleted', false)->whereBetween('customer_date', array($start_date, $end_date))->groupBy('client_source_id')->get();
                    //dd($clients_source);
                    $clients_source_count = Client::where('is_customer', true)->whereBetween('customer_date', array($start_date, $end_date))->count();
                    //dd($clients_source_count);
                    //dd($clients->firstProperty);
                    $sheet->loadView('reports.templates.source', array(
                        'clients'           => $clients_source,
                        'clients_count'     => $clients_source_count,
                        'start_date'        => Input::get('start_date'),
                        'end_date'          => Input::get('end_date')
                    ));

                });

            })->download('xlsx');
        }

    }
    public function getClientSouresView(){

        $clients_source = Client::with('source', 'source.customersCount')->where('is_customer', true)->where('marked_deleted', false)->groupBy('client_source_id')->get();
        //dd($clients_source);
        $clients_source_count = Client::where('is_customer', true)->count();

        PageTitle::add('Clients Sources Report');

        return view('reports.templates.source_view', array(
            'clients'       => $clients_source,
            'start_date'    => '',
            'end_date'      => '',
            'clients_count' => $clients_source_count,
            'form_route'    => 'report-sources-view'
        ));
    }    
    public function postClientSouresView(){

        $end_raw = Input::get('end_date');
        if($end_raw == ""){
            $end_raw = date("Y-m-d");
        }

        $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date       = date('Y-m-d', strtotime($end_raw));

        $clients_source = Client::with('source', 'source.customersCount')->where('is_customer', true)->where('marked_deleted', false)->whereBetween('customer_date', array($start_date, $end_date))->groupBy('client_source_id')->get();
        //dd($clients_source);
        $clients_source_count = Client::where('is_customer', true)->whereBetween('customer_date', array($start_date, $end_date))->count();
        //dd($clients);
        PageTitle::add('Clients Sources Report');

        return view('reports.templates.source_view', array(
            'clients'       => $clients_source,
            'clients_count' => $clients_source_count,
            'start_date'    => Input::get('start_date'),
            'end_date'      => Input::get('end_date'),
            'form_route'    => 'report-sources-view'
        ));
    }
    public function postLeadsSoures(){
        $validator = $this->validate($request, 
                                     array(
                                         'end_date'         => 'required',
                                         'start_date'       => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('reports-generate-single', array(7))
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_name = "Leads Sources Report - ".date("d/m/Y");

            $report     = Report::where('id', 7)->first();
            $generated  = (int)$report->number_generated;
            ++$generated;

            $report->update(array(
                'number_generated'  => $generated,
                'last_generated_at' => date("Y-m-d H:i:s")
            ));

            Excel::create($file_name, function($excel) {

                $excel->setTitle('Leads Sources Report');

                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Clients Sources', function($sheet) {
                    $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));

                    //$sales = ClientProperty::with('Client', 'Client.source', 'userCreated', 'Unit')->where('propertable_type', 'Unit')->whereBetween('status_updated_at', array($start_date, $end_date))->where('approved', true)->orderBy('status_updated_at')->get();

                    $clients_source = Client::with('source', 'source.leadsCount')->where('is_customer', false)->where('marked_deleted', false)->whereBetween('created_at', array($start_date, $end_date))->groupBy('client_source_id')->get();
                    //dd($clients_source);
                    $clients_source_count = Client::where('is_customer', false)->whereBetween('created_at', array($start_date, $end_date))->count();
                    //dd($clients_source_count);
                    //dd($clients->firstProperty);
                    $sheet->loadView('reports.templates.source', array(
                        'clients'           => $clients_source,
                        'clients_count'     => $clients_source_count,
                        'start_date'        => Input::get('start_date'),
                        'end_date'          => Input::get('end_date'),
                        'leads'	    => true
                    ));

                });

            })->download('xlsx');
        }

    }
    public function getLeadsSouresView(){

        $clients_source = Client::with('source', 'source.leadsCount')->where('is_customer', false)->where('marked_deleted', false)->groupBy('client_source_id')->get();
        //dd($clients_source);
        $clients_source_count = Client::where('is_customer', false)->count();

        PageTitle::add('Clients Sources Report');

        return view('reports.templates.source_view', array(
            'clients'       => $clients_source,
            'start_date'    => '',
            'end_date'      => '',
            'clients_count' => $clients_source_count,
            'form_route'    => 'report-sources-view',
            'leads'	    => true
        ));
    }
    public function postLeadsSouresView(){

        $end_raw = Input::get('end_date');
        if($end_raw == ""){
            $end_raw = date("Y-m-d");
        }

        $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date       = date('Y-m-d', strtotime($end_raw));

        $clients_source = Client::with('source', 'source.customersCount')->where('is_customer', false)->where('marked_deleted', false)->whereBetween('created_at', array($start_date, $end_date))->groupBy('client_source_id')->get();
        //dd($clients_source);
        $clients_source_count = Client::where('is_customer', false)->whereBetween('created_at', array($start_date, $end_date))->count();
        //dd($clients);
        PageTitle::add('Leads Sources Report');

        return view('reports.templates.source_view', array(
            'clients'       => $clients_source,
            'clients_count' => $clients_source_count,
            'start_date'    => Input::get('start_date'),
            'end_date'      => Input::get('end_date'),
            'form_route'    => 'report-sources-view',
            'leads'	    => true
        ));
    }
    public function getUserActions(){
        PageTitle::add('Generate The Daily Performance Report');
        $all = array('0' => '- All -');
        $users = $all + User::where('role_id', 2)->lists('username', 'id');
        return view('reports.daterange', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Reports',
                    'crumb_link' => 'reports-view'
                ])
                ,array([
                    'crumb_name' => 'Daily Performance',
                    'crumb_link' => ''
                ])
            ]),
            'users' => $users
        ));
    }
    public function postUserActions(){
        $date     = Input::get('start_date');

        $file_name = "Daily Report - ".date($date);

        $date     = date('Y-m-d', strtotime(Input::get('start_date')));
        $end_date = "";
        $end_raw = Input::get('end_date');
        if($end_raw != ""){
            $end_date = date('Y-m-d', strtotime(Input::get('end_date')));
        }

        $agents = Input::get('agents');
        $perf = array();
        if(($date == $end_date) || $end_date == ""){
            $UserActions_notes = UserAction::where('date', $date)->where('object_type', 'Client')->where('actionable_type', 'Note');

            $UserActions_activities = UserAction::where('date', $date)->where('object_type', 'Client')->where('actionable_type', 'Activity')->where('action_type','Closed');
            //dd($clients->firstProperty);
            $new_clients = Client::where("is_customer", false)->where(DB::raw('DATE(created_at)'), $date);
            $new_customers = Client::where("is_customer", true)->where('customer_date', $date);

            if((COUNT($agents) >= 1) && ($agents[0] != '0')){
                $UserActions_notes = $UserActions_notes->whereIn('created_by', $agents);
                $UserActions_activities = $UserActions_activities->whereIn('created_by', $agents);
                $new_clients = $new_clients->whereIn('assigned_to', $agents);
                $new_customers = $new_customers->whereIn('assigned_to', $agents);
            }

            $UserActions_notes = $UserActions_notes->orderBy('created_by', 'actionable_type')->get();
            $UserActions_activities = $UserActions_activities->orderBy('created_by', 'actionable_type')->get();
            $new_clients = $new_clients->orderBy('created_by')->get();
            $new_customers = $new_customers->orderBy('created_by')->get();


            $current;

            foreach($UserActions_notes as $note){
                $lead = $note->Client->id;
                //var_dump($note->Actionable->note_text);
                if(isset($perf[$lead]) && array_key_exists($lead, $perf)){
                    $current = $perf[$lead];
                    $perf[$lead][13] = $note->Actionable->note_text;
                } else {
                    $perf[$lead] = array(($note->Client->name." ".$note->Client->last_name), ($note->Client->Phone."/".$note->Client->mobile."'"), $note->Client->type->label, $note->Client->district->label, $note->Client->source->label);

                    array_push($perf[$lead], " ", 1);

                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ");

                    array_push($perf[$lead], ($note->Client->userCreated->username.' - '.$note->Client->userAssigned->username));
                    array_push($perf[$lead], $note->Actionable->note_text);
                    array_push($perf[$lead], $note->Client->created_at);
                }
            }
            foreach($UserActions_activities as $activity){
                $lead = $activity->Client->id;
                if(isset($perf[$lead]) && array_key_exists($lead, $perf)){
                    //var_dump($activity->Actionable->type);
                    if($activity->Actionable->type == 3) $perf[$lead][7] = 1;
                    if($activity->Actionable->type == 2) $perf[$lead][8] = 1;
                    if($activity->Actionable->type == 4) $perf[$lead][9] = 1;
                    if($activity->Actionable->type == 6) $perf[$lead][10] = 1;

                } else {
                    $perf[$lead] = array(($activity->Client->name." ".$activity->Client->last_name), ($activity->Client->Phone."/".$activity->Client->mobile."'"), $activity->Client->type->label, $activity->Client->district->label, $activity->Client->source->label);

                    array_push($perf[$lead], " ", 1);

                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ");

                    if($activity->Actionable->type == 3) $perf[$lead][7] = 1;
                    if($activity->Actionable->type == 2) $perf[$lead][8] = 1;
                    if($activity->Actionable->type == 4) $perf[$lead][9] = 1;
                    if($activity->Actionable->type == 6) $perf[$lead][10] = 1;

                    array_push($perf[$lead], ($activity->Client->userCreated->username.' - '.$activity->Client->userAssigned->username));
                    array_push($perf[$lead], " ");
                    array_push($perf[$lead], $activity->Client->created_at);
                }
            }
            foreach($new_clients as $new_lead){
                $lead = $new_lead->id;
                if(isset($perf[$lead]) && array_key_exists($lead, $perf)){
                    $current = $perf[$lead];
                    $perf[$lead][5] = 1;
                    $perf[$lead][6] = " ";
                } else {
                    $perf[$lead] = array(($new_lead->name." ".$new_lead->last_name), ($new_lead->Phone."/".$new_lead->mobile."'"), $new_lead->type->label, $new_lead->district->label, $new_lead->source->label);

                    array_push($perf[$lead], 1, " ");

                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ");

                    array_push($perf[$lead], ($new_lead->userCreated->username.' - '.$new_lead->userAssigned->username));
                    array_push($perf[$lead], "");
                    array_push($perf[$lead], $new_lead->created_at);
                }
            }
            foreach($new_customers as $new_lead){
                $lead = $new_lead->id;
                if(isset($perf[$lead]) && array_key_exists($lead, $perf)){
                    $current = $perf[$lead];
                    $perf[$lead][11] = 1;
                } else {
                    $perf[$lead] = array(($new_lead->name." ".$new_lead->last_name), ($new_lead->Phone."/".$new_lead->mobile."'"), $new_lead->type->label, $new_lead->district->label, $new_lead->source->label);

                    array_push($perf[$lead], " ", " ");

                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], 1);

                    array_push($perf[$lead], ($new_lead->userCreated->username.' - '.$new_lead->userAssigned->username));
                    array_push($perf[$lead], "");
                    array_push($perf[$lead], $new_lead->created_at);
                }
            }


        } else {
            $UserActions_notes = UserAction::whereBetween('date', array($date, $end_date))->where('object_type', 'Client')->where('actionable_type', 'Note');

            $UserActions_activities = UserAction::whereBetween('date', array($date, $end_date))->where('object_type', 'Client')->where('actionable_type', 'Activity')->where('action_type','Closed');
            //dd($clients->firstProperty);
            $new_clients = Client::where("is_customer", false)->whereBetween(DB::raw('DATE(created_at)'), array($date, $end_date));
            $new_customers = Client::where("is_customer", true)->whereBetween('customer_date', array($date, $end_date));

            if((COUNT($agents) >= 1) && ($agents[0] != '0')){
                $UserActions_notes = $UserActions_notes->whereIn('created_by', $agents);
                $UserActions_activities = $UserActions_activities->whereIn('created_by', $agents);
                $new_clients = $new_clients->whereIn('assigned_to', $agents);
                $new_customers = $new_customers->whereIn('assigned_to', $agents);
            }
            $UserActions_notes = $UserActions_notes->orderBy('created_by', 'actionable_type')->get();
            $UserActions_activities = $UserActions_activities->orderBy('created_by', 'actionable_type')->get();
            $new_clients = $new_clients->orderBy('created_by')->get();
            $new_customers = $new_customers->orderBy('created_by')->get();

            foreach($UserActions_notes as $note){
                $lead = $note->Client->id;
                //var_dump($note->Actionable->note_text);
                if(isset($perf[$lead]) && array_key_exists($lead, $perf)){
                    $current = $perf[$lead];
                    $perf[$lead][13] = $note->Actionable->note_text;
                } else {
                    $perf[$lead] = array(($note->Client->name." ".$note->Client->last_name), ($note->Client->Phone."/".$note->Client->mobile."'"), $note->Client->type->label, $note->Client->district->label, $note->Client->source->label);

                    array_push($perf[$lead], " ", 1);

                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ");

                    array_push($perf[$lead], ($note->Client->userCreated->username.' - '.$note->Client->userAssigned->username));
                    array_push($perf[$lead], $note->Actionable->note_text);
                    array_push($perf[$lead], $note->Client->created_at);
                }
            }
            foreach($UserActions_activities as $activity){
                $lead = $activity->Client->id;
                if(isset($perf[$lead]) && array_key_exists($lead, $perf)){
                    //var_dump($activity->Actionable->type);
                    if($activity->Actionable->type == 3) $perf[$lead][7] = 1;
                    if($activity->Actionable->type == 2) $perf[$lead][8] = 1;
                    if($activity->Actionable->type == 4) $perf[$lead][9] = 1;
                    if($activity->Actionable->type == 6) $perf[$lead][10] = 1;

                } else {
                    $perf[$lead] = array(($activity->Client->name." ".$activity->Client->last_name), ($activity->Client->Phone."/".$activity->Client->mobile."'"), $activity->Client->type->label, $activity->Client->district->label, $activity->Client->source->label);

                    array_push($perf[$lead], " ", 1);

                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ");

                    if($activity->Actionable->type == 3) $perf[$lead][7] = 1;
                    if($activity->Actionable->type == 2) $perf[$lead][8] = 1;
                    if($activity->Actionable->type == 4) $perf[$lead][9] = 1;
                    if($activity->Actionable->type == 6) $perf[$lead][10] = 1;

                    array_push($perf[$lead], ($activity->Client->userCreated->username.' - '.$activity->Client->userAssigned->username));
                    array_push($perf[$lead], " ");
                    array_push($perf[$lead], $activity->Client->created_at);
                }
            }
            foreach($new_clients as $new_lead){
                $lead = $new_lead->id;
                if(isset($perf[$lead]) && array_key_exists($lead, $perf)){
                    $current = $perf[$lead];
                    $perf[$lead][5] = 1;
                    $perf[$lead][6] = " ";
                } else {
                    $perf[$lead] = array(($new_lead->name." ".$new_lead->last_name), ($new_lead->Phone."/".$new_lead->mobile."'"), $new_lead->type->label, $new_lead->district->label, $new_lead->source->label);

                    array_push($perf[$lead], 1, " ");

                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ");

                    array_push($perf[$lead], ($new_lead->userCreated->username.' - '.$new_lead->userAssigned->username));
                    array_push($perf[$lead], "");
                    array_push($perf[$lead], $new_lead->created_at);
                }
            }
            foreach($new_customers as $new_lead){
                $lead = $new_lead->id;
                if(isset($perf[$lead]) && array_key_exists($lead, $perf)){
                    $current = $perf[$lead];
                    $perf[$lead][11] = 1;
                } else {
                    $perf[$lead] = array(($new_lead->name." ".$new_lead->last_name), ($new_lead->Phone."/".$new_lead->mobile."'"), $new_lead->type->label, $new_lead->district->label, $new_lead->source->label);

                    array_push($perf[$lead], " ", " ");

                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], " ", " ");
                    array_push($perf[$lead], 1);

                    array_push($perf[$lead], ($new_lead->userCreated->username.' - '.$new_lead->userAssigned->username));
                    array_push($perf[$lead], "");
                    array_push($perf[$lead], $new_lead->created_at);
                }
            }

        }

        Excel::create($file_name, function($excel) use($perf) {

            $excel->setTitle('Sales Daily Report');

            $excel->setCreator('Vertex CRM')
                ->setCompany('BE Real eState Investment & Marketing');

            $excel->sheet('Sales', function($sheet) use($perf){

                $date     = date('Y-m-d', strtotime(Input::get('start_date')));
                $end_date = "";
                $end_raw = Input::get('end_date');
                if($end_raw != ""){
                    $end_date = date('Y-m-d', strtotime(Input::get('end_date')));
                }

                if(($date == $end_date) || $end_date == ""){
                    $sheet->loadView('reports.templates.daily', array(
                        'report_date'		       	=> $perf,
                        'date'    					=> $date
                    ));
                } else {
                    $sheet->loadView('reports.templates.daily', array(
                        'report_date'		       	=> $perf,
                        'date'    					=> $date,
                        'end_date'					=> $end_date
                    ));
                }

            });

        })->download('xlsx');
    }
    public function getClientAttr(){
        PageTitle::add('Generate Report Clients Attributes');
        return view('reports.client_param', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Reports',
                    'crumb_link' => 'reports-view'
                ])
                ,array([
                    'crumb_name' => 'Clients Attributes',
                    'crumb_link' => ''
                ])
            ])
        ));
    }

    public function postClientAttr(){
        $validator = $this->validate($request, 
                                     array(
                                         'secondary_email'  => 'email',
                                         'email'            => 'email',
                                         'sel_leads'        => 'required_without:clients',
                                         'clients'          => 'required_without:sel_leads',
                                         'start_date'		=> 'required',
                                         'end_date'		    => 'required'
                                     )
                                    );

        if($validator -> fails()) {
            return route('report-clients-attr-get')
                ->withErrors($validator)
                ->withInput();
        } else {
            $date_gen     = Input::get('start_date');
            $file_name = "Clients Attributes - ".date($date_gen);

            $name                   = Input::get('name');
            $title                  = Input::get('title');
            $company                = Input::get('company');
            $work_title             = Input::get('work_title');
            $phone                  = Input::get('phone');
            $mobile                 = Input::get('mobile');
            $email                  = Input::get('email');
            $last_name              = Input::get('last_name');
            $lead_status            = Input::get('lead_status');
            $lead_source            = Input::get('lead_source');
            $secondary_email        = Input::get('secondary_email');
            $interested_district    = Input::get('interested_district');
            $interested_type        = Input::get('interested_type');

            $include_leads          = Input::has('sel_leads') ? true : false;
            $include_clients        = Input::has('clients') ? true : false;

            $assigned_to            = Input::get('assigned_to');
            //dd(in_array("mobile", $output));

            $leads 		= Client::with('userDeleted', 'userAssigned', 'district');

            if($include_clients == false){
                $leads = $leads->where('is_customer', false);
            } else if($include_leads == false){
                $leads = $leads->where('is_customer', true);
            }

            $date     = date('Y-m-d', strtotime(Input::get('start_date')));
            $end_date = date('Y-m-d', strtotime(Input::get('end_date')));
            $leads = $leads->whereBetween(DB::raw('DATE(created_at)'), array($date, $end_date));

            if($name != "") {
                $leads = $leads->where('name', 'like', $name);
            }
            if($title != "") {
                $leads = $leads->where('title', 'like', $title);
            }
            if($company != "") {
                $leads = $leads->where('company', 'like', $company);
            }
            if($work_title != "") {
                $leads = $leads->where('work_title', 'like', $work_title);
            }
            if($phone != "") {
                $leads = $leads->where('phone', 'like', $phone);
            }
            if($email != "") {
                $leads = $leads->where('email', 'like', $email);
            }
            if($mobile != "") {
                $leads = $leads->where('mobile', 'like', $mobile);
            }
            if($last_name != "") {
                $leads = $leads->where('last_name', 'like', $last_name);
            }
            if($assigned_to != "") {
                $leads = $leads->where('assigned_to', $assigned_to);
            }
            if($lead_status != "") {
                $leads = $leads->where('client_status_id', $lead_status);
            }
            if($lead_source != "") {
                $leads = $leads->where('client_source_id', $lead_source);
            }
            if($secondary_email != "") {
                $leads = $leads->where('secondary_email', 'like', $secondary_email);
            }
            if($interested_district != "") {
                $leads = $leads->where('interested_district', $interested_district);
            }
            if($interested_type != "") {
                $leads = $leads->where('interested_type', $interested_type);
            }

            $leads = $leads->get();
            Excel::create($file_name, function($excel) use($leads) {

                $excel->setTitle('Client Attributes Report');

                $excel->setCreator('Vertex CRM')
                    ->setCompany('BE Real eState Investment & Marketing');

                $excel->sheet('Clients', function($sheet) use($leads){

                    $output					= Input::get('output');

                    $date     = date('Y-m-d', strtotime(Input::get('start_date')));
                    $end_date = date('Y-m-d', strtotime(Input::get('end_date')));

                    $sheet->loadView('reports.templates.client_attr', array(
                        'report_date'		       	=> $leads,
                        'date'    					=> $date,
                        'end_date'    				=> $end_date,
                        'output'					=> $output
                    ));

                });

            })->download('xlsx');

        }
    }
    public function getExports(){

        /*Report::create(array(
	    	"report_name"	=> "Clients Sources (Leads)",
	    	"user_id"	=> auth()->user()->id,
	    	"active"	=> 1,
	    	"route"		=> "report-sources-leads"
	    ));*/


        $file_name = "DB Exports Clients - ".date("d/m/Y");

        Excel::create($file_name, function($excel) {

            $excel->setTitle('Sales Report');

            $excel->setCreator('Vertex CRM')
                ->setCompany('BE Real eState Investment & Marketing');

            $excel->sheet('Sales', function($sheet) {

                $UserActions = Client::all()->toArray();
                //dd($clients->firstProperty);
                $sheet->fromArray($UserActions, null, 'A1', true);

            });

        })->download('xlsx');
    }


}