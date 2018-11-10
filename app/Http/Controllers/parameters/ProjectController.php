<?php

namespace App\Http\Controllers\parameters;

use App\Http\Controllers\Controller;
use App\Models\ParameterProject;
use Illuminate\Http\Request;
use PageTitle;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sources = ParameterProject::orderBy('created_at','desc')->get();
        PageTitle::add('View All ParameterProjects');

        return view('developers.projects.index', array(
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
        return view('developers.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request,['name'=>'required','developer_id'=>'required']);
            
       ParameterProject::create(array(
            'name'          => $request->name,
            'developer_id'  => $request->developer_id,
            'published'     => true,
            'created_by'    => auth()->user()->id
        ));
        
        session()->flash('success', '<strong>Congratulations!</strong> The New ParameterProject "'.$request->name.'" is added successfully.');
        return redirect()->route('newprojects.index');
                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParameterProject  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(ParameterProject $project,$id)
    {  
        $project = ParameterProject::find($id);     
        return view('developers.projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParameterProject  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParameterProject $project,$id)
    {

      $project = ParameterProject::find($id);            
      $this->validate($request,['name'=>'required','developer_id'=>'required']);

       $project->update([
            'name'          => $request->name,
            'developer_id'  => $request->developer_id,            
            'updated_by'    => auth()->user()->id
        ]);
        
        session()->flash('success', '<strong>Congratulations!</strong> The New ParameterProject "'.$request->name.'" is Edited successfully.');
        return redirect()->route('newprojects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParameterProject  $project
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request,$id,$status)
    {
       $project = ParameterProject::find($id);
       $project->update([
            'published'  => (bool)$status,
            'updated_by' => auth()->user()->id
        ]);
        session()->flash('success', '<strong>Congratulations!</strong> The New ParameterProject "'.$request->name.'" is Edited successfully.');
        return redirect()->route('newprojects.index');
    }

}
