<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignedAbstract extends Model
{
    protected $table = 'assigned_abstract';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_reviewer');
    }

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }
}
