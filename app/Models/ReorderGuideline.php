<?php

namespace App\Models;

use App\Models\ReorderItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goods;
class ReorderGuideline extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'from_date',
        'thru_date',
        'reorder_level',
        'user_id',
        'warehouse_id',
        'is_approve',
        'comment',
        'approve_comment'
    ];

    public function items()
    {
        return $this->morphMany(ReorderItem::class, 'reorderable');
    }
    public function getFromDateAttribute( $value ) {
        return  $this->attributes['date'] = (new Carbon($value))->format('d-m-Y');
    }

    public function getThruDateAttribute( $value ) {
        return  $this->attributes['date'] = (new Carbon($value))->format('d-m-Y');
    }
}
