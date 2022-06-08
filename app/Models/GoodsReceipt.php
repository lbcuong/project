<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReorderItem;
use Carbon\Carbon;

class GoodsReceipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'from_date',
        'warehouse_id',
        'reorder_id',
        'supplier_id',
        'customer_name',
        'phone',
        'image'
    ];


    public function items()
    {
        return $this->morphMany(ReorderItem::class, 'reorderable');
    }

    public function getFromDateAttribute( $value ) {
       return  $this->attributes['date'] = (new Carbon($value))->format('d-m-Y');
    }
}
