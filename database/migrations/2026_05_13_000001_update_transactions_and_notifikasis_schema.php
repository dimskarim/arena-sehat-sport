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
        // 1. Rename details_bookings to booking_details
        Schema::rename('details_bookings', 'booking_details');

        // 2. Modify bookings
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('status')->default('menunggu_pembayaran')->change();
        });

        // 3. Modify payments
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('butki_payment', 'bukti_payment');
            $table->string('status')->default('pending')->change();
        });

        // 4. Modify notifikasis
        Schema::table('notifikasis', function (Blueprint $table) {
            // Drop foreign key and column details_booking_id
            $table->dropForeign(['details_booking_id']);
            $table->dropColumn('details_booking_id');

            // Add booking_id
            $table->foreignId('booking_id')->after('user_id')->nullable()->constrained('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 4. Revert notifikasis
        Schema::table('notifikasis', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
            $table->dropColumn('booking_id');
            $table->foreignId('details_booking_id')->nullable()->constrained('booking_details')->onDelete('cascade');
        });

        // 3. Revert payments
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('bukti_payment', 'butki_payment');
        });

        // 2. Revert bookings
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });

        // 1. Revert rename booking_details to details_bookings
        Schema::rename('booking_details', 'details_bookings');
    }
};
