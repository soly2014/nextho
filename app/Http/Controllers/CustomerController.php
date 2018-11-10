<?php 

namespace App\Http\Controllers;




use Illuminate\Http\Request;


class CustomerController extends Controller {



    public function getAll()
    {
        PageTitle::add('View Customers');
        return view('clients.customersview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Customer',
                'crumb_link' => ''
                ])
                 ,array([
                'crumb_name' => 'View All',
                'crumb_link' => 'customers-view'
                ])
            ])
        ));
    }
    public function getSingle()
    {
        PageTitle::add('Single View Details');
        return view('clients.singleview', array(
            'breadcrumbs' => array([
                array([
                 'crumb_name' => 'Customer',
                 'crumb_link' => ''
                ])
                 ,array([
                 'crumb_name' => 'View All',
                 'crumb_link' => 'customers-view-single'
                ])
            ]),
            'customer' => true
        ));
    }
    public function getModify()
    {
        PageTitle::add('Modify A Customers\'s Info');
        return view('clients.edit', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Customers',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'Edit Customer',
                    'crumb_link' => 'customers-modify-single'
                ])
            ])
        ));
    }

}
