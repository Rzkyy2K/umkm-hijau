<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::with('user')->get();

        return response()->json([
            'success' => true,
            'data' => $umkms
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_usaha' => 'required|string|max:150',
            'pemilik' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'jenis_usaha' => 'required|string|max:100',
            'tahun_berdiri' => 'required|integer',
            'status' => 'required|in:aktif,proses,nonaktif',
        ]);

        $umkm = Umkm::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil ditambahkan',
            'data' => $umkm
        ], 201);
    }

    public function show(Umkm $umkm)
    {
        return response()->json([
            'success' => true,
            'data' => $umkm->load([
                'user',
                'inventaris',
                'konsumsiListrik',
                'auditEnergi',
                'penilaian',
                'verifikasi',
                'sertifikasi'
            ])
        ]);
    }

    public function update(Request $request, Umkm $umkm)
    {
        $validated = $request->validate([
            'nama_usaha' => 'sometimes|string|max:150',
            'pemilik' => 'sometimes|string|max:100',
            'alamat' => 'sometimes|string',
            'no_telepon' => 'sometimes|string|max:20',
            'jenis_usaha' => 'sometimes|string|max:100',
            'tahun_berdiri' => 'sometimes|integer',
            'status' => 'sometimes|in:aktif,proses,nonaktif',
        ]);

        $umkm->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil diperbarui',
            'data' => $umkm
        ]);
    }

    public function destroy(Umkm $umkm)
    {
        $umkm->delete();

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil dihapus'
        ]);
    }
}