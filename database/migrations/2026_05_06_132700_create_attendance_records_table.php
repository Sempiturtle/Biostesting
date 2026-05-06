<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('rfid_uid', 32);
            $table->text('fingerprint_template')->nullable();
            $table->timestamp('scanned_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
