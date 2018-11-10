<?php
namespace App\Http\Controllers\parameters;

use App\Http\Controllers\Controller;
use App\Models\UnitPlace;
use Illuminate\Http\Request;
use PageTitle;

class UnitPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sources = UnitPlace::orderBy('created_at','desc')->get();
        PageTitle::add('View All unitplaces');

        return view('unitplaces.index', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Client Source',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Client Sources',
            'publish_route'     => 'parameters-client-source-publish',
            'unpublish_route'   => 'parameters-client-source-unpublish',
            'create_route'      => 'parameters-client-source-create',
            'modify_route'      => 'parameters-client-source-modify'
        ));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unitplaces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request,['name'=>'required']);
            
       UnitPlace::create(array(
            'name'          => $request->name,
            'published'     => true,
            'created_by'    => auth()->user()->id
        ));
        
        session()->flash('success', '<strong>Congratulations!</strong> The New UnitPlace "'.$request->name.'" is added successfully.');
        return redirect()->route('unitplaces.index');
                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Developer  $unitplace
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitPlace $unitplace)
    {
        return view('unitplaces.edit',compact('unitplace'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnitPlace  $unitplace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitPlace $unitplace)
    {
      $this->validate($request,['name'=>'required']);

       $unitplace->update([
            'name'          => $request->name,
            'updated_by'    => auth()->user()->id
        ]);
        
        session()->flash('success', '<strong>Congratulations!</strong> The New UnitPlace "'.$request->name.'" is Edited successfully.');
        return redirect()->route('unitplaces.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnitPlace  $unitplace
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request,$id,$status)
    {
       $unitplace = UnitPlace::find($id);
       $unitplace->update([
            'published'  => (bool)$status,
            'updated_by' => auth()->user()->id
        ]);
        session()->flash('success', '<strong>Congratulations!</strong> The New UnitPlace "'.$request->name.'" is Edited successfully.');
        return redirect()->route('unitplaces.index');
    }

}
