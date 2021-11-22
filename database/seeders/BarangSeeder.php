<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barangs')->insert([
            'toko_id' => '1',
            'nama_barang' => 'Tenda Isi 4',
            'gambar_barang' => 'tenda_isi_4.jpg',
            'harga' => '25.000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('barangs')->insert([
            'toko_id' => '1',
            'nama_barang' => 'Tas Carrier 60L',
            'gambar_barang' => 'carrier_60l.jpg',
            'harga' => '30.000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('barangs')->insert([
            'toko_id' => '2',
            'nama_barang' => 'Tenda Isi 4',
            'gambar_barang' => 'tenda_isi_4.jpg',
            'harga' => '25.000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('barangs')->insert([
            'toko_id' => '1',
            'nama_barang' => 'Sleeping Bag',
            'gambar_barang' => 'sleeping_bag.jpg',
            'harga' => '10.000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('barangs')->insert([
            'toko_id' => '2',
            'nama_barang' => 'Flysheet',
            'gambar_barang' => 'flysheet.jpg',
            'harga' => '10.000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('barangs')->insert([
            'toko_id' => '1',
            'nama_barang' => 'Hammock',
            'gambar_barang' => 'hammock.jpg',
            'harga' => '10.000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
