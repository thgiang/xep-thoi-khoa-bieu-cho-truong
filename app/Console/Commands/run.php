<?php

namespace App\Console\Commands;

use App\Services\Scheduler;
use Illuminate\Console\Command;

class run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run';

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
        $tkb = new Scheduler();
        $tkb->generateBase();
        $tkb->evolutionToCorrect();
        $tkb->fineTuning(0, 1);
        return 0;
    }
}
