<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,Attachment};
use Carbon\Carbon;
use DB;
use PageTitle;
use File;


class AttachmentController extends Controller {
    

    
    /**
     * [postAttachment description]
     * @return [type] [description]
     */
    public function postAttachment(Request $request){


        if($request->file('attachements')){

            $files      =  $request->attachements;
            $fake_name  = $request->fake_name ? true : false;

            $attach_id      = $request->attachable_id;
            $attach_type    = $request->attachable_type;

            $files_path = public_path()."/uploads/".$attach_type;

            if(!File::exists($files_path)) {
                $result = File::makeDirectory($files_path);
            }

            $client_path = $files_path."/".$attach_id;

            if(!File::exists($client_path)) {
                $result = File::makeDirectory($client_path);
            }


            $user = auth()->user()->id;
            
            $units = ["Bytes", "KB", "MB", "GB"];

            foreach($files as $file) {
                $filename   = $file->getClientOriginalName();

                if($fake_name){
                    $extension  = $file->getClientOriginalExtension();
                    $filename = str_random(15).".{$extension}";
                }
                
                $file_ActualSize = $file->getSize();
                $file_Size = $file_ActualSize;
                
                $unit_itr = 0;
                while($file_Size > 1024){
                    $file_Size = $file_Size/1024;
                    ++$unit_itr;
                }
                
                $file_with_unit = round( $file_Size, 1, PHP_ROUND_HALF_UP).' '.$units[$unit_itr];

                $file->move($client_path, $filename);

                $filepath = $client_path."/".$filename;
                
                $attachments = Attachment::create(array(
                    'filename'          => $filename,
                    'filepath'          => $filepath,
                    'attached_by'       => $user,
                    'attachment_owner'  => $user,
                    'marked_deleted'    => false,
                    'size'              => $file_with_unit,
                    'attachable_id'     => $attach_id,
                    'attachable_type'   => 'App\Models\\'.$attach_type
                ));
            }
            
            $now_dt = date('Y-m-d H:i:s');
            if($attachments->attachable_type == "App\Models\Client"){
                if($attachments->attachable->newly_assigned){
                    $attachments->attachable->update(array(
                        'last_updated'  => $now_dt
                    ));
                } else {
                    $attachments->attachable->update(array(
                        'last_updated'  => $now_dt
                    ));
                }
            } else {
                $attachments->attachable->update(array(
                    'last_updated'  => $now_dt
                ));
            }
            
                session()->flash('success', '<strong>Congratulations!</strong> The File(s) has been Successfully Uploaded.');
            return back();
        } else {
                session()->flash('error', '<strong>Error!</strong> you have to choose files first to upload.');
            return back();
        }
        
    }
    


    /**
     * [getDownload description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDownload($id){
        
        $user = auth()->user()->id;
        
        if(auth()->user()->userRole->download_any_attachment){
            $file = Attachment::where('id', $id)->first();
        } else {
            $file = Attachment::where('id', $id)->where('marked_deleted', false)->first();
        }
        
        if($file){
            $filePath = $file->filepath;
            return response()->download($filePath, $file->filename);
        } else {
                    session()->flash('error', '<strong>Error!</strong> File Not Found, The File Doesn\'t exist anymore or The URL Provided is invalid');
            return back();
        }
    }
    

    /**
     * [getDelete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDelete($id){
        
        $user = auth()->user()->id;
        
        if(auth()->user()->userRole->delete_any_attachment){
            $file = Attachment::where('id', $id)->where('marked_deleted', false)->first();
            //dd($file);
        } else {
            $file = Attachment::where('id', $id)->where('marked_deleted', false)->where('attached_by', $user)->where('attachment_owner', $user)->first();
        }
        
        $now_dt = date('Y-m-d H:i:s');
        
        if($file){
            $query = $file->update([
                'marked_deleted'    => true,
                'deleted_by'        => $user,
                'deleted_at'        => $now_dt
            ]);
            if($query){
                        session()->flash('success', '<strong>Congratulations!</strong> The File "'.$file->filename.'" is deleted successfully.');
                return back();
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> File Not Found, The File Doesn\'t exist anymore or The URL Provided is invalid');
            return back();
        }
        
    }   

    /**
     * [getRestore description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getRestore($id){
        
        $user = auth()->user()->id;
        
        if(auth()->user()->userRole->restore_any_attachment){
            $file = Attachment::where('id', $id)->where('marked_deleted', true)->first();
        } else {
            $file = Attachment::where('id', $id)->where('marked_deleted', true)->where('attached_by', $user)->where('attachment_owner', $user)->first();
        }
        
        if($file){
            $query = $file->update([
                'marked_deleted'    => false,
                'deleted_by'        => null,
                'deleted_at'        => null
            ]);
            if($query){
                      session()->flash('success', '<strong>Congratulations!</strong> The File "'.$file->filename.'" is Restored successfully.');
                return back();
            }
        } else {
                  session()->flash('error', '<strong>Error!</strong> File Not Found, The File Doesn\'t exist anymore or The URL Provided is invalid');
            return back();
        }
        
    }
    
}