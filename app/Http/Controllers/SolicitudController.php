<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function create()
    {
        return view('solicitudes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => ['required', 'string', 'max:120'],
            'apellidos' => ['required', 'string', 'max:120'],
            'barrio' => ['required', 'string', 'max:120'],
            'comuna_corregimiento' => ['required', 'string', 'max:120'],
            'celular' => ['required', 'string', 'max:30'],
            'direccion' => ['required', 'string', 'max:255'],
            'punto_atencion' => ['required', 'string', 'max:80'],
            'latitud' => ['required', 'numeric', 'between:-90,90'],
            'longitud' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $validated['user_id'] = $request->user()->id;
        Solicitud::create($validated);

        return redirect()->route('ventanilla.solicitudes.create')
            ->with('success', 'La solicitud fue registrada correctamente.');
    }
}
