<?php

namespace App\Console\Commands;

use App\Models\Lab;
use App\Models\MapTeacherSubjectTeam;
use App\Models\Teacher;
use App\Models\Team;
use App\Services\GenTKB;
use Illuminate\Console\Command;

class run2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $teachers = Teacher::get();
        $labs = Lab::get();
        $teams = Team::get();
        $maps = MapTeacherSubjectTeam::with('teacher', 'subject', 'team', 'subject')->get();

        $maxScore = -99999;
        for ($i = 0; $i < 10000; $i++) {
            echo 'Chay lan '.$i.': ';
            $generator = new GenTKB($teachers, $labs, $teams, $maps);
            $result = $generator->generateBase();
            if ($result != false) {
                $score = $result->score;
                echo $score;
                echo ' / ';
                echo $maxScore;
                if ($score > $maxScore) {
                    $maxScore = $score;
                    file_put_contents('ketqua', json_encode($result));
                }
            } else {
                echo "False";
            }
            echo "\n";
        }

        return 0;
    }
}
