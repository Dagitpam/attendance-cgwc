<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')
                  ->nullable()
                  ->constrained('states')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('lga_id')
                  ->nullable()
                  ->constrained('lgas')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('community');
            $table->string('activity');
            $table->foreignId('benefit_id')
                  ->nullable()
                  ->constrained('welfares')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('component_id')
                  ->nullable()
                  ->constrained('components')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('brief_grieviance');
            $table->date('date_report');
            $table->string('status_griviance');
            $table->date('date_resolution');
            $table->longText('brief_conclusion');
            $table->string('level_resolution');
            $table->foreignId('reported_by')
                  ->nullable()
                  ->constrained('users');
            $table->foreignId('deleted_by')
                  ->nullable()
                  ->constrained('users');
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
        Schema::dropIfExists('grms');
    }
}
