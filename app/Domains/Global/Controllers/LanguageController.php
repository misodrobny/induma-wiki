<?php

namespace App\Domains\Global\Controllers;

use App\Domains\Global\Enums\AvailableLanguageEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        if (AvailableLanguageEnum::tryFrom($locale)) {
            app()->setLocale(
                locale: $locale
            );
            session()->put('locale', $locale);

            return redirect()->back();
        }

        return redirect()->route('application.dashboard');
    }
}
