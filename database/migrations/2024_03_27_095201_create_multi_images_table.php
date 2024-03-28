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
        Schema::create('multi_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_catalogs_id');
            $table->string('photo');
            $table->timestamps();
            $table->foreign('product_catalogs_id')->references('id')->on('product_catalogs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multi_images');
    }
};
