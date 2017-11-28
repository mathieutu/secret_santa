<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Config\Repository as Config;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class RegistrationController extends BaseController
{
    private $socialite;
    private $config;

    public function __construct(Socialite $socialite, Config $config)
    {
        $this->config = $config->get('secret_santa.registration');
        $this->socialite = $socialite->driver($this->config['provider']);
    }

    /**
     * Redirect the user to the OAuth authentification page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return $this->socialite->redirect();
    }

    /**
     * Obtain the user information from OAuth Provider.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback()
    {
        try {
            $socialiteUser = $this->socialite->user();
        } catch (RequestException $e) {
            return redirect('/')->with([
                'error' => \App\Exceptions\SocialiteError::class,
                'user'  => null,
            ]);
        }

        if (!$this->emailAllowed($socialiteUser)) {
            return redirect('/')->with([
                'error' => \App\Exceptions\EmailNotAllowedError::class,
                'user'  => new User([
                    'name'  => $socialiteUser[$this->config['user_name_key']],
                    'email' => $socialiteUser->getEmail(),
                ]),
            ]);
        }

        return redirect('/')->withUser(User::firstOrCreate(
            ['email' => $socialiteUser->getEmail()],
            ['name' => $socialiteUser[$this->config['user_name_key']]]
        ));
    }

    protected function emailAllowed(SocialiteUser $user): bool
    {
        return preg_match('/' . $this->config['domain'] . '/', $user->getEmail());
    }
}
