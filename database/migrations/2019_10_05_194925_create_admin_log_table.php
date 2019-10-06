<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->comment('用户名');
            $table->string('password')->nullable()->comment('密码');
            $table->string('admin_ip')->nullable()->comment('登录IP');
            $table->Integer('status')->default(1)->comment('状态,1:登录成功,2:登录失败,3:修改密码');
            $table->string('message')->nullable()->comment('日志内容');
            $table->string('todo')->nullable()->comment('操作');
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
        Schema::dropIfExists('admin_log');
    }
}
