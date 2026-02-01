<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            //  CUSTOMER ONLY REGISTER
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password, // hashed by model
                'phone'    => $request->phone,
                'role'     => User::ROLE_CUSTOMER,
                'status'   => User::STATUS_ACTIVE,
            ]);

            $tokenName = $this->generateTokenName($request);
            $token = $user->createToken($tokenName)->plainTextToken;

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'রেজিস্ট্রেশন সফল হয়েছে | Registration successful',
                'data' => [
                    'user' => [
                        'id'     => $user->id,
                        'name'   => $user->name,
                        'email'  => $user->email,
                        'phone'  => $user->phone,
                        'role'   => $user->role,
                        'status' => $user->status,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'রেজিস্ট্রেশন ব্যর্থ | Registration failed',
                'error'   => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    private function generateTokenName(Request $request): string
    {
        $platform = $request->input('platform', 'web');
        $agent = strtolower($request->header('User-Agent', 'web'));

        $device = str_contains($agent, 'mobile') ? 'mobile' : 'web';

        return 'bazaarbd-'.$platform.'-'.$device.'-'.now()->timestamp;
    }
}
