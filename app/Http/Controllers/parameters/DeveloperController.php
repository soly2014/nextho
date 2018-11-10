<?php

namespace App\Http\Controllers\parameters;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;
use PageTitle;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sources = Developer::orderBy('created_at','desc')->get();
        PageTitle::add('View All Developers');

        return view('developers.index', array(
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
        return view('developers.create');
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
            
       Developer::create(array(
            'name'          => $request->name,
            'published'     => true,
            'created_by'    => auth()->user()->id
        ));
        
        session()->flash('success', '<strong>Congratulations!</strong> The New Developer "'.$request->name.'" is added successfully.');
        return redirect()->route('developers.index');
                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function edit(Developer $developer)
    {
        return view('developers.edit',compact('developer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Developer $developer)
    {
      $this->validate($request,['name'=>'required']);

       $developer->update([
            'name'          => $request->name,
            'updated_by'    => auth()->user()->id
        ]);
        
        session()->flash('success', '<strong>Congratulations!</strong> The New Developer "'.$request->name.'" is Edited successfully.');
        return redirect()->route('developers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request,$id,$status)
    {
       $developer = Developer::find($id);
       $developer->update([
            'published'  => (bool)$status,
            'updated_by' => auth()->user()->id
        ]);
        session()->flash('success', '<strong>Congratulations!</strong> The New Developer "'.$request->name.'" is Edited successfully.');
        return redirect()->route('developers.index');
    }

}
