<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Parental\HasChildren;
use App\Casts\DateCast;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Traits\Notifiable, HasChildren;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'type',
        'sex',
        'born_at',
    ];

    protected $childTypes = [
        'admin' => Admin::class,
        'customer' => Customer::class,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => DateCast::class,
        'updated_at' => DateCast::class,
        'born_at' => 'date:Y-m-d',
    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getNotificationCountAttribute()
    {
        return $this->unreadNotifications()->count();
    }
}
