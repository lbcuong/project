<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersPdf implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($users)
    {
        $this->users = $users;
    }

    public function view(): View
    {
        return view('users.exports.pdf', [
            'users' => $this->users
        ]);
    }
}
