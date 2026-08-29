<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Umkm extends Model
{
    protected $fillable = [
        'user_id',
        'nama_usaha',
        'pemilik',
        'alamat',
        'no_telepon',
        'jenis_usaha',
        'tahun_berdiri',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class);
    }

    public function konsumsiListrik(): HasMany
    {
        return $this->hasMany(KonsumsiListrik::class);
    }

    public function auditEnergi(): HasMany
    {
        return $this->hasMany(AuditEnergi::class);
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }

    public function verifikasi(): HasMany
    {
        return $this->hasMany(Verifikasi::class);
    }

    public function sertifikasi(): HasMany
    {
        return $this->hasMany(Sertifikasi::class);
    }
}