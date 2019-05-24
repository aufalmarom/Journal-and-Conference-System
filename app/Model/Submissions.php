<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    public $table = 'submissions';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user');
    }

    public function reviewer()
    {
        return $this->hasMany('App\Model\AssignedAbstract', 'id_paper', 'id');
    }

    public function team()
    {
        return $this->hasMany('App\Model\Team', 'team_code', 'team_code');
    }

    public function assignedabstract()
    {
        return $this->hasMany('App\Model\AssignedAbstract', 'id_paper', 'id');
    }

    public function topics()
    {
        return $this->belongsTo('App\Model\Topics', 'topic');
    }

    public function invoice_paper()
    {
        return $this->belongsTo('App\Model\InvoicePaper', 'id');
    }

    public function paper()
    {
        return $this->hasMany('App\Model\Paper', 'id_paper', 'id');
    }

    public function paperreview()
    {
        return $this->hasMany('App\Model\PaperReview', 'id_paper', 'id');
    }

    public function paperunderview()
    {
        return $this->hasMany('App\Model\PaperUnderview', 'id_paper', 'id');
    }

    public function paperunderviewreview()
    {
        return $this->hasMany('App\Model\PaperUnderviewReview', 'id_paper', 'id');
    }

    public function papercameraready()
    {
        return $this->hasMany('App\Model\PaperCameraReady', 'id_paper', 'id');
    }

    public function ppt()
    {
        return $this->hasMany('App\Model\Powerpoint', 'id_paper', 'id');
    }

    public function invoicepaper()
    {
        return $this->hasOne('App\Model\InvoicePaper', 'id_paper', 'id');
    }

    public function auth_info()
    {
        return $this->hasOne('App\Model\AuthorInfo', 'id_user', 'id_user');
    }

    public function pub_at()
    {
        return $this->belongsTo('App\Model\PublicationSubmissions', 'publication');
    }



}
