<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'consultation' => $this->consultation,
            'program' => $this->program,
            'package' => $this->package,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'country' => $this->country,
            'age' => $this->age,
            'height' => $this->height,
            'weight' => $this->weight,
            'payment_status' => $this->payment_status == 'not_paid' ? "لم يتم اكمال الدفع": "تم الدفع بنجاح",
        ];
    }
}
