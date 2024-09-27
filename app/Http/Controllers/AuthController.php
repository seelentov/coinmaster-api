<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRequest;
use App\Http\Requests\Auth\UpdateAvatarRequest;
use App\Http\Requests\Auth\UpdateExpo;
use App\Jobs\SendMail;
use App\Mail\VerifierMail;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

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

        $user = $this->users->get('phone', $credentials['phone']);

        if (! $token = auth()->attempt([
            'phone' => $credentials['phone'],
            'password' => $credentials['password']
        ])) {
            return response()->json(['authorization' => __("authorization.WRONG_LOGIN")], 401);
        }

        if (!$user || is_null($user->user_verified_at)) {
            return response()->json(['authorization' => __("authorization.NOT_VERIFIED")], 402);
        }

        if (!$user || !is_null($user->password_reset_token)) {
            return response()->json(['authorization' => __("authorization.PASS_HAS_BEEN_CHANGED")], 402);
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

        return response()->json(['authorization' => __("authorization.LOGGED_OUT")]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(true));
    }

    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\Auth\StoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreRequest $request)
    {
        $data = $request->validated();

        $user = $this->users->create($data);

        if (!$user) {
            return response()->json(['authorization' => __("authorization.ERROR")], 501);
        }

        $activationLink = route('verify', ['token' => $user->activation_token]);

        SendMail::dispatch(
            $user->email,
            new VerifierMail($activationLink)
        );

        return response()->json(['authorization' => __("authorization.REGISTERED")]);
    }

    /**
     * Verify user.
     *
     * @param  Request  $request
     */

    public function verify($token)
    {
        $user = $this->users->validateCode($token);

        if (!$user) {
            return view('message')->with("message", __("authorization.BAD_VERIDY_CODE"));
        }

        return view('message')->with("message", __("authorization.VERIFIED"));
    }

    /**
     * Update user avatar.
     *
     * @param  \App\Http\Requests\Auth\UpdateAvatarRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $data = $request->validated();
        $userId = auth()->user()->id;

        $this->users->updateAvatar($userId, $data["avatar"]);

        return response()->json(['authorization' =>  __("authorization.UPDATED")]);
    }

    public function updateExpo(UpdateExpo $request)
    {
        $data = $request->validated();
        $userId = auth()->user()->id;

        $this->users->updateExpo($userId, $data['expo_token']);

        return response()->json(['authorization' =>  __("authorization.UPDATED")]);
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
