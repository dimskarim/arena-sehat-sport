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
        // 1. Rename tabel
        Schema::rename('oprational_waktus', 'waktu_operasionals');

        // 2. Tambah kolom is_libur di waktu_operasionals
        Schema::table('waktu_operasionals', function (Blueprint $table) {
            $table->boolean('is_libur')->default(false)->after('waktu_tutup');
        });

        // 3. Ubah struktur slot_waktus
        Schema::table('slot_waktus', function (Blueprint $table) {
            // Drop constraint foreign key dan kolom lapangan_id
            $table->dropForeign(['lapangan_id']);
            $table->dropColumn('lapangan_id');

            // Tambah waktu_operasional_id yang berelasi ke waktu_operasionals
            $table->foreignId('waktu_operasional_id')->nullable()->after('id')->constrained('waktu_operasionals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert slot_waktus
        Schema::table('slot_waktus', function (Blueprint $table) {
            $table->dropForeign(['waktu_operasional_id']);
            $table->dropColumn('waktu_operasional_id');
            $table->foreignId('lapangan_id')->nullable()->constrained('lapangans')->onDelete('cascade');
        });

        // Revert waktu_operasionals
        Schema::table('waktu_operasionals', function (Blueprint $table) {
            $table->dropColumn('is_libur');
        });

        // Rename kembali
        Schema::rename('waktu_operasionals', 'oprational_waktus');
    }
};
