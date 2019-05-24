<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbstractFinalDecision extends Model
{
    protected $table = 'abstract_final_decision';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_reviewer');
    }
}
