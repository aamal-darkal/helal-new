<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('section_details', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->index();
            $table->text('content');
            $table->enum('lang' , ['ar' , 'en']);            
            $table->foreignId('section_id')->constrained();            
            $table->unique(['lang' , 'section_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_details');
    }
};
