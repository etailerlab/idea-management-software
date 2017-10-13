<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('password');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('department_id')
                ->nullable()
                ->unsigned();

            $table->integer('position_id')
                ->nullable()
                ->unsigned();

            $table->boolean('is_active');
            $table->string('password')->nullable();
            $table
                ->foreign('department_id')
                ->references('id')->on('departments')
                ->onDelete('set null');

            $table
                ->foreign('position_id')
                ->references('id')->on('positions')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('department_id');
            $table->dropColumn('department_id');
            $table->dropColumn('is_active');
        });
    }
}
