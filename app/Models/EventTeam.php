<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTeam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function districts()
    {
        return $this->belongsToMany(District::class, 'district_event_team');
    }

    public function decorationItems()
    {
        return $this->belongsToMany(DecorationItem::class, 'decoration_item_event_team');
    }

    public function serviceItems()
    {
        return $this->belongsToMany(ServiceItem::class, 'service_item_event_team');
    }
}
