<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $header = $request->header('Authorization');
        // $login = $request->header('Login');

        $token = str_replace("Bearer ", "", $header);



        if (!$token) {
            return response()->json([
                'message' => 'Token não encontrado.'
            ], 401);
        }

        try {
            $key = env('JWT_SECRET');
            if ($key == null) {
                $key = 'qoOuaRDNIFzmWYzZsaKWhFc8LP4WncU9Jw2IbJhN';
            };
            $credentials = JWT::decode($token, $key, ['HS256']);
        } catch (ExpiredException $e) {

            // User::where('login', $login)->update(['logado' => false]);

            return response()->json([
                'message' => 'O token utilizado expirou. Refaça seu login.'
            ], 401);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Token inválido.'
            ], 401);
        }

        reconnect_data_base(get_connection_client($credentials->login), 'cliente');

        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $credentials;



        return $next($request);
    }
}
