<?php

namespace App\Modules\Users\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Users\Http\Controllers\Contracts\IUserController;
use App\Modules\Users\Services\Concretes\UserService;
use App\Shared\Models\Responses\Concretes\FailedResponse;
use App\Shared\Models\Responses\Concretes\SuccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

abstract class BaseUserController extends BaseController implements IUserController
{
    protected readonly UserService $userService;

    protected array $createRules = [];

    protected array $updateRules = [];

    public function __construct(UserService $service)
    {
        parent::__construct($service, $this->createRules, $this->updateRules);
        $this->userService = $service;
    }

    public function verifyCredentials(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validate->fails()) {
            $response = new FailedResponse(422, 'Invalid email or password', $validate->errors());
            return $response->toResponse();
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->userService->verifyCredentials($email, $password);

        if (!$user) {
            $response = new FailedResponse(401, 'Invalid credentials', null);
            return $response->toResponse();
        }

        $response = new SuccessResponse(200, 'Login successful', $user);
        return $response->toResponse();
    }

    public function me(Request $request)
    {
        $authorization = $request->header('Authorization');

        if (!$authorization) {
            $response = new FailedResponse(401, 'Token no proporcionado', null);
            return $response->toResponse();
        }

        $secret = env('JWT_SECRET');

        $token = JWT::decode($authorization, new Key($secret, 'HS256'));

        $userId = $token->user_id ?? null;
        $tenantId = $token->tenant_id ?? null;

        if (!$userId || !$tenantId) {
            $response = new FailedResponse(401, 'Token incompleto', null);
            return $response->toResponse();
        }

        $user = $this->userService->getBy('id', $userId, true, true, ['tenant_id' => $tenantId]);

        if (!$user) {
            $response = new FailedResponse(404, 'User not found', null);
            return $response->toResponse();
        }

        $response = new SuccessResponse(200, 'User found', $user);
        return $response->toResponse();
    }
}
