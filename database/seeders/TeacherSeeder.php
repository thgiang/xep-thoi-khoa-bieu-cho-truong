<?php

namespace Database\Seeders;

use App\Models\Teacher;
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

        //Tân	Tuyết	Nhật	Thơm buộc phải trống T7 do đi học
        //Ng.Hương tổng phụ trách, muốn trống T2, T7
        //Hoàng Hương nhà xa muốn nghỉ T7

        $nghiT7 = [
            ['th' => 7, 't' => 1, 'priority' => 'require'],
            ['th' => 7, 't' => 2, 'priority' => 'require'],
            ['th' => 7, 't' => 3, 'priority' => 'require'],
            ['th' => 7, 't' => 4, 'priority' => 'require'],
            ['th' => 7, 't' => 5, 'priority' => 'require'],
        ];

        $muonNghiT7 = [
            ['th' => 7, 't' => 1, 'priority' => 'optional'],
            ['th' => 7, 't' => 2, 'priority' => 'optional'],
            ['th' => 7, 't' => 3, 'priority' => 'optional'],
            ['th' => 7, 't' => 4, 'priority' => 'optional'],
            ['th' => 7, 't' => 5, 'priority' => 'optional'],
        ];

        $nghiT2 = [
            ['th' => 2, 't' => 1, 'priority' => 'require'],
            ['th' => 2, 't' => 2, 'priority' => 'require'],
            ['th' => 2, 't' => 3, 'priority' => 'require'],
            ['th' => 2, 't' => 4, 'priority' => 'require'],
            ['th' => 2, 't' => 5, 'priority' => 'require'],
        ];

        $gvNghiT7s = Teacher::whereIn('name', ['Tân', 'Tuyết', 'Nhật', 'Thơm'])->get();
        foreach ($gvNghiT7s as $gvNghiT7) {
            $gvNghiT7->skip_days = json_encode($nghiT7);
            $gvNghiT7->save();
        }

        $gvMuonNghiT7s = Teacher::whereIn('name', ['H.Hương'])->get();
        foreach ($gvMuonNghiT7s as $gvMuonNghiT7) {
            $gvMuonNghiT7->skip_days = json_encode($muonNghiT7);
            $gvMuonNghiT7->save();
        }

        $gvNghiT2s = Teacher::whereIn('name', ['N.Hương'])->get();
        foreach ($gvNghiT2s as $gvNghiT2) {
            $gvNghiT2->skip_days = json_encode($nghiT2);
            $gvNghiT2->save();
        }
    }
}
