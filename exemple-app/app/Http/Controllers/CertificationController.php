<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::all();
        return view('certifications.index', compact('certifications'));
    }
    
    public function create()
    {
        return view('certifications.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Certification::create($validatedData);

        return redirect()->route('certifications.index')->with('success', 'La certification a été ajoutée avec succès.');
    }
    
    
}
