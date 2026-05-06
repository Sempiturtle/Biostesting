<x-school-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-slate-800">
            {{ __('Enroll RFID & Fingerprint') }}
        </h2>
        <p class="text-slate-500 mt-1 text-sm">
            Assign a RFID tag and fingerprint template to <strong>{{ $user->name }}</strong>.
        </p>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6">
        <div class="school-card space-y-6">

            {{-- RFID capture --------------------------------------------------- --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 uppercase mb-1">
                    RFID UID
                </label>

                {{--
                Your hardware will usually push the UID to the browser via
                a WebUSB/WebSerial API, BLE, or a local server endpoint.
                For a quick demo you can manually paste the UID.
                --}}
                <input type="text" name="rfid_uid" id="rfid_uid"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300" placeholder="e.g. 04A224B1C2D3"
                    required>
            </div>

            {{-- Fingerprint capture -------------------------------------------- --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 uppercase mb-1">
                    Fingerprint Template (Base‑64)
                </label>

                {{-- The fingerprint scanner will return a base‑64 string.
                You can also paste it manually for testing. --}}
                <textarea name="fingerprint_template" id="fingerprint_template" rows="4"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300"
                    placeholder="Paste the base‑64 template here" required></textarea>
            </div>

            {{-- Submit ---------------------------------------------------------- --}}
            <form method="POST" action="{{ route('admin.employees.attendance.store', $user) }}">
                @csrf
                {{-- Hidden fields to forward the values captured above --}}
                <input type="hidden" name="rfid_uid" id="hidden_rfid_uid">
                <input type="hidden" name="fingerprint_template" id="hidden_fp_template">

                <button type="submit" class="btn-school btn-accent shadow-lg">
                    Save Attendance Credentials
                </button>
            </form>
        </div>
    </div>

    {{-- --------------------------------------------------------------
    OPTIONAL: Tiny JS snippet that copies the visible inputs into the
    hidden fields just before submit (so the form posts the right data).
    -------------------------------------------------------------- --}}
    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            document.getElementById('hidden_rfid_uid').value = document.getElementById('rfid_uid').value.trim();
            document.getElementById('hidden_fp_template').value = document.getElementById('fingerprint_template').value.trim();
        });
    </script>
</x-school-layout>