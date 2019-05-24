<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Powerpoint extends Model
{
    public $table = 'powerpoint';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }
}
