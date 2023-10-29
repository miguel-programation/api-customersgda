<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \stdClass;

//Creamos el controlador authcontroler con sus metodos....

class AuthController extends Controller
{

    /*Aqui creamos el metodo register donde creamos el usuario
    con sus diferentes validaciones en Validator  */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
             return response()->json($validator->errors());
        }

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password)
        ]);

        //aqui se crea el tokens para acceso al sistema
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer',]);
    }


    //Aqui creamos el metodo para logueo
    public function login(Request $request)
    {

         if(!Auth::attempt($request->only('email', 'password'))){

             return response()
                   ->json(['message' => 'Datos incorrectos'], 401);

         }

         $user = User::where('email', $request['email'])->firstOrFail();

         $token = $user->createToken('auth_token')->plainTextToken;

         return response()->json([
            'message' => 'HI '.$user->name,
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
         ]);




    }

    //Aqui creamos el metodo logout salida del sistema y eliminamos el token
    public function logout()
    {

        auth()->user()->tokens()->delete();

        return ['message' => 'Te has deslogueado y el token fue eliminado'];



    }

}
