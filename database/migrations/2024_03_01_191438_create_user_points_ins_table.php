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
        Schema::create('user_points_ins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained();
            $table->integer('code_id')->nullable();
            $table->string('code');
            $table->integer('accumulated_points')->default(0);
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('product_catalog_id')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_points_ins');
    }
};
