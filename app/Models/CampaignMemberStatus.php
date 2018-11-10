<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignMemberStatus extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'campaign_member_status'; 
    
    public function clients(){
        //Has Many Through
    }

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
}