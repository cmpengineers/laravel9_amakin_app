<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToItemReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('item_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('place_id')->nullable();
            $table->foreign('place_id', 'place_fk_6729469')->references('id')->on('places');
        });
    }
}
