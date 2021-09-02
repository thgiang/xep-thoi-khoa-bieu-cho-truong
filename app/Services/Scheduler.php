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
    private $teacherLessons; // Danh sách giáo án của giáo viên trong ngày $teacherLessons['Duyên']['D5'] = array('Toán 8_1', 'Toán 8_2', 'KHTN 6_1');

    public function __construct()
    {
        $this->prependData();
    }

    public function prependData()
    {
        $this->lessons = MapTeacherSubjectTeam::with('team', 'teacher', 'subject', 'subject.lab')->get();
        $this->teams = (object)array();
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
    public function generateBase()
    {
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
                        if (isset($this->results['D' . $day]['O' . $order][$map->team->name])) {
                            continue;
                        }

                        // Ghi tiết đầu tiên đang chờ
                        $lesson = new Lesson();
                        $lesson->subject = $map->subject;
                        $lesson->team = $map->team;
                        $lesson->teacher = $map->teacher;
                        $lesson->lab = $map->subject->lab;

                        $this->setLessonForBase($day, $order, $lesson, $map);
                    }
                }
            }
            if (count($this->waitingLessons) == 0) {
                break;
            }
        }
    }

    /*
     * Set cứng tiết chào cờ và tiết sinh hoạt
     */
    public function setCCAndSH()
    {
        foreach ($this->teams as $team) {
            // Ghi ngày nghỉ
            for ($day = 2; $day <= $this->lastDay; $day++) {
                for ($order = 1; $order <= $this->lastOrder; $order++) {
                    // Ghi tiết nghỉ nếu tiết này là tiết nghỉ
                    if ($this->isOffLesson($day, $order, substr($team->name, 0, 1))) {
                        $ccLesson = new Lesson();
                        $ccLesson->isStatic = true;
                        $ccLesson->team = $team;
                        $ccLesson->subject = new Subject();
                        $ccLesson->subject->block = 1;
                        $ccLesson->subject->name = '-';
                        $ccMap = new MapTeacherSubjectTeam();
                        $this->setLessonForBase($day, $order, $ccLesson, $ccMap);
                        continue;
                    }
                }
            }

            // Chào cờ
            $ccLesson = new Lesson();
            $ccLesson->team = $team;
            $ccLesson->isStatic = true;
            $ccLesson->subject = new Subject();
            $ccLesson->subject->block = 1;
            $ccLesson->subject->name = 'Chào cờ';
            $ccMap = new MapTeacherSubjectTeam();
            $this->setLessonForBase(2, 1, $ccLesson, $ccMap);

            // Sinh hoạt
            foreach ($this->waitingLessons as $waitingLesson) {
                if ($waitingLesson->team->id == $team->id && substr($waitingLesson->subject->name, 0, 2) == 'SH') {
                    $lesson = new Lesson();
                    $lesson->isStatic = true;
                    $lesson->subject = $waitingLesson->subject;
                    $lesson->team = $waitingLesson->team;
                    $lesson->teacher = $waitingLesson->teacher;
                    $lesson->lab = $waitingLesson->subject->lab;
                    for ($n = $this->lastDay; $n >= 2; $n--) {
                        if ($this->isTeacherDayOff($n, $this->lastOrder, $lesson->teacher) == 'none') {
                            $this->setLessonForBase($n, $this->lastOrder, $lesson, $waitingLesson);
                            break;
                        }
                    }
                }
            }
        }
    }

    /*
     * Set môn học vào TKB cơ sở, tuyệt đối không dùng ở giai đoạn tiến hóa do logic sử dụng khác nhau
     * Giai đoạn tiến hóa dùng hàm setLessonEvolution
     */
    public function setLessonForBase($day, $order, $lesson, $map)
    {
        /* Tạm bỏ yêu cầu này vì dù sao lát nữa ở bước evolution cũng bị đảo lên
        if ($this->isNotEnoughSpaceForBlock($day, $order, $lesson)) {
            // Không thể sắp môn học có 2 tiết vào tiết cuối vì sẽ bị học quá trưa
            return false;
        }
        */

        // Kiểm tra xem tiết này đã có môn chưa
        for ($i = 0; $i < $lesson->subject->block; $i++) {
            if (isset($this->results['D' . $day]['O' . $order][$lesson->team->name])
                &&
                $this->results['D' . $day]['O' . $order][$lesson->team->name]->subject->name != '') {
                return false;
            }
        }
        // Ghi tiết học vào TKB
        for ($i = 0; $i < $lesson->subject->block; $i++) {
            $this->results['D' . $day]['O' . ($order + $i)][$lesson->team->name] = $lesson;
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
    public function isOffLesson($day, $order, $group): bool
    {
        // Khối 8 học full, còn các khối khác đc nghỉ 1 vài tiết 5
        // Khối 6 nghỉ thứ 3, 5, 6
        if ($group == 6 && $order == $this->lastOrder && ($day == 3 || $day == 5 || $day == 6)) {
            return true;
        } // Khối 7 nghỉ thứ 3, 6
        else if ($group == 7 && $order == $this->lastOrder && ($day == 3 || $day == 6)) {
            return true;
        } // Khối 9 nghỉ thứ 5
        else if ($group == 9 && $order == $this->lastOrder && ($day == 5)) {
            return true;
        }
        return false;
    }

    /*
     * Kiểm tra xem có phải ngày giáo viên muốn nghỉ hay ko
     */
    public function isTeacherDayOff($day, $order, $teacher)
    {

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

    /*
     * Tiến hóa đến mức đúng
     */
    public function evolutionToCorrect()
    {
        $theHe = 0;
        $start = microtime(true);
        do {
            $theHe ++;
            $hasIssue = false;
            for ($day = 2; $day <= $this->lastDay; $day++) {
                for ($order = 1; $order <= $this->lastOrder; $order++) {
                    foreach ($this->results['D' . $day]['O' . $order] as $k => $lesson) {
                        if ($lesson->teacher && $this->isTeacherBusy($day, $order, $lesson->team, $lesson)) {
                            $this->results['D' . $day]['O' . $order][$k]->isTeacherBusy = true;
                            // Rơi vào tình huống trùng lịch thì tìm giáo viên thay
                            $replacementTeacher = $this->findFirstReplacementTeacher($day, $order, $lesson);
                            // Ko tìm đc giáo viên thay thế
                            if ($replacementTeacher['D'] == null) {
                                $hasIssue = true;
                                continue;
                            } else {
                                // Có tìm đc giáo viên thay thế thì đảo tiết giữa 2 GV
                                // Sau khi đảo xong thì cả 2 giáo viên đã hết bị trùng tiết
                                $replacementLesson = $this->results['D' . $replacementTeacher['D']]['O' . $replacementTeacher['O']][$k];
                                $replacementLesson->isTeacherBusy = false;
                                $tmpLesson = $this->results['D' . $day]['O' . $order][$k];
                                $tmpLesson->isTeacherBusy = false;

                                $this->setLessonEvolution($day, $order, $replacementLesson);
                                $this->setLessonEvolution($replacementTeacher['D'], $replacementTeacher['O'], $tmpLesson);
                            }
                        } else {
                            $this->results['D' . $day]['O' . $order][$k]->isTeacherBusy = false;
                        }
                    }
                }
            }
        } while ($hasIssue == true);
        $stop = microtime(true);

        echo  'Kết quả thế hệ thứ '. $theHe . ' sau ' .number_format($stop - $start) .' giây';
    }

    /*
     * Tìm giáo viên thay thế phù hợp
     */
    public function findFirstReplacementTeacher($replaceDay, $replaceOrder, $lesson): array
    {
        $team = $lesson->team;
        for ($day = 2; $day <= $this->lastDay; $day++) {
            for ($order = 1; $order <= $this->lastOrder; $order++) {
                if (!isset($this->results['D'.$day]['O'.$order][$team->name])) {
                    continue;
                }
                $lesson = $this->results['D'.$day]['O'.$order][$team->name];
                if ($lesson->teacher && !$lesson->isStatic) {
                    // Nếu có giáo viên và giáo viên hôm đó có thể thay thế cho hôm nay
                    if (!$this->isTeacherBusy($replaceDay, $replaceOrder, $team, $lesson)) {
                        // Và ngược lại giáo viên hôm nay đảo sang hôm đó cũng ko bị trùng lịch
                        if (!$this->isTeacherBusy($day, $order, $team, $this->results['D'.$replaceDay]['O'.$replaceOrder][$team->name])) {
                            return array('D' => $day, 'O' => $order);
                        }
                    }
                }
            }
        }
        return array('D' => null, 'O' => null);
    }

    /*
     * Kiểm tra tiết này giáo viên có đang bị trùng lịch không
     */
    public function isTeacherBusy($day, $order, $team, $lesson)
    {
        // Tiết giáo viên nghỉ thì auto là bận
        if ($this->isTeacherDayOff($day, $order, $lesson->teacher) == 'require') {
            return true;
        }

        // 1 giáo viên 1 ngày ko dạy quá 3 giáo án, vì vậy nếu đủ rồi là bận
        $countTeacherLessons = 0;
        if (isset($this->teacherLessons[$lesson->teacher->name]) && isset($this->teacherLessons[$lesson->teacher->name]['D'.$day])) {
            // Đếm số giáo án đang có
            $teacherLessons = $this->teacherLessons[$lesson->teacher->name]['D'.$day];
            $countTeacherLessons = count($teacherLessons);

            // Xác định xem nếu bây giờ đặt giáo viên vào tiết này thì sẽ là giáo án thứ bao nhiêu
            $currentPositionOfGa = $this->countPreviousSameLesson($day, $order, $lesson) + 1;
            $gaName = $lesson->subject->name .'__'.$currentPositionOfGa;
            if (!in_array($gaName, $teacherLessons)) {
                $countTeacherLessons ++;
            }
            // Nếu có trên 3 giáo án thì loại
            if ($countTeacherLessons > 3) {
                // echo 'Giáo viên '.$lesson->teacher->name.' ngày '.$day.' đã đủ '.($countTeacherLessons - 1).' giáo án<Br>';
                return true;
            }
        }

        foreach ($this->results['D' . $day]['O' . $order] as $item) {
            if (!$item->teacher || !$item->teacher->name) {
                continue;
            }
            if ($item->team->name != $team->name && $item->teacher->name == $lesson->teacher->name) {
                return true;
            }
        }
    }

    /*
     * Hàm set lesson vào TKB, chỉ dùng ở giai đoạn tiến hóa
     */
    public function setLessonEvolution($day, $order, $lesson) {
        $this->results['D' . $day]['O' . $order][$lesson->team->name] = $lesson;

        // Đếm lại số giáo án trong ngày của GV
        $this->calcTeacherLessons();
    }

    /*
     * Xây dựng mảng các giáo án của giáo viên theo ngày
     */
    public function calcTeacherLessons() {
        $teamSubjects = [];
        $this->teacherLessons = array();
        for ($day = 2; $day <= $this->lastDay; $day++) {
            for ($order = 1; $order <= $this->lastOrder; $order++) {
                foreach ($this->results['D'.$day]['O'.$order] as $lesson) {
                    if (!$lesson->teacher
                        || mb_substr($lesson->subject->name, 0, -2) == 'Tin'
                        || mb_substr($lesson->subject->name, 0, -2)  == 'VănKT'
                        || mb_substr($lesson->subject->name, 0, -2)  == 'SH'
                    )
                    {
                        continue;
                    }

                    // Đếm xem đây là lần xuất hiện thứ mấy của môn học của lớp này
                    if (!isset($teamSubjects[$lesson->team->name])) {
                        $teamSubjects[$lesson->team->name] = array();
                    }
                    if (!isset($teamSubjects[$lesson->team->name][$lesson->subject->name])) {
                        $teamSubjects[$lesson->team->name][$lesson->subject->name] = 0;
                    }
                    $teamSubjects[$lesson->team->name][$lesson->subject->name]++;

                    // Tên giáo án bằng tên môn học nối với lần xuất hiện thứ mấy trong tuần
                    $gaName = $lesson->subject->name.'__'.$teamSubjects[$lesson->team->name][$lesson->subject->name];
                    if (!isset($this->teacherLessons[$lesson->teacher->name])) {
                        $this->teacherLessons[$lesson->teacher->name] = array();
                    }
                    if (!isset($this->teacherLessons[$lesson->teacher->name]['D'.$day])) {
                        $this->teacherLessons[$lesson->teacher->name]['D'.$day] = array();
                    }
                    if (!in_array($gaName, $this->teacherLessons[$lesson->teacher->name]['D'.$day])) {
                        $this->teacherLessons[$lesson->teacher->name]['D'.$day][] = $gaName;
                    }
                }
            }
        }
    }

    /*
     * Tính xem trc đó đã xuất hiện môn học này bao nhiêu lần, để suy ra giáo án mà giáo viên sẽ phải sử dụng trong ngày
     */
    public function countPreviousSameLesson($currentDay, $currentOrder, $currentLesson) {
        $count = 0;
        for ($day = 2; $day <= $currentDay; $day++) {
            for ($order = 1; $order <= $currentOrder; $order++) {
                foreach ($this->results['D' . $day]['O' . $order] as $lesson) {
                    if ($lesson->team->name == $currentLesson->team->name && $lesson->subject->name == $currentLesson->subject->name) {
                        $count++;
                    }
                }
            }
        }
        return $count;
    }

    /*
     * Khi 1 môn học có block > 1 bị move, thì hàm findReplacement đã tìm cho nó 1 vị trí đủ rộng để đặt các tiết dưới
     * Nhiệm vụ bây giờ chỉ là nối thêm các tiết trong cùng block xuống dưới
     */
    public function appendRelationshipLesson($blockDay, $blockOrder, $blockLesson) {
        for ($day = 2; $day <= $this->lastDay; $day++) {
            for ($order = 1; $order <= $this->lastOrder; $order++) {
                foreach ($this->results['D' . $day]['O' . $order] as $teamName => $lesson) {
                    if (!isset($foundLessonOnBlock[$teamName])) {
                        $foundLessonOnBlock[$teamName] = 0;
                    }
                    if ($teamName != $blockLesson->team->name) {
                        continue;
                    } else if ($day == $blockDay && ($order <= $blockOrder + $foundLessonOnBlock[$teamName])) {
                        continue;
                    } else if ($lesson->subject->name == $blockLesson->subject->name){
                        // Tìm thấy 1 môn trong block mà ko phải môn vừa đc di chuyển
                        // Thì di chuyển xuống dưới để tạo thành cụm mới
                        $foundLessonOnBlock[$teamName] ++;

                        $tmp =  $this->results['D'.$blockDay]['O'.($blockOrder + $foundLessonOnBlock[$teamName])][$teamName];
                        $this->setLessonEvolution($day, $order, $tmp);
                        $this->setLessonEvolution($blockDay, $blockOrder + $foundLessonOnBlock[$teamName], $lesson);
                    }
                }
            }
        }
    }

    public function isNotEnoughSpaceForBlock($day, $order, $lesson) {
        $minus = 0;
        if ($this->isOffLesson($day, $order, mb_substr($lesson->team->name, 0, 1))) {
            $minus = 1;
        }
        if ($this->lastOrder - $order - $minus < $lesson->subject->block - 1) {
            return true;
        }
    }
}