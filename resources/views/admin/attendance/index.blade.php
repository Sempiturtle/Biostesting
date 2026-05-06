<x-school-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-slate-800">
            Attendance Dashboard
        </h2>
        <p class="text-slate-500 mt-1 text-sm">
            Scan RFID cards and fingerprints – the data is stored automatically.
        </p>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="school-card">

            {{-- Status area --}}
            <div id="status" class="mb-4 p-4 border rounded bg-gray-800 text-white">
                <p class="text-sm">⌛ Waiting for device…</p>
            </div>

            {{-- Hidden form --}}
            <form id="attendanceForm" method="POST" action="{{ route('admin.attendance.store') }}" class="hidden">
                @csrf
                <input type="hidden" name="rfid_uid" id="rfid_uid">
                <input type="hidden" name="fingerprint_template" id="fingerprint_template">
            </form>

            {{-- Start / Stop buttons --}}
            <div class="flex space-x-4 mb-6">
                <button id="btnStart" type="button" class="btn-school btn-accent">
                    ▶ Start Reader
                </button>
                <button id="btnStop" type="button" class="btn-school btn-primary" disabled>
                    ■ Stop Reader
                </button>

                {{-- Manual test button (remove when hardware is ready) --}}
                <div class="mt-4">
                    <button id="btnSimulate" type="button" class="btn-school btn-accent" onclick="simulateScan()">
                        🧪 Simulate Scan (Testing)
                    </button>
                </div>

            </div>

        </div>

        {{-- Recent scans table --}}
        @php $recent = \App\Models\Attendance::orderByDesc('scanned_at')->take(10)->get(); @endphp

        @if($recent->isNotEmpty())
            <div class="school-card mt-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Recent Scans</h3>
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
                        @foreach($recent as $a)
                            <tr class="border-b border-slate-200">
                                <td class="py-2">
                                    {{ \Carbon\Carbon::parse($a->scanned_at)->timezone('Asia/Manila')->format('M d, Y — h:i:s A') }}
                                </td>
                                <td class="py-2">
                                    @if($a->type === 'time_in')
                                        <span style="color: green; font-weight: bold;">⬆ TIME IN</span>
                                    @else
                                        <span style="color: red; font-weight: bold;">⬇ TIME OUT</span>
                                    @endif
                                </td>
                                <td class="py-2">{{ $a->rfid_uid }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        // Web Serial RFID & Fingerprint reader
        let port;
        let keepReading = false;

        const statusEl = document.getElementById('status');
        const btnStart = document.getElementById('btnStart');
        const btnStop = document.getElementById('btnStop');
        const form = document.getElementById('attendanceForm');
        const rfidInput = document.getElementById('rfid_uid');
        const fpInput = document.getElementById('fingerprint_template');

        function log(msg) {
            statusEl.innerHTML = '<p class="text-sm">' + msg + '</p>';
            console.log('[Attendance]', msg);
        }

        async function connectSerial() {
            if (!('serial' in navigator)) {
                alert('Web Serial API not supported in this browser.');
                return;
            }
            try {
                port = await navigator.serial.requestPort({ filters: [] });
                await port.open({ baudRate: 9600 });
                keepReading = true;
                btnStart.disabled = true;
                btnStop.disabled = false;
                log('📡 Serial port opened – waiting for scans…');
                readLoop();
            } catch (e) {
                console.error(e);
                alert('Failed to open serial port: ' + e);
            }
        }

        async function disconnectSerial() {
            keepReading = false;
            btnStart.disabled = false;
            btnStop.disabled = true;
            if (port) {
                await port.close();
                log('🔌 Serial port closed.');
            }
        }

        async function readLoop() {
            const textDecoder = new TextDecoderStream();
            port.readable.pipeTo(textDecoder.writable);
            const reader = textDecoder.readable
                .pipeThrough(new TransformStream({
                    transform(chunk, controller) {
                        chunk.split('\n').forEach(function (l) {
                            controller.enqueue(l.trim());
                        });
                    }
                }))
                .getReader();

            while (keepReading) {
                const { value, done } = await reader.read();
                if (done) break;
                if (!value) continue;

                if (value.startsWith('RFID:')) {
                    var uid = value.replace('RFID:', '').trim();
                    rfidInput.value = uid;
                    log('🔖 RFID detected: ' + uid);
                } else if (value.startsWith('FP:')) {
                    var fp = value.replace('FP:', '').trim();
                    fpInput.value = fp;
                    log('🔐 Fingerprint template received.');
                    submitAttendance();
                } else {
                    console.log('Ignored line:', value);
                }
            }
        }

        function submitAttendance() {
            if (!rfidInput.value) {
                log('⚠️ No RFID UID – cannot submit.');
                return;
            }
            log('🚀 Sending attendance data…');

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    rfid_uid: rfidInput.value,
                    fingerprint_template: fpInput.value
                })
            })
                .then(function (res) { return res.json(); })
                .then(function (json) {
                    if (json.status === 'ok') {
                        log('✅ ' + json.employee + ' — ' + json.type.replace('_', ' ').toUpperCase());
                        rfidInput.value = '';
                        fpInput.value = '';
                    } else {
                        log('❌ Server error: ' + JSON.stringify(json.errors));
                    }
                })
                .catch(function (err) {
                    console.error(err);
                    log('❌ Network error');
                });
        }

        btnStart.addEventListener('click', connectSerial);
        btnStop.addEventListener('click', disconnectSerial);
        window.addEventListener('beforeunload', disconnectSerial);

        function simulateScan() {
            var testUid = prompt('Enter a test RFID UID:', '04A224B1C2D3');
            if (!testUid) return;

            fetch('{{ route("admin.attendance.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    rfid_uid: testUid,
                    fingerprint_template: ''
                })
            })
                .then(function (res) { return res.json(); })
                .then(function (json) {
                    if (json.status === 'ok') {
                        log('✅ ' + json.employee + ' — ' + json.type.replace('_', ' ').toUpperCase());
                        location.reload();
                    } else {
                        log('❌ Error: ' + JSON.stringify(json.errors));
                    }
                })
                .catch(function (err) {
                    log('❌ Network error');
                });
        }

    </script>
</x-school-layout>