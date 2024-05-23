<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWdwModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wdw_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('student_id')->default('');  // 设置默认值为空字符串
            $table->string('major');
            $table->string('class');
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
        Schema::dropIfExists('wdw_models');
    }
}
