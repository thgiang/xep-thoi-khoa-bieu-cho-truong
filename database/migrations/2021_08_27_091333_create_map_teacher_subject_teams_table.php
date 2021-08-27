<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapTeacherSubjectTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_teacher_subject_teams', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('subject_id');
            $table->integer('team_id');
            $table->integer('number_of_lesson')->comment('Tong so tiet hoc cua mon nay trong lop nay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_teacher_subject_teams');
    }
}
