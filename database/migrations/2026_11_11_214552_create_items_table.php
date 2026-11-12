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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50)->unique();
            $table->string('image', 100);                      
            $table->string('type', 20);                        
            $table->string('required_class', 20)->nullable();  
            $table->string('armor_family', 20)->nullable();    

            $table->unsignedSmallInteger('damage')->default(0);
            $table->unsignedSmallInteger('defense')->default(0);

            $table->unsignedSmallInteger('bonus_strength')->default(0);
            $table->unsignedSmallInteger('bonus_intelligence')->default(0);
            $table->unsignedSmallInteger('bonus_agility')->default(0);
            $table->unsignedSmallInteger('bonus_vitality')->default(0);

            $table->unsignedTinyInteger('bonus_crit_chance')->default(0);
            $table->unsignedTinyInteger('bonus_damage_percent')->default(0);

            $table->unsignedSmallInteger('heal_amount')->default(0);

            $table->unsignedInteger('price');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
