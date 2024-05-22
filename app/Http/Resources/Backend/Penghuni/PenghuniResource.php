<?php

namespace App\Http\Resources\Backend\Penghuni;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenghuniResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nama_lengkap' => $this->nama_lengkap,
            'foto_ktp' => $this->foto_ktp,
            'status_penghuni' => $this->status_penghuni,
            'nomor_telepon' => $this->nomor_telepon,
            'sudah_menikah' => $this->sudah_menikah,
        ];
    }
}
