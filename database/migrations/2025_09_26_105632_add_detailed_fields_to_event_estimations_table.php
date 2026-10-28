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
        Schema::table('event_estimations', function (Blueprint $table) {
            // Add detailed product information fields
            $table->json('decoration_items')->nullable()->after('selected_items');
            $table->json('food_items')->nullable()->after('decoration_items');
            $table->json('service_items')->nullable()->after('food_items');
            
            // Add item counts for each category
            $table->integer('decoration_items_count')->default(0)->after('service_items');
            $table->integer('food_items_count')->default(0)->after('decoration_items_count');
            $table->integer('service_items_count')->default(0)->after('food_items_count');
            
            // Add detailed cost breakdown
            $table->decimal('decoration_items_cost', 10, 2)->default(0)->after('service_items_count');
            $table->decimal('food_items_cost', 10, 2)->default(0)->after('decoration_items_cost');
            $table->decimal('service_items_cost', 10, 2)->default(0)->after('food_items_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_estimations', function (Blueprint $table) {
            $table->dropColumn([
                'decoration_items',
                'food_items', 
                'service_items',
                'decoration_items_count',
                'food_items_count',
                'service_items_count',
                'decoration_items_cost',
                'food_items_cost',
                'service_items_cost'
            ]);
        });
    }
};
