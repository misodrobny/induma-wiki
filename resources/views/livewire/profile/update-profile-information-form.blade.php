<?php

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public string $first_given_name = '';
    public ?string $second_given_name = '';
    public string $first_family_name = '';
    public ?string $second_family_name = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->first_given_name = Auth::user()->first_given_name;
        $this->second_given_name = Auth::user()->second_given_name;
        $this->first_family_name = Auth::user()->first_family_name;
        $this->second_family_name = Auth::user()->second_family_name;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'first_given_name' => ['required', 'string', 'max:255'],
            'second_given_name' => ['nullable', 'string', 'max:255'],
            'first_family_name' => ['required', 'string', 'max:255'],
            'second_family_name' => ['nullable', 'string', 'max:255'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        Flux::toast(
            text: __('application.pages.profile.notifications.profile_changed_text'),
            heading: __('application.pages.profile.notifications.profile_changed_heading'),
            variant: 'success',
        );
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('application.dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('application.pages.profile.profile_info') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('application.pages.profile.profile_info_text') }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <flux:field>
                <flux:label for="first_given_name" class="required">{{ __('tables.users.first_given_name') }}</flux:label>
                <flux:input wire:model="first_given_name" id="first_given_name" name="first_given_name" type="text" class="mt-1 block w-full"
                            autocomplete="first_given_name"/>
                <flux:error name="first_given_name"/>
            </flux:field>
        </div>

        <div>
            <flux:field>
                <flux:label for="second_given_name">{{ __('tables.users.second_given_name') }}</flux:label>
                <flux:input wire:model="second_given_name" id="second_given_name" name="second_given_name" type="text" class="mt-1 block w-full"
                            autocomplete="second_given_name"/>
                <flux:error name="second_given_name"/>
            </flux:field>
        </div>

        <div>
            <flux:field>
                <flux:label for="first_family_name" class="required">{{ __('tables.users.first_family_name') }}</flux:label>
                <flux:input wire:model="first_family_name" id="first_family_name" name="first_family_name" type="text" class="mt-1 block w-full"
                            autocomplete="first_family_name"/>
                <flux:error name="first_family_name"/>
            </flux:field>
        </div>

        <div>
            <flux:field>
                <flux:label for="second_family_name">{{ __('tables.users.second_family_name') }}</flux:label>
                <flux:input wire:model="second_family_name" id="second_family_name" name="second_family_name" type="text" class="mt-1 block w-full"
                            autocomplete="second_family_name"/>
                <flux:error name="second_family_name"/>
            </flux:field>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('global.buttons.save') }}</x-primary-button>
        </div>
    </form>
</section>
