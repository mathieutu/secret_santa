<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogOut
{
    public function __invoke(Request $request, Session $session)
    {
        try {
            auth()->logout();
        } catch (\Exception $e) {
            // Exception is sent because there is no remember_token column.
            // At the state of this app, we really don't care.
        }

       return redirect('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
    }
}
