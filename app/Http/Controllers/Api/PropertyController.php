<?php

namespace App\Http\Controllers\Api;

use auth;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\StorePropertyRequest;

class PropertyController extends Controller
{
    public function store(StorePropertyRequest $request){
        $user = auth()->user(); // Utilisateur connecté

        // Créer la propriété
        $property = Property::create([
            'user_id' => $user->id,
            'category_id' => $request->category_id, // On récupère l'id de la catégorie
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $request->status,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_image', 'public');

                $property->images()->create(['image_url' => $path]);
            }
        }

        return response()->json([
            'message' => 'Propriété créée avec succès',
            'property' => $property,
        ], 201);
    }

    public function destroy(Property $property)
    {
        if ($property->user_id !== auth()->id()) {
            return response()->json(['message' => 'Propriété non trouvée ou non autorisée'], 403);
        }

        $property->delete();
        return response()->json(['message' => 'Propriété supprimée avec succès']);
    }

    public function index(){
        $properties = Property::with('user', 'category', 'images')->paginate(20);
        return response()->json($properties);
    }

    public function show(Property $property){
        $property = Property::with('user', 'category', 'images')->find($property);
        if (!$property) {
            return response()->json(['message' => 'Propriété non trouvée'], 404);
        }
        return response()->json($property);
    }

    public function update(StorePropertyRequest $request, $id){
        $property = Property::find($id);
        if (!$property || $property->user_id !== Auth::id()) {
            return response()->json(['message' => 'Propriété non trouvée ou non autorisée'], 403);
        }

        $property->update($request->all());

        return response()->json(['message' => 'Propriété mise à jour avec succès', 'property' => $property]);
    }
}
