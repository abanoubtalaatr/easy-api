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
        Schema::create('google_map_branch_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('google_map_place_branche_id');
            $table->string('username');
            $table->float('rating');
            $table->text('text');

            $table->foreign('google_map_place_branche_id')
                ->references('id')
                ->on('google_map_place_branches')
                ->onDelete('cascade'); // Optional: Define the behavior on deletion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_map_branch_reviews');
    }
};
