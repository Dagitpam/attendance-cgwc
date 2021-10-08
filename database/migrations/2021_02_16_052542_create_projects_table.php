<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id')
                  ->nullable()
                  ->constrained('components')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('category_id')
                  ->nullable()
                  ->constrained('project_categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('sub_category')
                  ->nullable()
                  ->constrained('project_sub_categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('status_id')
                  ->nullable()
                  ->constrained('project_statuses')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('why_not_functional')->nullable();
            $table->decimal('amount_disbursed', 16, 2);
            $table->decimal('amount_spend', 16, 2);
            $table->integer('number');
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
            $table->string('location')->nullable();
            $table->double('longtitude');
            $table->double('latitude');
            $table->string('description');
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
        Schema::dropIfExists('projects');
    }
}
