<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatingImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'seating_id',
        'image_path',
    ];

    public function seating()
    {
        return $this->belongsTo(Seating::class);
    }
}
