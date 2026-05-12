<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Lapangan;
use App\Models\GambarLapangan;
use App\Models\OprationalWaktu;
use App\Models\SlotWaktu;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\DetailsBooking;
use App\Models\Notifikasi;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Users (1 Admin, 20 Users)
        $admin = User::create([
            'name' => 'Admin Arena',
            'email' => 'admin@arena.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $users = [];
        for ($i = 1; $i <= 20; $i++) {
            $users[] = User::create([
                'name' => $faker->name,
                'email' => "user{$i}@arena.com",
                'phone' => $faker->phoneNumber,
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }

        // 2. Kategori
        $kategoriNames = ['Futsal', 'Badminton', 'Basket', 'Voli', 'Tenis Lapangan', 'Mini Soccer'];
        $kategoris = [];
        foreach ($kategoriNames as $name) {
            $kategoris[] = Kategori::create(['name' => $name]);
        }

        // 3. Lapangan, Gambar, Oprational, Slot
        $lapangans = [];
        $slotsPerLapangan = [];

        foreach ($kategoris as $kategori) {
            $numLapangans = rand(2, 5); // 2-5 lapangan per kategori
            for ($i = 1; $i <= $numLapangans; $i++) {
                $harga = $faker->randomElement([50000, 75000, 100000, 120000, 150000, 200000]);
                
                $lapangan = Lapangan::create([
                    'kategori_id' => $kategori->id,
                    'name' => "Lapangan {$kategori->name} " . strtoupper($faker->bothify('?##')),
                    'deskripsi' => $faker->paragraph(2),
                    'harga' => $harga,
                    'status' => 'tersedia',
                ]);
                $lapangans[] = $lapangan;

                // Gambar Lapangan (1-3 gambar)
                for ($g = 1; $g <= rand(1, 3); $g++) {
                    GambarLapangan::create([
                        'lapangan_id' => $lapangan->id,
                        'gambar_file' => 'https://ui-avatars.com/api/?name=' . urlencode($lapangan->name) . '&background=random&size=800',
                    ]);
                }

                // Oprational Waktu (Buka 08:00 - Tutup 23:00)
                OprationalWaktu::create([
                    'lapangan_id' => $lapangan->id,
                    'waktu_buka' => '08:00:00',
                    'waktu_tutup' => '23:00:00',
                ]);

                // Slot Waktu (Setiap 1 jam)
                $slots = [];
                for ($hour = 8; $hour < 23; $hour++) {
                    $mulai = sprintf('%02d:00:00', $hour);
                    $selesai = sprintf('%02d:00:00', $hour + 1);
                    $slots[] = SlotWaktu::create([
                        'lapangan_id' => $lapangan->id,
                        'waktu_mulai' => $mulai,
                        'waktu_selesai' => $selesai,
                    ]);
                }
                $slotsPerLapangan[$lapangan->id] = $slots;
            }
        }

        // 4. Booking, Payment, Details, Notifikasi
        // Buat 100 random booking
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        
        for ($b = 1; $b <= 100; $b++) {
            $user = $faker->randomElement($users);
            $lapangan = $faker->randomElement($lapangans);
            $slots = $slotsPerLapangan[$lapangan->id];
            
            // Random ambil 1 sampai 3 slot berurutan
            $numSlots = rand(1, 3);
            $startSlotIdx = rand(0, count($slots) - $numSlots - 1);
            $bookedSlots = array_slice($slots, $startSlotIdx, $numSlots);
            
            $status = $faker->randomElement($statuses);
            
            // Tanggal antara -30 hari s/d +30 hari
            $bookingDate = Carbon::today()->addDays(rand(-30, 30));
            $totalHarga = count($bookedSlots) * $lapangan->harga;

            $booking = Booking::create([
                'user_id' => $user->id,
                'lapangan_id' => $lapangan->id,
                'tanggal_booking' => $bookingDate->format('Y-m-d'),
                'total_harga' => $totalHarga,
                'status' => $status,
            ]);

            // Setup Status Payment berdasarkan Status Booking
            $paymentStatus = 'pending';
            if ($status == 'confirmed' || $status == 'completed') $paymentStatus = 'paid';
            if ($status == 'cancelled') $paymentStatus = $faker->randomElement(['failed', 'refunded', 'pending']);

            $paymentMethods = ['Transfer Bank BCA', 'Transfer Bank Mandiri', 'Qris', 'E-Wallet DANA', 'E-Wallet OVO'];
            
            Payment::create([
                'booking_id' => $booking->id,
                'payment_method' => $paymentStatus == 'pending' ? null : $faker->randomElement($paymentMethods),
                'butki_payment' => $paymentStatus == 'paid' ? 'https://ui-avatars.com/api/?name=Bukti+Transfer&background=random&size=400' : null,
                'tanggal_payment' => $paymentStatus == 'paid' ? $bookingDate->copy()->subHours(rand(1, 24)) : null,
                'status' => $paymentStatus,
            ]);

            // Details dan Notifikasi
            foreach ($bookedSlots as $slot) {
                $detailStatus = $status === 'cancelled' ? 'available' : 'booked';
                
                $detail = DetailsBooking::create([
                    'booking_id' => $booking->id,
                    'slot_waktu_id' => $slot->id,
                    'harga' => $lapangan->harga,
                    'status' => $detailStatus,
                ]);

                if ($status == 'confirmed' || $status == 'completed') {
                    Notifikasi::create([
                        'user_id' => $user->id,
                        'details_booking_id' => $detail->id,
                        'deskripsi' => "Booking Lapangan",
                        'pesan' => "Booking lapangan {$lapangan->name} untuk tanggal {$bookingDate->format('d-m-Y')} jam {$slot->waktu_mulai} berhasil dikonfirmasi.",
                    ]);
                }
            }
        }
    }
}
