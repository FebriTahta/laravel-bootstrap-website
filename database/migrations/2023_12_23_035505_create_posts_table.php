<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('konten_id');
            $table->string('post_title');
            $table->string('post_slug');
            $table->string('post_status');
            $table->text('post_desc');
            $table->string('post_thumb');
            $table->integer('post_view');
            $table->timestamps();

            $table->index(['id','post_slug','post_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
