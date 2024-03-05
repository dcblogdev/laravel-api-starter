<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController
{
    public function __invoke(UserStoreRequest $request)
    {
        $user = User::create($request->validated());

        $user->token = $user->createToken('api')->plainTextToken;

        return new UserResource($user);
    }
}