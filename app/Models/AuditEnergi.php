<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuditEnergi extends Model
{
    protected $table = 'audit_energi';

    protected $fillable = [
        'umkm_id',
        'periode',
        'total_kwh',
        'luas_bangunan',
        'ike',
        'skor_energi',
        'catatan',
    ];

    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class);
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class, 'audit_id');
    }
}