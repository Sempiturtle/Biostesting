<div class="school-card mt-6">
    <h3 class="text-lg font-bold text-slate-800 mb-4">Recent Scans</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600">
            <thead class="border-b border-slate-300">
                <tr>
                    <th class="pb-2">Time</th>
                    <th class="pb-2">Type</th>
                    <th class="pb-2">RFID UID</th>
                    <th class="pb-2">Employee</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent as $a)
                    <tr class="border-b border-slate-200">
                        <td class="py-2">
                            {{ \Carbon\Carbon::parse($a->scanned_at)->timezone('Asia/Manila')->format('M d, Y — h:i:s A') }}
                        </td>
                        <td class="py-2">
                            @if($a->type === 'time_in')
                                <span class="text-green-600 font-bold">⬆ TIME IN</span>
                            @else
                                <span class="text-red-600 font-bold">⬇ TIME OUT</span>
                            @endif
                        </td>
                        <td class="py-2 font-mono">{{ $a->rfid_uid }}</td>
                        <td class="py-2 font-semibold text-slate-700">
                            {{ $a->user->name ?? 'Unknown' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-slate-400 italic">
                            No scans detected yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
