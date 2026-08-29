<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Verifikasi;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $data = Verifikasi::with([
            'umkm',
            'verifier'
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
            'verifier_id' => 'required|exists:users,id',
            'tanggal_verifikasi' => 'required|date',
            'status' => 'required|string|max:50',
            'catatan' => 'nullable|string'
        ]);

        $data = Verifikasi::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Verifikasi berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(Verifikasi $verifikasi)
    {
        return response()->json([
            'success' => true,
            'data' => $verifikasi->load([
                'umkm',
                'verifier'
            ])
        ]);
    }

    public function update(Request $request, Verifikasi $verifikasi)
    {
        $validated = $request->validate([
            'tanggal_verifikasi' => 'sometimes|date',
            'status' => 'sometimes|string|max:50',
            'catatan' => 'nullable|string'
        ]);

        $verifikasi->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Verifikasi berhasil diperbarui',
            'data' => $verifikasi
        ]);
    }

    public function destroy(Verifikasi $verifikasi)
    {
        $verifikasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Verifikasi berhasil dihapus'
        ]);
    }
}