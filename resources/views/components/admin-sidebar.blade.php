<div class="bg-slate-900 text-white w-64 min-h-screen p-6 shadow-2xl flex flex-col">
    <div class="mb-8 border-b border-slate-800 pb-4">
        <h2 class="text-xl font-black text-white tracking-tighter uppercase italic">AISAT <span class="text-amber-500">PAYROLL</span></h2>
        <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest mt-1">Intelligence Console</p>
    </div>

    <nav class="space-y-6 flex-1">
        
        <!-- Dashboard -->
        <div>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 border-l-4 border-amber-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} rounded transition-all duration-200">
                <span class="text-lg">📊</span>
                <span class="text-sm font-bold uppercase tracking-tight">Dashboard</span>
            </a>
        </div>

        <!-- Attendance & Relief -->
        <div>
            <p class="text-slate-600 text-[10px] uppercase mb-3 font-black tracking-widest">Operations</p>
            <div class="space-y-1">
                <a href="{{ route('admin.attendance.index') }}"
                    class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.attendance.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} rounded transition-all">
                    <span class="text-lg">⏱️</span>
                    <span class="text-sm font-bold">Kiosk Monitor</span>
                </a>
                <a href="{{ route('admin.relief.index') }}"
                    class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.relief.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} rounded transition-all">
                    <span class="text-lg">🧠</span>
                    <span class="text-sm font-bold">Relief Engine</span>
                </a>
            </div>
        </div>

        <!-- Management -->
        <div>
            <p class="text-slate-600 text-[10px] uppercase mb-3 font-black tracking-widest">Management</p>
            <div class="space-y-1">
                <a href="{{ route('admin.employees.index') }}"
                    class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.employees.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} rounded transition-all">
                    <span class="text-lg">👥</span>
                    <span class="text-sm font-bold">Professors</span>
                </a>
                <a href="{{ route('admin.payroll.index') }}"
                    class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.payroll.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} rounded transition-all">
                    <span class="text-lg">💰</span>
                    <span class="text-sm font-bold">Payroll Center</span>
                </a>
            </div>
        </div>

        <!-- System -->
        <div>
            <p class="text-slate-600 text-[10px] uppercase mb-3 font-black tracking-widest">System</p>
            <div class="space-y-1">
                <a href="{{ route('admin.admins.index') }}"
                    class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.admins.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} rounded transition-all">
                    <span class="text-lg">🛡️</span>
                    <span class="text-sm font-bold">Administrators</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Logout -->
    <div class="mt-auto pt-6 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 p-3 text-red-400 hover:bg-red-500/10 rounded transition-all">
                <span class="text-lg">🚪</span>
                <span class="text-sm font-bold uppercase tracking-tight">Logout</span>
            </button>
        </form>
    </div>
</div>