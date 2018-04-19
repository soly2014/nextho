<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CampaignClient extends Model  {

    protected $guarded = [];
    
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'campaign_client'; 
    
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    
    public function Client(){
        return $this->belongsTo('\App\Models\Client', 'client_id');
    }
    public function Campaign(){
        return $this->belongsTo('\App\Models\Campaign', 'campaign_id');
    }
}