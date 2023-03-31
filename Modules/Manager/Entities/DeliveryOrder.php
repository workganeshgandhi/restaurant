<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryOrder extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'name', 'mobile', 'address', 'branch_id', 'offer_id', 'delivery_boy_id', 'deliveryFees', 'cashier_id', 'total_price'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\DeliveryOrderFactory::new();
    }
    public function delivery_order_categories()
    {
        return $this->hasMany(DeliveryOrderCategories::class);
    }
    public function cashier()
    {
        return $this->belongsTo('App\Models\Cashier'::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function delivery_boy()
    {
        return $this->belongsTo(DeliveryBoy::class);
    }
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
