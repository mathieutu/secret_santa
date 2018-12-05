<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (!$this->app->runningInConsole()) {
            if ($this->app->environment('local') && auth()->guest()) {
                auth()->login(User::whereEmail('mathieu.tudisco@link-value.fr')->first());
            }

            if ($this->app->environment('production')) {
                $url->forceScheme('https');
                $this->app['request']->server->set('HTTPS', true);
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
