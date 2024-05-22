<?php

namespace App\Http\Resources\Backend\Rumah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RumahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nomor_rumah' => $this->nomor_rumah,
            'status_rumah' => $this->status_rumah
        ];
    }
}
