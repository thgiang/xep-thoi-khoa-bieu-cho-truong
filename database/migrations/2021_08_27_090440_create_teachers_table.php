<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('has_children')->default(0)->comment('Co con nho hay ko');
            $table->string('skip_days')->nullable()->comment('Tranh nhung ngay nay ra do co viec ca nhan');
            $table->boolean('team_id')->nullable()->comment('ID lop ma nguoi nay lam chu nhiem');
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
        Schema::dropIfExists('teachers');
    }
}
