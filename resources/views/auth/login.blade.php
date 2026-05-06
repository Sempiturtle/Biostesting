<x-guest-school-layout>
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-slate-800">Welcome Back</h3>
        <p class="text-slate-500 text-sm mt-1">Sign in to your institutional account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="e.g. name@aisat.edu.ph" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-slate-800 focus:ring-slate-800 transition-all" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-slate-500 cursor-pointer">Keep me signed in</label>
        </div>

        <button type="submit" class="btn-auth">
            Sign In to Portal
        </button>
    </form>
</x-guest-school-layout>

