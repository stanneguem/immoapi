<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class favoriteController extends Controller
{
    public function addPropertyToFavorite(Request $request){
        // Validate the request
        $request->validate([
            'property_id' => 'required|integer',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = auth()->user();
        if ($user) {
            $user->favorites()->attach($request->property_id);
            return response()->json(['message' => 'Propriété ajoutée aux favoris avec succès.'], 200);
        }

        return response()->json(['message' => 'Utilisateur non authentifié.'], 401);
    }

    public function removePropertyFromFavorite(Request $request){
        // Validate the request
        $request->validate([
            'property_id' => 'required|integer',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = auth()->user();
        if ($user) {
            $user->favorites()->detach($request->property_id);
            return response()->json(['message' => 'Propriété retirée des favoris avec succès.'], 200);
        }

        return response()->json(['message' => 'Utilisateur non authentifié.'], 401);
    }
}
