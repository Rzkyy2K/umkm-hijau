<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::with('umkm')->get();

        return response()->json([
            'success' => true,
            'data' => $inventaris
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'umkm_id' => 'required|exists:umkm,id',
            'nama_alat' => 'required|string|max:150',
            'jumlah' => 'required|integer|min:1',
            'daya_watt' => 'required|numeric|min:0',
            'jam_operasional' => 'required|numeric|min:0'
        ]);

        $inventaris = Inventaris::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Inventaris berhasil ditambahkan',
            'data' => $inventaris
        ], 201);
    }

    public function show(Inventaris $inventaris)
    {
        return response()->json([
            'success' => true,
            'data' => $inventaris->load('umkm')
        ]);
    }

    public function update(Request $request, Inventaris $inventaris)
    {
        $validated = $request->validate([
            'nama_alat' => 'sometimes|string|max:150',
            'jumlah' => 'sometimes|integer|min:1',
            'daya_watt' => 'sometimes|numeric|min:0',
            'jam_operasional' => 'sometimes|numeric|min:0'
        ]);

        $inventaris->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Inventaris berhasil diperbarui',
            'data' => $inventaris
        ]);
    }

    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();

        return response()->json([
            'success' => true,
            'message' => 'Inventaris berhasil dihapus'
        ]);
    }
}