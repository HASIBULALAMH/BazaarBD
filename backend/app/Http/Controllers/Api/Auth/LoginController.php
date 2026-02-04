<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends Controller
{
    //invoke
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        //invalid email or password
        if (! $user || !Hash::check($request->password, $user->password))
            {
                return response()->json([
                    'success' => false,
                    'message' => 'ইমেইল অথবা পাসওয়ার্ড ভুল | Invalid credentials'
                ]);
            }

            //block user
            if ($user->status !== User::STATUS_ACTIVE)
                {
                    return response()->json([
                        'success' => false,
                        'message' => 'আপনার একাউন্ট সক্রিয় নয় | Account inactive',
                     ], 403);
                }

        //token
        $tokenName = "login-web-".now()->timestamp;
        $token = $user->createToken($tokenName)->plainTextToken;

        return response()->json([
            'success' => true,
            'massage' => 'সফলভাবে লগইন হয়েছে | Login successful',
            'data' => [
                'user' =>[
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'status' => $user->status,
                ],
                'token' => $token,
                'token_type' => 'Bearer',
            ],
        ], 200);

    }


}
