<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KonsumsiListrik;
use Illuminate\Http\Request;

class KonsumsiListrikController extends Controller
{
    public function index()
    {
        $data = KonsumsiListrik::with('umkm')->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'umkm_id' => 'required|exists:umkm,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
            'kwh' => 'required|numeric|min:0',
            'biaya' => 'required|numeric|min:0'
        ]);

        $data = KonsumsiListrik::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data konsumsi listrik berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(KonsumsiListrik $konsumsiListrik)
    {
        return response()->json([
            'success' => true,
            'data' => $konsumsiListrik->load('umkm')
        ]);
    }

    public function update(Request $request, KonsumsiListrik $konsumsiListrik)
    {
        $validated = $request->validate([
            'bulan' => 'sometimes|integer|min:1|max:12',
            'tahun' => 'sometimes|integer',
            'kwh' => 'sometimes|numeric|min:0',
            'biaya' => 'sometimes|numeric|min:0'
        ]);

        $konsumsiListrik->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data konsumsi listrik berhasil diperbarui',
            'data' => $konsumsiListrik
        ]);
    }

    public function destroy(KonsumsiListrik $konsumsiListrik)
    {
        $konsumsiListrik->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data konsumsi listrik berhasil dihapus'
        ]);
    }
}