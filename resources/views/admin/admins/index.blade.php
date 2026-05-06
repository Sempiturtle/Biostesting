<x-school-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-slate-800">
                {{ __('Administrative Staff') }}
            </h2>
            <a href="{{ route('admin.admins.create') }}" class="btn-school btn-accent">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Appoint Administrator
            </a>
        </div>
    </x-slot>

    <div class="school-card p-0 overflow-hidden">
        <div class="p-6 border-b bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">System Administrators</h3>
            <p class="text-sm text-slate-500">Users with full access to institutional management tools.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-6 py-4">Administrator</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="h-10 w-10 rounded-full shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=0f172a&color=fff" alt="">
                                <div class="font-bold text-slate-800">{{ $admin->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $admin->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-slate-900 text-white rounded text-[10px] font-bold uppercase tracking-wider">Super Admin</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $admin) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</a>
                                @if(Auth::id() !== $admin->id)
                                <form action="{{ route('admin.users.destroy', $admin) }}" method="POST" onsubmit="return confirm('Revoke admin access?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase">Revoke</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                            No administrators found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-school-layout>
