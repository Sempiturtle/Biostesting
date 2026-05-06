<x-school-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-slate-800">
            {{ __('Enroll New User') }}
        </h2>
        <p class="text-slate-500 mt-1 text-sm">Create a new institutional account for staff or administrators.</p>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="school-card">
            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 uppercase tracking-wide mb-1">Full
                        Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-all outline-none"
                        placeholder="e.g. John Doe">
                    @error('name') <p class="mt-1 text-xs text-red-600 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-sm font-bold text-slate-700 uppercase tracking-wide mb-1">Institutional
                        Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-all outline-none"
                        placeholder="name@aisat.edu.ph">
                    @error('email') <p class="mt-1 text-xs text-red-600 font-bold uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div>
                    <label for="role"
                        class="block text-sm font-bold text-slate-700 uppercase tracking-wide mb-1">Account
                        Authorization</label>

                    @if(isset($fixedRole))
                        {{-- If role is fixed, show a disabled input for display and a hidden input for the form --}}
                        <input type="text"
                            class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-500 outline-none cursor-not-allowed"
                            value="{{ $fixedRole === 'admin' ? 'System Administrator' : 'Standard User / Employee' }}"
                            disabled>
                        <input type="hidden" name="role" value="{{ $fixedRole }}">
                    @else
                        {{-- Otherwise show the normal dropdown --}}
                        <select name="role" id="role"
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-all outline-none bg-white">
                            <option value="user">Standard User / Employee</option>
                            <option value="admin">System Administrator</option>
                        </select>
                    @endif

                    @error('role') <p class="mt-1 text-xs text-red-600 font-bold uppercase">{{ $message }}</p> @enderror
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div>
                        <label for="password"
                            class="block text-sm font-bold text-slate-700 uppercase tracking-wide mb-1">Secure
                            Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-all outline-none">
                        @error('password') <p class="mt-1 text-xs text-red-600 font-bold uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-bold text-slate-700 uppercase tracking-wide mb-1">Verify
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-all outline-none">
                    </div>
                </div>

                {{-- ------------------------------------------------------------
                RFID UID field
                ------------------------------------------------------------ --}}
                <div class="mb-4">
                    <label for="rfid_uid" class="block text-sm font-bold text-slate-700 uppercase mb-1">
                        RFID UID
                    </label>
                    <input id="rfid_uid" name="rfid_uid" type="text" value="{{ old('rfid_uid') }}"
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-all outline-none"
                        placeholder="e.g. 04A224B1C2D3" autocomplete="off">
                    @error('rfid_uid')
                        <p class="mt-1 text-xs text-red-600 font-bold uppercase">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ------------------------------------------------------------
                Fingerprint Template field
                ------------------------------------------------------------ --}}
                <div class="mb-4">
                    <label for="fingerprint_template" class="block text-sm font-bold text-slate-700 uppercase mb-1">
                        Fingerprint Template (Base‑64)
                    </label>
                    <textarea id="fingerprint_template" name="fingerprint_template" rows="4"
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-all outline-none"
                        placeholder="Paste the Base‑64 fingerprint data here">{{ old('fingerprint_template') }}</textarea>
                    @error('fingerprint_template')
                        <p class="mt-1 text-xs text-red-600 font-bold uppercase">{{ $message }}</p>
                    @enderror
                </div>


                <div class="pt-4 border-t flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-slate-500 hover:text-slate-700 text-sm font-bold uppercase tracking-wide">Cancel</a>
                    <button type="submit" class="btn-school btn-accent shadow-lg shadow-amber-200">
                        Create Institutional Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-school-layout>