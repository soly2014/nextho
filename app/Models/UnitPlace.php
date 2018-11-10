<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitPlace extends Model
{
	protected $table= 'unit_places'; 
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo('\App\Models\user','created_by');
    }
}

