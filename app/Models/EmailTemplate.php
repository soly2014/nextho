<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'email_templates'; 
    
    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    
    public function Project(){
        return $this->belongsTo('\App\Models\Project', 'project_id');
    }
    
    public function notes(){
        return $this->morphMany('\App\Models\Note', 'noteable');
    }
    
    public function attachments(){
        return $this->morphMany('\App\Models\Attachment', 'attachable');
    }
    
    public function activities(){
        return $this->morphMany('\App\Models\Activity', 'activitable');
    }
    
    public function clients(){
        return $this->belongsToMany('\App\Models\Client')
            ->withPivot(['id', 'sent_by', 'sent_Date', 'email_subject'])
            ->leftJoin('users', 'sent_by', '=', 'users.id')
            //->leftJoin('clients', 'client_id', '=', 'clients.id')
            ->select('clients.*', 'users.username as user_sent');
    }


}