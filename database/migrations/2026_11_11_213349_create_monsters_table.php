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
        Schema::create('monsters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50)->unique();          
            $table->unsignedTinyInteger('floor');         
            $table->boolean('is_boss')->default(false);
            $table->string('ability', 30)->nullable();    
            $table->unsignedSmallInteger('level');
            $table->unsignedInteger('hp');
            $table->unsignedSmallInteger('attack');
            $table->unsignedSmallInteger('defense');
            $table->unsignedInteger('xp_reward');
            $table->unsignedInteger('gold_reward');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monsters');
    }
};
