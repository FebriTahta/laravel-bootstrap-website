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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('alumni_name')->nullable();
            $table->string('alumni_jurusan')->nullable();
            $table->integer('alumni_tahun_ajaran1')->nullable();
            $table->integer('alumni_tahun_ajaran2')->nullable();
            $table->string('alumni_email')->nullable();
            $table->string('alumni_kegiatan')->nullable();
            $table->text('alumni_keterangan')->nullable();
            $table->string('alumni_passpharse')->nullable();
            $table->string('alumni_image')->nullable();
            $table->integer('alumni_status')->nullable();
            $table->timestamps();

            $table->index(['id','alumni_jurusan','alumni_passpharse']);   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
