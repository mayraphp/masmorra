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
        Schema::create('monster_drops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monster_id')->constrained()->cascadeOnDelete();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('drop_chance'); 
            $table->timestamps();
            // Para o mesmo item não aparecer duas vezes na lista do mesmo monstro
            $table->unique(['monster_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monster_drops');
    }
};
