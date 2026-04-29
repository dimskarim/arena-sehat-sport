<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('details_booking_id')->constrained('detail_bookings')->onDelete('cascade');
            $table->string('deskripsi')->nullable();
            $table->text('pesan');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('notifikasis');
    }
};