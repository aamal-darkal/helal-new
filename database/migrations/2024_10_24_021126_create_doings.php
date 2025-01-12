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
        Schema::create('doings', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar', 50);
            $table->string('title_en', 50);
            $table->text('icon')->nullable();
            $table->boolean('hidden')->default(false);
            $table->foreignId('menu_id')->nullable()->constrained();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doings');
    }
};
