<aside class="school-sidebar">
    <div class="p-6 flex items-center gap-3">
        <div class="bg-white p-1.5 rounded-lg shadow-sm">
            <x-application-logo class="w-8 h-8 text-slate-800" />
        </div>
        <div>
            <h1 class="text-xl font-bold tracking-tight text-white leading-none">AISAT</h1>
            <p class="text-[10px] uppercase tracking-widest text-slate-400 mt-1">Institutional Portal</p>
        </div>
    </div>

    <nav class="flex-1 mt-4 px-2 space-y-1">


        @if(Auth::user()->role === 'admin')
            <div class="px-4 mt-8 mb-2 text-[10px] uppercase tracking-widest text-slate-500 font-bold">Administration</div>
            
            <x-school-sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span>Admin Console</span>
            </x-school-sidebar-link>

            <x-school-sidebar-link :href="route('admin.admins.index')" :active="request()->routeIs('admin.admins.*')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span>Administrators</span>
            </x-school-sidebar-link>

            <x-school-sidebar-link :href="route('admin.employees.index')" :active="request()->routeIs('admin.employees.*')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span>Employees</span>
            </x-school-sidebar-link>

            <div class="px-4 mt-8 mb-2 text-[10px] uppercase tracking-widest text-slate-500 font-bold">Attendance</div>

            <x-school-sidebar-link :href="route('admin.attendance.index')" :active="request()->routeIs('admin.attendance.*')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Attendance Dashboard</span>
            </x-school-sidebar-link>
        @endif
    </nav>

    <div class="p-4 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-sm text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</aside>