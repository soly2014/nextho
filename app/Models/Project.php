<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'projects'; 
    
    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    
    public function emails(){
        return $this->hasMany('\App\Models\EmailTemplate', 'project_id');
    }
    
    public function notes(){
        return $this->morphMany('\App\Models\Note', 'noteable');
    }
    
    public function District(){
        return $this->belongsTo('\App\Models\ProjectDistrict', 'district');
    }
    
    public function Units(){
        return $this->hasMany('\App\Models\ProjectUnit', 'project_id');
    }
    

}