<x-school-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-black text-slate-800">Payroll Management</h2>
        <p class="text-slate-500 text-sm">Generate and manage employee compensation based on attendance.</p>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6 space-y-8">
        
        <!-- 1. Generation Form -->
        <div class="school-card">
            <h3 class="text-lg font-bold text-slate-800 mb-4 uppercase tracking-widest">Generate New Payroll</h3>
            <form action="{{ route('admin.payroll.generate') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                @csrf
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase mb-2">Start Date</label>
                    <input type="date" name="start_date" required class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase mb-2">End Date</label>
                    <input type="date" name="end_date" required class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-slate-800 outline-none">
                </div>
                <div>
                    <button type="submit" class="w-full btn-school btn-accent shadow-lg shadow-amber-200 py-3">
                        🚀 Generate for All Employees
                    </button>
                </div>
            </form>
        </div>

        <!-- 2. Payroll History -->
        <div class="school-card">
            <h3 class="text-lg font-bold text-slate-800 mb-4 uppercase tracking-widest">Payroll Records</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 font-black uppercase">Employee</th>
                            <th class="px-4 py-3 font-black uppercase">Period</th>
                            <th class="px-4 py-3 font-black uppercase">Hours</th>
                            <th class="px-4 py-3 font-black uppercase">Gross Pay</th>
                            <th class="px-4 py-3 font-black uppercase">Deductions</th>
                            <th class="px-4 py-3 font-black uppercase">Net Pay</th>
                            <th class="px-4 py-3 font-black uppercase">Status</th>
                            <th class="px-4 py-3 font-black uppercase text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payrolls as $p)
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-4 font-bold text-slate-800">{{ $p->user->name }}</td>
                                <td class="px-4 py-4">
                                    <span class="text-xs text-slate-400 font-bold">{{ \Carbon\Carbon::parse($p->start_date)->format('M d') }}</span>
                                    <span class="mx-1 text-slate-300">→</span>
                                    <span class="text-xs text-slate-400 font-bold">{{ \Carbon\Carbon::parse($p->end_date)->format('M d, Y') }}</span>
                                </td>
                                <td class="px-4 py-4 font-mono">{{ $p->total_hours }} hrs</td>
                                <td class="px-4 py-4 font-bold text-slate-700">₱{{ number_format($p->gross_pay, 2) }}</td>
                                <td class="px-4 py-4">
                                    <div class="text-[10px] text-slate-400">
                                        SSS: ₱{{ number_format($p->sss, 2) }} <br>
                                        Tax: ₱{{ number_format($p->tax, 2) }}
                                    </div>
                                    <span class="text-xs font-bold text-red-500">-₱{{ number_format($p->total_deductions, 2) }}</span>
                                </td>
                                <td class="px-4 py-4 text-green-600 font-black">₱{{ number_format($p->net_pay, 2) }}</td>
                                <td class="px-4 py-4">
                                    @if($p->status === 'paid')
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase">Paid</span>
                                    @else
                                        <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-center space-y-2">
                                    <a href="{{ route('admin.payroll.download', $p) }}" class="block text-slate-600 hover:text-slate-800 text-[10px] font-black uppercase tracking-tighter border border-slate-200 rounded py-1 bg-white shadow-sm">
                                        📄 Download PDF
                                    </a>

                                    @if($p->status === 'pending')
                                        <form action="{{ route('admin.payroll.paid', $p) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="text-blue-600 hover:text-blue-800 text-xs font-black uppercase tracking-tighter">
                                                Mark as Paid
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-slate-300 text-xs font-bold uppercase tracking-widest">Released</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center text-slate-400 italic">
                                    No payroll records found. Generate one above to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-school-layout>
