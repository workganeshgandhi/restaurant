<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryOrderCategories extends Model
{
    use HasFactory;

    protected $fillable = ['subtotal', 'mount', 'delivery_order_id', 'category_id','category_type',];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\DeliveryOrderCategoriesFactory::new();
    }
    public function deliveryorder()
    {
        return $this->belongsTo(DeliveryOrder::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
