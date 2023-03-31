<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'discount', 'percentage', 'start_at', 'end_at', 'active'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\OfferFactory::new();
    }
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
