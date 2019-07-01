<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsRolesTable extends Migration
{
    public function up()
    {
        Schema::create('permissions_roles', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}