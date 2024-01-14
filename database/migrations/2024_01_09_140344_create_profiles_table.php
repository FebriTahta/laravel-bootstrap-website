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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_name')->nullable();
            $table->string('profile_logo')->nullable();
            $table->string('profile_thumb')->nullable();
            $table->string('profile_title')->nullable();
            $table->string('profile_subtitle')->nullable();
            $table->string('profile_badge')->nullable();
            $table->string('profile_link1')->nullable();
            $table->string('profile_heroimage')->nullable();
            $table->string('profile_herotitle')->nullable();
            $table->string('profile_herosubtitle')->nullable();
            $table->text('profile_herodesc')->nullable();
            $table->string('profile_contactnumber')->nullable();
            $table->string('profile_featuretitle')->nullable();
            $table->text('profile_featuredesc')->nullable();
            $table->string('profile_featurelink')->nullable();
            $table->string('profile_address')->nullable();
            $table->string('profile_email')->nullable();
            $table->string('profile_maplong')->nullable();
            $table->string('profile_maplat')->nullable();
            $table->timestamps();

            $table->index(['id','profile_name','profile_thumb','profile_logo']);   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
