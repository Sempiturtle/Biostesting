<x-school-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-slate-800">Relief Intelligence</h2>
                <p class="text-slate-500 text-sm">Real-time absence detection and substitute matching.</p>
            </div>
            <div class="flex items-center space-x-2 bg-green-50 px-4 py-2 rounded-full border border-green-100">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                <span class="text-xs font-black text-green-700 uppercase tracking-widest">Live Monitoring</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- 1. ABSENT PROFESSORS (ALERTS) -->
        <div class="space-y-6">
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center">
                <span class="mr-2 italic">⚠️</span> Current Absences Detected
            </h3>
            
            @forelse($absentProfessors as $absent)
                <div class="school-card border-l-4 border-red-500 bg-red-50/30">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="text-lg font-black text-slate-800">{{ $absent['user']->name }}</h4>
                            <p class="text-xs font-bold text-red-600 uppercase mb-2">Missing Scan for Current Session</p>
                            
                            <div class="flex items-center space-x-4 mt-4">
                                <div class="bg-white px-3 py-2 rounded border border-slate-200">
                                    <p class="text-[9px] text-slate-400 font-black uppercase">Scheduled Block</p>
                                    <p class="text-xs font-bold text-slate-700">
                                        {{ \Carbon\Carbon::parse($absent['schedule']->start_time)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($absent['schedule']->end_time)->format('h:i A') }}
                                    </p>
                                </div>
                                <div class="bg-white px-3 py-2 rounded border border-slate-200">
                                    <p class="text-[9px] text-slate-400 font-black uppercase">Day</p>
                                    <p class="text-xs font-bold text-slate-700">{{ $absent['schedule']->day }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-black text-slate-400 uppercase">Alert Level</span>
                            <div class="text-red-600 font-black text-xl italic">CRITICAL</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="school-card text-center py-12 bg-slate-50 border-dashed">
                    <div class="text-4xl mb-4 text-green-200">✅</div>
                    <p class="text-slate-400 font-bold italic text-sm">All scheduled professors are currently present.</p>
                </div>
            @endforelse
        </div>

        <!-- 2. SMART MATCH (SUBSTITUTES) -->
        <div class="space-y-6">
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center">
                <span class="mr-2 italic">📋</span> Smart Match: Available Substitutes
            </h3>

            <div class="school-card p-0 overflow-hidden">
                <div class="bg-slate-800 p-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Available Right Now</p>
                    <h4 class="text-white text-sm font-bold italic underline decoration-amber-400">Professors with no schedule in this block</h4>
                </div>
                
                <div class="divide-y divide-slate-100">
                    @forelse($availableSubstitutes as $sub)
                        <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center font-black text-slate-500 uppercase">
                                    {{ substr($sub->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">{{ $sub->name }}</p>
                                    <p class="text-[10px] text-slate-500 uppercase font-bold italic">{{ $sub->email }}</p>
                                </div>
                            </div>
                            <button class="bg-slate-800 text-white text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-tighter hover:bg-amber-500 transition-colors">
                                Assign Relief
                            </button>
                        </div>
                    @empty
                        <div class="p-8 text-center text-slate-400 text-xs font-bold italic">
                            No substitutes found. All personnel are currently in class.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-amber-50 border border-amber-100 rounded-xl p-6">
                <h4 class="text-amber-800 text-xs font-black uppercase mb-2 italic underline">Intelligence Note</h4>
                <p class="text-xs text-amber-700 leading-relaxed font-medium">
                    The Smart Match engine checks the institutional database in real-time. Only employees who are 
                    <strong>NOT</strong> currently in a scheduled class block are suggested as substitutes.
                </p>
            </div>
        </div>

    </div>
</x-school-layout>
