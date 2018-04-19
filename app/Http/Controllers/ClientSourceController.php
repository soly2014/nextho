<?php 

namespace App\Http\Controllers;




use Illuminate\Http\Request;


class ClientSource extends Controller {

    
    public function getAll()
	{
        PageTitle::add('Dashboard');
		return view('dashboard');
	}

}
