<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoicePaper extends Model
{
    public $table = 'invoice_paper';

    public function submissions()
    {
        return $this->belongsTo('App\Model\Submissions', 'id_paper');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_paper');
    }
}
