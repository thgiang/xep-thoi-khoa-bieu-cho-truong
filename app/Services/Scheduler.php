<?php

namespace App\Services;

use App\Models\MapTeacherSubjectTeam;
use App\Models\Subject;
use Database\Seeders\MapTeacherSubjectTeamSeeder;
use function Symfony\Component\Translation\t;

class Scheduler
{
    public $teams;
    private $lessons; // Toàn bộ các tiết học trong tuần
    public $results; // Kết quả sắp lịch
    private $waitingLessons; // Các tiết học đang đc chờ sắp lịch
    private $lastOrder = 5;
    private $lastDay = 7;

    public function __construct()
    {
        $this->prependData();
    }

    public function prependData() {
        $this->lessons = MapTeacherSubjectTeam::with('team', 'teacher', 'subject', 'subject.lab')->get();
        $this->teams = (object) array();
        $this->results = array();
        foreach ($this->lessons as $lesson) {
            $this->waitingLessons[$lesson->code] = $lesson;

            // Danh sách lớp
            if (!isset($this->teams->{$lesson->team->name})) {
                $this->teams->{$lesson->team->name} = $lesson->team;
            }
        }

        // Khởi tạo mảng TKB rỗng
        for ($day = 2; $day <= $this->lastDay; $day++) {
            for ($order = 1; $order <= $this->lastOrder; $order++) {
                // Khởi tạo mảng cho lần lặp đầu tiên nếu chưa tồn tại
                if (!isset($this->results['D' . $day])) {
                    $this->results['D' . $day] = array();
                }
                // Khởi tạo mảng cho lần lặp đầu tiên nếu chưa tồn tại
                if (!isset($this->results['D' . $day]['O' . $order])) {
                    $this->results['D' . $day]['O' . $order] = array();
                }
            }
        }
    }

    /*
     * Tạo TKB cơ sở, chỉ cần các lớp đủ tiết, giáo viên đủ giờ dạy, không quan tâm tới việc trùng tiết
     */
    public function generateBase() {
        // Đặt tiết sinh hoạt và tiết chào cờ
        $this->setCCAndSH();

        // Lặp tối đa 35 lần để rải hết các môn học, đáng lẽ ko cần lặp tuy nhiên trong quá trình rải đôi khi 1 số môn bị bỏ qua
        // do môn đó chiếm 2 tiết, mà thứ tự rải lại đang ở tiết 4, thì tạm thời cứ để môn đó waiting rồi lần rải sau sẽ rải lại
        // 1 tuần có max là 35 tiết nên cứ cho lặp lại cho chắc, hết waiting thì break;
        for ($i = 0; $i < 35; $i++) {
            for ($day = 2; $day <= $this->lastDay; $day++) {
                for ($order = 1; $order <= $this->lastOrder; $order++) {
                    foreach ($this->waitingLessons as $map) {
                        // Nếu thiết này có lịch rồi thì bỏ qua
                        if (isset($this->results['D'.$day]['O'.$order][$map->team->name]))
                        {
                            continue;
                        }

                        // Ghi tiết nghỉ nếu tiết này là tiết nghỉ
                        if ($this->isOffLesson($day, $order, substr($map->team->name, 0, 1))) {
                            $ccLesson = new Lesson();
                            $ccLesson->team = $map->team;
                            $ccLesson->subject = new Subject();
                            $ccLesson->subject->block = 1;
                            $ccLesson->subject->name = '-';
                            $ccMap = new MapTeacherSubjectTeam();
                            $this->setLesson($day, $order, $ccLesson, $ccMap);
                            continue;
                        }

                        // Ghi tiết đầu tiên đang chờ
                        $lesson = new Lesson();
                        $lesson->subject = $map->subject;
                        $lesson->team = $map->team;
                        $lesson->teacher = $map->teacher;
                        $lesson->lab = $map->subject->lab;

                        $this->setLesson($day, $order, $lesson, $map);
                    }
                }
            }
            if (count($this->waitingLessons) == 0) {
                break;
            }
        }
    }

    public function setCCAndSH() {
        foreach ($this->teams as $team) {
            // Chào cờ
            $ccLesson = new Lesson();
            $ccLesson->team = $team;
            $ccLesson->subject = new Subject();
            $ccLesson->subject->block = 1;
            $ccLesson->subject->name = 'Chào cờ';
            $ccMap = new MapTeacherSubjectTeam();
            $this->setLesson(2, 1, $ccLesson, $ccMap);

            // Sinh hoạt
            foreach ($this->waitingLessons as $waitingLesson) {
                if ($waitingLesson->team->id == $team->id && substr($waitingLesson->subject->name, 0, 2) == 'SH') {
                    $lesson = new Lesson();
                    $lesson->subject = $waitingLesson->subject;
                    $lesson->team = $waitingLesson->team;
                    $lesson->teacher = $waitingLesson->teacher;
                    $lesson->lab = $waitingLesson->subject->lab;
                    for ($n = $this->lastDay; $n >= 2; $n--) {
                        if ($this->isTeacherDayOff($n, $this->lastOrder, $lesson->teacher) == 'none') {
                            $this->setLesson($n, $this->lastOrder, $lesson, $waitingLesson);
                            break;
                        }
                    }
                }
            }
        }
    }

    public function setLesson($day, $order, $lesson, $map) {
        if ($this->lastOrder - $order < $lesson->subject->block - 1) {
            // Không thể sắp môn học có 2 tiết vào tiết cuối vì sẽ bị học quá trưa
            return false;
        }

        // Kiểm tra xem tiết này đã có môn chưa
        for ($i = 0; $i < $lesson->subject->block; $i++) {
            if (isset($this->results['D'.$day]['O'.$order][$lesson->team->name])
                &&
                $this->results['D'.$day]['O'.$order][$lesson->team->name]->subject->name != '') {
                return false;
            }
        }
        // Ghi tiết học vào TKB
        for ($i = 0; $i < $lesson->subject->block; $i++) {
            $this->results['D'.$day]['O'.($order + $i)][$lesson->team->name] = $lesson;
        }

        // Giảm số tiết hoặc bỏ tiết học này ra khỏi mảng waiting (nếu hết tiết)
        if (isset($this->waitingLessons[$map->code])) {
            $this->waitingLessons[$map->code]->number_of_lesson -= $lesson->subject->block;
            if ($this->waitingLessons[$map->code]->number_of_lesson == 0) {
                unset($this->waitingLessons[$map->code]);
            }
        }

        return true;
    }

    /*
     * Kiểm tra xem tiết này lớp có đc nghỉ không
     */
    public function isOffLesson($day, $order, $group): bool {
        // Khối 8 học full, còn các khối khác đc nghỉ 1 vài tiết 5
        // Khối 6 nghỉ thứ 3, 5, 6
        if ($group == 6 && $order == $this->lastOrder && ($day == 3 || $day == 5 || $day == 6)) {
            return true;
        }
        // Khối 7 nghỉ thứ 3, 6
        else if ($group == 7 && $order == $this->lastOrder && ($day == 3 || $day == 6)) {
            return true;
        }
        // Khối 9 nghỉ thứ 5
        else  if ($group == 9 && $order == $this->lastOrder && ($day == 5)) {
            return true;
        }
        return false;
    }

    /*
     * Kiểm tra xem có phải ngày giáo viên muốn nghỉ hay ko
     */
    public function isTeacherDayOff($day, $order, $teacher) {

        $skipDays = @json_decode($teacher->skip_days, true);

        if (!$skipDays) {
            return 'none';
        }

        foreach ($skipDays as $skipDay) {
            if ($skipDay['th'] == $day && $skipDay['t'] == $order) {
                return $skipDay['priority'];
            }
        }

        return 'none';
    }

}