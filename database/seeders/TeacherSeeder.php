<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data[] = ['name' => 'Phương', 'team_id' => null];
        $data[] = ['name' => 'H.Hoa', 'team_id' => 4];
        $data[] = ['name' => 'Th Hà', 'team_id' => 13];
        $data[] = ['name' => 'Hướng T', 'team_id' => 14];
        $data[] = ['name' => 'Tuyên', 'team_id' => null];
        $data[] = ['name' => 'Nghiệp', 'team_id' => 10];
        $data[] = ['name' => 'H.Hương', 'team_id' => null];
        $data[] = ['name' => 'Long', 'team_id' => null];
        $data[] = ['name' => 'Tuyết', 'team_id' => null];
        $data[] = ['name' => 'Ly', 'team_id' => 2];
        $data[] = ['name' => 'H.Hà', 'team_id' => null];
        $data[] = ['name' => 'Nhung', 'team_id' => 8];
        $data[] = ['name' => 'Tâm', 'team_id' => 5];
        $data[] = ['name' => 'Hà', 'team_id' => 9];
        $data[] = ['name' => 'Tuấn', 'team_id' => null];
        $data[] = ['name' => 'Tân', 'team_id' => 16];
        $data[] = ['name' => 'Tr.Hoa', 'team_id' => 6];
        $data[] = ['name' => 'Thơm', 'team_id' => null];
        $data[] = ['name' => 'Hường', 'team_id' => 11];
        $data[] = ['name' => 'L.Anh', 'team_id' => 12];
        $data[] = ['name' => 'Nguyệt', 'team_id' => 15];
        $data[] = ['name' => 'Tr.Xuyến', 'team_id' => 3];
        $data[] = ['name' => 'Mai', 'team_id' => null];
        $data[] = ['name' => 'Huyền', 'team_id' => null];
        $data[] = ['name' => 'N.Xuyến', 'team_id' => 7];
        $data[] = ['name' => 'Chuyên', 'team_id' => null];
        $data[] = ['name' => 'Ngát', 'team_id' => null];
        $data[] = ['name' => 'Nhật', 'team_id' => null];
        $data[] = ['name' => 'Ng.Hương', 'team_id' => null];
        $data[] = ['name' => 'Bông', 'team_id' => 1];
        foreach ($data as &$datum) {
            $datum['created_at'] = Carbon::now();
            $datum['updated_at'] = Carbon::now();
        }

        DB::table('teachers')->insert($data);
    }
}
