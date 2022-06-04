<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturePlacePivotTable extends Migration
{
    public function up()
    {
        Schema::create('feature_place', function (Blueprint $table) {
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id', 'place_id_fk_6729457')->references('id')->on('places')->onDelete('cascade');
            $table->unsignedBigInteger('feature_id');
            $table->foreign('feature_id', 'feature_id_fk_6729457')->references('id')->on('features')->onDelete('cascade');
        });
    }
}
