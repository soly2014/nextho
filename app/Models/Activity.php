<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'activities'; 
    
    public function activitable(){
        return $this->morphTo();
    }
    
    public function activityType(){
        return $this->belongsTo('\App\Models\ActivityType', 'type');
    }
    public function activityStatus(){
        return $this->belongsTo('\App\Models\ActivityStatus', 'status');
    }
    
    public function clientBelongsTo(){
        return $this->belongsTo('\App\Models\Client', 'activitable_id');
    }
    
    public function owner(){
        return $this->belongsTo('\App\Models\User', 'activity_owner');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userClosed(){
        return $this->belongsTo('\App\Models\User', 'closed_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    
    public function action(){
        return $this->morphMany('\App\Models\UserAction', 'actionable');
    }

}