<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('students');
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('imaji_academy_id')->nullable();
            $table->string('nis')->nullable();
            $table->string('address')->nullable();
            $table->string('birthday')->nullable();
            $table->string('school')->nullable();
            $table->string('class')->nullable();
            $table->string('future_goal')->nullable();
            $table->string("parent_name")->nullable();
            $table->string("parent_job")->nullable();
            $table->integer("ips")->nullable();
            $table->integer("age")->nullable();
            $table->string("birth_place")->nullable();
            $table->date("birth_date")->nullable();
            $table->string("semester")->nullable();
            $table->string("home_village")->nullable();
            $table->string("home_address")->nullable();
            $table->integer("year_enter")->nullable();
            $table->timestamps();
            $table->foreign('imaji_academy_id')
                ->references('id')
                ->on('imaji_academies')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
