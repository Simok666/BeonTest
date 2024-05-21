<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenghuniRumah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'penghuni_id',
        'rumah_id',
        'tanggal_mulai_menempati',
        'tanggal_selesai_menempati'
    ];

    /**
     * Get the penghuni that owns the penghuni rumah.
     */
    public function penghuni(): BelongsTo
    {
        return $this->belongsTo(Penghuni::class, 'penghuni_id');
    }

    /**
     * Get the rumah owns the penghuni rumah.
     */
    public function rumah(): BelongsTo
    {
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }
}
