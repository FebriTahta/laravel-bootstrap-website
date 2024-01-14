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
        Schema::create('videosources', function (Blueprint $table) {
            $table->id();
            $table->string('video_name')->nullable();
            $table->string('video_source')->nullable();
            $table->morphs('videoable');
            $table->timestamps();

            $table->index(['id','video_source']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videosources');
    }
};
