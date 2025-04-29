<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        for ($i = 0; $i < 9; $i++) { // Buat 10 data dummy
            DB::table('aktivitas')->insert([
                'nama' => $faker->randomElement([
                    'Keychain Painting', 
                    'Air Dry Clay', 
                    'DIY Soft Clay', 
                    'Bear Bricks Painting', 
                    'Gypsum Painting', 
                    'Bucket Hat Painting', 
                    'Clay Art', 
                    'Painting On Canvas', 
                    'Making Air Dry Clay',
                ]), // Nama aktivitas dari daftar
                'durasi' => $faker->numberBetween(60, 180), // Durasi antara 30-180 menit
                'harga' => $faker->numberBetween(400000, 300000), // Harga acak antara 400rb - 300rb
                'detail' => $faker->sentence(15), // Detail atau deskripsi aktivitas
                'gambar' => 'images/' . $faker->word . '.jpg', // Path gambar acak
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
