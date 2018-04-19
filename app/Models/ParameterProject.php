<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterProject extends Model
{
	protected $table= 'parameter_projects';
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo('\App\Models\user','created_by');
    }
}
