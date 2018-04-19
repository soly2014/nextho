<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubContact extends Model
{

    protected $table = 'sub_contacts';

    protected $guarded = [];


    public function user()
    {
    	return $this->belongsTo('\App\Models\user','user_id');
    }

}
