<x-school-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-slate-800">
                {{ __('Administrative Console') }}
            </h2>
            <div class="flex gap-3">
                <button class="btn-school bg-slate-200 text-slate-700 hover:bg-slate-300">Generate Report</button>
                <button class="btn-school btn-accent">System Settings</button>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Employees -->
        <div class="school-card border-l-4 border-l-blue-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Active Employees</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $stats['totalEmployees'] }}</h3>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-slate-400 font-bold mt-4 uppercase">Institutional Personnel</p>
        </div>

        <!-- Attendance Today -->
        <div class="school-card border-l-4 border-l-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Attendance Today</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $stats['presentToday'] }}</h3>
                </div>
                <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-green-600 font-bold mt-4 uppercase italic">Live Presence Tracking</p>
        </div>

        <!-- Pending Payrolls -->
        <div class="school-card border-l-4 border-l-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pending Payroll</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $stats['pendingPayrolls'] }}</h3>
                </div>
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-amber-600 font-bold mt-4 uppercase italic">Awaiting Release</p>
        </div>

        <!-- Active Absences -->
        <div class="school-card border-l-4 border-l-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Active Absences</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $stats['absentNow'] }}</h3>
                </div>
                <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-red-600 font-bold mt-4 uppercase italic">Requires Relief Action</p>
        </div>
    </div>

    <div class="mt-8 school-card p-0 overflow-hidden">
        <div class="p-6 border-b flex items-center justify-between">
            <h3 class="text-xl font-bold text-slate-800">Recent System Activity</h3>
            <span class="text-xs font-black text-slate-400 uppercase tracking-widest italic">Latest Registrations</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Registered</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($recentUsers as $user)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-slate-200 flex items-center justify-center font-black text-slate-500 text-[10px]">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800">{{ $user->name }}</div>
                                    <div class="text-xs text-slate-500 italic lowercase">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded text-[10px] font-bold uppercase tracking-tighter border border-slate-200">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="flex items-center gap-1.5 text-green-600 font-black text-[10px] uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> 
                                Verified
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase">
                            {{ $user->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="4" class="p-8 text-center text-slate-400 italic">No activity recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-school-layout>