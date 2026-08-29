<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditEnergi;
use Illuminate\Http\Request;

class AuditEnergiController extends Controller
{
    public function index()
    {
        $data = AuditEnergi::with([
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
            'periode' => 'required|string|max:100',
            'total_kwh' => 'required|numeric|min:0',
            'luas_bangunan' => 'required|numeric|min:0',
            'ike' => 'nullable|numeric|min:0',
            'skor_energi' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string'
        ]);

        $data = AuditEnergi::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Audit energi berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(AuditEnergi $auditEnergi)
    {
        return response()->json([
            'success' => true,
            'data' => $auditEnergi->load([
                'umkm',
                'penilaian'
            ])
        ]);
    }

    public function update(Request $request, AuditEnergi $auditEnergi)
    {
        $validated = $request->validate([
            'periode' => 'sometimes|string|max:100',
            'total_kwh' => 'sometimes|numeric|min:0',
            'luas_bangunan' => 'sometimes|numeric|min:0',
            'ike' => 'nullable|numeric|min:0',
            'skor_energi' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string'
        ]);

        $auditEnergi->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Audit energi berhasil diperbarui',
            'data' => $auditEnergi
        ]);
    }

    public function destroy(AuditEnergi $auditEnergi)
    {
        $auditEnergi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Audit energi berhasil dihapus'
        ]);
    }
}