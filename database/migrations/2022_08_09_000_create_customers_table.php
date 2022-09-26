<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('admin_group_id');
            $table->bigInteger('person_id');
            $table->timestamps();
            // $table->string('role')->default(2);
            $table->boolean('is_new')->default(true);

            $table->foreign('person_id')->references('id')->on('people');
            // $table->foreign("admin_group_id")->references("id")->on("admin_groups");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
