<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('oprational_waktus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lapangan_id')->constrained('lapangans')->onDelete('cascade');
            $table->time('waktu_buka');
            $table->time('waktu_tutup');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('oprational_waktus');
    }
};