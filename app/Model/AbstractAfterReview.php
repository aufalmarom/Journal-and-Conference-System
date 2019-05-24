<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbstractAfterReview extends Model
{
    protected $table = 'abstract_after_review';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }

    public function topics()
    {
        return $this->belongsTo('App\Model\Topics', 'topic');
    }


}
