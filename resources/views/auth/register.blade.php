<x-guest-school-layout>
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-slate-800">Account Enrollment</h3>
        <p class="text-slate-500 text-sm mt-1">Join the AISAT Institutional Community</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="input-group">
            <label for="name">Full Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="e.g. John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="input-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@aisat.edu.ph" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Password -->
            <div class="input-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <button type="submit" class="btn-auth">
            Complete Enrollment
        </button>

        <p class="text-center text-sm text-slate-500 mt-8">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-bold text-slate-800 hover:underline">Institutional Login</a>
        </p>
    </form>
</x-guest-school-layout>
