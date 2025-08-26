<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('content');
            $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->onDelete('cascade');
            $table->date('report_date')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
