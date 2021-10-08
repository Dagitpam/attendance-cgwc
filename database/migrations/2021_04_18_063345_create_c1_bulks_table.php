<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateC1BulksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c1_bulks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')
                  ->constrained('states')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('welfare_id')
                    ->constrained('welfares')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('male_participants');
            $table->integer('female_participants');
            $table->string('date');
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
        Schema::dropIfExists('c1_bulks');
    }
}
