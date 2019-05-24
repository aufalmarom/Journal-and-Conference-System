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

    public function abstractscore()
    {
        return $this->hasMany('App\Model\AbstractScore', 'id_paper', 'id_paper');
    }

    public function abstractfinaldecision()
    {
        return $this->hasMany('App\Model\AbstractFinalDecision', 'id_paper', 'id_paper');
    }

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }

    public function abstractafterreview()
    {
        return $this->hasMany('App\Model\AbstractAfterReview', 'id_paper', 'id_paper');
    }
}
