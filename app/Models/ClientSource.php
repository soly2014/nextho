<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientSource extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'client_source'; 
    
    public function Clients(){
        return $this->hasMany('\App\Models\Client', 'client_source_id');
    }

    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    public function userUpdated(){
        return $this->belongsTo('\App\Models\User', 'updated_by');
    }
    
    public function clientsCount()
    {
        return $this->hasOne('\App\Models\Client', 'client_source_id')
            ->selectRaw('client_source_id, count(*) as aggregate')
            ->groupBy('client_source_id');
    }  
    public function customersCount()
    {
        return $this->hasOne('\App\Models\Client', 'client_source_id')
                    ->selectRaw('client_source_id, count(*) as aggregate')
                    ->where('is_customer', true)
                    ->groupBy('client_source_id');
    }  
    
    public function leadsCount()
    {
        return $this->hasOne('\App\Models\Client', 'client_source_id')
            ->selectRaw('client_source_id, count(*) as aggregate')
            ->where('is_customer', false)
            ->groupBy('client_source_id');
    } 
    
    public function getClientsCountAttribute()
    {
      // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('clientsCount', $this->relations)) 
            $this->load('clientsCount');

        $related = $this->getRelation('clientsCount');

      // then return the count directly
      return ($related) ? (int) $related->aggregate : 0;
    }
    
    public function getCustomersCountAttribute()
    {
      // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('customersCount', $this->relations)) 
            $this->load('customersCount');

        $related = $this->getRelation('customersCount');

      // then return the count directly
      return ($related) ? (int) $related->aggregate : 0;
    }
    public function getLeadsCountAttribute()
    {
      // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('leadsCount', $this->relations)) 
            $this->load('leadsCount');

        $related = $this->getRelation('leadsCount');

      // then return the count directly
      return ($related) ? (int) $related->aggregate : 0;
    }
}