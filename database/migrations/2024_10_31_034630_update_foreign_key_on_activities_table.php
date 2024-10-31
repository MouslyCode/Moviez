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
        Schema::table('activities', function (Blueprint $table) {
            //
            $table->dropForeign(['movie_id']);
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            //
            $table->dropForeign(['movie_id']);
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('restrict');
        });
    }
};
