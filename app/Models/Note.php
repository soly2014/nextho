<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Note extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'notes'; 
    
    public function noteable(){
        return $this->morphTo();
    }
    
    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }

    public function action(){
        return $this->morphMany('\App\Models\UserAction', 'actionable');
    }
}