<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rss_feed_id')
            ->nullable()
            ->constrained("rss_feeds")
            ->onDelete('cascade');
            $table->text("content");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feed_items');
    }
}
