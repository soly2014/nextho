<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientUser extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'clients_users'; 

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    
    public function Lead(){
        return $this->belongsTo('\App\Models\Client', 'client_id');
    }
    public function userAssigned(){
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

}