<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImajiAcademyLearningActivityPresences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_activity_presences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('presence_status_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('feature_activity_id');
            $table->text('note');
            $table->timestamps();
            $table->foreign('feature_activity_id')
                ->references('id')
                ->on('feature_activities')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('presence_status_id')
                ->references('id')
                ->on('presence_statuses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('imaji_academy_learning_activity_presences');
    }
}
