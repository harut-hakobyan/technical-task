<?php

namespace app\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller {
    public function login(LoginRequest $request): JsonResponse {
        /** @var User $user */
        $user = User::query()
            ->where('email', $request->get('email'))
            ->first();

        if ($user && Hash::check($request->get('password'), $user->password)) {

            return $this->respond([
                'user' => $user,
                'token' => $user->createToken('token_name')->plainTextToken
            ]);
        }

        return $this->respondError('Email and/or password do not match.', 401, 'password');
    }

    public function register(RegisterRequest $request): JsonResponse {
        DB::beginTransaction();
        try {
            /** @var User $user */
            $user = User::query()->create($request->validated());

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            return $this->respondError('Something went wrong', 500);
        }

        return $this->respond([
            'user' => $user,
            'token' => $user->createToken('token_name')->plainTextToken
        ], 201);
    }
}
