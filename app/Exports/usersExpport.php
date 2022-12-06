<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class usersExpport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // exprot all user data
        // User::all();
        $data = User::select('id', 'name', 'address', 'city', 'country', 'pincode', 'phone', 'email', 'created_at') -> get();
        return $data;
    }


    public function headings(): array{
        return ['Id', 'Name', 'Address', 'City', 'Country', 'PinCode', 'Phone', 'Email', 'Registered on'];
    }
}
