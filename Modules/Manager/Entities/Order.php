<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'order_type', 'table', 'branch_id', 'cashier_id', 'offer_id', 'total_price'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\OrderFactory::new();
    }
    public function ordercategories()
    {
        return $this->hasMany(OrderCategories::class);
    }
    public function cashier()
    {
        return $this->belongsTo('App\Models\Cashier'::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

}
