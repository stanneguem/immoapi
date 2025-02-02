<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\loginRequest;
use App\Http\Requests\Api\RegisterRequest;

class AuthController extends Controller
{
    /**
     * Inscription d'un utilisateur
     */
    public function register(RegisterRequest $request){
        try {
            // Creation de l'utilisateur
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'statut'=>200,
                'message'=>"register success",
                'data'=>$user
            ]);
        } catch (\Exception $th) {
            return response()->json($th);
        }
    }

    public function login(loginRequest $request) {
        try {
            if (Auth::attempt($request->only(['email', 'password']))) {
                $user = Auth::user();
    
                 // Generation du token d'authentification
                $token = $user->createToken('immo_api_back_v1_localhost')->plainTextToken;

                return response()->json([
                    'statut'=>200,
                    'message'=>"login success",
                    'token'=>$token,
                    'user'=>$user
                ]);
            }
        } catch (\Exception $th) {
            return response()->json($th);
        }
    }
}
