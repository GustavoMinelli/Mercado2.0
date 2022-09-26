<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table){
        $table->id();
        $table->unsignedInteger("admin_group_id");
        $table->string("email")->unique();
        $table->string("password");
        $table->rememberToken();
        $table->timestamps();

        $table->foreign("admin_group_id")->references("id")->on("admin_groups");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("admin_users");
    }
}
