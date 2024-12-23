<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('application.dashboard', absolute: false));
    }
}; ?>

<div>
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div
                class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div class="flex justify-end w-full">
                    @include('components.language')
                </div>
                <div>
                    <a href="/" wire:navigate>
                        <img src="{{ asset('images/logo_induma.webp') }}" class="h-20 fill-current text-gray-500"/>
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <form wire:submit="login">

                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="relative">
                                <flux:input wire:model="form.email" id="email" type="email" :label="__('application.pages.login.email')" required autofocus
                                            autocomplete="username" icon="at-symbol"/>
                            </div>
                            <div class="relative">
                                <flux:input wire:model="form.password" id="password" type="password" :label="__('application.pages.login.password')" required
                                            autocomplete="current-password" icon="lock-closed"/>
                            </div>
                            <div class="relative">
                                <div class="block mt-4">
                                    <label for="remember" class="inline-flex items-center">
                                        <flux:switch class="data-[checked]:!bg-primary-800" wire:model.live="form.remember" id="remember" name="remember" :label="__('application.pages.login.remember_me')" />
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                           href="{{ route('password.request') }}" wire:navigate>
                                            {{ __('application.pages.login.forgot_your_password') }}
                                        </a>
                                    @endif

                                    <flux:button type="submit" variant="primary" class="ms-3 !bg-primary-800 hover:!bg-primary-700">{{ __('application.pages.login.login') }}</flux:button>
                                </div>
                            </div>
                            <div class="relative flex justify-center !mt-8">
                                <div class="text-sm text-center">
                                    &copy; {{ date('Y') }} drobny.dev<br/>
                                    {{ __('application.pages.login.version') }}: {{ ApplicationVersion::getFormatedVersion() }}<br/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

