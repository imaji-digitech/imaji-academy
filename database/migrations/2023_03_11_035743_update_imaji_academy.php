<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImajiAcademy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imaji_academies', function (Blueprint $table) {
            $table->string('village_program')->nullable();
            $table->integer('year_program')->default(2021);
            $table->integer('year_program_code')->default(21);
            $table->string('village_code')->nullable();
            $table->text('note')->nullable();

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
