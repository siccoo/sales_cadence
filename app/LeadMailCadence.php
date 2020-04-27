<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadMailCadence extends Model
{
    public function lead(){
        return $this->belongsTo(Lead::class, 'user_id', 'id');
    }
}
