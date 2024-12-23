<?php

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        Flux::toast(
            text: __('application.pages.profile.notifications.password_changed_text'),
            heading: __('application.pages.profile.notifications.password_changed_heading'),
            variant: 'success',
        );
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('application.pages.profile.update_password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('application.pages.profile.update_password_text') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">

        <div>
            <flux:field>
                <flux:label for="update_password_current_password" class="required">{{ __('application.pages.profile.current_password') }}</flux:label>
                <flux:input wire:model="current_password" id="update_password_current_password" name="current_password" type="password"
                              class="mt-1 block w-full" autocomplete="current-password"/>

                <flux:error name="current_password"/>
            </flux:field>
        </div>

        <div>
            <flux:field>
                <flux:label for="update_password_password" class="required">{{ __('application.pages.profile.new_password') }}</flux:label>
                <flux:input wire:model="password" id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                              autocomplete="new-password"/>
                <flux:error name="password"/>
            </flux:field>
        </div>

        <div>
            <flux:field>
                <flux:label for="update_password_password_confirmation" class="required">{{ __('application.pages.profile.confirm_password') }}</flux:label>
                <flux:input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password"
                              class="mt-1 block w-full" autocomplete="new-password"/>
                <flux:error name="password_confirmation"/>
            </flux:field>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('global.buttons.save') }}</x-primary-button>
        </div>
    </form>
</section>
