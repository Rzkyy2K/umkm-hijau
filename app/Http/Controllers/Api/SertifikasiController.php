<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sertifikasi;
use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    public function index()
    {
        $data = Sertifikasi::with([
            'umkm',
            'penilaian'
        ])->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'umkm_id' => 'required|exists:umkm,id',
            'penilaian_id' => 'required|exists:penilaian,id',
            'label' => 'required|string|max:50',
            'nomor_sertifikat' => 'required|string|max:100',
            'tanggal_terbit' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_terbit',
            'status' => 'required|string|max:50'
        ]);

        $data = Sertifikasi::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Sertifikasi berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(Sertifikasi $sertifikasi)
    {
        return response()->json([
            'success' => true,
            'data' => $sertifikasi->load([
                'umkm',
                'penilaian'
            ])
        ]);
    }

    public function update(Request $request, Sertifikasi $sertifikasi)
    {
        $validated = $request->validate([
            'label' => 'sometimes|string|max:50',
            'nomor_sertifikat' => 'sometimes|string|max:100',
            'tanggal_terbit' => 'sometimes|date',
            'tanggal_berakhir' => 'sometimes|date',
            'status' => 'sometimes|string|max:50'
        ]);

        $sertifikasi->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Sertifikasi berhasil diperbarui',
            'data' => $sertifikasi
        ]);
    }

    public function destroy(Sertifikasi $sertifikasi)
    {
        $sertifikasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sertifikasi berhasil dihapus'
        ]);
    }
}