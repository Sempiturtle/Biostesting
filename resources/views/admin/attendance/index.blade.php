<x-school-layout>
    <div class="max-w-4xl mx-auto p-6">
        <!-- Main Kiosk Card -->
        <div class="school-card text-center p-12 mb-6">
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 rounded-full mb-4">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04m17.236 0a11.955 11.955 0 00-11.762-3.048 11.955 11.955 0 00-11.762 3.048m17.236 0l-17.236 0">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl font-black text-slate-800">ATTENDANCE SYSTEM</h1>
                <p class="text-slate-500 text-lg">System is Ready. Tap your ID or Fingerprint.</p>
            </div>

            <!-- Feedback Area -->
            <div id="statusBox"
                class="p-4 rounded-xl border-2 border-dashed border-slate-200 transition-all duration-300">
                <span class="text-slate-400 italic">Waiting for scan...</span>
            </div>

            <!-- Hidden Input for RFID (Always Focused) -->
            <input type="text" id="rfidBuffer" class="opacity-0 absolute pointer-events-none" autofocus
                autocomplete="off">
        </div>

        <!-- Recent Scans Table (Updates automatically) -->
        <div id="scansTableContainer">
            @include('admin.attendance.partials.table')
        </div>
    </div>

    <script>
        const input = document.getElementById('rfidBuffer');
        const statusBox = document.getElementById('statusBox');
        let cooldown = false;

        // 1. Keep the input focused at all times so RFID reader can "type" into it
        const keepFocus = () => input.focus();
        document.addEventListener('click', keepFocus);
        window.addEventListener('focus', keepFocus);
        setInterval(keepFocus, 1000); // Force focus every second

        // 2. Listen for RFID "typing" (USB Readers send Enter at the end)
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const uid = input.value.trim();
                if (uid && !cooldown) {
                    processScan(uid);
                }
                input.value = ''; // Clear buffer
            }
        });

        function processScan(uid) {
            cooldown = true;
            statusBox.innerHTML = `<span class="text-blue-600 font-bold animate-pulse">🚀 Processing ID: ${uid}...</span>`;
            statusBox.className = "p-4 rounded-xl border-2 border-blue-500 bg-blue-50";

            fetch("{{ route('admin.attendance.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ rfid_uid: uid })
            })
                .then(res => res.json())
                .then(json => {
                    if (json.status === 'ok') {
                        statusBox.innerHTML = `<span class="text-green-600 font-bold">✅ Welcome, ${json.employee}! (${json.type.replace('_', ' ')})</span>`;
                        statusBox.className = "p-4 rounded-xl border-2 border-green-500 bg-green-50";
                        refreshTable(); // Update the table immediately
                    } else {
                        statusBox.innerHTML = `<span class="text-red-600 font-bold">❌ ${json.errors?.message || 'Unauthorized Card'}</span>`;
                        statusBox.className = "p-4 rounded-xl border-2 border-red-500 bg-red-50";
                    }

                    // Reset feedback after 3 seconds
                    setTimeout(() => {
                        statusBox.innerHTML = `<span class="text-slate-400 italic">Waiting for scan...</span>`;
                        statusBox.className = "p-4 rounded-xl border-2 border-dashed border-slate-200";
                        cooldown = false;
                    }, 3000);
                })
                .catch(() => {
                    statusBox.innerHTML = `<span class="text-red-600">❌ Connection Error</span>`;
                    cooldown = false;
                });
        }

        // 3. Auto-Refresh the table every 3 seconds (to show ESP32 scans)
        function refreshTable() {
            fetch("{{ route('admin.attendance.index') }}?refresh=1")
                .then(res => res.text())
                .then(html => {
                    document.getElementById('scansTableContainer').innerHTML = html;
                });
        }
        setInterval(refreshTable, 3000);
    </script>
</x-school-layout>