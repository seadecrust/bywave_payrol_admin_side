<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('employee_id');
			$table->boolean('over_time')->default(0);
			$table->boolean('notified')->default(0);
            $table->integer('input_salary')->nullable();
			$table->integer('hours')->nullable();
			$table->integer('rate')->nullable();
			$table->integer('gross')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('philhealth')->nullable();
            $table->integer('sss')->nullable();
            $table->integer('pagibig')->nullable();
            $table->integer('laptoprent')->nullable();
            $table->integer('others')->nullable();
			
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
        Schema::dropIfExists('payrolls');
    }
}
