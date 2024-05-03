<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleMapPlaces extends Model
{
    use HasFactory;

    protected $fillable = ['keyword'];

    public function googleMapPlaceBranches()
    {
        return $this->hasMany(GoogleMapPlaceBranches::class);
    }
}
