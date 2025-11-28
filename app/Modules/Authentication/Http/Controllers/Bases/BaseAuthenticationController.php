<?php

namespace App\Modules\Authentication\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Controller;
use App\Modules\Authentication\Http\Controllers\Contracts\IAuthenticationController;
use App\Modules\Authentication\Services\Concretes\AuthenticationService;
use Illuminate\Http\Request;
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
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $jwt = $this->service->login($email, $password);

        return response()
            ->json(['message' => 'Login exitoso', 'jwt' => $jwt]);
    }
}
