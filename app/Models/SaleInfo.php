<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SaleInfo extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'sale_info'; 

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    
    public function Transaction(){
        return $this->belongsTo('\App\Models\ClientProperty', 'transaction_id');
    }
    public function Type(){
        return $this->belongsTo('\App\Models\UnitType', 'unit_type');
    }

}