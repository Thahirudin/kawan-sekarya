<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia
        DB::table('pegawais')->insert([
            'nama' => 'Thahirudin', // Nama acak
            'tanggal_lahir' => '2003-02-10', // Tanggal lahir sebelum 2000
            'nomor_hp' => '089628437540', // Nomor HP acak
            'jabatan' => 'Founder',
            'email' => 'tohiruzain098@gmail.com', // Email unik
            'password' => Hash::make('uzumaki12356'), // Password default (harus di-hash)
            'gambar' => 'uploads/pegawai/cewek.png', // Nama gambar acak
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // for ($i = 1; $i < 10; $i++) { // Buat 10 data dummy
        //     DB::table('pegawais')->insert([
        //         'nama' => $faker->name, // Nama acak
        //         'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'), // Tanggal lahir sebelum 2000
        //         'nomor_hp' => $faker->numerify('#### #### ####'), // Nomor HP acak
        //         'jabatan' => 'Event Staff',
        //         'email' => $faker->unique()->safeEmail, // Email unik
        //         'password' => Hash::make('password123'), // Password default (harus di-hash)
        //         'gambar' => 'uploads/pegawai/cewek.png', // Nama gambar acak
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
