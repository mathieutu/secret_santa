<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email',
    ];

    protected static function boot()
    {
        static::created(function (self $user) {
            $user->notify(new \App\Notifications\AccountRegistered);
        });
    }
}
