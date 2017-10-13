<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title', 255);
            $table->text('description');
            $table->integer('core_competency_id')
                ->nullable()
                ->unsigned();

            $table->integer('operational_goal_id')
                ->nullable()
                ->unsigned();

            $table->integer('strategic_objective_id')
                ->nullable()
                ->unsigned();

            $table->integer('department_id')
                ->nullable()
                ->unsigned();

            $table->integer('type_id')
                ->nullable()
                ->unsigned();

            $table->integer('user_id')
                ->nullable()
                ->unsigned();

            $table->integer('status_id')
                ->nullable()
                ->unsigned();

            $table
                ->foreign('core_competency_id')
                ->references('id')->on('core_competencies')
                ->onDelete('set null');

            $table
                ->foreign('operational_goal_id')
                ->references('id')->on('operational_goals')
                ->onDelete('set null');

            $table
                ->foreign('strategic_objective_id')
                ->references('id')->on('strategic_objectives')
                ->onDelete('set null');

            $table
                ->foreign('department_id')
                ->references('id')->on('departments')
                ->onDelete('set null');

            $table
                ->foreign('type_id')
                ->references('id')->on('types')
                ->onDelete('set null');

            $table
                ->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table
                ->foreign('status_id')
                ->references('id')->on('statuses')
                ->onDelete('set null');

            $table->tinyInteger('approve_status')->unsigned();

            $table->boolean('is_priority')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas');
    }
}
