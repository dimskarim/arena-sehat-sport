<?php

$migrationsPath = __DIR__ . '/database/migrations/';
$files = scandir($migrationsPath);

$migrationContents = [
    'users' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->string('foto_profile')->nullable();
            \$table->string('email')->nullable()->unique();
            \$table->timestamp('email_verified_at')->nullable();
            \$table->string('phone')->nullable();
            \$table->string('password');
            \$table->string('role')->default('user');
            \$table->rememberToken();
            \$table->timestamps();
        });
        Schema::create('password_reset_tokens', function (Blueprint \$table) {
            \$table->string('email')->primary();
            \$table->string('token');
            \$table->timestamp('created_at')->nullable();
        });
        Schema::create('sessions', function (Blueprint \$table) {
            \$table->string('id')->primary();
            \$table->foreignId('user_id')->nullable()->index();
            \$table->string('ip_address', 45)->nullable();
            \$table->text('user_agent')->nullable();
            \$table->longText('payload');
            \$table->integer('last_activity')->index();
        });
    }
    public function down(): void {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};",

    'kategoris' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('kategoris', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('kategoris');
    }
};",

    'lapangans' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('lapangans', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            \$table->string('name');
            \$table->text('deskripsi')->nullable();
            \$table->integer('harga');
            \$table->string('status')->default('tersedia');
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('lapangans');
    }
};",

    'gambar_lapangans' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('gambar_lapangans', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('lapangan_id')->constrained('lapangans')->onDelete('cascade');
            \$table->string('gambar_file');
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('gambar_lapangans');
    }
};",

    'slot_waktus' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('slot_waktus', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('lapangan_id')->constrained('lapangans')->onDelete('cascade');
            \$table->time('waktu_mulai');
            \$table->time('waktu_selesai');
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('slot_waktus');
    }
};",

    'oprational_waktus' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('oprational_waktus', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('lapangan_id')->constrained('lapangans')->onDelete('cascade');
            \$table->time('waktu_buka');
            \$table->time('waktu_tutup');
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('oprational_waktus');
    }
};",

    'bookings' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            \$table->foreignId('lapangan_id')->constrained('lapangans')->onDelete('cascade');
            \$table->date('tanggal_booking');
            \$table->integer('total_harga');
            \$table->string('status')->default('pending');
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};",

    'payments' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            \$table->string('payment_method')->nullable();
            \$table->string('butki_payment')->nullable();
            \$table->dateTime('tanggal_payment')->nullable();
            \$table->string('status')->default('pending');
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('payments');
    }
};",

    'detasil_bookings' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('detasil_bookings', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            \$table->foreignId('slot_waktu_id')->constrained('slot_waktus')->onDelete('cascade');
            \$table->integer('harga');
            \$table->string('status')->nullable();
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('detasil_bookings');
    }
};",

    'notifikasis' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('notifikasis', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            \$table->foreignId('details_booking_id')->constrained('detasil_bookings')->onDelete('cascade');
            \$table->string('deskripsi')->nullable();
            \$table->text('pesan');
            \$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('notifikasis');
    }
};",
];

foreach ($files as $file) {
    if (strpos($file, '.php') !== false) {
        foreach ($migrationContents as $key => $content) {
            if (strpos($file, 'create_' . $key . '_table') !== false) {
                file_put_contents($migrationsPath . $file, $content);
                echo "Updated $file\n";
            }
        }
    }
}

echo "Migrations updated successfully!\n";
