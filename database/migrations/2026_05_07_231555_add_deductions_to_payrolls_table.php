<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->decimal('sss', 10, 2)->default(0)->after('gross_pay');
            $table->decimal('philhealth', 10, 2)->default(0)->after('sss');
            $table->decimal('pagibig', 10, 2)->default(0)->after('philhealth');
            $table->decimal('tax', 10, 2)->default(0)->after('pagibig');
            $table->decimal('total_deductions', 10, 2)->default(0)->after('tax');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropColumn(['sss', 'philhealth', 'pagibig', 'tax', 'total_deductions']);
        });
    }
};
