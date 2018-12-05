<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Config\Repository as Config;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class RedirectToProvider
{
    public function __invoke(Socialite $socialite)
    {
        return $socialite->driver(config('secret_santa.registration.provider'))->redirect();
    }
}
