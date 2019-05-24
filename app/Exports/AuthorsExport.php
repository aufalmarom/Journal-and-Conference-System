<?php

namespace App\Exports;

use App\Model\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuthorsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 3)->select('users.name', 'users.email', 'users.affiliation', 'users.phone', 'users.address')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'E-mail',
            'Affiliation',
            'Phone',
            'Address',
        ];
    }
}
