<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CampaignType extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'campaign_types'; 
    
    public function campaigns(){
        return $this->hasMany('\App\Models\Campaign', 'type');
    }

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }

}