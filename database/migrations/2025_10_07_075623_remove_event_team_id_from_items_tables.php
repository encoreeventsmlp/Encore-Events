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
        // Remove event_team_id from decoration_items table
        Schema::table('decoration_items', function (Blueprint $table) {
            $table->dropForeign(['event_team_id']);
            $table->dropColumn('event_team_id');
        });

        // Remove event_team_id from service_items table
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropForeign(['event_team_id']);
            $table->dropColumn('event_team_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back event_team_id to decoration_items table
        Schema::table('decoration_items', function (Blueprint $table) {
            $table->foreignId('event_team_id')->nullable()->constrained()->onDelete('cascade');
        });

        // Add back event_team_id to service_items table
        Schema::table('service_items', function (Blueprint $table) {
            $table->foreignId('event_team_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
};
