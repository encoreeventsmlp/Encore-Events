<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventEstimation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'seating_id',
        'guest_count',
        'catering_boys',
        'selected_items',
        'item_details',
        'total_cost',
        'food_cost',
        'decoration_cost',
        'service_cost',
        'catering_boys_cost',
        'decoration_items',
        'food_items',
        'service_items',
        'decoration_items_count',
        'food_items_count',
        'service_items_count',
        'decoration_items_cost',
        'food_items_cost',
        'service_items_cost',
    ];

    protected $casts = [
        'selected_items' => 'array',
        'item_details' => 'array',
        'catering_boys' => 'boolean',
        'total_cost' => 'decimal:2',
        'food_cost' => 'decimal:2',
        'decoration_cost' => 'decimal:2',
        'service_cost' => 'decimal:2',
        'catering_boys_cost' => 'decimal:2',
        'decoration_items' => 'array',
        'food_items' => 'array',
        'service_items' => 'array',
        'decoration_items_cost' => 'decimal:2',
        'food_items_cost' => 'decimal:2',
        'service_items_cost' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function seating()
    {
        return $this->belongsTo(Seating::class);
    }
}
