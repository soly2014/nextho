<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
	protected $table= 'developers'; 
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo('\App\Models\user','created_by');
    }
}
