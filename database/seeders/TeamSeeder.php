<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i = 6; $i <= 9; $i++) {
            $data[] = ['name' => $i.'A', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
            $data[] = ['name' => $i.'B', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
            $data[] = ['name' => $i.'C', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
            $data[] = ['name' => $i.'D', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
        }
        DB::table('teams')->insert($data);
    }
}
