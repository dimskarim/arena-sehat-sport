<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. User
        $admin = \App\Models\User::create([
            'name' => 'Admin Arena',
            'email' => 'admin@arena.com',
            'phone' => '081234567890',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $user = \App\Models\User::create([
            'name' => 'John Doe',
            'email' => 'user@arena.com',
            'phone' => '081298765432',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // 2. Kategori
        $kategori1 = \App\Models\Kategori::create(['name' => 'Futsal']);
        $kategori2 = \App\Models\Kategori::create(['name' => 'Badminton']);

        // 3. Lapangan
        $lapangan1 = \App\Models\Lapangan::create([
            'kategori_id' => $kategori1->id,
            'name' => 'Lapangan Futsal Sintetis A',
            'deskripsi' => 'Lapangan futsal rumput sintetis standar FIFA.',
            'harga' => 150000,
            'status' => 'tersedia',
        ]);

        $lapangan2 = \App\Models\Lapangan::create([
            'kategori_id' => $kategori2->id,
            'name' => 'Lapangan Badminton Karpet B',
            'deskripsi' => 'Lapangan badminton dengan karpet vinyl nyaman.',
            'harga' => 50000,
            'status' => 'tersedia',
        ]);

        // 4. Gambar Lapangan
        \App\Models\GambarLapangan::create([
            'lapangan_id' => $lapangan1->id,
            'gambar_file' => 'futsal_a.jpg',
        ]);
        \App\Models\GambarLapangan::create([
            'lapangan_id' => $lapangan2->id,
            'gambar_file' => 'badminton_b.jpg',
        ]);

        // 5. Oprational Waktu
        \App\Models\OprationalWaktu::create([
            'lapangan_id' => $lapangan1->id,
            'waktu_buka' => '08:00:00',
            'waktu_tutup' => '23:00:00',
        ]);
        \App\Models\OprationalWaktu::create([
            'lapangan_id' => $lapangan2->id,
            'waktu_buka' => '08:00:00',
            'waktu_tutup' => '22:00:00',
        ]);

        // 6. Slot Waktu
        $slot1 = \App\Models\SlotWaktu::create([
            'lapangan_id' => $lapangan1->id,
            'waktu_mulai' => '10:00:00',
            'waktu_selesai' => '11:00:00',
        ]);
        $slot2 = \App\Models\SlotWaktu::create([
            'lapangan_id' => $lapangan1->id,
            'waktu_mulai' => '11:00:00',
            'waktu_selesai' => '12:00:00',
        ]);

        // 7. Booking
        $booking = \App\Models\Booking::create([
            'user_id' => $user->id,
            'lapangan_id' => $lapangan1->id,
            'tanggal_booking' => date('Y-m-d', strtotime('+1 day')),
            'total_harga' => 300000,
            'status' => 'success',
        ]);

        // 8. Payment
        \App\Models\Payment::create([
            'booking_id' => $booking->id,
            'payment_method' => 'Transfer Bank BCA',
            'butki_payment' => 'bukti_tf_123.jpg',
            'tanggal_payment' => date('Y-m-d H:i:s'),
            'status' => 'success',
        ]);

        // 9. Detail Booking
        $detail1 = \App\Models\DetailBooking::create([
            'booking_id' => $booking->id,
            'slot_waktu_id' => $slot1->id,
            'harga' => 150000,
            'status' => 'booked',
        ]);
        $detail2 = \App\Models\DetailBooking::create([
            'booking_id' => $booking->id,
            'slot_waktu_id' => $slot2->id,
            'harga' => 150000,
            'status' => 'booked',
        ]);

        // 10. Notifikasi
        \App\Models\Notifikasi::create([
            'user_id' => $user->id,
            'details_booking_id' => $detail1->id,
            'deskripsi' => 'Booking Futsal Sintetis A',
            'pesan' => 'Booking lapangan Anda untuk besok jam 10:00 telah berhasil dan dikonfirmasi.',
        ]);
    }
}
