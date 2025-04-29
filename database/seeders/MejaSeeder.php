<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        for ($i = 0; $i < 10; $i++) { // Buat 10 data dummy
            DB::table('mejas')->insert([
                'nama' => 'Meja ' . $i, // Nama meja unik
                'deskripsi' => $faker->sentence(10), // Deskripsi meja acak
                'kapasitas' => $faker->numberBetween(2, 5), // Kapasitas antara 2-10 orang
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
