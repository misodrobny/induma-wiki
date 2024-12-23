<?php

namespace App\Domains\Application\Global\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect()->route('login');

    }
}
