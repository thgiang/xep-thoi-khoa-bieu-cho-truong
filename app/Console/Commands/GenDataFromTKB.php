<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenDataFromTKB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'from_tkb';

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
        $tkb = '9A|Văn|Nguyệt
9A|Văn|Nguyệt
9A|Địa|Mai
9A|Anh|Chuyên
9A|Hóa|Phương
9A|Toán|T.Hà
9A|Sinh|Ly
9A|CN|Hướng
9A|CD|L.Anh
9A|Văn|Nguyệt
9A|Văn|Nguyệt
9A|TD|Long
9A|Sử|T.Xuyến
9A|Toán|T.Hà
9A|Tin|Nghiệp
9A|Tin|Nghiệp
9A|TD|Long
9A|Lý|Nhung
9A|Hóa|Phương
9A|Toán|T.Hà
9A|Văn|Nguyệt
9A|Anh|Chuyên
9A|MT|Nhật
9A|Lý|Nhung
9A|Địa|Mai
9A|Sinh|Ly
9A|Toán|T.Hà
9A|SH|T.Hà
9B|Địa|Mai
9B|Toán|Hướng
9B|Văn|Tân
9B|Anh|Ngát
9B|CD|L.Anh
9B|Văn|Tân
9B|Hóa|Phương
9B|Sinh|Ly
9B|CN|Hướng
9B|Văn|Tân
9B|Toán|Hướng
9B|Sử|T.Xuyến
9B|MT|Nhật
9B|TD|Long
9B|TD|Long
9B|Toán|Hướng
9B|Lý|Tuyên
9B|Hóa|Phương
9B|Văn|Tân
9B|Văn|Tân
9B|Lý|Tuyên
9B|Anh|Ngát
9B|Sinh|Ly
9B|Tin|Tuyên
9B|Tin|Tuyên
9B|Địa|Mai
9B|Toán|Hướng
9B|SH|Hướng
9C|Anh|N.Xuyến
9C|Địa|Mai
9C|Tin|Nghiệp
9C|Tin|Nghiệp
9C|Toán|T.Hà
9C|CN|Hướng
9C|CD|L.Anh
9C|Hóa|Phương
9C|Sinh|Ly
9C|TD|Long
9C|Địa|Mai
9C|Toán|T.Hà
9C|Văn|Nguyệt
9C|Văn|Nguyệt
9C|Hóa|Phương
9C|Sinh|Ly
9C|Lý|Nhung
9C|TD|Long
9C|Văn|Nguyệt
9C|Văn|Nguyệt
9C|Toán|T.Hà
9C|MT|Nhật
9C|Anh|N.Xuyến
9C|Toán|T.Hà
9C|Lý|Nhung
9C|Sử|T.Xuyến
9C|Văn|Nguyệt
9C|SH|Nguyệt
9D|Văn|Tân
9D|Anh|Ngát
9D|Toán|Hướng
9D|Địa|Mai
9D|Văn|Tân
9D|Sinh|Ly
9D|CN|Hướng
9D|CD|L.Anh
9D|Hóa|Phương
9D|Toán|Hướng
9D|Văn|Tân
9D|Văn|Tân
9D|TD|Long
9D|Sử|T.Xuyến
9D|Lý|Tuyên
9D|TD|Long
9D|Hóa|Phương
9D|Toán|Hướng
9D|MT|Nhật
9D|Sinh|Ly
9D|Văn|Tân
9D|Lý|Tuyên
9D|SH|Tân
9D|Địa|Mai
9D|Toán|Hướng
9D|Anh|Ngát
9D|Tin|Tuyên
9D|Tin|Tuyên
8A|Tin|H.Hà
8A|Tin|H.Hà
8A|Văn|Hường
8A|Toán|H.Hà
8A|Sử|Thơm
8A|Anh|N.Xuyến
8A|Lý|Tuyên
8A|TD|Long
8A|Địa|Nguyệt
8A|CN|HàHT
8A|Hóa|Phương
8A|Anh|N.Xuyến
8A|Văn|Hường
8A|Văn|Hường
8A|Toán|H.Hà
8A|Sinh|H.Hương
8A|Văn|Hường
8A|CN|HàHT
8A|Sử|Thơm
8A|Nhạc|N.Hương
8A|Sinh|H.Hương
8A|Toán|H.Hà
8A|Anh|N.Xuyến
8A|Hóa|Phương
8A|Toán|H.Hà
8A|MT|Nhật
8A|TD|Long
8A|CD|T.Hoa
8A|SH|H.Hà
8B|Anh|Ngát
8B|Toán|Nghiệp
8B|Văn|L.Anh
8B|CN|H.Hương
8B|Toán|Nghiệp
8B|Lý|Tuyên
8B|TD|Long
8B|CD|T.Hoa
8B|Sử|Thơm
8B|Văn|L.Anh
8B|Văn|L.Anh
8B|Anh|Ngát
8B|Nhạc|N.Hương
8B|Hóa|Phương
8B|Sinh|H.Hương
8B|Sử|Thơm
8B|Toán|Nghiệp
8B|Địa|Mai
8B|CN|H.Hương
8B|Tin|H.Hà
8B|Tin|H.Hà
8B|Hóa|Phương
8B|TD|Long
8B|Sinh|H.Hương
8B|Anh|Ngát
8B|Văn|L.Anh
8B|Toán|Nghiệp
8B|MT|Nhật
8B|SH|Nghiệp
8C|Văn|Hường
8C|CN|Nhung
8C|Anh|Chuyên
8C|Toán|Hướng
8C|TD|Long
8C|CD|T.Hoa
8C|Sử|Thơm
8C|Địa|Nguyệt
8C|Lý|Tuyên
8C|Hóa|Phương
8C|Sử|Thơm
8C|Toán|Hướng
8C|CN|Nhung
8C|Nhạc|N.Hương
8C|Toán|Hướng
8C|Tin|H.Hà
8C|Tin|H.Hà
8C|Sinh|H.Hương
8C|Anh|Chuyên
8C|Sinh|H.Hương
8C|Hóa|Phương
8C|Văn|Hường
8C|Văn|Hường
8C|Anh|Chuyên
8C|MT|Nhật
8C|TD|Long
8C|Toán|Hướng
8C|Văn|Hường
8C|SH|Hường
8D|Toán|T.Hà
8D|Văn|L.Anh
8D|Anh|Ngát
8D|CN|Nhung
8D|Lý|Tuyên
8D|TD|Long
8D|CD|T.Hoa
8D|Sử|Thơm
8D|MT|Nhật
8D|Sử|Thơm
8D|Toán|T.Hà
8D|Hóa|Phương
8D|Anh|Ngát
8D|CN|Nhung
8D|Văn|L.Anh
8D|Địa|Mai
8D|Sinh|H.Hương
8D|Tin|H.Hà
8D|Tin|H.Hà
8D|Toán|T.Hà
8D|Nhạc|N.Hương
8D|TD|Long
8D|Sinh|H.Hương
8D|Anh|Ngát
8D|Hóa|Phương
8D|Toán|T.Hà
8D|Văn|L.Anh
8D|Văn|L.Anh
8D|SH|L.Anh
7A|Văn|T.Hoa
7A|Toán|Tâm
7A|Anh|N.Xuyến
7A|Sinh|Tuyết
7A|Tin|H.Hương
7A|Tin|H.Hương
7A|Toán|Tâm
7A|CD|T.Xuyến
7A|Địa|Mai
7A|Toán|Tâm
7A|MT|Nhật
7A|Anh|N.Xuyến
7A|Văn|T.Hoa
7A|TD|Hường
7A|Nhạc|N.Hương
7A|Sử|Huyền
7A|Sinh|Tuyết
7A|Địa|Mai
7A|Sử|Huyền
7A|CN|Thơm
7A|Văn|T.Hoa
7A|Văn|T.Hoa
7A|TD|Hường
7A|Toán|Tâm
7A|Anh|N.Xuyến
7A|Lý|Tâm
7A|SH|Tâm
7B|Toán|Tâm
7B|Văn|T.Hoa
7B|Sinh|Tuyết
7B|Địa|Huyền
7B|MT|Nhật
7B|Toán|Tâm
7B|Tin|H.Hương
7B|Tin|H.Hương
7B|Toán|Tâm
7B|CD|T.Xuyến
7B|Văn|T.Hoa
7B|Văn|T.Hoa
7B|Anh|Ngát
7B|Nhạc|N.Hương
7B|TD|Hường
7B|Sinh|Tuyết
7B|Sử|Huyền
7B|Anh|Ngát
7B|CN|Thơm
7B|Anh|Ngát
7B|Sử|Huyền
7B|Lý|Tâm
7B|Toán|Tâm
7B|TD|Hường
7B|Văn|T.Hoa
7B|Địa|Huyền
7B|SH|T.Hoa
7C|Toán|Nhung
7C|Sinh|Tuyết
7C|Địa|Huyền
7C|Anh|N.Xuyến
7C|Anh|N.Xuyến
7C|Nhạc|N.Hương
7C|MT|Nhật
7C|Sinh|Tuyết
7C|Tin|H.Hương
7C|Tin|H.Hương
7C|Toán|Nhung
7C|Văn|Thơm
7C|Văn|Thơm
7C|Toán|Nhung
7C|TD|Huyền
7C|Văn|Thơm
7C|CN|Thơm
7C|Sử|Huyền
7C|Lý|Tâm
7C|Sử|Huyền
7C|Văn|Thơm
7C|TD|Huyền
7C|Địa|Huyền
7C|CD|T.Xuyến
7C|Toán|Nhung
7C|Anh|N.Xuyến
7C|SH|N.Xuyến
7D|Sinh|Tuyết
7D|Địa|Huyền
7D|Toán|Nhung
7D|Văn|Tuấn
7D|Văn|Tuấn
7D|Văn|Tuấn
7D|TD|Tuyết
7D|MT|Nhật
7D|Toán|Nhung
7D|Anh|Ngát
7D|TD|Tuyết
7D|Tin|H.Hương
7D|Tin|H.Hương
7D|Sử|Huyền
7D|Toán|Nhung
7D|Văn|Tuấn
7D|Anh|Ngát
7D|Sinh|Tuyết
7D|Anh|Ngát
7D|Nhạc|Nhật
7D|Lý|Tâm
7D|CN|Thơm
7D|CD|T.Xuyến
7D|Sử|Huyền
7D|Địa|Huyền
7D|Toán|Nhung
7D|SH|Nhung
6A|KHTN|Ly
6A|Văn|Bông
6A|MT|Nhật
6A|CN|Thơm
6A|Sử|Huyền
6A|Toán|Nghiệp
6A|Nhạc|N.Hương
6A|Địa|Mai
6A|Văn|Bông
6A|Văn|Bông
6A|Anh|Chuyên
6A|TD|Tuyết
6A|Toán|Nghiệp
6A|Địa|Mai
6A|Anh|Chuyên
6A|KHTN|Ly
6A|Toán|Nghiệp
6A|Anh|Chuyên
6A|TD|Tuyết
6A|KHTN|Ly
6A|CD|Bông
6A|KHTN|Ly
6A|Tin|H.Hà
6A|Văn|Bông
6A|Toán|Nghiệp
6A|SH|Bông
6B|Văn|Bông
6B|MT|Nhật
6B|CN|Thơm
6B|Toán|H.Hoa
6B|KHTN|Ly
6B|Địa|Mai
6B|Sử|Huyền
6B|Nhạc|N.Hương
6B|Toán|H.Hoa
6B|TD|Tuyết
6B|Văn|Bông
6B|Văn|Bông
6B|Anh|Chuyên
6B|Anh|Chuyên
6B|Toán|H.Hoa
6B|Địa|Mai
6B|KHTN|Ly
6B|TD|Tuyết
6B|Văn|Bông
6B|CD|Bông
6B|KHTN|Ly
6B|Anh|Chuyên
6B|Toán|H.Hoa
6B|Tin|H.Hà
6B|KHTN|Ly
6B|SH|Ly
6C|Toán|H.Hoa
6C|Văn|T.Xuyến
6C|CN|H.Hương
6C|KHTN|Tuyên
6C|Địa|Mai
6C|Sử|Huyền
6C|Văn|T.Xuyến
6C|KHTN|Tuyên
6C|TD|Tuyết
6C|Toán|H.Hoa
6C|Địa|Mai
6C|Anh|Chuyên
6C|Nhạc|Nhật
6C|Toán|H.Hoa
6C|KHTN|Tuyên
6C|Văn|T.Xuyến
6C|Văn|T.Xuyến
6C|KHTN|Tuyên
6C|Anh|Chuyên
6C|TD|Tuyết
6C|Tin|H.Hà
6C|Toán|H.Hoa
6C|Anh|Chuyên
6C|MT|Nhật
6C|CD|Bông
6C|SH|T.Xuyến
6D|Văn|T.Xuyến
6D|CN|H.Hương
6D|Toán|H.Hoa
6D|MT|Nhật
6D|Văn|T.Xuyến
6D|KHTN|Phương
6D|Địa|Mai
6D|Sử|Huyền
6D|Anh|Chuyên
6D|Nhạc|Nhật
6D|Toán|H.Hoa
6D|KHTN|Phương
6D|Địa|Mai
6D|Văn|T.Xuyến
6D|Văn|T.Xuyến
6D|Toán|H.Hoa
6D|Anh|Chuyên
6D|CD|Bông
6D|TD|Long
6D|Anh|Chuyên
6D|KHTN|Phương
6D|TD|Long
6D|KHTN|Phương
6D|Toán|H.Hoa
6D|Tin|H.Hà
6D|SH|H.Hoa';

        $lines = explode(PHP_EOL, $tkb);
        $tietHoc = array();
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            $team_name = $parts[0];
            // Tin 6
            $subject = $parts[1] . ' ' . substr($parts[0], 0, 1);
            $teacher_name = $parts[2];

            if (!isset($tietHoc[$team_name.'__'.$subject.'__'.$teacher_name])) {
                $tietHoc[$team_name.'__'.$subject.'__'.$teacher_name] = array();
                $tietHoc[$team_name.'__'.$subject.'__'.$teacher_name]['teacher_name'] = $teacher_name;
                $tietHoc[$team_name.'__'.$subject.'__'.$teacher_name]['subject_name'] = $subject;
                $tietHoc[$team_name.'__'.$subject.'__'.$teacher_name]['team_name'] = $team_name;
                $tietHoc[$team_name.'__'.$subject.'__'.$teacher_name]['number_of_lesson'] = 0;
            }
            $tietHoc[$team_name.'__'.$subject.'__'.$teacher_name]['number_of_lesson']++;
        }

        $text = '';
        foreach ($tietHoc as $item) {
            $l = $item['team_name'];
            $name = $item['teacher_name'];
            $subject = $item['subject_name'];
            $tiet = $item['number_of_lesson'];
            if (mb_substr($subject, 0, 3) == 'Văn') {
                $tiet -= 2;
                $kt = str_replace('Văn', 'VănKT', $subject);
                $text .= '$data[] = [\'team_name\' => \''.$l.'\', \'teacher_name\' => \''.$name.'\', \'subject_name\' => \''.$kt.'\', \'number_of_lesson\' => 2];'."\n";
            }
            $text .= '$data[] = [\'team_name\' => \''.$l.'\', \'teacher_name\' => \''.$name.'\', \'subject_name\' => \''.$subject.'\', \'number_of_lesson\' => '.$tiet.'];'."\n";
        }

        file_put_contents('pccm_tu_tkb.txt', $text);
        return 0;
    }
}
