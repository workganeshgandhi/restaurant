<?php

namespace App\Models;

use App\Notifications\Manager\Auth\ResetPassword;
use App\Notifications\Manager\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Manager extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'address', 'mobile', 'national_id', 'join_date', 'salary_state', 'password', 'salary_id', 'branch_id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    public function branch()
    {
        return $this->belongsTo('Modules\Manager\Entities\Branch'::class);
    }
    public function salary()
    {
        return $this->belongsTo('Modules\Manager\Entities\salary'::class);
    }
}
