<!-- resources/views/auth/forgot-password.blade.php -->
<x-guest-layout>
    <div class="relative min-h-screen py-12">
        <!-- Overlays -->
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="absolute inset-0 -z-20 bg-gradient-to-b from-black via-[#070b1f] to-[#050713]"></div>

        <div class="max-w-md mx-auto px-6">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">
                    {{ __('Forgot Password') }}
                </h1>
                <p class="mt-2 text-gray-300">
                    {{ __("Saisis ton adresse e-mail et nous t'enverrons un lien pour réinitialiser ton mot de passe.") }}
                </p>
            </div>

            <!-- Card -->
            <div class="mt-8 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg shadow-sky-900/20">
                <div class="mb-4 text-sm text-gray-300">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status
                    class="mb-4 rounded-xl border border-emerald-500/30 bg-emerald-500/10 text-emerald-200 px-4 py-3"
                    :status="session('status')"
                />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label
                            for="email"
                            :value="__('Email')"
                            class="text-gray-200 text-sm uppercase tracking-wider"
                        />
                        <x-text-input
                            id="email"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            placeholder="you@example.com"
                            class="mt-1 w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}" class="text-sm text-sky-400 hover:text-sky-300">
                            {{ __('Back to Login') }}
                        </a>

                        <x-primary-button class="rounded-xl bg-sky-500/90 hover:bg-sky-400 text-white shadow-lg shadow-sky-500/20">
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
