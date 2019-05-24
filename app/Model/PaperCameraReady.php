<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaperCameraReady extends Model
{
    protected $table = 'paper_camera_ready';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }
}
