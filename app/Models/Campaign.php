<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Campaign extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'campaigns'; 

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    
    public function campaignStatus(){
        return $this->belongsTo('\App\Models\CampaignStatus', 'status');
    }
    public function campaignType(){
        return $this->belongsTo('\App\Models\CampaignType', 'type');
    }
    
    public function leadSource(){
        return $this->belongsTo('\App\Models\ClientSource', 'source_id');
    }

    public function notes(){
        return $this->morphMany('\App\Models\Note', 'noteable');
    }
    
    public function attachments(){
        return $this->morphMany('\App\Models\Attachment', 'attachable');
    }
    
    public function activities(){
        return $this->morphMany('\App\Models\Activity', 'activitable');
    }
    
    public function clients(){
        return $this->belongsToMany('\App\Models\Client')
            ->withPivot(['member_status', 'id'])
            ->leftJoin('users', 'added_by', '=', 'users.id')
            //->leftJoin('clients', 'client_id', '=', 'clients.id')
            ->select('clients.*', 'users.username as added_by');
    }

}