<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Set locale Indonesia agar data lebih natural
        $faker = Faker::create('id_ID');

        // 1. Buat 3 Admin
        for ($i = 1; $i <= 3; $i++) {
            $adminId = DB::table('users')->insertGetId([
                'username' => sprintf('admin_%03d', $i),
                'name' => $faker->name,
                'email' => sprintf('admin%03d@example.com', $i),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'bio' => $faker->sentence,
                'avatar' => null,
                'banner' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. Buat 10 User biasa
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'username' => sprintf('user_%03d', $i),
                'name' => $faker->name,
                'email' => sprintf('user%03d@example.com', $i),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'bio' => $faker->sentence,
                'avatar' => null,
                'banner' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Buat 100 User UMKM + data umkm
        for ($i = 1; $i <= 100; $i++) {
            // Insert user
            $userId = DB::table('users')->insertGetId([
                'username' => sprintf('umkm_%03d', $i),
                'name' => $faker->name,
                'email' => sprintf('umkm%03d@example.com', $i),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'umkm',
                'bio' => $faker->sentence,
                'avatar' => null,
                'banner' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Buat data UMKM terkait
            DB::table('umkm')->insert([
                'user_id' => $userId,
                'nama_usaha' => $faker->company, // Nama usaha acak
                'deskripsi' => $faker->paragraph(1),
                'alamat' => $faker->address,
                'latitude' => $faker->randomFloat(7, -6.3, -6.1),   // sekitar Jakarta
                'longitude' => $faker->randomFloat(7, 106.7, 107.0),
                'tipe_tempat' => $faker->randomElement(['warung', 'gerobak', 'kios', 'toko', 'lapak', 'lainnya']),
                'jam_buka' => $faker->time('H:i:s', '08:00:00'),   // buka antara 08:00 - 10:00
                'jam_tutup' => $faker->time('H:i:s', '20:00:00'),  // tutup antara 18:00 - 22:00
                'tipe_produk' => $faker->randomElement(['bahan_mentah', 'bahan_matang', 'bahan_olahan', 'campuran']),
                'banner' => null, // bisa diisi dengan URL placeholder jika ingin
                'kontak' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}