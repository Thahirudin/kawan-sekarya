<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        for ($i = 0; $i < 10; $i++) { // Buat 10 data dummy
            $nama_event = $faker->sentence(3); // Nama event acak
            $tanggal_mulai = $faker->dateTimeBetween('now', '+1 month'); // Acara dalam 1 bulan ke depan
            $tanggal_selesai = (clone $tanggal_mulai)->modify('+4 hours'); // Tambahkan 4 jam dari tanggal mulai

            DB::table('events')->insert([
                'nama' => $nama_event, // Nama event acak
                'slug' => Str::slug($nama_event), // Slug dari nama event
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_selesai' => $tanggal_selesai, // Acara selesai dalam 2 bulan
                'kapasitas' => $faker->numberBetween(10, 100), // Kapasitas 10-100 orang
                'pegawai_id' => $faker->numberBetween(1, 5), // Sesuaikan dengan jumlah pegawai yang ada
                'harga' => $faker->numberBetween(50000, 500000), // Harga acak antara 50rb - 500rb
                'lokasi' => $faker->city, // Lokasi acak (nama kota)
                'deskripsi' => $faker->paragraph(3), // Deskripsi acak
                'gambar' => 'uploads/event/cewek.png', // Nama gambar acak
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
