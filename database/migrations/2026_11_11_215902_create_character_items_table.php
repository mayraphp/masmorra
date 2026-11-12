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
        Schema::create('character_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('character_id')->constrained()->cascadeOnDelete();
            $table->foreignId('item_id')->constrained()->restrictOnDelete();
            $table->string('rarity', 20)->default('common');   // ItemRarity

            $table->string('slot', 20)->nullable();
            $table->unsignedTinyInteger('backpack_position')->nullable();

            $table->unique(['character_id', 'slot']);
            $table->unique(['character_id', 'backpack_position']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_items');
    }
};
