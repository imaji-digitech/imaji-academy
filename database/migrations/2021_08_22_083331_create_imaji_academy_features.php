<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImajiAcademyFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaji_academy_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('imaji_academy_id');
            $table->unsignedBigInteger('feature_id');
            $table->timestamps();
            $table->foreign('feature_id')
                ->references('id')
                ->on('features')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists('imaji_academy_features');
    }
}
