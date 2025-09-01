<?php

namespace App\Modules\Users\Http\Controllers\Bases;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Users\Http\Controllers\Contracts\IUserController;
use App\Modules\Users\Services\Concretes\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            return response()->json(['errors' => $validate->errors()], 422);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->userService->verifyCredentials($email, $password);

        if (!$user) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['user' => $user], 200);
    }
}
