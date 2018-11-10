<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientProperty extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'client_properties'; 
    
    public function Project(){
        return $this->belongsTo('\App\Models\Project', 'project_id');
    }
    public function Unit(){
        return $this->belongsTo('\App\Models\Unit', 'unit_id');
    }
    public function projectUnit(){
        return $this->belongsTo('\App\Models\ProjectUnit', 'unit_id');
    }
    
    public function Client(){
        return $this->belongsTo('\App\Models\Client', 'propertable_id');
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
    
    public function saleInfo(){
        return $this->hasOne('\App\Models\SaleInfo', 'transaction_id');
    }
    

}