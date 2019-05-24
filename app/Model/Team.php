<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $table = 'team';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user');
    }

    public function paper()
    {
        return $this->belongsTo('App\Model\Submissions', 'team_code', 'team_code');
    }

}
