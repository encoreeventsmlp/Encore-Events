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
        Schema::create('service_item_event_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_team_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Ensure unique combinations
            $table->unique(['service_item_id', 'event_team_id'], 'service_item_event_team_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_item_event_team');
    }
};
