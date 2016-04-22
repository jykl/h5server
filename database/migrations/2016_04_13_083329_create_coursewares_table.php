<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursewaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coursewares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();//创建者的id
            $table->integer('c_type')->default(0);//课件类型,0:个人,1:标准,2:非标准
            $table->integer('score')->default(0);//星级评分
            $table->string('label')->nullable();//备注
            $table->string('position_id');//12160109020905七个值定位课件位置

            $table->softDeletes();

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
        Schema::drop('coursewares');
    }
}
