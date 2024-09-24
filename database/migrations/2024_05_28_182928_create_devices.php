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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('floorplan_id')->constrained('floorplans')->onDelete('cascade');
            $table->foreignId('fire_ext_id')->constrained('fire_extinguishers')->onDelete('cascade');
            $table->double('x', 15, 8)->nullable();
            $table->double('y', 15, 8)->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
