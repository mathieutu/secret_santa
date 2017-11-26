<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Config\Repository as Config;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class RegistrationController extends Controller
{
    private $socialite;
    private $config;

    public function __construct(Socialite $socialite, Config $config)
    {
        $this->config = $config->get('secret_santa.authentication');
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
                'error' => new \App\Exceptions\SocialiteError,
                'user'  => null,
            ]);
        }

        if (Carbon::now()->gte(Carbon::parse($this->config['closing_date']))) {
            return redirect('/')->with([
                'error' => new \App\Exceptions\RegistrationClosedError,
                'user'  => null,
            ]);
        }

        if (!$this->emailAllowed($socialiteUser)) {
            return redirect('/')->with([
                'error' => new \App\Exceptions\EmailNotAllowedError,
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
