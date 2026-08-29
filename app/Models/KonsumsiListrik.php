<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KonsumsiListrik extends Model
{
    protected $table = 'konsumsi_listrik';

    protected $fillable = [
        'umkm_id',
        'bulan',
        'tahun',
        'kwh',
        'biaya',
    ];

    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class);
    }
}