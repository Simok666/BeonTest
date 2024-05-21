<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Penghuni extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'foto_ktp',
        'nomor_telepon',
        'sudah_menikah'
    ];

    public function penghuni_rumah() :HasMany 
    {
        return $this->HasMany(PenghuniRumah::class);
    }

    public function pembayaranIuran() :HasMany
    {
        return $this->hasMany(PembayaranIuran::class);
    }

}
