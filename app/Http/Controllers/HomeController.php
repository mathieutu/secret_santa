<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    private const ERRORS_VIEWS = [
        \App\Exceptions\SocialiteError::class => 'error',
        \App\Exceptions\EmailNotAllowedError::class => 'error',
        \App\Exceptions\RegistrationClosedError::class => 'too-late',
    ];

    public function __invoke(Session $session)
    {
        if ($session->has('error')) {
            return view(self::ERRORS_VIEWS[$session->get('error')])
                ->with([
                    'user' => $session->get('user'),
                ]);
        }

        if ($user = $session->get('user')) {
            /** @var User $user */
            return view('confirmation')->with([
                'user' => $user,
                'img' => snake_case($user->city) . '.gif',
                'alreadyKnown' => !$user->wasRecentlyCreated
            ]);
        }

        return view('welcome');
    }
}
