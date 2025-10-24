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
        Schema::create('hero_carousel_promos', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('alt_image')->nullable();
            $table->string('heading')->nullable();
            $table->string('paragraph')->nullable();
            $table->enum('jenis', ['promo', 'testimoni']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_carousel_promos');
    }
};
