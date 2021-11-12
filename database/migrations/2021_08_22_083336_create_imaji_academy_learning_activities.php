<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImajiAcademyLearningActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_activities', function (Blueprint $table) {
            $table->id();
            $table->text('module');
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('iaf_id');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('iaf_id')
                ->references('id')
                ->on('imaji_academy_features')
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
        Schema::dropIfExists('imaji_academy_learning_activities');
    }
}
