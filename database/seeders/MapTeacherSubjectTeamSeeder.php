<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapTeacherSubjectTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];


//Hồ Tuấn
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Hồ Tuấn', 'subject_name' => 'VănKT 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Hồ Tuấn', 'subject_name' => 'Văn 7', 'number_of_lesson' => 2];

//Tân
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Tân', 'subject_name' => 'VănKT 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Tân', 'subject_name' => 'Văn 9', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Tân', 'subject_name' => 'VănKT 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Tân', 'subject_name' => 'Văn 9', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Tân', 'subject_name' => 'SH 9', 'number_of_lesson' => 1];

//Tr.Hoa
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'VănKT 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'Văn 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'VănKT 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'Văn 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'CD 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'CD 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'CD 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'CD 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Tr.Hoa', 'subject_name' => 'SH 7', 'number_of_lesson' => 1];

//Thơm
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Thơm', 'subject_name' => 'CN 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Thơm', 'subject_name' => 'CN 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Thơm', 'subject_name' => 'Sử 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Thơm', 'subject_name' => 'Sử 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Thơm', 'subject_name' => 'Sử 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Thơm', 'subject_name' => 'Sử 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Thơm', 'subject_name' => 'VănKT 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Thơm', 'subject_name' => 'Văn 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Thơm', 'subject_name' => 'CN 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Thơm', 'subject_name' => 'CN 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Thơm', 'subject_name' => 'CN 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Thơm', 'subject_name' => 'CN 7', 'number_of_lesson' => 1];

//Hường
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Hường', 'subject_name' => 'VănKT 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Hường', 'subject_name' => 'Văn 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Hường', 'subject_name' => 'VănKT 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Hường', 'subject_name' => 'Văn 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Hường', 'subject_name' => 'TD 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Hường', 'subject_name' => 'TD 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Hường', 'subject_name' => 'SH 8', 'number_of_lesson' => 1];

//Lan Anh
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Lan Anh', 'subject_name' => 'VănKT 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Lan Anh', 'subject_name' => 'Văn 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Lan Anh', 'subject_name' => 'VănKT 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Lan Anh', 'subject_name' => 'Văn 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Lan Anh', 'subject_name' => 'CD 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Lan Anh', 'subject_name' => 'CD 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Lan Anh', 'subject_name' => 'CD 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Lan Anh', 'subject_name' => 'CD 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Lan Anh', 'subject_name' => 'SH 8', 'number_of_lesson' => 1];

//Nguyệt
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Nguyệt', 'subject_name' => 'VănKT 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Nguyệt', 'subject_name' => 'Văn 9', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Nguyệt', 'subject_name' => 'VănKT 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Nguyệt', 'subject_name' => 'Văn 9', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Nguyệt', 'subject_name' => 'Địa 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Nguyệt', 'subject_name' => 'SH 9', 'number_of_lesson' => 1];

//Tr.Xuyến
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'VănKT 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'Văn 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'VănKT 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'Văn 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'CD 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'CD 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'CD 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'CD 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'Sử 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'Sử 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'Sử 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'Sử 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Tr.Xuyến', 'subject_name' => 'SH 6', 'number_of_lesson' => 1];

//Mai
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Mai', 'subject_name' => 'Địa 8', 'number_of_lesson' => 1];

//Huyền
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Huyền', 'subject_name' => 'Địa 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Huyền', 'subject_name' => 'Địa 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Huyền', 'subject_name' => 'Địa 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Huyền', 'subject_name' => 'Sử 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Huyền', 'subject_name' => 'Sử 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Huyền', 'subject_name' => 'Sử 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Huyền', 'subject_name' => 'Sử 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Huyền', 'subject_name' => 'Sử 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Huyền', 'subject_name' => 'Sử 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Huyền', 'subject_name' => 'Sử 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Huyền', 'subject_name' => 'Sử 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Huyền', 'subject_name' => 'TD 7', 'number_of_lesson' => 2];

//N.Xuyến
        $data[] = ['team_name' => '9C', 'teacher_name' => 'N.Xuyến', 'subject_name' => 'Anh 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'N.Xuyến', 'subject_name' => 'Anh 7', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'N.Xuyến', 'subject_name' => 'Anh 7', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'N.Xuyến', 'subject_name' => 'Anh 8', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'N.Xuyến', 'subject_name' => 'SH 7', 'number_of_lesson' => 1];

//Chuyên
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Chuyên', 'subject_name' => 'Anh 8', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Chuyên', 'subject_name' => 'Anh 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Chuyên', 'subject_name' => 'Anh 6', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Chuyên', 'subject_name' => 'Anh 6', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Chuyên', 'subject_name' => 'Anh 6', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Chuyên', 'subject_name' => 'Anh 6', 'number_of_lesson' => 3];

//Ngát
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Ngát', 'subject_name' => 'Anh 8', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Ngát', 'subject_name' => 'Anh 8', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Ngát', 'subject_name' => 'Anh 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Ngát', 'subject_name' => 'Anh 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Ngát', 'subject_name' => 'Anh 7', 'number_of_lesson' => 3];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Ngát', 'subject_name' => 'Anh 7', 'number_of_lesson' => 3];

//Nhật
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Nhật', 'subject_name' => 'Nhạc 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Nhật', 'subject_name' => 'Nhạc 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Nhật', 'subject_name' => 'MT 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Nhật', 'subject_name' => 'Nhạc 7', 'number_of_lesson' => 1];

//N.Hương
        $data[] = ['team_name' => '7C', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'N.Hương', 'subject_name' => 'Nhạc 8', 'number_of_lesson' => 1];

//Bông
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Bông', 'subject_name' => 'VănKT 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Bông', 'subject_name' => 'Văn 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Bông', 'subject_name' => 'VănKT 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Bông', 'subject_name' => 'Văn 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Bông', 'subject_name' => 'CD 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Bông', 'subject_name' => 'CD 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Bông', 'subject_name' => 'CD 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Bông', 'subject_name' => 'CD 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Bông', 'subject_name' => 'SH 6', 'number_of_lesson' => 1];

//H.Hoa
        $data[] = ['team_name' => '6C', 'teacher_name' => 'H.Hoa', 'subject_name' => 'Toán 6', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'H.Hoa', 'subject_name' => 'Toán 6', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'H.Hoa', 'subject_name' => 'Toán 6', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'H.Hoa', 'subject_name' => 'SH 6', 'number_of_lesson' => 1];

//Phương
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Phương', 'subject_name' => 'Hoá 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Phương', 'subject_name' => 'Hoá 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Phương', 'subject_name' => 'Hoá 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Phương', 'subject_name' => 'Hoá 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Phương', 'subject_name' => 'TN 6', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Phương', 'subject_name' => 'Hoá 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Phương', 'subject_name' => 'Hoá 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Phương', 'subject_name' => 'Hoá 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Phương', 'subject_name' => 'Hoá 8', 'number_of_lesson' => 2];

//T.Hà
        $data[] = ['team_name' => '8D', 'teacher_name' => 'T.Hà', 'subject_name' => 'Toán 8', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'T.Hà', 'subject_name' => 'Toán 9', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'T.Hà', 'subject_name' => 'Toán 9', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'T.Hà', 'subject_name' => 'SH 9', 'number_of_lesson' => 1];

//Hướng
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Hướng', 'subject_name' => 'Toán 9', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Hướng', 'subject_name' => 'Toán 9', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Hướng', 'subject_name' => 'Toán 8', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Hướng', 'subject_name' => 'CN 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Hướng', 'subject_name' => 'CN 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Hướng', 'subject_name' => 'CN 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Hướng', 'subject_name' => 'CN 9', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Hướng', 'subject_name' => 'SH 9', 'number_of_lesson' => 1];

//Tuyên
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Tuyên', 'subject_name' => 'TN 6', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Tuyên', 'subject_name' => 'Lý 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Tuyên', 'subject_name' => 'Lý 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Tuyên', 'subject_name' => 'Lý 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Tuyên', 'subject_name' => 'Lý 8', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Tuyên', 'subject_name' => 'Lý 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Tuyên', 'subject_name' => 'Lý 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Tuyên', 'subject_name' => 'Tin 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Tuyên', 'subject_name' => 'Tin 9', 'number_of_lesson' => 2];

//Nghiệp
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Nghiệp', 'subject_name' => 'Toán 8', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Nghiệp', 'subject_name' => 'Tin 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Nghiệp', 'subject_name' => 'Tin 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Nghiệp', 'subject_name' => 'Toán 6', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Nghiệp', 'subject_name' => 'SH 8', 'number_of_lesson' => 1];

//H.Hương
        $data[] = ['team_name' => '6D', 'teacher_name' => 'H.Hương', 'subject_name' => 'CN 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'H.Hương', 'subject_name' => 'CN 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'H.Hương', 'subject_name' => 'CN 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'H.Hương', 'subject_name' => 'Tin 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'H.Hương', 'subject_name' => 'Tin 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'H.Hương', 'subject_name' => 'Tin 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'H.Hương', 'subject_name' => 'Tin 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'H.Hương', 'subject_name' => 'Sinh 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'H.Hương', 'subject_name' => 'Sinh 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'H.Hương', 'subject_name' => 'Sinh 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'H.Hương', 'subject_name' => 'Sinh 8', 'number_of_lesson' => 2];

//Long
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Long', 'subject_name' => 'TD 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Long', 'subject_name' => 'TD 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Long', 'subject_name' => 'TD 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Long', 'subject_name' => 'TD 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Long', 'subject_name' => 'TD 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Long', 'subject_name' => 'TD 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Long', 'subject_name' => 'TD 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Long', 'subject_name' => 'TD 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Long', 'subject_name' => 'TD 6', 'number_of_lesson' => 2];

//Tuyết
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Tuyết', 'subject_name' => 'Sinh 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Tuyết', 'subject_name' => 'Sinh 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Tuyết', 'subject_name' => 'Sinh 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Tuyết', 'subject_name' => 'Sinh 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Tuyết', 'subject_name' => 'TD 7', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Tuyết', 'subject_name' => 'TD 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Tuyết', 'subject_name' => 'TD 6', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Tuyết', 'subject_name' => 'TD 6', 'number_of_lesson' => 2];

//Ly
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Ly', 'subject_name' => 'TN 6', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Ly', 'subject_name' => 'TN 6', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '9D', 'teacher_name' => 'Ly', 'subject_name' => 'Sinh 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Ly', 'subject_name' => 'Sinh 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9B', 'teacher_name' => 'Ly', 'subject_name' => 'Sinh 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Ly', 'subject_name' => 'Sinh 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Ly', 'subject_name' => 'SH 6', 'number_of_lesson' => 1];

//Hà HT
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Hà HT', 'subject_name' => 'CN 8', 'number_of_lesson' => 2];

//Nhung
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Nhung', 'subject_name' => 'Toán 7', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Nhung', 'subject_name' => 'Toán 7', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Nhung', 'subject_name' => 'CN 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Nhung', 'subject_name' => 'CN 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9C', 'teacher_name' => 'Nhung', 'subject_name' => 'Lý 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '9A', 'teacher_name' => 'Nhung', 'subject_name' => 'Lý 9', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Nhung', 'subject_name' => 'SH 7', 'number_of_lesson' => 1];

//Tâm
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Tâm', 'subject_name' => 'Toán 7', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Tâm', 'subject_name' => 'Toán 7', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '7C', 'teacher_name' => 'Tâm', 'subject_name' => 'Lý 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7D', 'teacher_name' => 'Tâm', 'subject_name' => 'Lý 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7B', 'teacher_name' => 'Tâm', 'subject_name' => 'Lý 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Tâm', 'subject_name' => 'Lý 7', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '7A', 'teacher_name' => 'Tâm', 'subject_name' => 'SH 7', 'number_of_lesson' => 1];

//Hà Tin
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Tin 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8C', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Tin 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8D', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Tin 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8B', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Tin 8', 'number_of_lesson' => 2];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Toán 8', 'number_of_lesson' => 4];
        $data[] = ['team_name' => '6C', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Tin 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6A', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Tin 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6B', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Tin 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '6D', 'teacher_name' => 'Hà Tin', 'subject_name' => 'Tin 6', 'number_of_lesson' => 1];
        $data[] = ['team_name' => '8A', 'teacher_name' => 'Hà Tin', 'subject_name' => 'SH 8', 'number_of_lesson' => 1];


        $teams = DB::table('teams')->select('id', 'name')->get()->keyBy('name');
        $teachers = DB::table('teachers')->select('id', 'name')->get()->keyBy('name');
        $subjects = DB::table('subjects')->select('id', 'name')->get()->keyBy('name');

        $existing = array();
        foreach ($data as &$datum) {
            $name = $datum['subject_name'] . ' ' . $datum['team_name'];
            if (!in_array($name, $existing)) {
                $existing[] = $name;
            } else {
                exit('Trùng giáo viên '.$name);
            }

            $datum['subject_id'] = $subjects[$datum['subject_name']]->id;
            $datum['teacher_id'] = $teachers[$datum['teacher_name']]->id;
            $datum['team_id'] = $teams[$datum['team_name']]->id;
            unset($datum['subject_name']);
            unset($datum['teacher_name']);
            unset($datum['team_name']);

            $datum['created_at'] = Carbon::now();
            $datum['updated_at'] = Carbon::now();
            $datum['code'] = $this->RandomString(5);
        }
        DB::table('map_teacher_subject_teams')->insert($data);
        //sort($existing);
        //print_r($existing);
    }

    public function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }

}
