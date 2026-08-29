<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $data = Penilaian::with([
            'umkm',
            'auditEnergi',
            'sertifikasi'
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
            'audit_id' => 'required|exists:audit_energi,id',
            'skor_energi' => 'required|numeric|min:0',
            'skor_teknologi' => 'required|numeric|min:0',
            'skor_lingkungan' => 'required|numeric|min:0',
            'skor_total' => 'required|numeric|min:0',
            'hasil' => 'required|string|max:100',
            'catatan' => 'nullable|string'
        ]);

        $data = Penilaian::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Penilaian berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(Penilaian $penilaian)
    {
        return response()->json([
            'success' => true,
            'data' => $penilaian->load([
                'umkm',
                'auditEnergi',
                'sertifikasi'
            ])
        ]);
    }

    public function update(Request $request, Penilaian $penilaian)
    {
        $validated = $request->validate([
            'skor_energi' => 'sometimes|numeric|min:0',
            'skor_teknologi' => 'sometimes|numeric|min:0',
            'skor_lingkungan' => 'sometimes|numeric|min:0',
            'skor_total' => 'sometimes|numeric|min:0',
            'hasil' => 'sometimes|string|max:100',
            'catatan' => 'nullable|string'
        ]);

        $penilaian->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Penilaian berhasil diperbarui',
            'data' => $penilaian
        ]);
    }

    public function destroy(Penilaian $penilaian)
    {
        $penilaian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penilaian berhasil dihapus'
        ]);
    }
}