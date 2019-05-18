<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AuthorInfo extends Model
{
    protected $table = 'author_info';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user');
    }
}
