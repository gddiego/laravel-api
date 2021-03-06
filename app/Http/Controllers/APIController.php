<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

class APIController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message'   => 'Sem registros na base dados',
            ], 404);
        }

        return response()->json($user);
    }


    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationFormRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();


        return response()->json([

            'data'      =>  $user,
            'success'   =>  'usuario criado com sucesso'
        ], 200);
    }




    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = Auth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais invalidas',
            ], 401);
        }

        return response()->json([
            'success' => 'login efetuado com sucesso',
            'token' => $token,
        ]);
    }
    public function update(RegistrationFormRequest $request,  $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message'   => 'Sem Registros para serem atualizados',
            ], 404);
        }

        $user->fill($request->all());
        $user->save();

        return response()->json($user);
    }



    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message'   => 'Sem registro para deletar',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message'   => 'Registro deletado com sucesso'
        ]);
    }
}
