<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Forecast extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'forecast'; 

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    
    public function associatedRole(){
        return $this->belongsTo('\App\Models\Role', 'role_id');
    }

}