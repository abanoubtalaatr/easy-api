<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' =>  $this->name,
            'features' => $this->features,
            'price' => $this->price,
            'weight' => $this->weight,
            'height' => $this->height,
            'image' => $this->getImageUrl(),
            'number_of_days' => $this->number_of_days
        ];
    }

    private function getImageUrl()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }
        return null;
    }
}
