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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('class', 20);
            $table->string('description', 100);

            $table->unsignedSmallInteger('level')->default(1);
            $table->unsignedInteger('xp')->default(0);
            $table->unsignedInteger('gold')->default(0);

            $table->unsignedSmallInteger('strength');
            $table->unsignedSmallInteger('intelligence');
            $table->unsignedSmallInteger('agility');
            $table->unsignedSmallInteger('vitality');
            $table->unsignedSmallInteger('unspent_points')->default(0);

            $table->unsignedInteger('current_hp');

            $table->unsignedTinyInteger('current_floor')->default(1);
            $table->unsignedTinyInteger('max_floor_reached')->default(1);
            $table->boolean('has_won')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
