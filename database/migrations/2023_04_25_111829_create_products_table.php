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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->index('name');
            $table->string('slug');
            $table->integer('active')->unsigned()->default(1);
            $table->integer('hit')->unsigned()->default(0);
            $table->integer('new')->unsigned()->default(0);
            $table->integer('stock')->unsigned()->default(0);
            $table->integer('advice')->unsigned()->default(0);
            $table->integer('sort')->unsigned()->default(500);
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->decimal('base_price', 10, 2, true)->default(0);
            $table->decimal('price', 10, 2, true)->default(0);
            $table->string('currency')->default('RUB');
            $table->json('properties')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
