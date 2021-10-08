<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('gender');
            $table->string('age');
            $table->string('occupation');
            $table->integer('phone')->nullable();
            $table->foreignId('education_id')
                  ->nullable()
                  ->constrained('education')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('benefit_id')
                  ->nullable()
                  ->constrained('benefits')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('status_id')
                  ->nullable()
                  ->constrained('statuses')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
            $table->foreignId('community_id')
                  ->nullable()
                  ->constrained('communities')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('beneficiaries');
    }
}
