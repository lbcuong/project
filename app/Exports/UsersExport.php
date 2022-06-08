<?php

namespace App\Exports;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromQuery, WithMapping, WithHeadings
{
    /**
     * @var Invoice $invoice
     */
    public function __construct($userIds)
    {
        $this->userIds = $userIds;
    }

    public function map($user): array
    {
        if($user->email)
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->personalInfo->phone_number ?? '',
            $user->personalInfo->passport_number ?? '',
            $user->personalInfo->birth ?? '',
            $user->personalInfo->address ?? ''
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Phone',
            'Passport',
            'birth',
            'address'
        ];
    }

    public function query()
    {
        return User::query()->whereIn('uuid',$this->userIds);
    }
}
