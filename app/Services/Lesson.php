<?php

namespace App\Services;

use App\Models\Lab;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Team;

class Lesson
{
    public $teacher;
    public $subject;
    public $team;
    public $lab;
    public $day;
    public $order;
}