<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

    <div class="w-full max-w-sm bg-white p-8 rounded-2xl shadow-xl mx-auto my-auto">
        <div class="flex flex-col gap-2">
            <div class="text-center mb-1">
                <img src="{{ asset('images/LOGO-PMI-png-1 2.png') }}" alt="Logo" class="mx-auto mb-4 rounded-xl" style="width: 210px; height: 142px; object-fit: contain;">
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />
            <form wire:submit="login" class="flex flex-col gap-6">
                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    :label="__('Email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="example@gmail.com"
                    class="rounded-lg"
                />
                <!-- Password -->
                <div class="relative">
                    <flux:input
                        wire:model="password"
                        :label="__('Password')"
                        type="password"
                        required
                        autocomplete="current-password"
                        :placeholder="__('******')"
                        viewable
                        class="rounded-lg"
                    />
                </div>
                <div class="flex items-center justify-end">
                    <flux:button variant="danger" type="submit" class="w-full rounded-lg">{{ __('Masuk') }}</flux:button>
                </div>
            </form>
        </div>
    </div>

