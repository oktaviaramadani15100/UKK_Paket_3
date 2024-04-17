<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'NamaAlbum' => 'mic',
                'Deskripsi' => 'i like mic',
                'TanggalDibuat' => now(),
                'user_id' => User::inRandomOrder()->first()->id
            ],
            [
                'NamaAlbum' => 'mobil',
                'Deskripsi' => 'i like mobil',
                'TanggalDibuat' => now(),
                'user_id' => User::inRandomOrder()->first()->id
            ],
            [
                'NamaAlbum' => 'happy',
                'Deskripsi' => 'i like happy',
                'TanggalDibuat' => now(),
                'user_id' => User::inRandomOrder()->first()->id
            ],
        ];

        foreach ($data as $items) {
            Album::insert([
                'NamaAlbum' => $items['NamaAlbum'],
                'Deskripsi' => $items['Deskripsi'],
                'TanggalDibuat' => $items['TanggalDibuat'],
                'user_id' => $items['user_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
