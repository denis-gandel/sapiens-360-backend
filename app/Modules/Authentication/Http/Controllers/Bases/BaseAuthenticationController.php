<?php

namespace App\Modules\Authentication\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Controller;
use App\Modules\Authentication\Http\Controllers\Contracts\IAuthenticationController;
use App\Modules\Authentication\Services\Concretes\AuthenticationService;
use App\Shared\Models\Responses\Concretes\FailedResponse;
use App\Shared\Models\Responses\Concretes\SuccessResponse;
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
            $response = new FailedResponse(422, 'Verify the data sent', $validate->errors());
            return $response->toResponse();
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $jwt = $this->service->login($email, $password);

        $response = new SuccessResponse(200, 'Login exitoso', $jwt);
        return $response->toResponse();
    }
}
