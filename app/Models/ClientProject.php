<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientProject extends Model
{

    protected $table = 'clients_projects';

    protected $guarded = [];


    public function user()
    {
    	return $this->belongsTo('\App\Models\user','client_id');
    }

}
