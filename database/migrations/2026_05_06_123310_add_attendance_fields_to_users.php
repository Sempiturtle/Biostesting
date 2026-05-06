<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Stores the raw RFID UID (hex string, 24 bytes max)
            $table->string('rfid_uid', 32)->nullable()->unique()->after('role');

            // Stores a fingerprint template (binary data, base‑64 encoded string is fine)
            $table->text('fingerprint_template')->nullable()->after('rfid_uid');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rfid_uid', 'fingerprint_template']);
        });
    }
};
