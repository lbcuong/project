<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Webpatser\Uuid\Uuid;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row['email']){
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'email_verified_at' => now(),
                'password' => Hash::make($row['password']),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $this->savePersonalInfo($user,$row);
        }

    }

    protected function savePersonalInfo($user,$row){
        $params = [
                    'phone_number'=> $row['phone'],
                    'passport_number' =>$row['passport'],
                    'birth' => Carbon::parse($row['birth'])->format('Y-m-d'),
                    'address' => $row['address'],
                    'user_id' => $user->id
            ];
        $user->personalInfo()->create($params);

    }


}
