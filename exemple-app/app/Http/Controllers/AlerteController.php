<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Alerte;

class AlerteController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $alertes = Alerte::all();
    
        return view('dashboard', ['events' => $events, 'alertes' => $alertes]);
    }
}