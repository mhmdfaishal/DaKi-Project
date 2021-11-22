<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GunungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gunung')->insert([
            'user_id' => '1',
            'nama_gunung' => 'Bromo',
            'gambar_gunung' => 'bromo.jpg',
            'lokasi' => 'Jawa Timur',
            'provinsi_id' => '15',
            'status' => 'Buka',
            'ketinggian' => '2329',
            'htm' => '50000',
            'kuota_pendaki' => '200',
            'kontak' => '022634578987',
            'url_gmaps' => 'https://goo.gl/maps/KTunD68CmRxPDsF57',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('gunung')->insert([
            'user_id' => '1',
            'nama_gunung' => 'Rinjani',
            'gambar_gunung' => 'rinjani.jpg',
            'lokasi' => 'Lombok',
            'provinsi_id' => '18',
            'status' => 'Buka',
            'ketinggian' => '3726',
            'htm' => '30000',
            'kuota_pendaki' => '300',
            'kontak' => '022634578986',
            'url_gmaps' => 'https://goo.gl/maps/WqaFHgofRD8J5Kng9',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('gunung')->insert([
            'user_id' => '1',
            'nama_gunung' => 'Prau',
            'gambar_gunung' => 'prau.jpg',
            'lokasi' => 'Jawa Tengah',
            'provinsi_id' => '14',
            'status' => 'Buka',
            'ketinggian' => '2565',
            'htm' => '40000',
            'kuota_pendaki' => '100',
            'kontak' => '022634578985',
            'url_gmaps' => 'https://goo.gl/maps/2fM24SUQppZ422d49',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('gunung')->insert([
            'user_id' => '1',
            'nama_gunung' => 'Kerinci',
            'gambar_gunung' => 'kerinci.jpg',
            'lokasi' => 'Jambi',
            'provinsi_id' => '3',
            'status' => 'Buka',
            'ketinggian' => '3800',
            'htm' => '30000',
            'kuota_pendaki' => '200',
            'kontak' => '022634578985',
            'url_gmaps' => 'https://goo.gl/maps/5VfwqKGpPV2Xf4MQA',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('gunung')->insert([
            'user_id' => '1',
            'nama_gunung' => 'Sindoro',
            'gambar_gunung' => 'sindoro.jpg',
            'lokasi' => 'Wonosobo',
            'provinsi_id' => '14',
            'status' => 'Buka',
            'ketinggian' => '2865',
            'htm' => '50000',
            'kuota_pendaki' => '100',
            'kontak' => '022634578985',
            'url_gmaps' => 'https://goo.gl/maps/Au39WEUJmHruGmQ2A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('gunung')->insert([
            'user_id' => '1',
            'nama_gunung' => 'Sumbing',
            'gambar_gunung' => 'sumbing.jpg',
            'lokasi' => 'Wonosobo',
            'provinsi_id' => '14',
            'status' => 'Buka',
            'ketinggian' => '2765',
            'htm' => '20000',
            'kuota_pendaki' => '150',
            'kontak' => '022634578985',
            'url_gmaps' => 'https://goo.gl/maps/KzRBL1UxvuNwU9GS9',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
