<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class MeasuringUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'comment'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
