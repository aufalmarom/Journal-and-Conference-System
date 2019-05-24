<?php

namespace App\Exports;

use App\Model\Submissions;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbstractsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('layouts/administratorset/recapabstract', [
            'datas' => Submissions::get()
        ]);
    }
}
