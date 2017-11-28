<?php

namespace App\Http\Controllers;

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
                ->withUser($session->get('user'));
        }

        if ($session->has('user')) {
            return view('confirmation')->withUser($session->get('user'));
        }

        return view('welcome');
    }
}
