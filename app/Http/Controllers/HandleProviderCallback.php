<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class HandleProviderCallback extends BaseController
{
    public function __invoke(Socialite $socialite)
    {
        try {
            $socialiteUser = $socialite->driver(config('secret_santa.registration.provider'))->user();
        } catch (\Exception $e) {
            return redirect('/')->with([
                'error' => \App\Exceptions\SocialiteError::class,
            ]);
        }

        $email = $socialiteUser->getEmail();
        $firstName = Str::title($socialiteUser['firstName']);

        if (!$this->emailAllowed($socialiteUser)) {
            return redirect('/')->with([
                'error' => \App\Exceptions\EmailNotAllowedError::class,
                'user' => new User(['email' => $email, 'name' => $firstName]),
            ]);
        }

        $user = User::firstOrCreate([
            'email' => $email,
        ], [
            'name' => $firstName,
            'city' => $socialiteUser['city'],
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }

    protected function emailAllowed(SocialiteUser $user): bool
    {
        return preg_match('/' . config('secret_santa.registration.domain') . '/', $user->getEmail());
    }
}
