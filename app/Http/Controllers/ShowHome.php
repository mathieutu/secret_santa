<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowHome
{
    private const ERRORS_VIEWS = [
        \App\Exceptions\SocialiteError::class => 'error',
        \App\Exceptions\EmailNotAllowedError::class => 'error-email',
        \App\Exceptions\RegistrationClosedError::class => 'too-late',
    ];

    public function __invoke(Request $request, Session $session)
    {
        if ($session->has('error')) {
            return $this->errorView($session);
        }

        if ($user = $request->user()) {
            return view('confirmation')->with([
                'user' => $user,
                'img' => snake_case($user->city) . '.gif',
                'alreadyKnown' => !$user->wasRecentlyCreated,
            ]);
        }

        return view('welcome');
    }

    private function errorView(Session $session): View
    {
        return view(self::ERRORS_VIEWS[$session->get('error')])
            ->with([
                'user' => $session->get('user'),
            ]);
    }
}
