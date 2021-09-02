<?php



namespace App\Http\Controllers;
set_time_limit(-1);

use App\Models\Lab;
use App\Models\MapTeacherSubjectTeam;
use App\Models\Teacher;
use App\Models\Team;
use App\Services\GenTKB;

class HomeController extends Controller
{
    public function generateScheduler()
    {
//        $teachers = Teacher::get();
//        $labs = Lab::get();
//        $teams = Team::get();
//        $maps = MapTeacherSubjectTeam::with('teacher', 'subject', 'team', 'subject')->get();
//
//        for ($i = 0; $i < 1000; $i++) {
//            $generator = new GenTKB($teachers, $labs, $teams, $maps);
//            $result = $generator->generateBase();
//            if ($result != false) {
//                break;
//            }
//        }
//
//        file_put_contents('tkb_raw.txt', json_encode($result));

        $result = json_decode(file_get_contents('../ketqua'));
        $schedule = $result->schedule;
        $wating = $result->waiting;
        $teams = $result->teams;
        $score = $result->score;
        return view('schedule2', compact('schedule', 'teams', 'score'));
    }
}
