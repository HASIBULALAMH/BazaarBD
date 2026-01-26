<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register a new user
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */

     public function __invoke(RegisterRequest $request): JsonResponse
       {

       try{
         $user = User::create([
            'name' => $request ->name,
            'email' => $request ->email,
            'password' => Hash::make($request->password),
            'phone' => $request ->phone,
            'role' => 'customer',
             'status' => 'active',
         ]);


         //device specific token
         $tokenName = $this->generateTokenName($request);

         //create new token (multi-device support)
         $token = $user->createToken($tokenName)->plainTextToken;

        return response()->json([
                'success' => true,
                'message' => 'রেজিস্ট্রেশন সফল হয়েছে | Registration successful',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'role' => $user->role,
                        'status' => $user->status,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
            ], 201);
       }
       catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'রেজিস্ট্রেশন ব্যর্থ | Registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

      //Generate token name based on device/platform
         private function generateTokenName($request): string
    {
        // Get platform from request (web, mobile, admin)
        $platform = $request->input('platform', 'web');

        // Detect device from User-Agent
        $userAgent = $request->header('User-Agent', 'unknown');

        $device = 'web';
        if (str_contains(strtolower($userAgent), 'mobile')) {
            $device = 'mobile';
        } elseif (str_contains(strtolower($userAgent), 'postman')) {
            $device = 'postman';
        } elseif (str_contains(strtolower($userAgent), 'chrome')) {
            $device = 'chrome';
        } elseif (str_contains(strtolower($userAgent), 'firefox')) {
            $device = 'firefox';
        } elseif (str_contains(strtolower($userAgent), 'safari')) {
            $device = 'safari';
        }

        // Create unique token name with timestamp
        return sprintf(
            'bazarbd-%s-%s-%s',
            $platform,
            $device,
            now()->format('YmdHis')
        );
    }
}
