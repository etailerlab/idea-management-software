<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100)->nullable();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            //$table->string('slug', 100)->nullable();
        });

        Schema::create('core_competencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            //$table->string('slug', 100);
        });

        Schema::create('strategic_objectives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            //$table->string('slug', 100);
        });

        Schema::create('operational_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            //$table->string('slug', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('types');
        Schema::dropIfExists('core_competencies');
        Schema::dropIfExists('strategic_objectives');
        Schema::dropIfExists('operational_goals');
    }
}
