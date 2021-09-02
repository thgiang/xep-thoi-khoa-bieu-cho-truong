<?php

namespace App\Services;

use App\Models\DeadEnd;
use App\Models\Lab;
use App\Models\MapTeacherSubjectTeam;
use App\Models\Teacher;
use App\Models\Team;

//K9: 4 * 28, K8: 4 * 29, K7: 4 * 27, K6: 4 * 26

class GenTKB
{
    public $mapTeacherSubjectTeams;
    public $waiting;
    private $lessonPerDay = 5;
    private $endOfWeek = 7;
    private $schedule;
    private $teachersBusy;
    private $labsBusy;
    private $labs;
    private $teams;
    private $teachers;
    private $maps;

    private $score = 10000;
    private $minusLogs;
    private $plusLogs;
    // Chữ m có nghĩa là trừ điểm

    private $mSportLast = -1000; // Môn thể dục ở tiết cuối, trừ thật nặng
    private $mSpacingLesson = -50; // Giáo viên bị trẫng giờ dạy
    private $mManySubjectSameDay = -30; // Giáo viên bị 2 giáo án trong 1 ngày
    private $mHasChildrenInFirst = -100; // Giáo viên có con nhỏ bị dạy tiết đầu
//    private $mCoupleLessonSameDay = -1000; // Môn học ko quan trọng mà bị 2 tiết 1 ngày
//    private $mNearDay = -200; // Môn học không quan trọng nằm ở 2 ngày liên tiếp
//    private $mImportantInLast = -100; // Môn học quan trọng bị xếp tiết cuối
    private $mCoupleLessonSameDay = -1000; // Môn học ko quan trọng mà bị 2 tiết 1 ngày
    private $mNearDay = -30; // Môn học không quan trọng nằm ở 2 ngày liên tiếp
    private $mImportantInLast = -50; // Môn học quan trọng bị xếp tiết cuối
    private $mTeacherBusy = -200; // Giáo viên bị trùng tiết
    private $mTeacherWantSkip = -50; // Giáo viên muốn đc nghỉ ngơi ngày này


    public function __construct($teachers, $labs, $teams, $maps)
    {
        $this->teachers = $teachers;
        $this->labs = $labs;
        $this->teams = $teams;
        $this->maps = $maps;

        $this->resetData();
    }

    public function resetData() {
        // Export maps
        foreach ($this->maps as $mapTeacherSubjectTeam) {
            $mapTeacherSubjectTeam = (object)$mapTeacherSubjectTeam->toArray();

            foreach ($mapTeacherSubjectTeam->teacher as $key => $value) {
                $mapTeacherSubjectTeam->{'teacher_' . $key} = $value;
            }

            foreach ($mapTeacherSubjectTeam->subject as $key => $value) {
                $mapTeacherSubjectTeam->{'subject_' . $key} = $value;
            }
            foreach ($mapTeacherSubjectTeam->team as $key => $value) {
                $mapTeacherSubjectTeam->{'team_' . $key} = $value;
            }
            unset($mapTeacherSubjectTeam->team);
            unset($mapTeacherSubjectTeam->subject);
            unset($mapTeacherSubjectTeam->teacher);
            $this->mapTeacherSubjectTeams[] = $mapTeacherSubjectTeam;
        }

        // Sắp xếp theo độ ưu tiên của môn học
        usort($this->mapTeacherSubjectTeams, [$this, 'sortMapByPriority']);

        // Setup waiting
        unset($this->waiting);
        $this->waiting = [];
        foreach ($this->mapTeacherSubjectTeams as $m) {
            $this->waiting[$m->code] = $m;
        }

        // Blank schedule
        unset($this->schedule);
        $this->schedule = [];
        foreach ($this->teams as $team) {
            $this->schedule[$team->name] = array();
            for ($i = 2; $i <= $this->endOfWeek; $i++) {
                $this->schedule[$team->name]['TH' . $i] = array();
                for ($j = 1; $j <= $this->lessonPerDay; $j++) {
                    $this->schedule[$team->name]['TH' . $i]['T' . $j] = (object)['subject_name' => '', 'teacher_name' => ''];
                }
            }
        }

        // Setup all lab is free
        unset($this->labsBusy);
        $this->labsBusy = [];
        foreach ($this->labs as $lab) {
            for ($i = 2; $i <= $this->endOfWeek; $i++) {
                $this->labsBusy[$lab->id]['TH' . $i] = array();
                for ($j = 1; $j <= $this->lessonPerDay; $j++) {
                    $this->labsBusy[$lab->id]['TH' . $i]['T' . $j] = '';
                }
            }
        }

        // Setup all teacher is free
        unset($this->teachersBusy);
        $this->teachersBusy = [];
        foreach ($this->teachers as $teacher) {
            for ($i = 2; $i <= $this->endOfWeek; $i++) {
                $this->teachersBusy[$teacher->name]['TH' . $i] = array();
                for ($j = 1; $j <= $this->lessonPerDay; $j++) {
                    $this->teachersBusy[$teacher->name]['TH' . $i]['T' . $j] = '';
                }
            }
        }
    }

    public function generateBase()
    {

        // Base TKB
        foreach ($this->teams as $team) {
            // Xếp ngày có 4 tiết, giờ chào cờ, giờ sinh hoạt
            $this->setDayOff($team);

            // Xếp môn học
            for ($th = 2; $th <= $this->endOfWeek; $th++) {
                for ($t = 1; $t <= $this->lessonPerDay; $t++) {
                    // Đã đc xếp môn khác rồi thì thôi
                    if ($this->schedule[$team->name]['TH' . $th]['T' . $t]->subject_name != '') {
                        continue;
                    }

                    // Tìm 1 môn phù hợp
                    $option = $this->getReadyOption($th, $t, $team, false);
                    if ($option == 'ERR') {
//                        $options = $options = $this->findWatingLessonsOfTeam($team);
//                        echo '<pre>';
//                        print_r($options);
//                        echo '</pre>';
                        return false;
                    } else if ($option == 'DONE') {
                        break;
                    } else {
                        $this->setSchedule($th, $t, $option);
                    }
                }
            }
        }

        return (object)['waiting' => $this->waiting, 'schedule' => $this->schedule, 'teams' => $this->teams, 'score' => $this->score];
    }

    // Lấy 1 môn học bất kì cho lớp, ko quan tâm ràng buộc
    public function getReadyOption($th, $t, $team, $strict = true)
    {
        $options = $this->findWatingLessonsOfTeam($team);
        if (count($options) == 0) {
            return 'DONE';
        }

        usort($options, [$this, 'sortRandom']);

        foreach ($options as $item) {
            // Nếu môn học này có block > 1 thì ko đc bắt đầu ở tiết cuối để nó kết thúc trc khi tan học
            if ($item->subject_block > 1) {
                if ($this->lessonPerDay - $item->subject_block + 1 < $t) {
                    continue;
                }
            }

            // Ngày này giáo viên nghỉ đi học tại chức, hoặc nhà xa đc ưu tiên
            $teacherSkip = false;
            if ($item->teacher_skip_days) {
                $skipDays = json_decode($item->teacher_skip_days, true);
                if ($skipDays) {
                    foreach ($skipDays as $skipDay) {
                        if ($th == $skipDay['th'] && $t == $skipDay['t']) {
                            if ($skipDay['priority'] == 'require') {
                                //echo 'Giao vien '.$item->teacher_name.' nghi thu '.$th.' tiet '.$t."\n";
                                $teacherSkip = true;
                            }
                            if ($skipDay['priority'] == 'optional') {
                                $this->score += $this->mTeacherWantSkip;
                            }
                        }
                    }
                }
            }
            if ($teacherSkip) {
                continue;
            }

            // Một số môn yêu cầu học cách ngày
            $isTooNear = false;
            if ($item->subject_require_spacing && $th > 2 && $th < $this->endOfWeek) {
                for ($i = 1; $i <= $this->lessonPerDay; $i++) {
                    if (str_replace('KT ', ' ', $item->subject_name) == str_replace('KT ', '', $this->schedule[$team->name]['TH' . ($th - 1)]['T' . $i]->subject_name)) {
                        $isTooNear = true;
                        break;
                    }
                }
            }
            if ($isTooNear) {
                //continue;
                $this->score += $this->mNearDay;
            }

            // Trong 1 ngày không học 2 môn giống nhau
            $isDuplicate = false;
            for ($i = 1; $i <= $this->lessonPerDay; $i++) {
                if (isset($this->schedule[$team->name]['TH' . $th]['T' . $i]->subject_group)
                    && $item->subject_group == $this->schedule[$team->name]['TH' . $th]['T' . $i]->subject_group)
                {
                    $isDuplicate = true;
                    break;
                }
            }
            if ($isDuplicate) {
                //continue;
                $this->score += $this->mCoupleLessonSameDay;
            }

            // Môn Thể dục không được bắt đầu ở tiết cuối
            if ($item->subject_avoid_last_lesson && $t == $this->lessonPerDay) {
                continue;
            }

            // Ktra xem giáo viên có đang dạy lớp khác hay ko
            $teacherFree = true;
            for ($i = 0; $i < $item->subject_block; $i++) {
                if ($this->teachersBusy[$item->teacher_name]['TH' . $th]['T' . ($t+$i)] != '') {
                    $teacherFree = false;
                }
            }
            if (!$teacherFree) {
                //continue;
                $this->score += $this->mTeacherBusy;
            }

            // Nếu môn học này dùng phòng lab thì ktra xem phòng lab có trống hay ko
            $labFree = true;
            if ($item->subject_lab_id != null) {
                // Vì phòng máy chỉ có 1 nên chấp nhận 1 tiết lý thuyết, 1 tiết thực hành, vì vậy chỉ cần tránh nhau 1 tiết đầu

//                for ($i = 0; $i < $item->subject_block; $i++) {
//                    if ($this->labsBusy[$item->subject_lab_id]['TH' . $th]['T' . ($t+$i)] != '') {
//                        $labFree = false;
//                    }
//                }
                // Chỉ cần check tiết đầu ko trùng
                if ($this->labsBusy[$item->subject_lab_id]['TH' . $th]['T' . $t] != '') {
                    $labFree = false;
                }
            }
            if (!$labFree) {
                continue;
            }

            // Nếu môn này dài hơn 1 tiết thì phải kiểm tra xem liệu có môn nào chặn đuôi ko
            if ($item->subject_block > 1) {
                $ignore = false;
                for ($i = 0; $i < $item->subject_block; $i++) {
                    if ($this->schedule[$item->team_name]['TH' . $th]['T' . ($t + $i)]->subject_name != '') {
                        $ignore = true;
                    }
                }
                if ($ignore) {
                    continue;
                }
            }


            return $item;
        }

        return 'ERR';
    }

    public function setSchedule($th, $t, $map): bool
    {

        if (($t + $map->subject_block - 1) > $this->lessonPerDay) {
            if ($this->debug) {
                echo '<pre>';
                echo 'T = ' . $t . '<br>';
                print_r($map);
                exit('Không thể đặt môn học vào tiết học lớn hơn 5');
            }
            // Không thể set tiết học lớn hơn 5
            return false;
        }

        for ($i = 0; $i < $map->subject_block; $i++) {
            // Ghi TKB
            $this->schedule[$map->team_name]['TH' . $th]['T' . ($t + $i)] = $map;

            // Ghi phòng lab bận
            if ($map->subject_lab_id) {
                $this->labsBusy[$map->subject_lab_id]['TH' . $th]['T' . ($t + $i)] = $map->team_name . ' - ' . $map->subject_name;
            }

            // Ghi giáo viên bận
            $this->teachersBusy[$map->teacher_name]['TH' . $th]['T' . ($t + $i)] = $map->team_name . ' - ' . $map->subject_name;
        }

        if (isset($this->waiting[$map->code])) {
            $this->waiting[$map->code]->number_of_lesson -= $map->subject_block;
            if ($this->waiting[$map->code]->number_of_lesson == 0) {
                unset($this->waiting[$map->code]);
            }
        }

        return true;
    }

    public function setDayOff($team) {
        // Set giờ chào cờ
        $off = new MapTeacherSubjectTeam();
        $off->subject_block = 1;
        $off->subject_name = "-";
        $off->team_name = $team->name;
        $this->setSchedule(2, 1, $off);

        // Set giờ sinh hoạt
        $map = $this->findOption(['teacher_team_id' => $team->id]);
        if ($map) {
            // Sinh hoạt lớp
            $shMap = $this->findOption(['subject_name' => 'SH ' . substr($team->name, 0, 1), 'team_id' => $team->id]);
            if ($shMap->teacher_name != 'Tân') {
                $this->setSchedule(7, 5, $shMap);
            } else {
                $this->setSchedule(6, 5, $shMap);
            }
        }

        // Set ngày 4 tiết
        $t = $this->lessonPerDay;
        $group = substr($team->name, 0, 1);
        $ths = array();

        if ($group == '6') {
            $ths = array(3, 5, 6);
        }
        if ($group == '7') {
            $ths = array(3, 6);
        }
        if ($group == '9') {
            $ths = array(5);
        }
        foreach ($ths as $th) {
            $off = new MapTeacherSubjectTeam();
            $off->subject_block = 1;
            $off->subject_name = "-";
            $off->team_name = $team->name;
            $this->setSchedule($th, $t, $off);
        }
    }

    public function sortMapByPriority($a, $b)
    {
        return $a->subject_priority > $b->subject_priority;
    }

    public function findWatingLessonsOfTeam($team)
    {
        $options = array();
        foreach ($this->waiting as $item) {
            if ($item->team_id == $team->id) {
                $options[] = $item;
            }
        }
        return $options;
    }

    public function findOption($conditional)
    {
        foreach ($this->waiting as $item) {
            $found = true;
            foreach ($conditional as $key => $value) {
                if ($item->{$key} != $value) {
                    $found = false;
                    break;
                }
            }
            if ($found) {
                return $item;
            }
        }
        return false;
    }

    public function sortRandom($a, $b)
    {
        return rand(0, 1) % 2 == 0;
    }
}