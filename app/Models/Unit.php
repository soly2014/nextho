<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Unit extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'units'; 
    
    public function Project(){
        return $this->belongsTo('\App\Models\Project', 'project_id');
    }
    public function Type(){
        return $this->belongsTo('\App\Models\UnitType', 'property_type');
    }
    public function Finish(){
        return $this->belongsTo('\App\Models\Finish', 'finish');
    }
    public function District(){
        return $this->belongsTo('\App\Models\ProjectDistrict', 'district');
    }
    
    public function notes(){
        return $this->morphMany('\App\Models\Note', 'noteable');
    }

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    
    public function saleInfo(){
        return $this->hasOne('\App\Models\ClientProperty', 'unit_id');
    }

}