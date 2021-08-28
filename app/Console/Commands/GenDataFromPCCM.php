<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenDataFromPCCM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pccm';

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
        $lines = explode(PHP_EOL, file_get_contents('pccm.txt'));
        $data = [];
        foreach ($lines as $line) {
            $parts = explode(',', $line);
            $data[$parts[0]] = array();
            foreach ($parts as $i => $part) {
                if ($i == 0) {
                    continue;
                }
                $mls = explode(' ', $part);
                $mon = $mls[0];
                $lops = str_split($mls[1]);

                $mon = $mon . ' ' . $lops[0];
                $lop = strtoupper($mls[1]);
                if (!isset($data[$parts[0]][$mon])) {
                    $data[$parts[0]][$mon] = array();
                }
                if (!isset($data[$parts[0]][$mon][$lop])) {
                    $data[$parts[0]][$mon][$lop] = 0;
                }
                $data[$parts[0]][$mon][$lop]++;
            }
        }

        $text = "";
        foreach ($data as $name => $datum) {
            $text .= "\n" . '//' . $name . "\n";
            foreach ($datum as $subject => $item) {
                foreach ($item as $lop => $number_of_lesson) {
                    if (mb_substr($subject, 0, 3) == 'Văn') {
                        $number_of_lesson -= 2;
                        $kt = str_replace('Văn', 'VănKT', $subject);
                        $text .= '$data[] = [\'team_name\' => \'' . $lop . '\', \'teacher_name\' => \'' . $name . '\', \'subject_name\' => \'' . $kt . '\', \'number_of_lesson\' => 2];' . "\n";
                    }
                    $text .= '$data[] = [\'team_name\' => \'' . $lop . '\', \'teacher_name\' => \'' . $name . '\', \'subject_name\' => \'' . $subject . '\', \'number_of_lesson\' => ' . $number_of_lesson . '];' . "\n";
                }
            }
        }
        file_put_contents('map.txt', $text);
        return 0;
    }
}
