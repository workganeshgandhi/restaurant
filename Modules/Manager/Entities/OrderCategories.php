<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCategories extends Model
{
    use HasFactory;

    protected $fillable = ['subtotal', 'mount', 'order_id', 'category_id', 'category_type'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\OrderCategoriesFactory::new();
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
