<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_competencies', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
        Schema::table('operational_goals', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
        Schema::table('statuses', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
        Schema::table('strategic_objectives', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
        Schema::table('types', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_competencies', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
        Schema::table('operational_goals', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
        Schema::table('statuses', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
        Schema::table('strategic_objectives', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
        Schema::table('types', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
