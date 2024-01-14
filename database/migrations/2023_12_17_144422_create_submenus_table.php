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
        Schema::create('submenus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('submenu_name');
            $table->string('submenu_slug');
            $table->integer('submenu_status');
            $table->timestamps();

            $table->foreign('menu_id')
            ->references('id')->on('menus')
            ->onDelete('cascade');

            $table->index(['id','menu_id','submenu_slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submenus');
    }
};
