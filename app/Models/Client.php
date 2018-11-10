<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Client extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'clients';

    public function source(){
        return $this->belongsTo('\App\Models\ClientSource', 'client_source_id');
    }

    public function status(){
        return $this->belongsTo('\App\Models\ClientStatus', 'client_status_id');
    }

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }

    /**
     * [userDeleted description]
     * @return [type] [description]
     */
    public function userDeleted(){
        return $this->belongsTo('\App\Models\User', 'deleted_by');
    }
    

    public function userAssigned(){
        return $this->belongsTo('\App\Models\User', 'assigned_to');
    }

    public function district(){
        return $this->belongsTo('\App\Models\ProjectDistrict', 'interested_district');
    }
    public function type(){
        return $this->belongsTo('\App\Models\UnitType', 'interested_type');
    }

    public function notes(){
        return $this->morphMany('\App\Models\Note', 'noteable');
    }
    public function Properties(){
        return $this->hasMany('\App\Models\ClientProperty', 'propertable_id');
    }
    public function firstProperty(){
        return $this->belongsTo('\App\Models\ClientProperty', 'first_property');
    }
    public function propertiesCount()
    {
        return $this->hasOne('\App\Models\ClientProperty', 'propertable_id')
            ->selectRaw('propertable_id, count(*) as aggregate')
            ->where('approved', true)
            ->groupBy('propertable_id');
    }
    public function getPropertiesCountAttribute()
    {
      // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('propertiesCount', $this->relations))
          $this->load('propertiesCount');

        $related = $this->getRelation('propertiesCount');

      // then return the count directly
      return ($related) ? (int) $related->aggregate : 0;
    }

    public function propertiesAmount()
    {
        return $this->hasOne('\App\Models\ClientProperty', 'propertable_id')
            ->selectRaw('sum(price) as aggregate, propertable_id')
            ->where('approved', true)
            ->groupBy('propertable_id');
    }
    public function getPropertiesAmountAttribute()
    {
      // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('propertiesAmount', $this->relations))
            $this->load('propertiesAmount');

        $related = $this->getRelation('propertiesAmount');

      // then return the count directly
      return ($related) ? (int) $related->aggregate : 0;
    }

    public function attachments(){
        return $this->morphMany('\App\Models\Attachment', 'attachable');
    }

    public function activities(){
        return $this->morphMany('\App\Models\Activity', 'activitable');
    }

    public function campaigns(){
        /*return $this->belongsToMany('Campaign')
            ->withPivot(['member_status', 'id', 'marked_deleted', 'deleted_at']);*/
        return $this->belongsToMany('\App\Models\Campaign')
            ->withPivot(['member_status', 'id', 'marked_deleted', 'deleted_at'])
            ->leftJoin('users', 'campaign_client.deleted_by', '=', 'users.id')
            ->leftJoin('campaign_status', 'campaigns.status', '=', 'campaign_status.id')
            ->leftJoin('campaign_types', 'campaigns.type', '=', 'campaign_types.id')
            ->select('users.username', 'campaign_client.*', 'campaign_status.label as rel_status', 'campaign_types.label as rel_type', 'campaigns.*');
    }
    public function emails(){
        return $this->belongsToMany('\App\Models\EmailTemplate')
            ->withPivot(['id', 'sent_by', 'sent_Date', 'email_subject'])
            ->leftJoin('users', 'sent_by', '=', 'users.id')
            //->leftJoin('email_templates', 'email_template_id', '=', 'email_templates.id')
            ->select('users.username', 'email_templates.*');
    }

    public function assignHistory(){
        return $this->hasMany('\App\Models\ClientUser', 'client_id');
    }

    public function action(){
        return $this->morphMany('\App\Models\UserAction', 'actionable');
    }

    //////////////////////////////////////////////////
    //////                                    ////////
    //////                                    ////////
    //////////////////////////////////////////////////
    
    public function developers(){
        return $this->belongsToMany('\App\Models\Developer', 'clients_developers','client_id','developer_id');
    }

    
    public function projects(){
        return $this->belongsToMany('\App\Models\ParameterProject','clients_projects', 'client_id','project_id');
    }

    public function sub(){
        return $this->hasMany('\App\Models\SubContact', 'user_id');
    }



}
