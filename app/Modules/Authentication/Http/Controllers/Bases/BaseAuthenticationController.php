<?php

namespace App\Modules\Authentication\Http\Controllers\Bases;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Http\Controllers\Contracts\IAuthenticationController;
use App\Modules\Authentication\Services\Concretes\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

abstract class BaseAuthenticationController extends Controller implements IAuthenticationController
{
    protected AuthenticationService $service;

    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $jwt = $this->service->login($email, $password);

        return response()
            ->json(['message' => 'Login exitoso'])
            ->cookie(
                'sapiens_360_gwEjbpFRQsyFZm4VVYBTSk5zP7DmM9tpzAAmW1f4FvndB2HvJmyKytdFYkq2bK53',              // nombre
                $jwt,                     // valor
                60 * 24,                    // duración en minutos
                '/',                        // path
                null,                       // dominio (null usa el actual)
                true,                       // secure (true si usas https)
                true,                       // httpOnly
                false,                      // raw
                'None'                      // SameSite: 'Lax', 'Strict', 'None'
            );
    }
}
