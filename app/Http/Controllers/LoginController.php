<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $params = $request->all();

            $input = $request->only('email', 'password');

            $name = $request->only('email');

            if (!$name) {
                return response()->json([
                    "message" => 'Email inválido',
                ], 401);
            }


            $user = User::where('email', $params['email'])->get();

            if ($user) {


                if (!$input = Auth::attempt($input)) {
                    return response()->json([
                        "message" => 'Credenciais invalidas',
                    ], 401);
                }

                $key = 'qoOuaRDNIFzmWYzZsaKWhFc8LP4WncU9Jw2IbJhN';


                $payload = $user;
                $payload['iat'] = time() + 1;
                $payload['exp'] = time() + 10800;
                $jwt = JWT::encode($payload, $key);

                $response = [
                    "type" => 'Bearer',
                    "User" => $user[0]['name'],
                    "token" => $jwt,
                ];

                return response()->json(["data" => $response], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
