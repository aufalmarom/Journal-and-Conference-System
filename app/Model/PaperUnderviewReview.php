<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaperUnderviewReview extends Model
{
    protected $table = 'paper_underview_review';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }

}
