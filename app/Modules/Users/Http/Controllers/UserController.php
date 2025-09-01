<?php

namespace App\Modules\Users\Http\Controllers;

use App\Modules\Users\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tenantId = $request->query('tenant');
        $pageNumber = $request->query('page', 1);
        $pageSize = $request->query('size', 10);

        $data = $this->userService->getAllUsers($tenantId, $pageNumber, $pageSize);

        return response()->json(
            $data,
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tenantId = $request->query('tenant');

        if (!$tenantId) {
            return response()->json(['message' => 'Tenant ID is required'], 400);
        }

        $validate = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'firstnames' => 'required|string|max:255',
                'lastnames' => 'required|string|max:255',
                'shortname' => 'required|string|max:255',
                'code' => 'nullable|string|max:255',
                'ci' => 'required|string|max:255',
                'image_url' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:255',
                'password' => 'required|string|min:8',
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $user = $this->userService->createUser(array_merge(
                $request->all(),
                ['tenant_id' => $tenantId]
            ));
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $userId)
    {
        $tenantId = $request->query('tenant');

        if (!$tenantId) {
            return response()->json(['message' => 'Tenant ID is required'], 400);
        }

        $data = $this->userService->getUserById($tenantId, $userId);

        if (!$data) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $userId)
    {
        $tenantId = $request->query('tenant');

        if (!$tenantId) {
            return response()->json(['message' => 'Tenant ID is required'], 400);
        }

        $validate = Validator::make(
            $request->all(),
            [
                'email' => 'email',
                'firstnames' => 'string|max:255',
                'lastnames' => 'string|max:255',
                'shortname' => 'string|max:255',
                'code' => 'string|max:255',
                'ci' => 'string|max:255',
                'image_url' => 'string|max:255',
                'address' => 'string|max:255',
                'phone' => 'string|max:255',
                'password' => 'string|min:8',
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $updatedUser = $this->userService->updateUser($userId, $tenantId, $request->all());
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json($updatedUser, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId, Request $request)
    {
        $tenantId = $request->query('tenant');

        if (!$tenantId) {
            return response()->json(['message' => 'Tenant ID is required'], 400);
        }

        try {
            $this->userService->deleteUser($userId, $tenantId);
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json("User deleted", 204);
    }

    public function verifyCredentials(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $user = $this->userService->verifyCredentials(
                $request->input('email'),
                $request->input('password')
            );
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }

        return response()->json($user, 200);
    }
}
