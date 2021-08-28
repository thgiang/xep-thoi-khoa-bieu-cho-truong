<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data[] = ['name' => 'SH 6', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'SH 7', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'SH 8', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'SH 9', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'Toán 6', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'Toán 7', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'Toán 8', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'Toán 9', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'Lý 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Lý 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Lý 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'TN 6', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Hoá 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Hoá 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Sinh 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Sinh 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Sinh 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'CN 6', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'CN 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'CN 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'CN 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'TD 6', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'TD 7', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'TD 8', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'TD 9', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Tin 6', 'lab_id' => 1, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Tin 7', 'lab_id' => 1, 'avoid_last_lesson' => false, 'block' => 2, 'require_spacing' => true];
        $data[] = ['name' => 'Tin 8', 'lab_id' => 1, 'avoid_last_lesson' => false, 'block' => 2, 'require_spacing' => true];
        $data[] = ['name' => 'Tin 9', 'lab_id' => 1, 'avoid_last_lesson' => false, 'block' => 2, 'require_spacing' => true];
        $data[] = ['name' => 'Văn 6', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'VănKT 6', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 2, 'require_spacing' => true];
        $data[] = ['name' => 'Văn 7', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'VănKT 7', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 2, 'require_spacing' => true];
        $data[] = ['name' => 'Văn 8', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'VănKT 8', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 2, 'require_spacing' => true];
        $data[] = ['name' => 'Văn 9', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 1, 'require_spacing' => false];
        $data[] = ['name' => 'VănKT 9', 'lab_id' => null, 'avoid_last_lesson' => true, 'block' => 2, 'require_spacing' => true];
        $data[] = ['name' => 'Sử 6', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Sử 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Sử 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Sử 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Địa 6', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Địa 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Địa 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Địa 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'CD 6', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'CD 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'CD 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'CD 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Anh 6', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Anh 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Anh 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Anh 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'MT 6', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'MT 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'MT 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'MT 9', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Nhạc 6', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Nhạc 7', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        $data[] = ['name' => 'Nhạc 8', 'lab_id' => null, 'avoid_last_lesson' => false, 'block' => 1, 'require_spacing' => true];
        foreach ($data as &$datum) {
            $datum['created_at'] = Carbon::now();
            $datum['updated_at'] = Carbon::now();
        }

        DB::table('subjects')->insert($data);
    }
}
