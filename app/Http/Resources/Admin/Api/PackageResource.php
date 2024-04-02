<?php

namespace App\Http\Resources\Admin\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Package
 */

class PackageResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'member_type' => $this->member_type,
            'description' => $this->description,
            'features' => $this->features,
            'period' => $this->period,
            'discount_value_when_renew'=> $this->discount_value_when_renew
        ];
    }
}
