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
        Schema::create('event_estimations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->integer('guest_count');
            $table->boolean('catering_boys')->default(false);
            $table->json('selected_items'); // Store selected items as JSON
            $table->json('item_details'); // Store calculated item details as JSON
            $table->decimal('total_cost', 10, 2);
            $table->decimal('food_cost', 10, 2)->default(0);
            $table->decimal('decoration_cost', 10, 2)->default(0);
            $table->decimal('service_cost', 10, 2)->default(0);
            $table->decimal('catering_boys_cost', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_estimations');
    }
};
