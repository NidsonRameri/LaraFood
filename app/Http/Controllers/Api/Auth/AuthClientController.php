<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Resource_;

class AuthClientController extends Controller
{
    public function auth(Request $request){
        $request->validate([ //validando localmente sem criar um request por enquanto
            'email' => "required|email",
            "password" => "required",
            "device_name" => "required", // pra outros dispositivos
        ]);

        $client = Client::where("email", $request->email)->first();

        if (!$client || !Hash::check($request->password, $client->password)){
            // HASH - senha do BD tá crypt e $request->password não, ele consegue validar as duas
            return response()->json(["message", "Credenciais inválidas"], 404);
        }

        $token = $client->createToken($request->device_name)->plainTextToken;
        return response()->json(['token' => $token]); // retorna por padrão 200
    }

    public function me(Request $request){ //recuperar usuário autenticado
        // auth()-user() ou
        $client = $request->user(); //usuário ja autenticado com token
    
        return new ClientResource($client);
    }

    public function logout(Request $request){ //recuperar usuário autenticado
        $client = $request->user(); //usuário ja autenticado com token
    
        //Revoke all tokens client...
        $client->tokens()->delete();

        return response()->json([], 204);
    }
}
