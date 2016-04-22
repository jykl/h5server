<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();//创建者的id
            $table->integer('e_type');//类型,0:文件夹,1:切片坑,2:切片
            $table->string('name');//切片名字
            $table->string('label');//备注
            $table->string('url');//切片路径
            $table->integer('parent_id')->index();//在切片库中的父级id
            $table->string('grade_subject');//学科,学部
            $table->integer('content_type')->default(0);//包含内容,0:普通,1:图片,2:视频,4:几何画板,使用2进制表示组合,如3=1+2,表示有视频和图片
            $table->integer('order_index')->default(0);//切片有顺序

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
        Schema::drop('elements');
    }
}
