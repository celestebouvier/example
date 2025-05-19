<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Localidad;

class LocalidadController extends Controller
{
    public function index()
    {
        return response()->json(Localidad::all(), 200);
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
    ]);

    $localidad = Localidad::create([
        'nombre' => $request->nombre,
    ]);

    return response()->json([
        'success' => true,
        'data' => new LocalidadResource($localidad),
        'message' => 'Localidad creada correctamente.'
    ]);
}

    public function show($id)
    {
        $localidad = Localidad::find($id);
        if (!$localidad) {
            return response()->json(['error' => 'Localidad no encontrada'], 404);
        }

        return response()->json($localidad, 200);
    }

    public function update(Request $request, $id)
    {
        $localidad = Localidad::find($id);
        if (!$localidad) {
            return response()->json(['error' => 'Localidad no encontrada'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $localidad->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json($localidad, 200);
    }

    public function destroy($id)
    {
        $localidad = Localidad::find($id);
        if (!$localidad) {
            return response()->json(['error' => 'Localidad no encontrada'], 404);
        }

        $localidad->delete();

        return response()->json(['message' => 'Localidad eliminada correctamente'], 200);
    }
}
