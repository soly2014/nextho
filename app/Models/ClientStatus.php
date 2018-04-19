<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientStatus extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'client_status'; 
    
    public function clients(){
        return $this->hasMany('\App\Models\Client', 'client_status_id');
    }

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }

}