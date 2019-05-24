<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbstractReviewRevision extends Model
{
    protected $table = 'abstract_review_revision';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }

    public function abstractfinal()
    {
        return $this->hasMany('App\Model\AbstractFinal', 'id_paper', 'id_paper');
    }
}
