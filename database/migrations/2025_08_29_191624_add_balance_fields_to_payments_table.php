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
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->nullable()->after('amount');
            $table->decimal('remaining_balance', 10, 2)->nullable()->after('total_amount');
            $table->text('notes')->nullable()->after('remaining_balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'remaining_balance', 'notes']);
        });
    }
};
