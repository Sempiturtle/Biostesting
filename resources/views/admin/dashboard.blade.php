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
        <!-- Stat Card 1 -->
        <div class="school-card border-l-4 border-l-blue-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Students</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">1,284</h3>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-green-600 font-bold mt-4 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                +12% from last term
            </p>
        </div>

        <!-- Stat Card 2 -->
        <div class="school-card border-l-4 border-l-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Active Employees</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">86</h3>
                </div>
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-slate-500 font-bold mt-4">2 currently on leave</p>
        </div>

        <!-- Stat Card 3 -->
        <div class="school-card border-l-4 border-l-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Revenue (Monthly)</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">₱245k</h3>
                </div>
                <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-green-600 font-bold mt-4 flex items-center gap-1">On target for Q2</p>
        </div>

        <!-- Stat Card 4 -->
        <div class="school-card border-l-4 border-l-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pending Tasks</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">14</h3>
                </div>
                <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-red-600 font-bold mt-4 flex items-center gap-1">Requires urgent action</p>
        </div>
    </div>

    <div class="mt-8 school-card p-0 overflow-hidden">
        <div class="p-6 border-b flex items-center justify-between">
            <h3 class="text-xl font-bold text-slate-800">Recent User Registrations</h3>
            <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700">View All Users</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @for($i = 0; $i < 5; $i++)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin+{{$i}}&background=random" alt="">
                                <div>
                                    <div class="font-bold text-slate-800">Admin User {{$i}}</div>
                                    <div class="text-xs text-slate-500">admin{{$i}}@aisat.edu.ph</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4"><span class="px-2 py-1 bg-slate-100 text-slate-600 rounded text-[10px] font-bold uppercase">Administrator</span></td>
                        <td class="px-6 py-4"><span class="flex items-center gap-1.5 text-green-600 font-bold text-[10px] uppercase"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Active</span></td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg></button>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</x-school-layout>