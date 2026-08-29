<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UmkmController;
use App\Http\Controllers\Api\inventarisController;
use App\Http\Controllers\Api\konsumsiListrikController;
use App\Http\Controllers\Api\auditEnergiController;
use App\Http\Controllers\Api\penilaianController;
use App\Http\Controllers\Api\verifikasiController;
use App\Http\Controllers\Api\sertifikasiController;

Route::apiResource('umkm', UmkmController::class);
Route::apiResource('inventaris', inventarisController::class);
Route::apiResource('konsumsi-listrik', konsumsiListrikController::class);
Route::apiResource('audit-listrik', auditenergiController::class);
Route::apiResource('penilaian', penilaianController::class);
Route::apiResource('verifikasi', verifikasiController::class);
Route::apiResource('sertifikasi', sertifikasiController::class);
