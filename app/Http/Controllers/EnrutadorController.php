<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;

class EnrutadorController extends Controller
{
    public function bitacora()
    {
        $solicitudes = Solicitud::with('usuario')
            ->whereDate('created_at', today())
            ->latest()
            ->get();

        return view('enrutador.bitacora', compact('solicitudes'));
    }
}
