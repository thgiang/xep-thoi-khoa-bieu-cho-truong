<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen';

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
        $data = [];
        //$data[] = ['name' => 'Tâm', 'line' => ''];
        $data[] = ['name' => 'Hà', 'line' => 'Toán 8 A 4,Tin 6 ABCD 4,Tin 8 ABCD 8'];
        $data[] = ['name' => 'Tuấn', 'line' => 'Văn 7 D 2,VănKT 7 D 2'];
        $data[] = ['name' => 'Tân', 'line' => 'Văn 9 BD 6,VănKT 9 BD 4'];
        $data[] = ['name' => 'Tr.Hoa', 'line' => 'Văn 7 AB 4,VănKT 7 AB 4,CD 8 ABCD 4'];
        $data[] = ['name' => 'Thơm', 'line' => 'Văn 7 C 2,VănKT 7 C 2,Sử 8 ABCD 8,CN 6 AB 4,CN 7 ABCD 4'];
        $data[] = ['name' => 'Hường', 'line' => 'Văn 8 AC 4,VănKT 8 AC 4,TD 7 AB 4'];
        $data[] = ['name' => 'L.Anh', 'line' => 'Văn 8 BD 4,VănKT 8 BD 4,CD 9 ABCD 4'];
        $data[] = ['name' => 'Nguyệt', 'line' => 'Văn 9 AC 6,VănKT 9 AC 4,Địa 8 AC 2'];
        $data[] = ['name' => 'Tr.Xuyến', 'line' => 'Văn 6 CD 4,VănKT 6 CD 4,Sử 9 ABCD 4,CD 7 ABCD 4'];
        $data[] = ['name' => 'Mai', 'line' => 'Địa 6 ABCD 8,Địa 7 A 2,Địa 8 BD 2,Địa 9 ABCD 8'];
        $data[] = ['name' => 'Huyền', 'line' => 'Sử 6 ABCD 4,Sử 7 ABCD 8,Địa 7 BCD 6,TD 7 C 2'];
        $data[] = ['name' => 'N.Xuyến', 'line' => 'Anh 7 AC 6,Anh 8 A 3,Anh 9 C 2'];
        $data[] = ['name' => 'Chuyên', 'line' => 'Anh 6 ABCD 12,Anh 8 C 3,Anh 9 A 2'];
        $data[] = ['name' => 'Ngát', 'line' => 'Anh 7 BD 6,Anh 8 BD 6,Anh 9 BD 4'];
        $data[] = ['name' => 'Nhật', 'line' => 'MT 6 ABCD 4,MT 7 ABCD 4,MT 8 ABCD 4,MT 9 ABCD 4,Nhạc 6 CD 2,Nhạc 7 D 1'];
        $data[] = ['name' => 'Ng.Hương', 'line' => 'Nhạc 6 AB 2 Nhạc 7 ABC 3,Nhạc 8 ABCD 4'];
        $data[] = ['name' => 'Bông', 'line' => 'Văn 6 AB 4,VănKT 6 AB 4,CD 6 ABCD 4'];
        foreach ($data as $datum) {
            $this->writeFile($datum['name'], $datum['line']);
        }
        return 0;
    }

    public function writeFile($name, $line) {
        $mons = explode(',', $line);
        $text = '//'.$name."\n";
        foreach ($mons as $m) {
            $mon = explode(' ', $m);
            $lops = str_split($mon[2]);
            $tiet = $mon[3] / count($lops);

            foreach ($lops as $lop) {
                $l = $mon[1].$lop;
                $subject = $mon[0]. ' '.$mon[1];
                $text .= '$data[] = [\'team_name\' => \''.$l.'\', \'teacher_name\' => \''.$name.'\', \'subject_name\' => \''.$subject.'\', \'number_of_lesson\' => '.$tiet.'];'."\n";
            }
        }
        $text .= "\n";

        file_put_contents('map.txt', $text, FILE_APPEND);
    }
}
