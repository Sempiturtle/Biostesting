<x-school-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-slate-800">
            {{ __('Account Settings') }}
        </h2>
        <p class="text-slate-500 mt-1 text-sm">Manage your institutional profile and security preferences.</p>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        <div class="school-card">
            <div class="max-w-xl">
                <h3 class="text-xl font-bold text-slate-800 mb-6">Profile Information</h3>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="school-card">
            <div class="max-w-xl">
                <h3 class="text-xl font-bold text-slate-800 mb-6">Security Update</h3>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="school-card border-red-100 bg-red-50/10">
            <div class="max-w-xl">
                <h3 class="text-xl font-bold text-red-800 mb-6">Danger Zone</h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-school-layout>

