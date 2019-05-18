<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceParticipant extends Model
{
    protected $table = 'invoice_participants';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user');
    }
}
