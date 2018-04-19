<?php 

namespace App\Http\Controllers;




use Illuminate\Http\Request;


class EmailController extends Controller {



    public function getAll(){
        
        if(auth()->user()->userRole->view_all_email_templates){
            $email_templates = EmailTemplate::all();
        } else {
            $email_templates = EmailTemplate::where('marked_deleted', 0)->get();
        }
        
        PageTitle::add('View All Email Templates');
        return view('email_templates.view', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Emails',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'View All',
                    'crumb_link' => 'emails-view'
                ])
            ]),
            'email_templates'   => $email_templates
        ));
    }
    public function getCreate()
    {
        PageTitle::add('Create A New Email Template');
        return view('email_templates.create', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Emails',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'Create Template',
                    'crumb_link' => 'emails-create'
                ])
            ])
        ));
    }
    
    public function postCreate(){
        $validator = $this->validate($request, 
             array(
                 'template_name'    => 'required',
                 'activation_date'  => 'required|date',
                 'project'          => 'required',
                 'expiry_date'      => 'date',
                 'email_title'      => 'required|max:5120',
                 'email_body'       => 'required'
             )
        );

        if($validator -> fails()) {
            return route('emails-create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $template_name      = Input::get('template_name');
            $activation_date    = date('Y-m-d', strtotime(Input::get('activation_date')));
            $project            = Input::get('project');
            $expiry_date        = NULL;
            if(Input::get('expiry_date') != ''){
                $expiry_date        = date('Y-m-d', strtotime(Input::get('expiry_date')));
            }
            $email_title        = Input::get('email_title');
            $email_body         = Input::get('email_body');
            
            $user               = auth()->user()->id;
            
            $email_template = EmailTemplate::create(array(
                'template_name'     => $template_name,
                'activation_date'   => $activation_date,
                'expiry_date'       => $expiry_date,
                'project_id'        => $project,
                'email_title'       => $email_title,
                'email_body'        => $email_body,
                'created_by'        =>  $user
            ));
            
            if($email_template){
                $submit = Input::get('submit');
                
                if($submit == "save"){
                    return route('emails-view-single', array($email_template->id));
                } else if($submit == "save-new"){
                    return route('emails-create')
                        ->with('success', '<strong>Congratulations!</strong> The new Email Template "'.$template_name.'" has been created successfully.');
                } else {
                    return route('emails-view')
                        ->with('success', '<strong>Congratulations!</strong> The new Email Template "'.$template_name.'" has been created successfully.');
                }   
            }
        }
    }
    
    public function getSingle($id)
    {
        if(auth()->user()->userRole->view_all_email_templates){
            $email_template = EmailTemplate::where('id', $id)->first();    
        } else {
            $email_template = EmailTemplate::where('id', $id)->where('marked_deleted', false)->first();
        }
        //dd($email_template->clients()->wherePivot('marked_deleted', 0)->get()->toJson());
        
        
        
        if($email_template){ 
            
            $add_attachment = auth()->user()->userRole->add_email_attachment;
            $add_note = auth()->user()->userRole->add_email_note;
            
            PageTitle::add('View Email Template Details');
            return view('email_templates.singleview', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Emails',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'View All',
                    'crumb_link' => 'emails-view-single'
                ])
            ]),
            'object'            => $email_template,
            'notes'             => $email_template->notes()->where('marked_deleted', 0)->get(),
            'attachments'       => $email_template->attachments()->where('marked_deleted', 0)->get(),
            'add_attachment'    => $add_attachment,
            'add_note'          => $add_note,
            'model_type'        => 'EmailTemplate'
        ));
        } else {
            return route('emails-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Email Template you are looking for either no longer exists or The URL Provided is invalid.');
        }
        
    }
    public function getModify($id){
        $email_template = EmailTemplate::where('id', $id)->where('marked_deleted', false)->first();

        if($email_template) {
            PageTitle::add('Emails');
            return view('email_templates.modify', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Emails',
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'Edit Template',
                        'crumb_link' => 'emails-modify-single'
                    ])
                ]),
                'email_template'    => $email_template
            ));
        } else {
            return route('emails-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Email Template you are looking for either no longer exists or The URL Provided is invalid.');
        }
    }
    
    public function postModify($id){
        $email_template = EmailTemplate::where('id', $id)->where('marked_deleted', false)->first();
        
        if($email_template) {
            $validator = $this->validate($request, 
                 array(
                     'template_name'    => 'required',
                     'activation_date'  => 'required|date',
                     'project_id'          => 'required',
                     'expiry_date'      => 'date',
                     'email_title'      => 'required|max:5120',
                     'email_body'       => 'required'
                 )
            );

            if($validator -> fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $template_name      = Input::get('template_name');
                $activation_date    = date('Y-m-d', strtotime(Input::get('activation_date')));
                $project            = Input::get('project');
                $expiry_date        = NULL;
                if(Input::get('expiry_date') != ''){
                    $expiry_date        = date('Y-m-d', strtotime(Input::get('expiry_date')));
                }
                $email_title        = Input::get('email_title');
                $email_body         = Input::get('email_body');

                $user               = auth()->user()->id;

                $query = $email_template->update(array(
                    'template_name'     => $template_name,
                    'activation_date'   => $activation_date,
                    'expiry_date'       => $expiry_date,
                    'project_id'        => $project,
                    'email_title'       => $email_title,
                    'email_body'        => $email_body,
                    'updated_by'        => $user
                ));

                if($email_template){
                    $submit = Input::get('submit');

                    if($submit == "save"){
                        return route('emails-view-single', array($email_template->id));
                    } else if($submit == "save-new"){
                        return route('emails-create')
                            ->with('success', '<strong>Congratulations!</strong> The new Email Template "'.$template_name.'" has been created successfully.');
                    } else {
                        return route('emails-view')
                            ->with('success', '<strong>Congratulations!</strong> The new Email Template "'.$template_name.'" has been created successfully.');
                    }   
                }
            }
        } else {
            return route('emails-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Email Template you are looking for either no longer exists or The URL Provided is invalid.');
        }
    }
    
    public function postSendEmail(){
        $validator = $this->validate($request, 
         array(
             'selected_template'    => 'required'
         )
        );

        if($validator -> fails()) {
            return Redirect::back()
                ->withErrors($validator);
        } else {
            $selected_template  = (int)Input::get('selected_template');

            $email_template = EmailTemplate::where('id', $selected_template)->where('marked_deleted', false)
                        ->where('published', true)
                        ->where(function($query)
                        {
                            $query->where('expiry_date', '>', date('y-m-d'))
                                ->orWhere('expiry_date', NULL);
                        })
                        ->first();

            $email_sent = ($email_template->sent_number + 1);
            $query = $email_template->update(array(
                'sent_number' => $email_sent
            ));

            $sent_date      = date("Y-m-d H:i:s");
            $user           = auth()->user()->id;
            if(Input::get('email_title') != "") { 
                $mail_subject = Input::get('email_title'); 
            } else { 
                $mail_subject = $email_template->email_title; 
            }

            /*$addEmailRecord = ClientEmail::create(array(
                'email_subject'     => $mail_subject,
                'client_id'         => $client->id,
                'email_template_id' => $email_template->id,
                'sent_by'           => $user,
                'sent_date'         => $sent_date
            ));*/

            if($query){
                Mail::send('emails.templates.project', array("email" => $email_template), function($message) use ($email_template, $mail_subject){
                    $message->to(auth()->user()->email, "Be CRM")->subject($mail_subject)
                        ->replyTo(auth()->user()->email, auth()->user()->username);
                    foreach($email_template->attachments as $file){
                        $message->attach($file->filepath);
                    }
                });
                return Redirect::back()
                    ->with('success', '<strong>Congratulations!</strong> The Email was sent Successfully to your email "'.auth()->user()->email.'".');
            } else {
                return Redirect::back()
                    ->with('error', '<strong>Error!</strong> It Appears that the Email Template either no longer exists or the URL Provided is invalid.');
            }

        }
    }
    
    public function postSendSelectedEmail($id){
        $email_template = EmailTemplate::where('id', $id)->where('marked_deleted', false)
                    ->where('published', true)
                    ->where(function($query)
                    {
                        $query->where('expiry_date', '>', date('y-m-d'))
                            ->orWhere('expiry_date', NULL);
                    })
                    ->first();
        if($email_template){
            $email_sent = ($email_template->sent_number + 1);
            $query = $email_template->update(array(
                'sent_number' => $email_sent
            ));

            $sent_date      = date("Y-m-d H:i:s");
            $user           = auth()->user()->id;

            $mail_subject = $email_template->email_title; 

            /*$addEmailRecord = ClientEmail::create(array(
                'email_subject'     => $mail_subject,
                'client_id'         => $client->id,
                'email_template_id' => $email_template->id,
                'sent_by'           => $user,
                'sent_date'         => $sent_date
            ));*/

            if($query){
                Mail::send('emails.templates.project', array("email" => $email_template), function($message) use ($email_template, $mail_subject){
                    $message->to(auth()->user()->email, "Be CRM")->subject($mail_subject)
                        ->replyTo(auth()->user()->email, auth()->user()->username);
                    foreach($email_template->attachments as $file){
                        $message->attach($file->filepath);
                    }
                });
                return Redirect::back()
                    ->with('success', '<strong>Congratulations!</strong> The Email was sent Successfully to your email "'.auth()->user()->email.'".');
            } else {
                return Redirect::back()
                    ->with('error', '<strong>Error!</strong> It Appears that the Email Template either no longer exists or the URL Provided is invalid.');
            }
        } else {
            return Redirect::back()
                    ->with('error', '<strong>Error!</strong> It Appears that the Selected Email Template either no longer exists or the URL Provided is invalid.');
        }

    }
    
    public function postDelete($id){
        $email_template = EmailTemplate::where('id', $id)->where('marked_deleted', false)->first();
        
        if($email_template){
            $user = auth()->user()->id;
            $now_dt = date('Y-m-d H:i:s');
            $op = $email_template->update(array(
                'marked_deleted'    => true,
                'deleted_by'        => $user,
                'deleted_at'        => $now_dt
            ));
            if($op){
                return route('emails-view')
                    ->with('success', '<strong>Congratulations!</strong> The Intended Email Template is Deleted successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Email Template either no longer exists, is already deleted or The URL Provided is invalid.');
        }
    }
    
    public function postRestore($id){
        $email_template = EmailTemplate::where('id', $id)->where('marked_deleted', true)->first();
        
        if($email_template){
            $op = $email_template->update(array(
                'marked_deleted'    => false,
                'deleted_by'        => null,
                'deleted_at'        => null
            ));
            if($op){
                return route('emails-view-single', array($email_template->id))
                    ->with('Success', '<strong>Congratulations!</strong> The Intended Email Template is Restored successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Email Template either no longer exists, is already deleted or The URL Provided is invalid.');
        }
    }

}
