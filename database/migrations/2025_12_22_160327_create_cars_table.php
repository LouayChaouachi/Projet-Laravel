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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('brand');
            $table->string('model');
            $table->unsignedSmallInteger('year');
            $table->string('transmission');
            $table->string('fuel_type');
            $table->unsignedTinyInteger('seats')->default(4);
            $table->decimal('price_per_day', 8, 2);
            $table->string('image_url');
            $table->string('location')->default('Tunis, Tunisie');
            $table->boolean('available')->default(true);
            $table->boolean('featured')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
