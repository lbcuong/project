<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReorderItem;
class GoodsIssue extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'thru_date',
        'warehouse_id',
        'customer_name',
        'comment',
        'case_id',
        'user_id',
        'is_approve'
    ];
    public function items()
    {
        return $this->morphMany(ReorderItem::class, 'reorderable');
    }

    public function getThruDateAttribute( $value ) {
        return  $this->attributes['date'] = (new Carbon($value))->format('d-m-Y');
    }
}
