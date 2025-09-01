<?php

namespace App\Modules\Authentication\Services\Bases;

use App\Modules\Authentication\Services\Contracts\IAuthenticationService;
use App\Modules\Users\Services\Concretes\UserService;
use Firebase\JWT\JWT;

abstract class BaseAuthenticationService implements IAuthenticationService
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(string $email, string $password)
    {
        $user = $this->userService->verifyCredentials($email, $password);

        if (!$user) {
            throw new \DomainException('Invalid credentials');
        }

        $payload = [
            'iss' => 'sapiens-360-backend',
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24 * 30),
            'user_id' => $user->id,
            'tenant_id' => $user->tenant_id,
        ];

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }
}
