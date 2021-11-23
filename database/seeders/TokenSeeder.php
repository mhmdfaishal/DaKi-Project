<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function createToken() {
        $time = Carbon::now();
        $random_string = Str::random(20);
        return [
            'token_value' => $random_string,
            'created_at' => $time,
            'updated_at' => $time
        ];
    }
    public function run()
    {
        for($index = 0 ; $index <= 20 ; $index++){
            DB::table('tokens')->insert([
                $this->createToken()
            ]);
        }
    }
}