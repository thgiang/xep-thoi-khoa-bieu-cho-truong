<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('lab_id')->nullable()->comment('Sử dụng phòng thực hành nếu có');
            $table->integer('block')->default(1)->comment('So tiet lien tiep bat buoc, vi du Tin can 2 tiet');
            $table->boolean('avoid_last_lesson')->default(false)->comment('Tranh tiet cuoi cho 1 so mon the duc, toan, van');
            $table->boolean('require_spacing')->default(true)->comment('Tránh việc 2 ngày liên tiếp cùng học 1 môn');
            $table->string('group')->comment('2 môn Văn và VănKT cho vào group Văn để khi xếp ko bị 1 ngày học 2 môn cùng group');
            $table->integer('priority')->default(0)->comment('Độ ưu tiên của môn học trong ngày, ví dụ VănKT, Văn, Toán, Thể');
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
        Schema::dropIfExists('subjects');
    }
}
