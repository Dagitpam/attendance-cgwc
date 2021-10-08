<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('state_id')
                  ->nullable()
                  ->constrained('states')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('community');
            $table->string('activity');
            $table->string('indicator');
            $table->string('component');
            $table->string('target');
            $table->longText('description');
            $table->string('results');
            $table->longText('challenge');
            $table->string('reported_by');
            $table->string('image');
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
        Schema::dropIfExists('reports');
    }
}
