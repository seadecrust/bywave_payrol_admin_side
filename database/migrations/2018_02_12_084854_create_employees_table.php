<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('idnum')->unique();
			$table->string('name');
			$table->string('slug');

            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('salary');
            $table->date('datestarted');
			$table->string('address')->nullable();
			$table->string('role_id');
			$table->boolean('full_time')->default(1);
            $table->string('password');
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
        Schema::dropIfExists('employees');
    }
}
