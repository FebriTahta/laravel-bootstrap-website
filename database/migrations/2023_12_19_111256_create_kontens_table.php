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
        Schema::create('kontens', function (Blueprint $table) {
            $table->id();
            $table->string('konten_name')->unique();
            $table->string('konten_slug');
            $table->string('konten_status');
            $table->string('konten_model');
            // $table->string('contentable_type');
            // $table->unsignedBigInteger('contentable_id');
            $table->morphs('kontentable');
            $table->timestamps();
           
            // Menambahkan onDelete cascade untuk menghapus konten saat menu dihapus
            // $table->foreign('kontentable_id', 'fk_kontens_menus')
            // ->references('id')->on('menus');
            // $table->foreign('kontentable_id', 'fk_kontens_submenus')
            // ->references('id')->on('submenus');

            $table->index(['id','kontentable_type','konten_slug','konten_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontens');
    }
};
