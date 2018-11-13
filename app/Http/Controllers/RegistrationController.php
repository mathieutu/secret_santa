<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Config\Repository as Config;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
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
                'user' => null,
            ]);
        }

        $email = $socialiteUser->getEmail();
        $firstName = Str::title($socialiteUser['firstName']);

        if (!$this->emailAllowed($socialiteUser)) {
            return redirect('/')->with([
                'error' => \App\Exceptions\EmailNotAllowedError::class,
                'user' => new User([
                    'email' => $email,
                    'name' => $firstName,
                ]),
            ]);
        }

        $user = User::firstOrCreate([
            'email' => $email,
        ], [
            'name' => $firstName,
            'city' => $socialiteUser['city'],
        ]);

        return redirect()->route('home')->with(compact('user'));
    }

    protected function emailAllowed(SocialiteUser $user): bool
    {
        return preg_match('/' . $this->config['domain'] . '/', $user->getEmail());
    }
}
