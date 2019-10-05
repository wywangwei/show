<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->comment('用户名');
            $table->string('password')->comment('密码');
            $table->tinyInteger('is_root')->default(0)->comment('是否是管理员');
            $table->Integer('role_id')->nullable()->comment('角色ID');
            $table->Integer('group_id')->nullable()->comment('角色ID');
            $table->string('admin_ip')->nullable()->comment('登录IP');
            $table->Integer('admin_num')->nullable()->comment('登录次数');
            $table->string('remember_token')->nullable()->comment('token标识');
            $table->Integer('status')->default(1)->comment('是否启用,1:启用,0:不启用');
            $table->string('admin_name')->nullable()->comment('真实姓名');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
