<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->text('details')->nullable();
            $table->date('treatment_date')->nullable();
            $table->string('status')->default('scheduled');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
