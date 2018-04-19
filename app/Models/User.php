<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'users';

    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    protected $hidden = array('password', 'remember_token');
    
    /*
    public function client_source(){
        return $this->belongsTo('ClientSource');
    }
    
    public function client_status(){
        return $this->belongsTo('ClientStatus');
    }
    */
    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    
    public function clientsCreated(){
        return $this->hasMany('\App\Models\Client', 'created_by');
    }
    public function clientsAssigned(){
        return $this->hasMany('\App\Models\Client', 'assigned_to');
    }
    public function clientsUpdated(){
        return $this->hasMany('\App\Models\Client', 'last_updated_by');
    }
    
    public function notesCreated(){
        return $this->hasMany('\App\Models\Note', 'created_by');
    }
    public function notesUpdated(){
        return $this->hasMany('\App\Models\Note', 'updated_by');
    }
    
    public function activities(){
        return $this->hasMany('\App\Models\Activity', 'activity_owner');
    }
    
    public function attachmentUploaded(){
        return $this->hasMany('\App\Models\Attachment', 'attached_by');
    }
    public function attachmentDeleted(){
        return $this->hasMany('\App\Models\Attachment', 'deleted_by');
    }
    
    public function userRole(){
        return $this->belongsTo('\App\Models\Role', 'role_id');
    }
    
    public function soldProperties(){
        return $this->hasMany('\App\Models\ClientProperty', 'created_by');
    }
    public function clientsActions(){
        return $this->hasMany('\App\Models\UserAction', 'created_by')->where('object_type', 'App\Models\Client');
    }

}