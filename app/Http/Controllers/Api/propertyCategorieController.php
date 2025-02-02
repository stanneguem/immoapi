<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PropertyCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\propertyCategorieRequest;

class propertyCategorieController extends Controller
{
    public function addCategorie(propertyCategorieRequest $request){
        try {
            $categorie = new PropertyCategory();

            $categorie->name = $request->name;
    
            $categorie->save();

            return response()->json([
                'statut_code'=>200,
                'message'=>"la categorie a ete ajoute avec succes",
                'datas'=>$categorie
            ],200);

        } catch (\Exception $th) {
            return response()->json($th, 400);
        }
    }
}
