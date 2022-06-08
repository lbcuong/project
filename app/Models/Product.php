<?php

namespace App\Models;

use App\Models\MeasuringUnit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
use App\Models\ProductCost;
use App\Models\ProductPrice;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'name_other',
        'description',
        'cluster',
        'color',
        'size',
        'warranty',
        'product_group_id',
        'product_category_id',
        'measuring_unit_id',
        'measuring_unit_conversion_id',
        'producer_id',
        'warehouse_id',
        'barcode',
        'image',
        'comment',
        'limit',
        'storage_time',
        'productable_type',
        'productable_id',
        'introduction_date',
        'sales_discontinuation_date'
    ];

    public function productable()
    {
        return $this->morphTo();
    }


}
