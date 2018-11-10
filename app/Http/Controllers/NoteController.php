<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Note,Client};

class NoteController extends Controller {
    

    /**
     * [postNote description]
     * @return [type] [description]
     */
    public function postNote(Request $request){
       

            $validator = $this->validate($request, 
             array(
                 'note_text'  => 'required|max:5120',
             )
            );

            
            $current        = (int)$request->current_note_id;
            $noteable_id    = $request->noteable_id;
            $noteable_type  = 'App\Models\\'.$request->noteable_type;
            $note_text      = $request->note_text;
            $user           = auth()->user()->id;
            

            if($current == 0){

                $note = Note::create(array(
                    'note_text'         => $note_text,
                    'note_owner'        =>  \App\Models\Client::find($noteable_id)->assigned_to,
                    'marked_deleted'    => false,
                    'created_by'        => $user,
                    'updated_by'        => $user,
                    'activity_type'     => (int)$request->activity_type,
                    'noteable_id'       => $noteable_id,
                    'noteable_type'     => $noteable_type,
                ));

                if($note){

                    $now_dt = date('Y-m-d H:i:s');

                    if($note->noteable_type == "App\Models\Client"){
                        if($note->noteable->newly_assigned){
                            $note->noteable->update(array(
                                'last_updated'  => $now_dt
                            ));
                        } else {
                            $note->noteable->update(array(
                                'last_updated'  => $now_dt
                            ));
                        }
                    } else {
                        $note->noteable->update(array(
                            'last_updated'  => $now_dt
                        ));
                    }
                    
                    $now_d  = date('Y-m-d');
                    $note->action()->create(array(
                        'client_id'     =>  $noteable_id,
                        'action_type'   =>  'Create',
                        'object_type'   =>  $noteable_type,
                        'date'          =>  $now_d,
                        'created_by'    =>  $user
                    ));
                    
                    return back();
                }

            } else {


                if(auth()->user()->userRole->modify_any_note){
                    $note = Note::where('id', $current)->first();
                } else {
                    $note = Note::where('id', $current)->where('marked_deleted', false)->where('created_by', $user)->where('note_owner', $user)->first();
                }
                
                if($note){
                    $query = $note->update(array(
                        'note_text'         => $note_text,
                        'activity_type'     => (int)$request->activity_type,
                        'updated_by'        => $user,
                    ));
                    
                    if($query){
                        $now_dt = date('Y-m-d H:i:s');
                        if($note->noteable_type == "Client"){
                            if($note->noteable->newly_assigned){
                                $note->noteable->update(array(
                                    'last_updated'  => $now_dt
                                ));
                            } else {
                                $note->noteable->update(array(
                                    'last_updated'  => $now_dt
                                ));
                            }
                        } else {
                            $note->noteable->update(array(
                                'last_updated'  => $now_dt
                            ));
                        }
                        
                        $now_d  = date('Y-m-d');
                        $note->action()->update(array(
                            'client_id'     =>  $note->noteable_id,
                            'object_type'   =>  $note->noteable_type,
                            'action_type'   =>  'Update',
                            'date'          =>  $now_d,
                            'created_by'    =>  $user
                        ));
                        
                        return back();
                    }
                } else {
                         session()->flash('error', '<strong>Error!</strong> Note ID Mismatch');
                    return back();
                }
            }

	}
    

    /**
     * [getDelete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDelete($id){

        $user = auth()->user()->id;
        if(auth()->user()->userRole->delete_any_note){
            $note = Note::where('id', $id)->where('marked_deleted', 0)->first();
        } else {
            $note = Note::where('id', $id)->where('marked_deleted', 0)->where('created_by', $user)->where('note_owner', $user)->first();
        }
        
        if($note){
            $query = $note->update([
                'marked_deleted'    => true,
                'deleted_by'        => $user
            ]);
            if($query){
                    session()->flash('success', '<strong>Congratulations!</strong> The Note is deleted successfully.');
                return back();
            }
        } else {
                session()->flash('error', '<strong>Error!</strong> Note Not Found, This Note Doesn\'t exist anymore or The URL Provided is invalid');
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
        if(auth()->user()->userRole->restore_any_note){
            $note = Note::where('id', $id)->where('marked_deleted', true)->first();
        } else {
            $note = Note::where('id', $id)->where('marked_deleted', true)->where('created_by', $user)->where('note_owner', $user)->first();
        }
        
        if($note){
            $query = $note->update([
                'marked_deleted'    => false,
                'deleted_by'        => null
            ]);
            if($query){
                    session()->flash('success', '<strong>Congratulations!</strong> The Note is Restored successfully.');
                return back();
            }
        } else {
                session()->flash('error', '<strong>Error!</strong> Note Not Found, is not deleted or The URL Provided is invalid');
            return back();
        }
        
    }

}
