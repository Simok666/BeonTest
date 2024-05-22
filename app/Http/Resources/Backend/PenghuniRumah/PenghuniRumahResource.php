<?php

namespace App\Http\Resources\Backend\PenghuniRumah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Backend\Penghuni\PenghuniResource;
use App\Http\Resources\Backend\Rumah\RumahResource;
class PenghuniRumahResource extends JsonResource
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
            'penghuni_id' => $this->penghuni_id,
            'rumah_id' => $this->rumah_id,
            'tanggal_mulai_menempati' => $this->tanggal_mulai_menempati,
            'tanggal_selesai_menempati' => $this->tanggal_selesai_menempati,
            'penghuni' => new PenghuniResource($this->penghuni),
            'rumah' => new RumahResource($this->rumah)
         ];
    }
}
