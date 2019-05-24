<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbstractReview extends Model
{
    protected $table = 'abstract_review';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_reviewer');
    }

}
