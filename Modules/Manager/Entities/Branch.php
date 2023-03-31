<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'tables', 'address', 'open_date'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\BranchFactory::new();
    }
    public function cashiers()
    {
        return $this->hasMany('App\Models\Cashier'::class);
    }
    public function managers()
    {
        return $this->hasOne('App\Models\Manager'::class);
    }
    public function supervisor()
    {
        return $this->hasMany(Supervisor::class);
    }
    public function chef()
    {
        return $this->hasMany(Chef::class);
    }
    public function chef_assistants()
    {
        return $this->hasMany(ChefAssistant::class);
    }
    public function waiters()
    {
        return $this->hasMany(Waiter::class);
    }
    public function delivery_boy()
    {
        return $this->hasMany(DeliveryBoy::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function deliver_orders()
    {
        return $this->hasMany(DeliveryOrder::class);
    }
}
