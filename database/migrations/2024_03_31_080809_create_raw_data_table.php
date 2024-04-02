<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('raw_data', function (Blueprint $table) {
            $table->id();
            $table->string('commtrack_id')->nullable();
            $table->dateTime('pub_datetime')->nullable();
            $table->string('mchannel_id')->nullable();
            $table->string('uu_id')->nullable();
            $table->string('relevance')->nullable();
            $table->string('profile_country')->nullable();
            $table->string('lang_detected')->nullable();
            $table->string('profile_followers_atpost')->nullable();
            $table->string('mEngagement')->nullable();
            $table->text('cmeta')->nullable();
            $table->text('ftext')->nullable();
            $table->string('profile_name')->nullable();
            $table->string('profile_username')->nullable();
            $table->string('screen_name')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('profile_image_url')->nullable();
            $table->integer('followers_count')->nullable();
            $table->string('link')->nullable();
            $table->string('thumb_url')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('comment_count')->nullable();
            $table->integer('like_count')->nullable();
            $table->integer('views')->nullable();
            $table->integer('share_count')->nullable();
            $table->integer('retweets')->nullable();
            $table->integer('favorite_count')->nullable();
            $table->string('campaign')->nullable();
            $table->string('campaign_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_data');
    }
};
