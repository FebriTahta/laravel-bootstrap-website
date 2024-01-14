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
        Schema::create('socialmedia', function (Blueprint $table) {
            $table->id();
            $table->string('socialmedia_name')->nullable(); 
            $table->string('socialmedia_icon')->nullable(); // logo diambil dari sini jadi usahakan menggunakan cdn icon seperti fontawesome dsb
            $table->string('socialmedia_source')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socialmedia');
    }
};
