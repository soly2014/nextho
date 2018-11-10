<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProjectUnit extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'project_units'; 
    
    public function Project(){
        return $this->belongsTo('\App\Models\Project', 'project_id');
    }
    public function Type(){
        return $this->belongsTo('\App\Models\UnitType', 'unit_type');
    }
    public function Finish(){
        return $this->belongsTo('\App\Models\Finish', 'unit_finish');
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

}