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
            $table->integer('require_couple')->default(0)->comment('Yeu cau co it nhat X lan trong tuan co 2 tiet lien, vi du kiem tra Van');
            $table->boolean('is_eow')->default(false)->comment('Tiet sinh hoat fix cung vao cuoi tuan');
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
