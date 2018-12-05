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
       auth()->logout();

       return redirect('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
    }
}
