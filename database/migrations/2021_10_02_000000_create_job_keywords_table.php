<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_keywords', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained('job_details')->cascadeOnDelete();
            $table->string('keyword');
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
        Schema::dropIfExists('job_keywords');
    }
}
