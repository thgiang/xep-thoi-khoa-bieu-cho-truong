<?php


namespace App\Http\Controllers;
set_time_limit(-1);

use App\Models\Lab;
use App\Models\MapTeacherSubjectTeam;
use App\Models\Teacher;
use App\Models\Team;
use App\Services\Scheduler;

class HomeController extends Controller
{
    public function generateScheduler() {
//        $tkb = new Scheduler();
//        $tkb->generateBase();
//        $tkb->evolutionToCorrect();
//        $tkb->fineTuning();
//
//        echo $tkb->maxScore;
//        echo '<br>';

        $tkb = json_decode(file_get_contents('../best_result.txt'));
        $schedule = $tkb->schedule;
        $teams = $tkb->teams;
//        echo '<pre>';
//        print_r($schedule);
//        exit();

        return view('schedule2', compact('schedule', 'teams'));
    }
}
