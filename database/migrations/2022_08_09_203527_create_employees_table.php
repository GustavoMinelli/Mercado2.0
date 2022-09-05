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
            $table->bigInteger('user_id');
            $table->string('address')->nullable();
            $table->string('cpf', 14)->unique()->nullable();
            $table->string('rg', 11)->unique()->nullable();
            $table->string('phone', 14)->nullable();
            $table->timestamps();
            $table->string('role')->default(0);
            $table->boolean('is_new')->default(true);
            $table->string('work_code')->unique()->nullable();

            $table->foreign('user_id')->references('id')->on('users');


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
