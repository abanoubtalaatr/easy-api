<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleMapPlaceBranches extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'google_map_place_id', 'information'];

    protected $casts = [
        'id' => 'string'
    ];

    public function googleMapPlace()
    {
        return $this->belongsTo(GoogleMapPlaces::class);
    }
    public function googleMapBranchReviews()
    {
        return $this->hasMany(GoogleMapBranchReview::class);
    }
}
