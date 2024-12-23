<?php

namespace App\Domains\Application\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('domains.application.index');
    }
}
