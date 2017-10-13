<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManyToManyCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea_core_competency', function (Blueprint $table) {
            $table->integer('idea_id')->unsigned();
            $table->integer('core_competency_id')->unsigned();

            $table->foreign('idea_id')->references('id')->on('ideas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('core_competency_id')->references('id')->on('core_competencies')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['idea_id', 'core_competency_id']);
        });

        Schema::create('idea_operational_goal', function (Blueprint $table) {
            $table->integer('idea_id')->unsigned();
            $table->integer('operational_goal_id')->unsigned();

            $table->foreign('idea_id')->references('id')->on('ideas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('operational_goal_id')->references('id')->on('operational_goals')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['idea_id', 'operational_goal_id']);
        });

        Schema::create('idea_strategic_objective', function (Blueprint $table) {
            $table->integer('idea_id')->unsigned();
            $table->integer('strategic_objective_id')->unsigned();

            $table->foreign('idea_id')->references('id')->on('ideas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('strategic_objective_id')->references('id')->on('strategic_objectives')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['idea_id', 'strategic_objective_id']);
        });

        Schema::create('idea_departament', function (Blueprint $table) {
            $table->integer('idea_id')->unsigned();
            $table->integer('department_id')->unsigned();

            $table->foreign('idea_id')->references('id')->on('ideas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['idea_id', 'department_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('idea_core_competency');
        Schema::drop('idea_operational_goal');
        Schema::drop('idea_strategic_objective');
        Schema::drop('idea_core_competency');
    }
}
