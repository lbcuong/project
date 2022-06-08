<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReorderGuideline;
use App\Models\Goods;
use App\Models\GoodsIssue;

class ReorderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'reorder_quantity',
        'comment',
        'goods_id',
        'reorder_guideline_id',
        'reorderable_type',
        'reorderable_id'
    ];

    public function reorderable()
    {
        return $this->morphTo();
    }

    public function reorder()
    {
        return $this->belongsTo(ReorderGuideline::class);
    }

    public function goods()
    {
        return $this->hasOne(Goods::class,'id','goods_id');
    }

}
