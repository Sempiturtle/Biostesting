<x-school-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-slate-800">
                {{ __('Student Dashboard') }}
            </h2>
            <div class="text-sm text-slate-500">
                Welcome back, <span class="font-semibold text-slate-700">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Welcome Card -->
        <div class="md:col-span-2 school-card bg-gradient-to-br from-slate-900 to-slate-800 text-white border-none overflow-hidden relative">
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-2">Institutional Overview</h3>
                <p class="text-slate-300 mb-6 max-w-md">Welcome to the AISAT Institutional Portal. Your central hub for academic records, employee management, and institutional communications.</p>
                <div class="flex gap-4">
                    <button class="btn-school btn-accent">View Schedule</button>
                    <button class="btn-school bg-white/10 hover:bg-white/20">Read Handbook</button>
                </div>
            </div>
            <!-- Decorative SVG -->
            <div class="absolute right-[-20px] bottom-[-20px] opacity-10">
                <x-application-logo class="w-64 h-64" />
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="school-card flex flex-col justify-between">
            <div>
                <h4 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-4">Quick Stats</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600">Attendance Rate</span>
                        <span class="font-bold text-green-600">98%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600">Active Courses</span>
                        <span class="font-bold text-slate-800">6</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600">Pending Tasks</span>
                        <span class="font-bold text-orange-500">3</span>
                    </div>
                </div>
            </div>
            <button class="mt-6 w-full py-2 text-sm font-semibold text-slate-700 hover:text-slate-900 border-t">View All Activities →</button>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Announcements -->
        <div class="school-card">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                </svg>
                Institutional Announcements
            </h3>
            <div class="space-y-6">
                @for($i = 0; $i < 3; $i++)
                <div class="flex gap-4 group cursor-pointer">
                    <div class="flex-shrink-0 w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500 group-hover:bg-slate-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">Upcoming Thesis Defense Schedule</h4>
                        <p class="text-sm text-slate-500 mt-1">Please be advised that the final thesis defenses will begin on May 15th...</p>
                        <span class="text-[10px] text-slate-400 mt-2 block uppercase font-bold">2 hours ago</span>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="school-card">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Recent Activity
            </h3>
            <div class="relative pl-8 space-y-8 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200">
                <div class="relative">
                    <div class="absolute left-[-29px] top-1 w-3 h-3 rounded-full bg-blue-500 border-2 border-white"></div>
                    <p class="text-sm font-semibold text-slate-800">Biometric Attendance Logged</p>
                    <p class="text-xs text-slate-500">Successfully scanned at Main Entrance Terminal A</p>
                    <span class="text-[10px] text-slate-400 mt-1 block uppercase">08:30 AM Today</span>
                </div>
                <div class="relative">
                    <div class="absolute left-[-29px] top-1 w-3 h-3 rounded-full bg-slate-300 border-2 border-white"></div>
                    <p class="text-sm font-semibold text-slate-800">Profile Updated</p>
                    <p class="text-xs text-slate-500">Changed emergency contact information</p>
                    <span class="text-[10px] text-slate-400 mt-1 block uppercase">Yesterday</span>
                </div>
            </div>
        </div>
    </div>
</x-school-layout>