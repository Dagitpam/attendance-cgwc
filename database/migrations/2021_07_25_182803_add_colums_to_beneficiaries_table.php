<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            //
            $table->foreignId('sector_id')
            ->nullable()
            ->constrained('sectors')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('component_id')
            ->nullable()
            ->constrained('components')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            //
        });
    }
}
