<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbstractFinal extends Model
{
    protected $table = 'abstract_final';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }


}
