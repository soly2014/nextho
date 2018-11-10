<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ActivityStatus extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'activity_status'; 
    
    public function activitable(){
        return $this->morphTo();
    }
    
    public function activities(){
        return $this->hasOne('\App\Models\Activity', 'status');
    }
    
    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }


}