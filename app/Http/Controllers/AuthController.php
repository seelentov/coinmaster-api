<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRequest;
use App\Http\Requests\Auth\UpdateAvatarRequest;
use App\Http\Requests\Auth\UpdateExpo;
use App\Http\Requests\Auth\VerifyRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthController extends Controller
{
    use AuthorizesRequests;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(
        private readonly UserRepository $users
    ) {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verify']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['phone', 'password']);

        return (['users' => User::get(), "credentials" => $credentials]);

        $user = $this->users->get('phone', $credentials['phone']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['authorization' => 'Wrong login or password'], 401);
        }

        if (!$user || is_null($user->user_verified_at)) {
            return response()->json(['authorization' => 'Not verified'], 402);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout(true);

        return response()->json(['authorization' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\User\StoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreRequest $request)
    {
        $data = $request->validated();

        $this->users->create($data);
        return response()->json(['authorization' => 'Successfully registered']);
    }

    /**
     * Verify user.
     *
     * @param  \App\Http\Requests\User\VerifyRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function verify(VerifyRequest $request)
    {
        $data = $request->validated();

        if (!$this->users->verify($data['phone'], $data['code'])) {
            return response()->json(['authorization' => 'Bad verify code'], 403);
        }

        return response()->json(['authorization' => 'Successfully verified']);
    }

    /**
     * Update user avatar.
     *
     * @param  \App\Http\Requests\User\UpdateAvatarRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $data = $request->validated();
        $userId = auth()->user()->id;

        $this->users->updateAvatar($userId, $data["avatar"]);

        return response()->json(['authorization' => 'Successfully updated']);
    }

    public function updateExpo(UpdateExpo $request)
    {
        $data = $request->validated();
        $userId = auth()->user()->id;

        $this->users->updateExpo($userId, $data['expo_token']);

        return response()->json(['authorization' => 'Successfully updated']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
