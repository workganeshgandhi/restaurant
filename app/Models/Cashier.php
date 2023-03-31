<?php

namespace App\Models;

use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Salary;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Cashier\Auth\VerifyEmail;
use App\Notifications\Cashier\Auth\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cashier extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'mobile', 'salary_id', 'branch_id', 'join_date', 'salary_state', 'national_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function salary()
    {
        return $this->belongsTo(salary::class);
    }

}
