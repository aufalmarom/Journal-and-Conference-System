<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = 'paper';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }
}
