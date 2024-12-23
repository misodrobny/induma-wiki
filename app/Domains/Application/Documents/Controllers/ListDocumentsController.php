<?php

namespace App\Domains\Application\Documents\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;

class ListDocumentsController extends Controller
{
    public function __invoke(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('domains.application.documents.index');
    }
}
