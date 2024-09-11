<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepot;
use PDF;

class EntrepotController extends Controller
{
    public function index()
    {
        $entrepots = Entrepot::join('users', 'entrepots.autorisations_entrepot', '=', 'users.id')
            ->where('users.autorisations_entrepot', 1)
            ->select('entrepots.*', 'users.name as user_name')
            ->get();
    
        return view('entrepot', ['entrepots' => $entrepots]);
    }

    public function downloadMap($id)
    {
        $entrepot = Entrepot::find($id);
        $mapUrl = "https://maps.googleapis.com/maps/api/staticmap?center={$entrepot->localisation}&zoom=14&size=400x400&key=YOUR_API_KEY";
        $pdf = PDF::loadView('pdf.map', ['mapUrl' => $mapUrl]);

        return $pdf->download('map.pdf');
    }
}
