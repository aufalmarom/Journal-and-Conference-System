<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    public $table = 'submissions';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user');
    }

    public function reviewer()
    {
        return $this->hasMany('App\Model\AssignedAbstract', 'id_paper', 'id');
    }

    public function team()
    {
        return $this->hasMany('App\Model\Team', 'team_code', 'team_code');
    }

    public function assignedabstract()
    {
        return $this->hasMany('App\Model\AssignedAbstract', 'id_paper', 'id');
    }

    public function topics()
    {
        return $this->belongsTo('App\Model\Topics', 'topic');
    }
}
