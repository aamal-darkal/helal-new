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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar', 100)->index();
            $table->string('title_en', 100)->index();
            $table->string('url', 100)->default('');
            $table->tinyInteger('order')->default(0);
            $table->enum('permit' , ['all' , 'update' , 'none'])->default('all');
            $table->foreignId('menu_id')->nullable()->constrained();
            $table->foreignId('section_id')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
