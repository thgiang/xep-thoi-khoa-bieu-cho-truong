<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\MapTeacherSubjectTeam;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Team;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class HomeController extends Controller
{
    private $schedule;
    private $teachersBusy;
    private $labsBusy;
    private $labs;
    private $teams;
    private $subjects;
    private $teachers;
    private $waiting;
    private $mapTeacherSubjectTeams;
    private $debug = true;
    private $lessonPerDay = 5;
    private $endOfWeek = 7;

    private $score = 1000;
    private $minusLogs;
    private $plusLogs;
    // Chữ m có nghĩa là trừ điểm
    private $mImportantInLast = -100; // Môn học quan trọng bị xếp tiết cuối
    private $mSportLast = -1000; // Môn thể dục ở tiết cuối, trừ thật nặng
    private $mSpacingLesson = -50; // Giáo viên bị trẫng giờ dạy
    private $mManySubjectSameDay = -30; // Giáo viên bị 2 giáo án trong 1 ngày
    private $mHasChildrenInFirst = -100; // Giáo viên có con nhỏ bị dạy tiết đầu
    private $mCoupleLessonSameDay = -1000; // Môn học ko quan trọng mà bị 2 tiết 1 ngày
    private $mNearDay = -200; // Môn học không quan trọng nằm ở 2 ngày liên tiếp

    private $mtstKeyed;



    public function __construct()
    {
        $this->schedule = [];

        $this->labs = Lab::get();
        $this->teams = Team::get();
        $this->subjects = Subject::get();
        $this->teachers = Teacher::get();
        $maps = MapTeacherSubjectTeam::with('teacher', 'subject', 'team', 'subject')->get();

        // Export maps
        foreach ($maps as $mapTeacherSubjectTeam) {
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
            $this->waiting[$mapTeacherSubjectTeam->code] = $mapTeacherSubjectTeam;
        }

        // Blank schedule
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
        $this->labsBusy = array();
        foreach ($this->labs as $lab) {
            for ($i = 2; $i <= $this->endOfWeek; $i++) {
                $this->labsBusy[$lab->id]['TH' . $i] = array();
                for ($j = 1; $j <= $this->lessonPerDay; $j++) {
                    $this->labsBusy[$lab->id]['TH' . $i]['T' . $j] = '';
                }
            }
        }

        // Setup all teacher is free
        $this->teachersBusy = array();
        foreach ($this->teachers as $teacher) {
            for ($i = 2; $i <= $this->endOfWeek; $i++) {
                $this->teachersBusy[$teacher->name]['TH' . $i] = array();
                for ($j = 1; $j <= $this->lessonPerDay; $j++) {
                    $this->teachersBusy[$teacher->name]['TH' . $i]['T' . $j] = '';
                }
            }
        }
    }

    public function generateScheduler()
    {
        // Xếp GVCN vào tiết cuối ngày t7 và tiết 1, 2 ngày t2
        foreach ($this->teams as $team) {
            $map = $this->findOption(['teacher_team_id' => $team->id]);
            if ($map) {
                $ccMap = new MapTeacherSubjectTeam();
                $ccMap->code = substr(md5('2'.$team->name), 0, 5);
                $ccMap->subject_name = "Chào cờ";
                $ccMap->teacher_name = $map->teacher_name;
                $ccMap->team_name = $team->name;
                $ccMap->subject_block = 1;
                $this->setSchedule(2, 1, $ccMap);

                // Sinh hoạt lớp
                $shMap = $this->findOption(['subject_name' => 'SH '.substr($team->name, 0, 1), 'team_id' => $team->id]);
                if ($shMap->teacher_name != 'Tân') {
                    $this->setSchedule(7, 5, $shMap);
                } else {
                    $this->setSchedule(6, 5, $shMap);
                }


                // Tìm môn của GVCN đặt ngay vào sau chào cờ, nên thế nhưng ko đc vì có lớp phải đi học Tin luôn do thiếu phòng máy
//                $mainTeacherSubject = $this->findOption(['teacher_id' => $map->teacher_id, 'team_id' => $team->id]);
//                if ($mainTeacherSubject) {
//                    $this->setSchedule(2, 2, $mainTeacherSubject);
//                }
            }
        }

        // Sắp lịch sử dụng phòng Lab đầu tiên
        $usingLabs = [];
        foreach ($this->mapTeacherSubjectTeams as $mapTeacherSubjectTeam) {
            if ($mapTeacherSubjectTeam->subject_lab_id) {
                $usingLabs[] = $mapTeacherSubjectTeam;
            }
        }
        usort($usingLabs, [$this, 'shortByUsingLab']);
        foreach ($usingLabs AS $usingLab) {
            $timeToUsingLab = $this->getReadyLabOption($usingLab);
            if (!$timeToUsingLab) {
                if ($this->debug) {
                    echo '<pre>';
                    print_r($usingLab);
                }
                exit("Không tìm được ngày sử dụng phòng máy cho môn ".$usingLab->subject_name." của lớp ".$usingLab->team_name.", vui lòng bổ sung phòng máy hoặc giảm bớt tiết học");
            } else {
                $this->setSchedule($timeToUsingLab['th'], $timeToUsingLab['t'], $usingLab);
            }
        }
        // Sắp lịch random
        // Foreach từ trên xuống dưới TKB tìm ô trống, chọn phương án phù hợp để điền
        // Chạy đi chạy lại vài lần, từ lần chạy sau bỏ bớt chế độ nghiêm ngặt
        for ($try = 0; $try < 100; $try++) {
            for ($th = 2; $th <= $this->endOfWeek; $th++) {
                for ($t = 1; $t <= $this->lessonPerDay; $t++) {
                    foreach ($this->teams as $teamm) {
                        if ($this->schedule[$teamm->name]['TH' . $th]['T' . $t]->subject_name == '') {
                            $option = $this->getReasonableOption($th, $t, $teamm, $try < 50);
                            if ($option) {
                                $this->setSchedule($th, $t, $option);
                            }
                        }
                    }
                }
            }
        }

        //echo count($this->schedule);
        echo '<pre>';
        print_r($this->waiting);
        echo '</pre>';
        echo count($this->waiting);
        echo '/';
        echo count($this->mapTeacherSubjectTeams);

        $schedule = $this->schedule;
        $teams = $this->teams;
        $subjects = $this->subjects;
        $teachers = $this->teachers;
        return view('schedule', compact('schedule', 'teams', 'subjects', 'teachers'));
    }

    public function getReadyLabOption($item) {
        for ($th = 2; $th <= $this->endOfWeek; $th++) {
            for ($t = 1; $t <= $this->lessonPerDay - $item->subject_block + 1; $t++) {
                // Ktra xem lớp có đang học gì ko (chào cờ, sinh hoạt...)
                if ($this->schedule[$item->team_name]['TH' . $th]['T' . $t]->subject_name != '') {
                    continue;
                }

                // Ktra xem giáo viên có đang dạy lớp khác hay ko
                $teacherFree = false;
                if ($this->teachersBusy[$item->teacher_name]['TH' . $th]['T' . $t] == '') {
                    $teacherFree = true;
                }

                // Nếu môn học này dùng phòng lab thì ktra xem phòng lab có trống hay ko
                $labFree = false;
                if ($item->subject_lab_id == null || $this->labsBusy[$item->subject_lab_id]['TH' . $th]['T' . $t] == '') {
                    $labFree = true;
                }

                if ($teacherFree && $labFree) {
//                    echo $item->team_name . ' TH '.$th. ' T'.$t.'<br>';
//                    echo '<pre>';
//                    print_r($this->labsBusy);
                    return ['th' => $th, 't' => $t];
                }
            }
        }
        return false;
    }

    public function getReasonableOption($th, $t, $team, $strict = true)
    {
        foreach ($this->waiting as $item) {
            if ($strict) {
                // Random cho vui
                if (rand(0, count($this->waiting)) % 2 == 1) {
                    continue;
                }
            }

            if ($item->team_id != $team->id) {
                continue;
            }

            // Nếu môn học này có block > 1 thì ko đc bắt đầu ở tiết cuối để nó kết thúc trc khi tan học
            if ($this->lessonPerDay - $item->subject_block + 1 < $t) {
                continue;
            }

            // Ktra xem giáo viên có đang dạy lớp khác hay ko
            $teacherFree = false;
            if ($this->teachersBusy[$item->teacher_name]['TH'.$th]['T'.$t] == '') {
                $teacherFree = true;
            }

            // Nếu môn học này dùng phòng lab thì ktra xem phòng lab có trống hay ko
            $labFree = false;
            if ($item->subject_lab_id == null || $this->labsBusy[$item->subject_lab_id]['TH'.$th]['T'.$t] == '') {
                $labFree = true;
            }

            if ($strict) {
                // Trong 1 ngày không học 2 môn giống nhau
                $isDuplicate = false;
                for ($i = 1; $i <= $this->lessonPerDay; $i++) {
                    if(str_replace('KT ', ' ',$item->subject_name) == str_replace('KT ', ' ', $this->schedule[$team->name]['TH'.$th]['T'.$i]->subject_name)) {
                        $isDuplicate = true;
                        break;
                    }
                }
                if ($isDuplicate) {
                    continue;
                }

                // Môn Toán, Văn, Thể dục không được bắt đầu ở tiết cuối
                if ($item->subject_avoid_last_lesson && $t == $this->lessonPerDay) {
                    continue;
                }

                // Một số môn yêu cầu học cách ngày
                $isTooNear = false;
                if ($item->subject_require_spacing && $th > 2 && $th < $this->endOfWeek) {
                    for ($i = 1; $i <= $this->lessonPerDay; $i++) {
                        if (str_replace('KT ', ' ',$item->subject_name) == str_replace('KT ', '', $this->schedule[$team->name]['TH' . ($th - 1)]['T' . $i]->subject_name)) {
                            $isTooNear = true;
                            break;
                        }
                    }
                }
                if ($isTooNear) {
                    continue;
                }
            }

            if ($teacherFree && $labFree) {
                return $item;
            }
        }
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
                $this->labsBusy[$map->subject_lab_id]['TH'.$th]['T'.($t + $i)] = $map->team_name . ' - '.$map->subject_name;
            }

            // Ghi giáo viên bận
            $this->teachersBusy[$map->teacher_name]['TH'.$th]['T'.($t + $i)] = $map->team_name . ' - '.$map->subject_name;
        }

        if (isset($this->waiting[$map->code])) {
            $this->waiting[$map->code]->number_of_lesson -= $map->subject_block;
            if ($this->waiting[$map->code]->number_of_lesson == 0) {
                unset($this->waiting[$map->code]);
            }
        }

        return true;
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

    public function shortByUsingLab($a, $b): bool
    {
        if ($a->subject_block == $b->subject_block) {
            return rand(0, 1) == 0;
            //return $a->team_name < $b->team_name;
        } else {
            return $a->subject_block < $b->subject_block;
        }
    }

    public function randomShort($a, $b): bool {
        return rand(0, 1) == 0;
    }
}
