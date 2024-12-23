<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
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
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('application.pages.login.forgot_your_password_text') }}
                </div>
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form wire:submit="sendPasswordResetLink">
                    <!-- Email Address -->
                    <div>
                        <flux:input wire:model="email" id="email" type="email" :label="__('application.pages.login.email')" required autofocus
                                    name="email" icon="at-symbol"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <flux:button type="submit" variant="primary" class="ms-3 !bg-primary-800 hover:!bg-primary-700">
                            {{ __('application.pages.login.email_reset_link') }}
                        </flux:button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
