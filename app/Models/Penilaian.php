<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = [
        'umkm_id',
        'audit_id',
        'skor_energi',
        'skor_teknologi',
        'skor_lingkungan',
        'skor_total',
        'hasil',
        'catatan',
    ];

    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class);
    }

    public function auditEnergi(): BelongTo
    {
        return $this->belongsTo(AuditEnergi::class, 'audit_id');
    }
    
    public function sertifikasi(): HasMany
    {
        return $this->hasMany(Sertifikasi::class);
    }
}