<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbstractScore extends Model
{
    protected $table = 'abstract_score';

    public function submission()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_reviewer');
    }

    public function evaluation()
    {
        return $this->belongsTo('App\Model\Evaluation', 'id_evaluation');
    }

    public function scores()
    {
        return $this->belongsTo('App\Model\Scores', 'id_evaluation');
    }

}
