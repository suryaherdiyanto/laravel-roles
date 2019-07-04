<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesUsersTable extends Migration
{
    public function up()
    {
        Schema::create('roles_users', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles_users');
    }
}
