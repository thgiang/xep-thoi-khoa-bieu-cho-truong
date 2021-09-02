<?php

namespace App\Services;

use App\Models\Lab;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Team;

class Lesson
{
    public $teacher; // Giáo viên
    public $subject; // Môn
    public $team; // Lớp
    public $lab; // Phòng lab
    public $day; // Thứ
    public $order; // Tiết
    public $isStatic = false; // Tiết học này là cố định ko dịch chuyển đi đâu
    public $isTeacherBusy = false;
}