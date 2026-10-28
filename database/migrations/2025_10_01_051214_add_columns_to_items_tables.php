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
        // Add columns to decoration_items table
        Schema::table('decoration_items', function (Blueprint $table) {
            $table->foreignId('event_team_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('fixed_amount', 10, 2)->default(0);
            $table->softDeletes();
        });

        // Add columns to service_items table
        Schema::table('service_items', function (Blueprint $table) {
            $table->foreignId('event_team_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('fixed_amount', 10, 2)->default(0);
            $table->softDeletes();
        });

        // Add columns to food_items table
        Schema::table('food_items', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('amount_per_person', 10, 2)->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove columns from decoration_items table
        Schema::table('decoration_items', function (Blueprint $table) {
            $table->dropForeign(['event_team_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['event_team_id', 'category_id', 'title', 'image', 'short_description', 'fixed_amount', 'deleted_at']);
        });

        // Remove columns from service_items table
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropForeign(['event_team_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['event_team_id', 'category_id', 'title', 'image', 'short_description', 'fixed_amount', 'deleted_at']);
        });

        // Remove columns from food_items table
        Schema::table('food_items', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'title', 'image', 'short_description', 'amount_per_person', 'deleted_at']);
        });
    }
};
