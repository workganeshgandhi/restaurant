<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'mount'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\SalaryFactory::new();
    }
    public function supervisor()
    {
        return $this->hasMany(Supervisor::class);
    }
    public function chef()
    {
        return $this->hasMany(Chef::class);
    }
    public function chef_assistant()
    {
        return $this->hasMany(ChefAssistant::class);
    }
    public function waiter()
    {
        return $this->hasMany(Waiter::class);
    }
    public function delivery_boy()
    {
        return $this->hasMany(Waiter::class);
    }
    public function cashier()
    {
        return $this->hasMany('App\Models\Cashier'::class);
    }
    public function manager()
    {
        return $this->hasMany('App\Models\Manager'::class);
    }
}
