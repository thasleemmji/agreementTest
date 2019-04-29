<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model {
	
    public function acceptedInfo() {
        return $this->hasMany('App\Models\AcceptedInfo','agreement_id','id');
    }
}
