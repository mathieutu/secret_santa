<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'receiver_id'
    ];

    protected static function boot()
    {
        static::created(function (self $user) {
            $user->notify(new \App\Notifications\AccountRegistered);
        });
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
