<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProjectDistrict extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'project_district'; 
    
    public function projects(){
        return $this->hasMany('\App\Models\Project', 'district');
    }

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }

}