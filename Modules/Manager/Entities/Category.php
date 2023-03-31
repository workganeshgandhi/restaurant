<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['images', 'price', 'main_category_id'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\CategoryFactory::new();
    }
    public function main_category()
    {
        return $this->belongsTo(MainCategory::class);
    }
    public function order_categories()
    {
        return $this->belongsToMany(OrderCategories::class, 'order_categories');
    }
    public function delivery_order_categories()
    {
        return $this->belongsToMany(DeliveryOrderCategories::class, 'delivery_order_categories');
    }
}
