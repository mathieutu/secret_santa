<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;

class TooLateRegistration
{
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        if ($this->isTooLate() && !$request->session()->has('error')) {
            return redirect('/')->with(['error' => \App\Exceptions\RegistrationClosedError::class]);
        }

        return $next($request);
    }

    protected function isTooLate(): bool
    {
        return Carbon::now()->gte(Carbon::parse(config('secret_santa.registration.closing_date')));
    }
}
