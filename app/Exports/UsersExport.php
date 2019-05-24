<?php

namespace App\Exports;

use App\Model\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 4)->leftjoin('invoice_participants','users.id', '=', 'invoice_participants.id_user')->select('users.name', 'invoice_participants.no_invoice', 'users.email', 'users.affiliation', 'users.phone', 'users.address')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'No. Invoice',
            'E-mail',
            'Affiliation',
            'Phone',
            'Address',
        ];
    }
}
