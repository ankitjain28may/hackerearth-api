<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHackerearthOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hackerearth_outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_id')->nullable();
            $table->string('async')->default(0);
            $table->text('compile_status')->nullable();
            $table->string('time_used')->nullable();
            $table->string('memory_used')->nullable();
            $table->text('output')->nullable();
            $table->text('output_html')->nullable();
            $table->string('status')->nullable();
            $table->text('status_details')->nullable();
            $table->text('stderr')->nullable();
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
        Schema::dropIfExists('hackerearth_outputs');
    }
}

