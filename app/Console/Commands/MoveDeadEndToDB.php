<?php

namespace App\Console\Commands;

use App\Models\DeadEnd;
use Illuminate\Console\Command;

class MoveDeadEndToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'move_dead_end';

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
        $lines = explode(PHP_EOL, file_get_contents('deadEnd.txt'));
        foreach ($lines as $line) {
            $md5 = md5($line);

            $deadEnd = new DeadEnd();
            $deadEnd->hash = $md5;
            $deadEnd->save();
        }
        return 0;
    }
}
