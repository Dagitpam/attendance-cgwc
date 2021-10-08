<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePumpBoreholesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pump__boreholes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('location');
            $table->integer('number');
            $table->foreignId('state_id')
            ->nullable()
            ->constrained('states')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('type');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('pump__boreholes');
    }
}
