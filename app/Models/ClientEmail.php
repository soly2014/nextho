<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientEmail extends Model  {

    protected $fillable = array('email_subject', 'client_id', 'email_template_id', 'sent_by', 'sent_date', 'marked_deleted', 'deleted_by');
    
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'client_email_template'; 
    
    public function sentBy(){
        return $this->belongsTo('\App\Models\User', 'sent_by');
    }
}