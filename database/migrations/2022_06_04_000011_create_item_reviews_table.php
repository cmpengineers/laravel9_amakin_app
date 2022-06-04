<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('item_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quality');
            $table->integer('location');
            $table->integer('price');
            $table->integer('service');
            $table->integer('wifi');
            $table->string('attitude');
            $table->integer('noise');
            $table->integer('quietness');
            $table->integer('star')->nullable();
            $table->integer('total_score');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
