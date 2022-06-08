<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReorderGuideline;
use App\Models\ReorderItem;
use App\Models\Product;
use App\Models\MeasuringUnitConversion;
class Goods extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'reorder_guideline_id'
    ];

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

    public function reorder(){
        return $this->hasOne(ReorderGuideline::class,'id','reorder_guideline_id');
    }

    public function measuringUnitConversion(){
        return $this->hasOne(MeasuringUnitConversion::Class);
    }

    public function reorderItems(){
        return $this->hasMany(ReorderItem::Class);
    }

}
