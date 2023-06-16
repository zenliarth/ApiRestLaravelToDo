<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);

            $token = $user->createToken(config('app.name'))->plainTextToken;
            $response = [
                'token' => $token,
                'name' => $user->name,
            ];

            return $this->sendResponse($response, 'User registered successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.', ['error' => 'Failed to register user.']);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            /** @var User $user */
            $user = Auth::user();
            $token = $user->createToken(config('app.name'))->plainTextToken;
            $response = [
                'token' => $token,
                'name' => $user->name,
            ];

            return $this->sendResponse($response, 'User login successful.');
        }

        return $this->sendError('Invalid email or password.', ['error' => 'Unauthorized'], 401);
    }

    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $user->tokens()->delete();

        return $this->sendResponse(true, 'User logged out successfully.');
    }
}
