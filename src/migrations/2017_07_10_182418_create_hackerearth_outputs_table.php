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
        Schema::table('outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_id');
            $table->string('async');
            $table->string('compile_status');
            $table->string('time_used');
            $table->string('memory_used');
            $table->string('output');
            $table->string('output_html');
            $table->string('status');
            $table->string('status_details');
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
        Schema::dropIfExists('outputs');
    }
}
