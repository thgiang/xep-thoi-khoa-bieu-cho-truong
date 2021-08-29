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
        $data[] = ['name' => 'Phương', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'H.Hoa', 'team_id' => 4, 'has_children' => false];
        $data[] = ['name' => 'T.Hà', 'team_id' => 13, 'has_children' => false];
        $data[] = ['name' => 'Hướng', 'team_id' => 14, 'has_children' => false];
        $data[] = ['name' => 'Tuyên', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Nghiệp', 'team_id' => 10, 'has_children' => false];
        $data[] = ['name' => 'H.Hương', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Long', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Tuyết', 'team_id' => null, 'has_children' => true];
        $data[] = ['name' => 'Ly', 'team_id' => 2, 'has_children' => false];
        $data[] = ['name' => 'HàHT', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Nhung', 'team_id' => 8, 'has_children' => false];
        $data[] = ['name' => 'Tâm', 'team_id' => 5, 'has_children' => false];
        $data[] = ['name' => 'H.Hà', 'team_id' => 9, 'has_children' => false];
        $data[] = ['name' => 'Tuấn', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Tân', 'team_id' => 16, 'has_children' => false];
        $data[] = ['name' => 'T.Hoa', 'team_id' => 6, 'has_children' => false];
        $data[] = ['name' => 'Thơm', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Hường', 'team_id' => 11, 'has_children' => false];
        $data[] = ['name' => 'L.Anh', 'team_id' => 12, 'has_children' => false];
        $data[] = ['name' => 'Nguyệt', 'team_id' => 15, 'has_children' => false];
        $data[] = ['name' => 'T.Xuyến', 'team_id' => 3, 'has_children' => false];
        $data[] = ['name' => 'Mai', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Huyền', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'N.Xuyến', 'team_id' => 7, 'has_children' => false];
        $data[] = ['name' => 'Chuyên', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Ngát', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Nhật', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'N.Hương', 'team_id' => null, 'has_children' => false];
        $data[] = ['name' => 'Bông', 'team_id' => 1, 'has_children' => false];
        foreach ($data as &$datum) {
            $datum['created_at'] = Carbon::now();
            $datum['updated_at'] = Carbon::now();
        }

        DB::table('teachers')->insert($data);
    }
}
