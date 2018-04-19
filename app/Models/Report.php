<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Report extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'reports'; 

    public function belongsToUser(){
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

}