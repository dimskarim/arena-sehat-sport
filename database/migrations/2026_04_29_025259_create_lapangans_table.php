<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('name');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->string('status')->default('tersedia');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('lapangans');
    }
};