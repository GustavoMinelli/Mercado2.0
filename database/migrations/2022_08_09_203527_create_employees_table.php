<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('person_id');
            $table->bigInteger('role_id');
            // $table->unsignedInteger('admin_group_id');
            $table->timestamps();
            $table->boolean('is_new')->default(true);
            $table->string('work_code')->unique()->nullable();

            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('role_id')->references('id')->on('employee_roles');
            // $table->foreign('admin_group_id')->references('id')->on('admin_groups');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
