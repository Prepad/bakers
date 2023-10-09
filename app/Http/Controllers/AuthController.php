<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use \Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = '12345678';
        $user->role_id = 1;
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();
        $token = Auth::login($user);
        $refreshToken = $user->createRefreshToken();
        return $this->respondWithToken($token, $refreshToken);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->getCredentials();
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken(Auth::login(Auth::getUser()));
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @param string $token
     * @param string $refreshToken
     * @return JsonResponse
     */
    protected function respondWithToken(string $token, string $refreshToken): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => now()->addMinutes(config('jwt.ttl')),
        ]);
    }

    public function refresh(string $refreshToken)
    {
        /** @var User $user */
        $user = User::whereRefreshToken($refreshToken)->first();

        if (!$user?->verifyRefreshToken($refreshToken)) {
            throw new \Exception('Invalid refresh token');
        }

        return $this->tokenResponse(Auth::login($user), $user->createRefreshToken());
    }
}
