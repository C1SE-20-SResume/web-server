<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('user_companies')->nullOnDelete();
            $table->string('job_title');
            $table->text('job_descrip');
            $table->text('job_require');
            $table->text('job_benefit');
            $table->string('job_place');
            $table->double('salary');
            $table->dateTime('date_expire');
            $table->float('require_score');
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
        Schema::dropIfExists('job_details');
    }
}
