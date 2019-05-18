<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    public $table = 'reviewer';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user');
    }
}
