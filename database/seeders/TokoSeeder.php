<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('toko')->insert([
            'user_id' => '1',
            'nama_toko' => 'Toko Daki',
            'alamat' => 'Jl. Daki no.9, Kec. Daki, Kel. Daki, Kota Bandung, Jawa Barat, 40917',
            'kotakabupaten' => 'Kota Bandung',
            'rating' => '7.5',
            'follower' => '211',
            'kontak' => '081224534674',
            'url_gmaps' => 'https://goo.gl/maps/rRCndgVV7encVEfa8',
            'logo_toko' => 'tokodaki.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('toko')->insert([
            'user_id' => '2',
            'nama_toko' => 'Toko Daki 2',
            'alamat' => 'Jl. Daki no.10, Kec. Daki, Kel. Daki, Kota Bandung, Jawa Barat, 40917',
            'kotakabupaten' => 'Kota Bandung',
            'rating' => '8.5',
            'follower' => '155',
            'kontak' => '081224534675',
            'url_gmaps' => 'https://goo.gl/maps/uvYmgu64aK2ZPmsQ8',
            'logo_toko' => 'tokodaki2.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
