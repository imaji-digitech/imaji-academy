<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImajiAcademyFeatureTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iaf_id');
            $table->timestamps();
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
        Schema::dropIfExists('imaji_academy_feature_tests');
    }
}
