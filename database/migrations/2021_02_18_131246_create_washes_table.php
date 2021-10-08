<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('washes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->integer('number');
            $table->string('wash_type');
            $table->foreignId('state_id')
            ->nullable()
            ->constrained('states')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('washes');
    }
}
