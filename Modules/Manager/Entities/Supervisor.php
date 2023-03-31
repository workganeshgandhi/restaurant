<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'mobile', 'join_date', 'salary_state', 'national_id', 'branch_id', 'salary_id'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\SupervisorFactory::new();
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function salary()
    {
        return $this->belongsTo(salary::class);
    }
}
