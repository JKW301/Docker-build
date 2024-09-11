<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    
    public function addCertificationToUser($userId, $certificationId)
    {
        $user = User::find($userId);
        $certification = Certification::find($certificationId);

        if ($user && $certification) {
            $user->certifications()->attach($certification->id);
            return response()->json(['message' => 'Certification added to user successfully'], 200);
        }

        return response()->json(['error' => 'User or certification not found'], 404);
    }
    
    public function getUserCertifications($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $certifications = $user->certifications;
            return response()->json(['certifications' => $certifications], 200);
        }

        return response()->json(['error' => 'User not found'], 404);
    }
    
}

