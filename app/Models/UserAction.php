<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserAction extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'user_actions'; 

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function Client(){
        return $this->belongsTo('\App\Models\Client', 'client_id');
    }
    
    public function actionable(){
        return $this->morphTo();
    }

}