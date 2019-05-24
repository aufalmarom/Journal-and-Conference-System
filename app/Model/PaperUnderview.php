<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaperUnderview extends Model
{
    protected $table = 'paper_underview';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }
}
