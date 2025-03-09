<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        for ($i = 0; $i < 10; $i++) { // Buat 10 data dummy
            DB::table('pelanggans')->insert([
                'nama' => $faker->name, // Nama acak
                'tanggal_lahir' => $faker->date('Y-m-d'), // Usia minimal 20 tahun
                'email' => $faker->unique()->safeEmail, // Email unik
                'password' => Hash::make('password123'), // Password default (harus di-hash)
                'gambar' => 'uploads/pelanggan/cewek.png', // Path gambar acak
                'nohp' => $faker->numerify('08## #### ####'), // Nomor HP dengan format Indonesia
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
