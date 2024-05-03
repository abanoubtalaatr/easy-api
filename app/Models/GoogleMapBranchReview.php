<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleMapBranchReview extends Model
{
    use HasFactory;

    protected $fillable = ['google_map_place_branche_id', 'username', 'rating', 'text'];

    protected $casts = [
        'google_map_place_branche_id' => 'string',
    ];
    public function googleMapPlaceBranch()
    {
        return $this->belongsTo(GoogleMapPlaceBranches::class);
    }
}
