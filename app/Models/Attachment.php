<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Attachment extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'attachments'; 
    
    public function attachable(){
        return $this->morphTo();
    }
    
    public function userAttached(){
        return $this->belongsTo('\App\Models\User', 'attached_by');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }


}