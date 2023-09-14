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
        // Name = The Victoria,Bedrooms,Bathrooms,Storeys,Garages
        // Price = 374662
        // Bedrooms = 4
        // Bathrooms = 2
        // Storeys = 2
        // Garages = 2

        Schema::create('estates', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('price');
            $table->tinyInteger('bedrooms');
            $table->tinyInteger('bathrooms');
            $table->tinyInteger('storeys');
            $table->tinyInteger('garages');

            $table->json('data')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
