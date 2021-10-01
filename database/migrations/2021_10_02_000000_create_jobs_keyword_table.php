<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_keyword', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained('jobs_detail')->cascadeOnDelete();
            $table->char('keyword');
            $table->unique(['job_id', 'keyword']);
            $table->tinyInteger('priority_weight');
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
        Schema::dropIfExists('jobs_keyword');
    }
}
