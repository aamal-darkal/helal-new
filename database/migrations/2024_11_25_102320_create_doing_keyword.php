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
        Schema::create('doing_keyword', function (Blueprint $table) {
            $table->foreignId('keyword_id')->constrained()->onDelete('cascade');
            $table->foreignId('doing_id')->constrained()->onDelete('cascade');
            $table->primary(['keyword_id' , 'doing_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doing_keyword');
    }
};
