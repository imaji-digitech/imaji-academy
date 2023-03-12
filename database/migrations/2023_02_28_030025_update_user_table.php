<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('birth_place')
                ->nullable();
            $table->date('birth_date')
                ->nullable();
            $table->string('semester')
                ->default('gasal');
            $table->unsignedBigInteger('imaji_academy_id')
                ->nullable();
            $table->foreign('imaji_academy_id')
                ->references('id')
                ->on('imaji_academies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('home_village')
                ->nullable();
            $table->string('home_address')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
