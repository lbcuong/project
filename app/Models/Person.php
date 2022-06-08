<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'gender',
        'birthday',
        'image',
        'user_id'
    ];

    public function getFullNameAttribute() {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}
