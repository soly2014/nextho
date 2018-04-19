<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model  {

    protected $guarded = [];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'roles'; 
    
    public function Users(){
        return $this->hasMany('\App\Models\User', 'role_id');
    }
    
    public function usersCount()
    {
        return $this->hasOne('\App\Models\User', 'role_id')
            ->selectRaw('role_id, count(*) as aggregate')
            ->groupBy('role_id');
    }
    public function getUsersCountAttribute()
    {
      // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('\App\Models\usersCount', $this->relations)) 
            $this->load('usersCount');

        $related = $this->getRelation('usersCount');

      // then return the count directly
      return ($related) ? (int) $related->aggregate : 0;
    }
    
    public function userCreated(){
        return $this->belongsTo('\App\Models\User', 'created_by');
    }
    

}