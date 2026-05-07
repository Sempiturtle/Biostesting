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

                {{-- Compensation Section --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-slate-50 rounded-xl border border-slate-200">
                    <div>
                        <label for="basic_salary" class="block text-sm font-bold text-slate-700 uppercase mb-1">Monthly Basic Salary</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-slate-400 font-bold">₱</span>
                            <input type="number" step="0.01" name="basic_salary" id="basic_salary" value="{{ old('basic_salary') }}"
                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 outline-none"
                                placeholder="0.00">
                        </div>
                        @error('basic_salary') <p class="mt-1 text-xs text-red-600 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="hourly_rate" class="block text-sm font-bold text-slate-700 uppercase mb-1">Hourly Rate</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-slate-400 font-bold">₱</span>
                            <input type="number" step="0.01" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate') }}"
                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 outline-none"
                                placeholder="0.00">
                        </div>
                        @error('hourly_rate') <p class="mt-1 text-xs text-red-600 font-bold uppercase">{{ $message }}</p> @enderror
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

                <!-- Schedule Upload Section -->
                <div class="mt-8 p-6 bg-slate-50 rounded-xl border border-slate-200">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-4">Professor's Schedule
                    </h3>

                    <!-- Visual Example -->
                    <div class="mb-6">
                        <p class="text-xs font-bold text-slate-500 uppercase mb-2">Required Format (CSV/Excel):</p>
                        <div class="overflow-hidden rounded-lg border border-slate-200 shadow-sm">
                            <table class="w-full text-left text-xs bg-white">
                                <thead class="bg-slate-100 text-slate-600">
                                    <tr>
                                        <th class="px-3 py-2 border-r">day</th>
                                        <th class="px-3 py-2 border-r">start_time</th>
                                        <th class="px-3 py-2">end_time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-3 py-2 border-r border-t">Monday</td>
                                        <td class="px-3 py-2 border-r border-t">07:00 AM</td>
                                        <td class="px-3 py-2 border-t">12:50 PM</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 border-r border-t">Tuesday</td>
                                        <td class="px-3 py-2 border-r border-t">01:10 PM</td>
                                        <td class="px-3 py-2 border-t">10:00 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- File Input -->
                    <div>
                        <label for="schedule_file" class="block text-sm font-bold text-slate-700 uppercase mb-1">Upload
                            Schedule File (.csv)</label>
                        <input type="file" id="schedule_file" name="schedule_file" accept=".csv"
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 bg-white focus:ring-2 focus:ring-slate-800 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-slate-800 file:text-white hover:file:bg-slate-700 cursor-pointer">
                        <p class="mt-2 text-[10px] text-slate-400">Note: Please save your Excel file as <b>CSV (Comma
                                Delimited)</b> before uploading.</p>
                    </div>
                </div>

                <a href="/example_schedule.csv" download class="text-blue-600 underline text-xs">
                    📥 Download Example CSV Template
                </a>




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