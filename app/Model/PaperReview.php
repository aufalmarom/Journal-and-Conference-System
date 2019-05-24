<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaperReview extends Model
{
    protected $table = 'paper_review';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }

}
