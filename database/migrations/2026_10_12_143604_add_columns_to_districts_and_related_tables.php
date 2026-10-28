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
        // Add columns to districts table
        Schema::table('districts', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->softDeletes();
        });

        // Add columns to event_teams table
        Schema::table('event_teams', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->softDeletes();
        });

        // Add columns to categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->string('type')->after('id'); // decoration, service, food
            $table->string('name')->after('type');
            $table->softDeletes();
        });

        // Add columns to district_event_team pivot table
        Schema::table('district_event_team', function (Blueprint $table) {
            $table->foreignId('district_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('event_team_id')->after('district_id')->constrained()->onDelete('cascade');
            $table->unique(['district_id', 'event_team_id'], 'district_event_team_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('district_event_team', function (Blueprint $table) {
            $table->dropUnique('district_event_team_unique');
            $table->dropForeign(['district_id']);
            $table->dropForeign(['event_team_id']);
            $table->dropColumn(['district_id', 'event_team_id']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['type', 'name', 'deleted_at']);
        });

        Schema::table('event_teams', function (Blueprint $table) {
            $table->dropColumn(['name', 'deleted_at']);
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn(['name', 'deleted_at']);
        });
    }
};
